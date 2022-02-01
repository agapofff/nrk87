<?php

namespace backend\controllers;

use Yii;
use backend\models\TestAnswers;
use backend\models\TestAnswersSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\Langs;
use backend\models\Tests;
use backend\models\TestQuestions;

class TestAnswersController extends Controller
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
        $searchModel = new TestAnswersSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        $tests = Tests::find()->all();
        
        $questions = TestQuestions::find()->all();
        
        $languages = Langs::find()->all();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'tests' => $tests,
            'questions' => $questions,
            'languages' => $languages,
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
        $model = new TestAnswers();
        
        $tests = Tests::find()->all();
        
        $questions = TestQuestions::find()->orderBy(['id' => SORT_DESC])->all();
        
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

        return $this->render('create', [
            'model' => $model,
            'tests' => $tests,
            'questions' => $questions,
            'languages' => $languages,
        ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        
        $tests = Tests::find()->all();
        
        $questions = TestQuestions::find()->orderBy(['id' => SORT_DESC])->all();
        
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
            'questions' => $questions,
            'languages' => $languages,
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
        if (($model = TestAnswers::findOne($id)) !== null) {
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
    
    
    public function actionCorrect($id)
    {
        $model = $this->findModel($id);
        $model->correct = $model->correct ? 0 : 1;
        
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
