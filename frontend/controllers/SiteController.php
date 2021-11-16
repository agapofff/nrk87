<?php
namespace frontend\controllers;

// use frontend\models\ResendVerificationEmailForm;
// use frontend\models\VerifyEmailForm;
use Yii;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
// use common\models\LoginForm;
// use frontend\models\PasswordResetRequestForm;
// use frontend\models\ResetPasswordForm;
// use frontend\models\SignupForm;
// use frontend\models\ContactForm;

use dektrium\user\models\Profile;
use dektrium\user\models\User;

use frontend\models\Pages;
use frontend\models\Votes;
use frontend\models\MarsForm;

use backend\models\Boutiques;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->render('index');
        
    }
    
    
    public function actionGps()
    {
        $gps = Pages::findOne([
            'slug' => 'gps'
        ]);
        
        return $this->render('gps', [
            'gps' => $gps,
        ]);
    }
    
    
    public function actionAbout()
    {
        $founder = Pages::findOne([
            'slug' => 'founder'
        ]);
        
        $brand = Pages::findOne([
            'slug' => 'brand'
        ]);
        
        $philosophy = Pages::findOne([
            'slug' => 'philosophy'
        ]);
        
        $ghostDunes = Pages::findOne([
            'slug' => 'ghost-dunes'
        ]);
        
        $olympusVolcano = Pages::findOne([
            'slug' => 'olympus-volcano'
        ]);
        
        $marinerValley = Pages::findOne([
            'slug' => 'valley-mariner'
        ]);

        return $this->render('about', [
            'founder' => $founder,
            'brand' => $brand,
            'philosophy' => $philosophy,
            'ghostDunes' => $ghostDunes,
            'olympusVolcano' => $olympusVolcano,
            'marinerValley' => $marinerValley,
        ]);
    }
    
    
    public function actionVote()
    {
        $question_id = Yii::$app->request->post('question_id');
        $answer_id = Yii::$app->request->post('answer_id');
        $ip = Yii::$app->request->userIP;
        $now = date('Y-m-d H:i:s');

        $voted = Votes::find()
            ->where([
                'question_id' => $question_id,
                'ip' => $ip,
            ])
            ->one();
            
        $model = $voted ?: new Votes();
        
        $model->attributes = [
            'question_id' => $question_id,
            'answer_id' => $answer_id,
            'ip' => $ip,
            'created_at' => $voted ? $model->created_at : $now,
            'updated_at' => $now,
        ];

        if ($model->save()){
			$results = json_encode($model->getResults($question_id));
            $response = [
                'status' => 'success',
                'message' => Yii::t('front', 'Спасибо, Ваш голос принят'),
				'script' => 'showVoteResults(' . $results . ');',
            ];
        } else {
            $response = [
                'status' => 'error',
                'message' => Yii::t('front', 'Произошла ошибка! Пожалуйста, попробуйте еще раз чуть позже'),
            ];
        }
        
        return $this->asJson($response);
    }
    
    
    public function actionFashionShow()
    {
        if (Yii::$app->request->isPost){
            $profile = Profile::findOne([
                'user_id' => Yii::$app->user->id
            ]);
            $profile->lottery = 'on';
            
            if ($profile->save()){
                Yii::$app->session->setFlash('success', Yii::t('front', 'Вы успешно зарегистрировались в конкурсе на посещение показа'));
            } else {
                Yii::$app->session->setFlash('error', Yii::t('front', 'Произошла ошибка! Пожалуйста, попробуйте еще раз чуть позже'));
            }
        }
        
        return $this->render('show-info');
    }
    
    
    public function actionMarsForm()
    {        
        $model = MarsForm::find()
            ->where([
                'OR',
                ['=', 'user_id', Yii::$app->user->id],
                ['=', 'session', Yii::$app->session->getId()],
                ['=', 'ip', Yii::$app->request->userIP]
            ])
            ->one();
        $sent = false;
        if ($model){
            $sent = true;
        } else {
            $model = new MarsForm();

            $model->session = Yii::$app->session->getId();
            $model->ip = Yii::$app->request->userIP;
            $model->created_at = $model->updated_at = date('Y-m-d H:i:s');
            $model->gender = 1;
            
            if (!Yii::$app->user->isGuest){
                $profile = Profile::findOne([
                    'user_id' => Yii::$app->user->id
                ]);
                $model->name = $profile->first_name . ' ' . $profile->last_name;
                $model->gender = $profile->sex;
                $model->email = Yii::$app->user->identity->email;
                $model->user_id = Yii::$app->user->id;
            }
            
            if ($model->load(Yii::$app->request->post())){            
                if ($model->save())
				{
                    $mail = Yii::$app->mailer->compose('@common/mail/registrationToMars', [
                            'model' => $model,   
                        ])
                        ->setFrom([
                            Yii::$app->params['senderEmail'] => Yii::$app->params['senderName']
                        ])
                        ->setTo($model->email)
                        ->setReplyTo(Yii::$app->params['senderEmail'])
                        ->setSubject(Yii::t('front', 'Заявка на участие в экспедиции') . ' - ' . Yii::$app->name)
                        ->send();
						
                    $mail = Yii::$app->mailer->compose()
                        ->setFrom([
                            Yii::$app->params['senderEmail'] => Yii::$app->params['senderName']
                        ])
                        ->setTo(Yii::$app->params['adminEmail'])
                        ->setReplyTo(Yii::$app->params['senderEmail'])
                        ->setSubject(Yii::t('front', 'Заявка на участие в экспедиции') . ' - ' . Yii::$app->name)
                        ->setHtmlBody('
                            <p>Имя: ' . $model->name . '</p>
                            <p>Пол: ' . ($model->gender ? 'Мужской' : 'Женский') . '</p>
                            <p>Страна: ' . $model->country . '</p>
                            <p>Язык: ' . $model->language . '</p>
                            <p>Возраст: ' . $model->age . '</p>
                            <p>E-mail: ' . $model->email . '</p>
                        ')
                        ->send();
                    
                    $sent = true;
                    Yii::$app->session->setFlash('success', Yii::t('front', 'Ваша заявка на участие в экспедиции на Марс была успешно отправлена'));
                } else {
                    Yii::$app->session->setFlash('error', Yii::t('front', 'Произошла ошибка! Пожалуйста, попробуйте еще раз чуть позже'));
                }
            }
        }
        
        return $this->render('mars-form', [
            'model' => $model,
            'sent' => $sent,
        ]);
    }
    
    
    public function actionBoutiques($slug)
    {
        $boutiques = Boutiques::find()
            ->where([
                'active' => 1,
            ])
            ->andWhere('category = :slug', [
                ':slug' => $slug
            ])
            ->all();
        
        return $this->render('boutiques', [
            'boutiques' => $boutiques,
            'category' => $slug,
        ]);
    }
    
    
    public function actionAboutMars()
    {
        return $this->render('about-mars');
    }
	
	
	public function actionLookbook()
	{
		$images = [
			'DSC06241',
			'DSC06129',
			'DSC06141',
			'DSC06169',
			'DSC06303',
			'DSC06235',
			'DSC06151',
			'DSC06361',
			'DSC06112',
			'DSC06322',
			'DSC06121',
			'DSC06138',
			'DSC06428',
			'DSC06274',
			'DSC06178',
			'DSC06102',
			'DSC06373',
			'DSC06397',
			'DSC06436',
			'DSC06312',
			'DSC06183',
			'DSC05999-2',
			'DSC06017',
			'DSC05967',
			'DSC05987',
			'DSC05946',
			'DSC06080',
			'DSC05957',
			'DSC06003',
			'DSC05979',
			'DSC06023',
			'DSC06067',
			'DSC06009',
			'DSC06061',
			'DSC05951',
			'DSC06016',
		];
		
		return $this->render('lookbook', [
			'images' => $images
		]);
	}
    
    
    
    public function actionCookiesNotificationShown()
    {
        Yii::$app->session->set('cookiesNotificationShown', true);
        return true;
    }
    
	
	public function actionSitemap()
	{
		$categories = \dvizh\shop\models\Category::buildTree(true);
		return $this->render('sitemap', [
			'categories' => $categories,
		]);
	}
	
    
    // public function actionError() {
        // $exception = Yii::$app->errorHandler->exception;
        // if ($exception !== null){
            // return $this->render('error', [
                // 'exception' => $exception
            // ]);
        // }
    // }

    

    /**
     * Logs in a user.
     *
     * @return mixed
     */
     /*
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            $model->password = '';

            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }
    */

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
     /*
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
    */

    /**
     * Displays contact page.
     *
     * @return mixed
     */
     /*
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }
    */

    /**
     * Displays about page.
     *
     * @return mixed
     */




    /**
     * Signs user up.
     *
     * @return mixed
     */
     /*
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post()) && $model->signup()) {
            Yii::$app->session->setFlash('success', 'Thank you for registration. Please check your inbox for verification email.');
            return $this->goHome();
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }
    */

    /**
     * Requests password reset.
     *
     * @return mixed
     */
     /*
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }
    */

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
     /*
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }
    */

    /**
     * Verify email address
     *
     * @param string $token
     * @throws BadRequestHttpException
     * @return yii\web\Response
     */
     /*
    public function actionVerifyEmail($token)
    {
        try {
            $model = new VerifyEmailForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
        if ($user = $model->verifyEmail()) {
            if (Yii::$app->user->login($user)) {
                Yii::$app->session->setFlash('success', 'Your email has been confirmed!');
                return $this->goHome();
            }
        }

        Yii::$app->session->setFlash('error', 'Sorry, we are unable to verify your account with provided token.');
        return $this->goHome();
    }
    */

    /**
     * Resend verification email
     *
     * @return mixed
     */
     /*
    public function actionResendVerificationEmail()
    {
        $model = new ResendVerificationEmailForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');
                return $this->goHome();
            }
            Yii::$app->session->setFlash('error', 'Sorry, we are unable to resend verification email for the provided email address.');
        }

        return $this->render('resendVerificationEmail', [
            'model' => $model
        ]);
    }
    */

}
