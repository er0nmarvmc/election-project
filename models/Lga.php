<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class Lga extends ActiveRecord
{
    public static function tableName()
    {
        return 'lga';
    }

    public function rules()
    {
        return [
            [['lga_id', 'lga_name', 'state_id', 'entered_by_user', 'date_entered', 'user_ip_address'], 'required'],
            [['lga_id', 'state_id'], 'integer'],
            [['lga_description'], 'string'],
            [['date_entered'], 'safe'],
            [['lga_name', 'entered_by_user', 'user_ip_address'], 'string', 'max' => 50],
        ];
    }

    public function attributeLabels()
    {
        return [
            'uniqueid' => 'Unique ID',
            'lga_id' => 'LGA ID',
            'lga_name' => 'LGA Name',
            'state_id' => 'State ID',
            'lga_description' => 'LGA Description',
            'entered_by_user' => 'Entered By User',
            'date_entered' => 'Date Entered',
            'user_ip_address' => 'User IP Address',
        ];
    }

    public function getPollingUnits()
    {
        return $this->hasMany(PollingUnit::class, ['lga_id' => 'lga_id']);
    }
}
