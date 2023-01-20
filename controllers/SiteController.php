<?php

namespace app\controllers;

use app\models\News;
use yii\data\Pagination;
use yii\web\Controller;

class SiteController extends Controller
{

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
     * Отображает домашнюю страницу
     *
     * @return string
     */
    public function actionIndex(): string
    {
        $newsObject = new News();
        $allNewsActiveQuery = $newsObject->getAllNewsActiveQuery();
        $pagination = new Pagination([
            'defaultPageSize' => 2,
            'totalCount' => $allNewsActiveQuery->count(),
        ]);
        $allNews = $allNewsActiveQuery
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();
        return $this->render('index',compact('allNews','pagination'));
    }
}
