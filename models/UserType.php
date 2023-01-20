<?php

namespace app\models;

use yii\db\ActiveRecord;

class UserType extends ActiveRecord
{
    public function getName($id) : ActiveRecord{
        return $this->find()->select(['name'])->where(['id' => $id])->one();
    }
}