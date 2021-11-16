<?php

namespace backend\controllers;

use Yii;
use backend\models\Answers;
use backend\models\AnswersSearch;
use backend\models\Questions;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;


/**
 * AnswersController implements the CRUD actions for Answers model.
 */
class AnswersController extends Controller
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
     * Lists all Answers models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AnswersSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $questions = Questions::find()->asArray()->all();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'questions' => $questions,
        ]);
    }

    /**
     * Creates a new Answers model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Answers();
        $questions = Questions::find()->all();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()){
                Yii::$app->session->setFlash('success', Yii::t('back', 'Элемент успешно создан'));
            } else {
                Yii::$app->session->setFlash('danger', Yii::t('back', 'Ошибка создания элемента'));
            }
            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
            'questions' => $questions
        ]);
    }

    /**
     * Updates an existing Answers model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $questions = Questions::find()->all();

        if ($model->load(Yii::$app->request->post())) {
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
            'questions' => $questions,
        ]);
    }

    /**
     * Deletes an existing Answers model.
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

    /**
     * Finds the Answers model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Answers the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Answers::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('back', 'The requested page does not exist.'));
    }
}
