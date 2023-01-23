<?php

namespace app\models;

use Yii;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\db\Exception;
use yii\db\StaleObjectException;

class News extends ActiveRecord
{
    private ?int $id = null;
    private ?string $creationDateTime = null;
    private ?string $updateDateTime = null;
    private ?int $creatorID = null;
    private ?int $updaterID = null;
    private ?string $title = null;
    private ?string $description = null;
    private ?string $fullNew = null;

    public static function getAllNewsActiveQuery(): ActiveQuery
    {
        return self::find()->select(['id','title','creationDateTime','description'])->orderBy('id');
    }
    public static function getByID($id) : News
    {
        return self::findOne(['id' => $id]);
    }

    /**
     * @throws StaleObjectException
     * @throws \Throwable
     */
    public static function deleteByID(int $id){
        $new = self::getByID($id);
        $new->delete();
    }

    /**
     * @throws Exception
     */
    public static function createNew(int $creatorID, string $title, string $description, string $fullNew){
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

    /**
     * @throws Exception
     */
    public static function updateNew(int $newID, int $updaterID, string $title, string $description, string $fullNew){
        $nowDateTime = date('Y-m-d H:i:s',time() + 60*60*3); // поправка на время в GMT+3
        Yii::$app->db->createCommand()->update('news',[
                'updateDateTime' => $nowDateTime,
                'updaterID' => $updaterID,
                'title' => $title,
                'description' => $description,
                'fullNew' => $fullNew
            ],
            'id = :newID',
            [':newID'=>$newID]
        )->execute();
    }
}