<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class Party extends ActiveRecord
{
    public static function tableName()
    {
        return 'party';
    }

    public function rules()
    {
        return [
            [['partyid', 'partyname'], 'required'],
            [['partyid', 'partyname'], 'string', 'max' => 11],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'partyid' => 'Party ID',
            'partyname' => 'Party Name',
        ];
    }
}
