<?php

namespace app\controllers;

use app\models\News;
use app\models\Post;
use app\models\PostForm;
use Yii;
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
            Yii::debug($typeError);
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
        $postForm = new PostForm();
        if($postForm->load(Yii::$app->request->post())){

            if ($postForm->validate()) {
                $session = Yii::$app->session;
                $postID = $id;
                $title = $postForm->title;
                $description = $postForm->description;
                $fullNew = $postForm->fullNew;
                $updaterID = $session['user']['id'];
                News::updateNew($postID,$updaterID,$title,$description,$fullNew);
                $session->setFlash('postOK');
            }
            else{
                Yii::$app->session->setFlash('postERR');
            }
        }
        else{
            $new = News::getByID($id);
            $title = $new->__get('title');
            $description = $new->__get('description');
            $fullNew = $new->__get('fullNew');
            Yii::debug('title '.$title.
                ';desc ' . $description.
                ';fullnew ' . $fullNew
            );
            return $this->render('edit',compact('postForm','title','description','fullNew'));
        }

        return $this->render('edit',compact('postForm'));
    }

    public function actionCreate(){
        $this->view->title = 'Создание новостной записи';
        $postForm = new PostForm();
        if($postForm->load(Yii::$app->request->post())){
            if ($postForm->validate()){
                $session = Yii::$app->session;
                $title = $postForm->title;
                $description = $postForm->description;
                $fullNew = $postForm->fullNew;
                $creatorID = $session['user']['id'];
                News::createNew($creatorID,$title,$description,$fullNew);
                $session->setFlash('postOK');
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