<?php

namespace backend\controllers;

use Yii;
use backend\models\Experts;
use backend\models\ExpertsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * ExpertsController implements the CRUD actions for Experts model.
 */
class ExpertsController extends Controller
{
    /**
     * {@inheritdoc}
     */
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

    /**
     * Lists all Experts models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ExpertsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new Experts model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Experts();

        if ($model->load(Yii::$app->request->post())) {
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
            if ($model->imageFile){
                $fileName = md5(date('YmdHis').rand(111,999));
                if ($model->upload($fileName)){
                    $model->image = '/images/experts/' . $fileName . '.' . $model->imageFile->extension;
                } else {
                    Yii::$app->session->setFlash('danger', Yii::t('back', 'Ошибка загрузки изображения'));
                }
                $model->imageFile = null;
            }
            if ($model->save()){
                Yii::$app->session->setFlash('success', Yii::t('back', 'Элемент упсшено создан'));
            } else {
                Yii::$app->session->setFlash('danger', Yii::t('back', 'Ошибка создания элемента'));
            }
            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Experts model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
            if ($model->imageFile){
                $fileName = md5(date('YmdHis').rand(111,999));
                if ($model->upload($fileName)){
                    $model->image = '/images/experts/' . $fileName . '.' . $model->imageFile->extension;
                } else {
                    Yii::$app->session->setFlash('danger', Yii::t('back', 'Ошибка загрузки изображения'));
                }
                $model->imageFile = null;
            }
            if ($model->save()){
                Yii::$app->session->setFlash('success', Yii::t('back', 'Изменения сохранены'));
            } else {
                Yii::$app->session->setFlash('danger', Yii::t('back', 'Ошибка сохранения'));
            }

            if ($model->saveAndExit){
                return $this->redirect(['index']);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Experts model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        if ($this->findModel($id)->delete()){
            Yii::$app->session->setFlash('success', Yii::t('back', 'Элемент успешно удалён'));
        } else {
            Yii::$app->session->setFlash('danger', Yii::t('back', 'Ошибка удаления элемента'));
        }

        return $this->redirect(['index']);
    }
    
    
    
    public function actionPublish($id)
    {
        $model = $this->findModel($id);
        $model->publish = $model->publish ? 0 : 1;
        if ($model->save()){
            Yii::$app->session->setFlash('success', Yii::t('back', 'Изменения сохранены'));
        } else {
            Yii::$app->session->setFlash('danger', Yii::t('back', 'Ошибка сохранения'));
        }

        if (Yii::$app->request->isAjax){
            $this->actionIndex();
        } else {
            return $this->redirect(['index']);
        }
    }

    /**
     * Finds the Experts model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Experts the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Experts::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('back', 'The requested page does not exist.'));
    }
}
