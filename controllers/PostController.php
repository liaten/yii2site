<?php

namespace app\controllers;

use app\models\News;
use yii\BaseYii;
use yii\web\Controller;

class PostController extends Controller
{
    /**
     * Отображает страницу с постом
     *
     * @param null $id
     */
    public function actionIndex($id=null)
    {
        $news = new News();
        try {
            $new = $news->getByID($id);
        }
        catch (\TypeError $typeError){
            BaseYii::debug($typeError);
            return $this->goHome();
        }
        $creationDateTime = $new->__get('creation_datetime');
        $description = $new->__get('description');
        $fullNew = $new->__get('full_new');
        $title = $new->__get('title');
        return $this->render('index',compact(
            'id',
            'creationDateTime',
            'description',
            'fullNew',
            'title'
        ));
    }
}