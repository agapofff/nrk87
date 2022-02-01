<?php

namespace backend\controllers;

use Yii;
use backend\models\ScanToWinCodes;
use backend\models\ScanToWinCodesSearch;
use backend\models\User;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class ScanToWinCodesController extends Controller
{

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $searchModel = new ScanToWinCodesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        $users = User::find()->asArray()->all();
        
        $scanToWinCodes = new ScanToWinCodes();
        $codes = ScanToWinCodes::find()->asArray()->all();
        foreach ($codes as $key => $code) {
            $codes[$key]['code'] = $scanToWinCodes->getCode($code['id']);
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'users' => $users,
            'codes' => $codes,
        ]);
    }

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionCreate()
    {
        $model = new ScanToWinCodes();
        $model->status = 1;
        $model->created_at = $model->updated_at = date('Y-m-d H:i:s');
        
        $users = User::find()->asArray()->all();

        if ($model->load(Yii::$app->request->post())) {
            if ($checkOrder = $model->checkOrder($model->order_id)) {
                $checkOrder = json_decode($checkOrder);
                if ($checkOrder->status == 'success') {
                    $quantity = 0;
                    $response = $checkOrder->message;
                    
                    if (isset($response->content)) {
                        foreach ($response->content as $content) {
                            $quantity += $content->quantity;
                        }
                    }

                    for ($i = 0; $i < $quantity; $i++) {
                        $code = new ScanToWinCodes();
                        $code->user_id = Yii::$app->user->id;
                        $code->status = 1;
                        $code->order_id = $model->order_id;
                        $code->created_at = $code->updated_at = date('Y-m-d H:i:s');
                        $code->save();
                    }
                    
                    Yii::$app->session->setFlash('success', Yii::t('front', 'Заказ успешно добавлен и будет участвовать в розыгрышах призов'));
                    return $this->redirect(['index']);
                } else {
                    Yii::$app->session->setFlash('error', $checkOrder->message);
                    if ($checkOrder->code == 2) {
                        $orderNotFound = true;
                    }
                }
            } else {
                Yii::$app->session->setFlash('error', Yii::t('front', 'Ошибка сервера! Попробуйте ещё раз чуть позже'));
            }
        }
        
        return $this->render('create', [
            'model' => $model,
            'users' => $users,
        ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        
        $users = User::find()->asArray()->all();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                Yii::$app->session->setFlash('success', Yii::t('back', 'Изменения сохранены'));
            } else {
                Yii::$app->session->setFlash('danger', Yii::t('back', 'Ошибка сохранения'));
            }

            if ($model->saveAndExit) {
                return $this->redirect(['index']);
            }
        }

        return $this->render('update', [
            'model' => $model,
            'users' => $users,
        ]);
    }

    public function actionDelete($id)
    {
        if ($this->findModel($id)->delete()) {
            Yii::$app->session->setFlash('success', Yii::t('back', 'Элемент успешно удалён'));
        } else {
            Yii::$app->session->setFlash('danger', Yii::t('back', 'Ошибка удаления элемента'));
        }

        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        if (($model = ScanToWinCodes::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
    
    
    public function actionActive($id)
    {
        $model = $this->findModel($id);
        $model->status = $model->status ? 0 : 1;
        
        if ($model->save()) {
            Yii::$app->session->setFlash('success', Yii::t('back', 'Изменения сохранены'));
        } else {
            Yii::$app->session->setFlash('danger', Yii::t('back', 'Ошибка сохранения'));
        }

        if (Yii::$app->request->isAjax) {
            $this->actionIndex();
        } else {
            return $this->redirect(['index']);
        }
    } 
}
