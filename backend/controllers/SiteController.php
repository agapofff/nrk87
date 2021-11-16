<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;

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
                'rules' => [
                    [
                        'actions' => ['login', 'error', 'curl'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index'],
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
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $this->layout = 'blank';

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

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
    
    
    public function actionSaveRedactorImg($sub = 'main')
    {
     
        $this->enableCsrfValidation = false;
        if (Yii::$app->request->isPost) {
            $dir = Yii::getAlias('@storageUrl') . '/' . $sub . '/';
            if (!file_exists($dir)) {
                FileHelper::createDirectory($dir);
            }
     
            $result_link = str_replace('admin', '', Url::home(true)) . 'images' . '/' . $sub . '/';
            $file = UploadedFile::getInstanceByName('file');
            $model = new DynamicModel(compact('file'));
            $model->addRule('file', 'image')->validate();
     
            if ($model->hasErrors()) {
                $result = [
                    'error' => $model->getFirstError('file')
                ];
            } else {
                $model->file->name = strtotime('now') . '_' . Yii::$app->getSecurity()->generateRandomString(6) . '.' .
                    $model->file->extension;
                if ($model->file->saveAs($dir . $model->file->name)) {
                    $imag = Yii::$app->image->load($dir . $model->file->name);
                    $imag->resize(100, NULL, Yii\image\drivers\Image::PRECISE)
                    ->save($dir . $model->file->name, 85);
     
                    $result = ['filelink' => $result_link . $model->file->name, 'filename' => $model->file->name];
                } else {
                    $result = [
                        'error' => Yii::t('back', 'Ошибка загрузки файла')
                    ];
                }
                Yii::$app->response->format = Response::FORMAT_JSON;
                return $result;
            }
        } else {
            throw new BadRequestHttpException('Only Post is allowed');
        }
    }
    
    
    
    public function actionCurl ($url, $post = null, $params = null, $json = null)
    {
        $curl = new \linslin\yii2\curl\Curl();
        if ($params){
            if ($post){
                $curl->setPostParams(\yii\helpers\Json::decode($params));
            } else {
                $curl->setGetParams(\yii\helpers\Json::decode($params));
            }
        }
        $response = $post ? $curl->post($url) : $curl->get($url);
        if ($curl->errorCode === null){
            return $response;
        }
        
        return false;
    }
    
}