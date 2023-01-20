<?php

namespace app\models;

use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

class News extends ActiveRecord
{
    public function getAllNewsActiveQuery(): ActiveQuery
    {
        return $this->find()->select(['id','title','creation_datetime','description'])->orderBy('id');
    }
    public function getByID($id) : ActiveRecord
    {
        return $this->find()->where(['id' => $id])->one();
    }
}