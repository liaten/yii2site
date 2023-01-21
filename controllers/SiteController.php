<?php

namespace app\controllers;

use app\models\Curl;
use app\models\News;
use Yii;
use yii\data\Pagination;
use yii\web\Controller;

class SiteController extends Controller
{

    /**
     * {@inheritdoc}
     */
    public function actions(): array
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
        $title = 'Новости';
        $allNewsActiveQuery = News::getAllNewsActiveQuery();
        $pagination = new Pagination([
            'defaultPageSize' => 5,
            'totalCount' => $allNewsActiveQuery->count(),
        ]);
        $allNews = $allNewsActiveQuery
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();
        $session = Yii::$app->session;
        $nowTimeInHours = intval(time() / 60 / 60);
        if($nowTimeInHours > $session['weatherUpdateTimeInHours']){
            $IPInfo = Curl::executeJSON('https://ipinfo.io');
            $city = $IPInfo['city'];
            $lang = strtolower($IPInfo['country']);
            $session['weather'] = Curl::execute('https://wttr.in/'.$city.'?0T&lang='.$lang);
            $session['weatherUpdateTimeInHours'] = $nowTimeInHours;
        }
        return $this->render('index',compact('allNews','pagination', 'title'));
    }
}
