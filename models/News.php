<?php

namespace app\models;

use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

class News extends ActiveRecord
{
    private $id;
    private $creationDateTime;
    private $updateDateTime;
    private $creatorID;
    private $updaterID;
    private $title;
    private $description;
    private $fullNew;
    public static function getAllNewsActiveQuery(): ActiveQuery
    {
        return self::find()->select(['id','title','creationDatetime','description'])->orderBy('id');
    }
    public static function getByID($id) : ActiveRecord
    {
        return self::findOne(['id' => $id]);
    }

    public static function deleteByID($id){
        $new = self::getByID($id);
        $new->delete();
    }

    public static function createNew($creatorID,$updaterID,$title,$description,$fullNew){
        //
    }
}