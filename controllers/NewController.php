<?php

namespace app\controllers;

use app\models\News;
use app\models\NewsForm;
use Yii;
use yii\web\Controller;
use yii\web\Response;

class NewController extends Controller
{
    /**
     * Отображает страницу с постом
     *
     * @param int|null $id
     * @return Response|string
     */
    public function actionIndex(int $id=null): Response|string
    {
        try {
            $new = News::getByID($id);
        }
        catch (\TypeError $typeError){
            Yii::debug($typeError);
            return $this->goHome();
        }
        return $this->render('index',compact(
            'new'
        ));
    }

    /**
     * @param int|null $id
     * @return string
     */
    public function actionEdit(int $id = null): string
    {
        $this->view->title = 'Изменение поста №' .$id;
        $newsForm = new NewsForm();
        if($newsForm->load(Yii::$app->request->post())){

            if ($newsForm->validate()) {
                $session = Yii::$app->session;
                $newID = $id;
                $title = $newsForm->title;
                $description = $newsForm->description;
                $fullNew = $newsForm->fullNew;
                $updaterID = $session['user']['id'];
                News::updateNew($newID,$updaterID,$title,$description,$fullNew);
                $session->setFlash('newOK');
            }
            else{
                Yii::$app->session->setFlash('newERR');
            }
        }
        else{
            $new = News::getByID($id);
            return $this->render('edit',compact('newsForm','new'));
        }

        return $this->render('edit',compact('newsForm'));
    }

    public function actionCreate(): string
    {
        $this->view->title = 'Создание новостной записи';
        $newsForm = new NewsForm();
        if($newsForm->load(Yii::$app->request->post())){
            if ($newsForm->validate()){
                $session = Yii::$app->session;
                $title = $newsForm->title;
                $description = $newsForm->description;
                $fullNew = $newsForm->fullNew;
                $creatorID = $session['user']['id'];
                News::createNew($creatorID,$title,$description,$fullNew);
                $session->setFlash('newOK');
            }
            else{
                Yii::$app->session->setFlash('newERR');
            }
        }
        return $this->render('create',compact('newsForm'));
    }

    public function actionDelete($id = null): Response
    {
        News::deleteByID($id);
        return $this->goHome();
    }
}