<?php

namespace app\models;

use Yii;
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
        return self::find()->select(['id','title','creationDateTime','description'])->orderBy('id');
    }
    public static function getByID($id) : ActiveRecord
    {
        return self::findOne(['id' => $id]);
    }

    public static function deleteByID($id){
        $new = self::getByID($id);
        $new->delete();
    }

    public static function createNew($creatorID,$title,$description,$fullNew){
        $nowDateTime = date('Y-m-d H:i:s',time() + 60*60*3); // поправка на время в GMT+3
        Yii::$app->db->createCommand()->insert('news',[
                'creationDateTime' => $nowDateTime,
                'updateDateTime' => $nowDateTime,
                'creatorID' => $creatorID,
                'updaterID' => $creatorID,
                'title' => $title,
                'description' => $description,
                'fullNew' => $fullNew
            ]
        )->execute();
    }

    public static function updateNew($postID,$updaterID,$title,$description,$fullNew){
        $nowDateTime = date('Y-m-d H:i:s',time() + 60*60*3); // поправка на время в GMT+3
        $update_command = Yii::$app->db->createCommand()->update('news',[
                'updateDateTime' => $nowDateTime,
                'updaterID' => $updaterID,
                'title' => $title,
                'description' => $description,
                'fullNew' => $fullNew
            ],
            'id = :postID',
            [':postID'=>$postID]
        );
        $update_command->execute();
    }
}