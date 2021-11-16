<?php

namespace backend\controllers;

use Yii;
use backend\models\Common;
use backend\models\CommonSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * CommonController implements the CRUD actions for Common model.
 */
class CommonController extends Controller
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
     * Updates an existing Common model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionIndex()
    {
        $model = $this->findModel(1);

        if ($model->load(Yii::$app->request->post())){
            
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
            $model->backgroundFile = UploadedFile::getInstance($model, 'backgroundFile');
            
            $images = [];
            if ($model->imageFile) $images['image'] = $model->imageFile;
            if ($model->backgroundFile) $images['background'] = $model->backgroundFile;

            if (!empty($images)){
                foreach ($images as $key => $image){
                    $fileName = md5(date('YmdHis').rand(111,999));
                    switch ($key){
                        case 'image': $folder = 'main/'; break;
                        case 'background': $folder = 'backgrounds/'; break;
                        default: $folder = ''; break;
                    }
                    if ($model->upload($fileName, $key)){
                        $model->{$key} = '/images/' . $folder . $fileName . '.' . $model->{$key.'File'}->extension;
                    } else {
                        Yii::$app->session->setFlash('danger', Yii::t('back', 'Ошибка загрузки изображения'));
                    }
                    $model->{$key.'File'} = null;
                }
            }
            
            if ($model->save()){
                Yii::$app->session->setFlash('success', Yii::t('back', 'Изменения сохранены'));
            } else {
                Yii::$app->session->setFlash('danger', Yii::t('back', 'Ошибка сохранения'));
            }
            // return $this->refresh();
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Finds the Common model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Common the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Common::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('back', 'The requested page does not exist.'));
    }
}
