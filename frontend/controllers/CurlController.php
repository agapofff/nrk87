<?php

namespace frontend\controllers;

use Yii;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use linslin\yii2\curl;

class CurlController extends \yii\web\Controller
{
    
    public function actionIndex($url, $post = null, $params = null, $json = null)
    {
        $curl = new curl\Curl();
        if ($params) {
            if ($post) {
                $curl->setPostParams(Json::decode($params));
            } else {
                $curl->setGetParams(Json::decode($params));
            }
        }
        $response = $post ? $curl->post($url) : $curl->get($url);
        if ($curl->errorCode === null) {
            return $response;
        }
        
        return false;
    }
    
}