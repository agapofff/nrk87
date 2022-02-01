<?php

namespace backend\controllers;

use Yii;
use backend\models\ScanToWin;
use backend\models\ScanToWinCodes;
use backend\models\ScanToWinSearch;
use dvizh\shop\models\Product;
use backend\models\User;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class ScanToWinController extends Controller
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
        $searchModel = new ScanToWinSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        $products = Product::find()->all();
        $users = User::find()->asArray()->all();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'products' => $products,
            'users' => $users,
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
        $model = new ScanToWin();
        $model->loadDefaultValues();
        
        $products = Product::find()->asArray()->all();
        $users = User::find()->asArray()->all();
        
        $scanToWinCodes = new ScanToWinCodes();
        $allCodes = ScanToWinCodes::find()->all();
        $codes = [];
        
        foreach ($allCodes as $code) {
            $codes[] = [
                'id' => $code->id,
                'code' => $scanToWinCodes->getCode($code->id)
            ];
        }

        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                Yii::$app->session->setFlash('success', Yii::t('back', 'Элемент успешно создан'));
            } else {
                Yii::$app->session->setFlash('danger', Yii::t('back', 'Ошибка создания элемента'));
            }
            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
            'products' => $products,
            'users' => $users,
            'codes' => $codes,
        ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        
        $products = Product::find()->asArray()->all();
        $users = User::find()->asArray()->all();
        
        $scanToWinCodes = new ScanToWinCodes();
        $allCodes = ScanToWinCodes::find()->all();
        $codes = [];
        foreach ($allCodes as $code) {
            $codes[] = [
                'id' => $code->id,
                'code' => $scanToWinCodes->getCode($code->id)
            ];
        }

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
            'products' => $products,
            'users' => $users,
            'codes' => $codes,
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
        if (($model = ScanToWin::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
