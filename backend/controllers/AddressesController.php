<?php

namespace backend\controllers;

use Yii;
use backend\models\Addresses;
use backend\models\AddressesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\Langs;
use backend\models\Countries;
use backend\models\Cities;

/**
 * AddressesController implements the CRUD actions for Addresses model.
 */
class AddressesController extends Controller
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
     * Lists all Addresses models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AddressesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        $languages = Langs::find()->all();
        $countries = Countries::find()->all();
        $cities = Cities::find()->all();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'languages' => $languages,
            'countries' => $countries,
            'cities' => $cities,
        ]);
    }

    /**
     * Displays a single Addresses model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Addresses model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Addresses();
        $model->loadDefaultValues();
        $model->ordering = (int) Addresses::find()->max('ordering') + 1;

        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                Yii::$app->session->setFlash('success', Yii::t('back', 'Элемент успешно создан'));
            } else {
                Yii::$app->session->setFlash('danger', Yii::t('back', 'Ошибка создания элемента'));
            }
            return $this->redirect(['index']);
        }
        
        $languages = Langs::find()->all();
        $countries = Countries::find()->all();
        $cities = Cities::find()->all();

        return $this->render('create', [
            'model' => $model,
            'languages' => $languages,
            'countries' => $countries,
            'cities' => $cities,
        ]);
    }

    /**
     * Updates an existing Addresses model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

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
        
        $languages = Langs::find()->all();
        $countries = Countries::find()->all();
        $cities = Cities::find()->all();

        return $this->render('update', [
            'model' => $model,
            'languages' => $languages,
            'countries' => $countries,
            'cities' => $cities,
        ]);
    }

    /**
     * Deletes an existing Addresses model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        if ($this->findModel($id)->delete()) {
            Yii::$app->session->setFlash('success', Yii::t('back', 'Элемент успешно удалён'));
        } else {
            Yii::$app->session->setFlash('danger', Yii::t('back', 'Ошибка удаления элемента'));
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the Addresses model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Addresses the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Addresses::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('back', 'The requested page does not exist.'));
    }
    
    public function actionActive($id)
    {
        $model = $this->findModel($id);
        $model->active = $model->active ? 0 : 1;
        $model->save();
        
        if (!Yii::$app->request->isAjax) {
            return $this->redirect(['index']);
        }
    }
    
    public function actionOrdering($id, $ordering)
    {
        $model = $this->findModel($id);
        $model->ordering = $ordering;
        $model->save();
        return;
    }
}
