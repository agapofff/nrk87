<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use frontend\models\Tests;
use frontend\models\TestQuestions;
use frontend\models\TestAnswers;
use frontend\models\TestPassings;
use frontend\models\TestResults;
use frontend\models\MetaTags;
use yii\web\NotFoundHttpException;

use yii\helpers\ArrayHelper;

class TestController extends \yii\web\Controller
{
    
    public function actionIndex($slug)
    {
        
        $test = Tests::find()
            ->where('slug = :slug', [
                ':slug' => $slug,
            ])
            ->andWhere([
                'active' => 1
            ])
            ->one();
        
        if ($test) {
            
            $meta = MetaTags::find()
                ->where('link = :link', [
                    ':link' => Yii::$app->request->absoluteUrl
                ])
                ->andWhere([
                    'active' => 1
                ])
                ->one();
            
            $answered = false;
            $correct = false;
            $start = true;
            $finish = false;
            $testResult = null;
            $questionID = 0;
            $questionNumber = 0;
            $right = 0;
            $wrong = 0;
            $total = 0;
            
            $questions = TestQuestions::findAll([
                'test_id' => $test->id,
                'active' => 1
            ]);
            
            $questionsIds = ArrayHelper::getColumn($questions, 'id');
            
            $model = new TestPassings();
            
            $model->user_id = Yii::$app->user->id;
            $model->session = Yii::$app->session->getId();
            $model->ip = Yii::$app->request->userIP;
            $model->created_at = $model->updated_at = date('Y-m-d H:i:s');
            
            if ($model->load(Yii::$app->request->post())) {
                if ($model->save()) {
                    $start = false;
                    $answered = true;
                    $model->updated_at = date('Y-m-d H:i:s');
                    $questionID = $model->question_id;
                    if (TestAnswers::findOne($model->answer_id)->correct) {
                        $correct = true;
                    }
                } else {
                    Yii::$app->session->setFlash('error', Yii::t('front', 'Произошла ошибка! Пожалуйста, попробуйте еще раз чуть позже'));
                }
                // return $this->redirect(['index']);
            } else {
                
                $lastUserAnswer = TestPassings::find()
                    ->where([
                        'test_id' => $test->id
                    ])
                    ->andWhere([
                        'OR',
                        ['=', 'user_id', Yii::$app->user->id],
                        ['=', 'session', Yii::$app->session->getId()],
                        ['=', 'ip', Yii::$app->request->userIP]
                    ])
                    ->orderBy([
                        'id' => SORT_DESC
                    ])
                    ->limit(1)
                    ->one();
                    
                if ($lastUserAnswer) {
                    $start = false;
                    foreach ($questionsIds as $key => $id) {
                        if ($id == $lastUserAnswer->question_id) {
                            if ($lastUserAnswer->question_id == end($questionsIds)) {
                                $finish = true;
                            } else {
                                $questionID = $questionsIds[$key+1];
                                break;
                            }
                        }
                    }
                } else {
                    $questionID = $questionsIds[0];
                }
            }
            
                
            $questionNumber = array_search($questionID, $questionsIds) + 1;
            
            $question = \backend\models\TestQuestions::findOne($questionID);
            
            $questionImage = $question ? $question->getImage()->getUrl() : null;
            
            $answers = TestAnswers::findAll([
                'question_id' => $questionID,
                'active' => 1,
            ]);
            
            $rightAnswer = TestAnswers::find()
                ->where([
                    'question_id' => $questionID,
                    'correct' => 1,
                ])
                ->one();
            
            $model->test_id = $test->id;
            $model->question_id = $questionID;
            
            if ($finish) {
                $start = false;
                $allUserAnswers = TestPassings::find()
                    ->where([
                        'test_id' => $test->id
                    ])
                    ->andWhere([
                        'OR',
                        ['=', 'user_id', Yii::$app->user->id],
                        ['=', 'session', Yii::$app->session->getId()],
                        ['=', 'ip', Yii::$app->request->userIP]
                    ])
                    ->orderBy([
                        'id' => SORT_DESC
                    ])
                    ->all();
                    
                $allTestAnswers = TestAnswers::find()->all();
                
                foreach ($allUserAnswers as $userAnswer) {
                    foreach ($allTestAnswers as $testAnswer) {
                        if ($testAnswer->question_id == $userAnswer->question_id && $testAnswer->id == $userAnswer->answer_id) {
                            if ($testAnswer->correct) {
                                $right = $right + 1;
                            } else {
                                $wrong = $wrong + 1;
                            }
                        }
                    }
                }
                
                $total = $right + $wrong;
                
                $results = TestResults::findAll([
                    'test_id' => $test->id,
                    'active' => 1,
                ]);
                
                foreach ($results as $result) {
                    $range = range($result->min, $result->max);
                    if (in_array($right, $range)) {
                        $testResult = $result;
                        break;
                    }
                }

            }
                
            return $this->render('index', [
                'model' => $model,
                'test' => $test,
                'question' => $question,
                'answers' => $answers,
                'answered' => $answered,
                'correct' => $correct,
                'questionNumber' => $questionNumber,
                'rightAnswer' => $rightAnswer,
                'meta' => $meta,
                'slug' => $slug,
                'start' => $start,
                'finish' => $finish,
                'testResult' => $testResult,
                'questionImage' => $questionImage,
                'right' => $right,
                'total' => $total,
            ]);
            
        } else {
            throw new NotFoundHttpException(Yii::t('front', 'Запрашиваемая информация не найдена'));
        }
    }
    
    
    public function actionReset($slug)
    {
        $test = Tests::find()
            ->where('slug = :slug', [
                ':slug' => $slug,
            ])
            ->andWhere([
                'active' => 1
            ])
            ->one();
        
        if ($test) {
            $allUserAnswers = TestPassings::find()
                ->where([
                    'test_id' => $test->id
                ])
                ->andWhere([
                    'OR',
                    ['=', 'user_id', Yii::$app->user->id],
                    ['=', 'session', Yii::$app->session->getId()],
                    ['=', 'ip', Yii::$app->request->userIP]
                ])
                ->orderBy([
                    'id' => SORT_DESC
                ])
                ->all();
                
            if ($allUserAnswers) {
                foreach ($allUserAnswers as $answer) {
                    $answer->delete();
                }
            }
                
            return $this->redirect(['test/' . $slug]);
            
        } else {
            
            throw new NotFoundHttpException(Yii::t('front', 'Запрашиваемая информация не найдена'));
        }
    }
    
}