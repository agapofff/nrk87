<?php

namespace backend\controllers;

use Yii;
use backend\models\Langs;
use backend\models\Tests;
use backend\models\TestResults;
use backend\models\TestResultsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TestResultsController implements the CRUD actions for TestResults model.
 */
class TestResultsController extends Controller
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
     * Lists all TestResults models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TestResultsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        $tests = Tests::find()->all();
        
        $languages = Langs::find()->all();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'tests' => $tests,
            'languages' => $languages,
        ]);
    }

    /**
     * Displays a single TestResults model.
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
     * Creates a new TestResults model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TestResults();
        
        $tests = Tests::find()->all();
        
        $languages = Langs::find()->all();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                Yii::$app->session->setFlash('success', Yii::t('back', 'Элемент успешно создан'));
            } else {
                Yii::$app->session->setFlash('danger', Yii::t('back', 'Ошибка создания элемента'));
            }
            return $this->redirect(['index']);
        }
        
        $model->active = 1;
        $model->created_at = $model->updated_at = date('Y-m-d H:i:s');
        $model->min = 0;
        $model->max = 1;

        return $this->render('create', [
            'model' => $model,
            'tests' => $tests,
            'languages' => $languages,
        ]);
    }

    /**
     * Updates an existing TestResults model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        
        $tests = Tests::find()->all();
        
        $languages = Langs::find()->all();
        
        $model->updated_at = date('Y-m-d H:i:s');

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
            'tests' => $tests,
            'languages' => $languages,
        ]);
    }

    /**
     * Deletes an existing TestResults model.
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
     * Finds the TestResults model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TestResults the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TestResults::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
    
    
    public function actionActive($id)
    {
        $model = $this->findModel($id);
        $model->active = $model->active ? 0 : 1;
        
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
