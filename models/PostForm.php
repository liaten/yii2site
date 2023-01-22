<?php

namespace app\models;

use yii\base\Model;

class PostForm extends Model
{
    public $id;
    public $title;
    public $description;
    public $fullNew;

    public function attributeLabels(): array
    {
        return [
            'title' =>'Заголовок',
            'description' =>'Описание',
            'fullNew' =>'Подробности'
        ];
    }

    public function rules(): array
    {
        return [
            [['title','description','fullNew'],'required'],
            [['title','description','fullNew'],'trim']
        ];
    }

}