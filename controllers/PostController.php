<?php

namespace app\controllers;

use app\models\News;
use app\models\Post;
use app\models\PostForm;
use Yii;
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
        try {
            $new = News::getByID($id);
        }
        catch (\TypeError $typeError){
            BaseYii::debug($typeError);
            return $this->goHome();
        }
        $creationDateTime = $new->__get('creationDatetime');
        $updateDateTime = $new->__get('updateDatetime');
        $creatorID = $new->__get('creatorID');
        $updaterID = $new->__get('updaterID');
        $description = $new->__get('description');
        $fullNew = $new->__get('fullNew');
        $title = $new->__get('title');
        return $this->render('index',compact(
            'id',
            'creationDateTime',
            'updateDateTime',
            'creatorID',
            'updaterID',
            'description',
            'fullNew',
            'title'
        ));
    }

    public function actionEdit($id = null){
        $this->view->title = 'Изменение поста №' .$id;
        return $this->render('edit');
    }

    public function actionCreate(){
        $this->view->title = 'Создание новостной записи';
        $postForm = new PostForm();
        if($postForm->load(Yii::$app->request->post())){
            if ($postForm->validate()){
                Yii::$app->session->setFlash('postOK');
                $title = $postForm->title;
                $description = $postForm->description;
                $fullNew = $postForm->fullNew;
            }
            else{
                Yii::$app->session->setFlash('postERR');
            }
        }
        return $this->render('create',compact('postForm'));
    }

    public function actionDelete($id = null){
        News::deleteByID($id);
        return $this->goHome();
    }
}