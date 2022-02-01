<?php

namespace frontend\controllers;

use Yii;
use backend\models\Common;
use backend\models\Stream;
use backend\models\Countries;
use backend\models\Experts;
use backend\models\Learn;
use backend\models\PastEvents;
use backend\models\Questions;
use backend\models\Answers;
use backend\models\Votes;
use backend\models\VotesSearch;
use backend\models\Registration;
use backend\models\RegistrationSearch;

class WeekendController extends \yii\web\Controller
{
    
    public function actionIndex()
    {
        $this->layout = 'weekend';
        
        $common = Common::findOne(1);
        
        $stream = Stream::findOne(1);
        
        $countries = Countries::find()->all();
        
        $experts = Experts::findAll([
            'publish' => 1
        ]);
        
        $learns = Learn::find()->all();
        
        $questions = Questions::find()->where([
            '>', 'date_end', date('Y-m-d H:i:s')
        ])->one();
        $answers = $questions->answers;
        $votesSearch = new VotesSearch();
        $votes = $votesSearch->getResults([
            'VotesSearch' => [
                'question_id' => $questions->id
            ]
        ]);
        $voted = Votes::find()->where([
            'question_id' => $questions->id,
            'ip' => Yii::$app->request->userIP,
        ])->one();
        
        $pastEvents = PastEvents::find()->orderBy([
            'event_date' => SORT_DESC
        ])->all();
        
        $registration = new Registration();
        
        $vote = new Votes();
        
        return $this->render('index', [
            'common' => $common,
            'stream' => $stream,
            'countries' => $countries,
            'experts' => $experts,
            'learns' => $learns,
            'pastEvents' => $pastEvents,
            'questions' => $questions,
            'answers' => $answers,
            'votes' => $votes,
            'voted' => $voted,
            'vote' => $vote,
            'registration' => $registration,
        ]);
    }
    
    public function actionRegistration()
    {
        $this->layout = 'weekend';
        
        $model = new Registration();
        $countries = Countries::find()->where(['publish' => '1'])->orderBy('name')->all();
        $common = Common::findOne(1);

        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                
                $mail2client = Yii::$app->mailer->compose('registrationClient', [
                        'common' => $common,
                        'name' => $model->name,
                        'client_id' => $model->client_id,
                    ])
                    ->setFrom([
                        Yii::$app->params['senderEmail'] => Yii::$app->params['senderName']
                    ])
                    ->setTo($model->email)
                    ->setReplyTo(Yii::$app->params['senderEmail'])
                    ->setSubject(Yii::t('front', 'Регистрация') . ' - ' . Yii::$app->name)
                    ->send();
                
                $mail2admin = Yii::$app->mailer->compose()
                    ->setFrom([
                        Yii::$app->params['senderEmail'] => Yii::$app->params['senderName']
                    ])
                    ->setTo(Yii::$app->params['adminEmail'])
                    // ->setTo('agapofff@gmail.com')
                    ->setReplyTo(Yii::$app->params['senderEmail'])
                    ->setSubject('Регистрация - ' . Yii::$app->name)
                    ->setHtmlBody('
                        <p>Здравствуйте!</p>
                        <br>
                        <p>Новая регистрация на сайте ' . Yii::$app->request->hostInfo . '</p>
                        <br>
                        <p>ID участника: ' . $model->client_id . '</p>
                        <p>Имя отправителя: ' . $model->name . '</p>
                        <p>Телефон: ' . $model->phone . '</p>
                        <p>E-mail: ' . $model->email . '</p>
                        <p>Промокод: ' . $model->promocode . '</p>
                    ')
                    ->send();
                
                Yii::$app->session->setFlash('success', Yii::t('front', 'Успешная регистрация'));
            } else {
                Yii::$app->session->setFlash('danger', Yii::t('front', 'Ошибка регистрации'));
            }
            // return $this->redirect(['index']);
        }

        return $this->render('registration', [
            'model' => $model,
            'countries' => $countries,
        ]);
    }
    
    public function actionVote()
    {
        $this->layout = 'weekend';
        
        $model = new Votes();
        $questions = Questions::find()->where([
            '>', 'date_end', date('Y-m-d H:i:s')
        ])->one();
        $answers = $questions->answers;
        $votesSearch = new VotesSearch();
        $votes = $votesSearch->getResults([
            'VotesSearch' => [
                'question_id' => $questions->id
            ]
        ]);
        $voted = Votes::find()->where([
            'question_id' => $questions->id,
            'ip' => Yii::$app->request->userIP,
        ])->one();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                Yii::$app->session->setFlash('success', Yii::t('front', 'Спасибо, Ваш голос принят!'));
            } else {
                Yii::$app->session->setFlash('danger', Yii::t('front', 'Проголосовать не удалось. Попробуйте ещё раз чать позже.'));
            }
        }

        return $this->render('_vote', [
            'model' => $model,
            'questions' => $questions,
            'answers' => $answers,
            'voted' => $voted,
            'results' => $votes,
        ]);
    }

}
