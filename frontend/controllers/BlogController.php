<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use backend\models\BlogCategories;
use backend\models\Blog;
use backend\models\Langs;

class BlogController extends \yii\web\Controller
{
    
    public function actionIndex()
    {
        $categories = BlogCategories::findAll([
            'active' => 1
        ]);
        
        $posts = Blog::findAll([
            'active' => 1
        ])->orderBy([
            'date_published' => SORT_DESC
        ]);
        
        return $this->render('index', [
            'categories' => $categories,
            'posts' => $posts,
        ]);
    }
    
    public function actionPost($slug)
    {
        $post = Blog::find()
            ->where('slug = :slug', [
                ':slug' => $slug
            ])
            ->andWhere([
                'active' => 1
            ])
            ->one();
            
        return $this->render('post', [
            'model' => $post,
        ]);
    }
    
}
