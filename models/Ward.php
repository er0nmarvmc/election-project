<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class Ward extends ActiveRecord
{
    public static function tableName()
    {
        return 'ward';
    }

    public function rules()
    {
        return [
            [['ward_id', 'ward_name', 'lga_id', 'entered_by_user', 'date_entered', 'user_ip_address'], 'required'],
            [['ward_id', 'lga_id'], 'integer'],
            [['ward_description'], 'string'],
            [['date_entered'], 'safe'],
            [['ward_name', 'entered_by_user', 'user_ip_address'], 'string', 'max' => 50],
        ];
    }

    public function attributeLabels()
    {
        return [
            'uniqueid' => 'Unique ID',
            'ward_id' => 'Ward ID',
            'ward_name' => 'Ward Name',
            'lga_id' => 'LGA ID',
            'ward_description' => 'Ward Description',
            'entered_by_user' => 'Entered By User',
            'date_entered' => 'Date Entered',
            'user_ip_address' => 'User IP Address',
        ];
    }

    public function getPollingUnits()
    {
        return $this->hasMany(PollingUnit::class, ['ward_id' => 'ward_id']);
    }

    public function getLga()
    {
        return $this->hasOne(Lga::class, ['lga_id' => 'lga_id']);
    }
}
