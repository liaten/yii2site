<?php

namespace app\models;

use yii\base\Model;

class NewsForm extends Model
{
    public ?int $id = null;
    public ?string $title = null;
    public ?string $description = null;
    public ?string $fullNew = null;

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