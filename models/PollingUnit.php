<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class PollingUnit extends ActiveRecord
{
    public static function tableName()
    {
        return 'polling_unit';
    }

    public function rules()
    {
        return [
            [['polling_unit_id', 'ward_id', 'lga_id'], 'required'],
            [['polling_unit_id', 'ward_id', 'lga_id', 'uniquewardid'], 'integer'],
            [['polling_unit_description'], 'string'],
            [['date_entered'], 'safe'],
            [['polling_unit_number', 'polling_unit_name', 'entered_by_user', 'user_ip_address'], 'string', 'max' => 50],
            [['lat', 'long'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'uniqueid' => 'Unique ID',
            'polling_unit_id' => 'Polling Unit ID',
            'ward_id' => 'Ward ID',
            'lga_id' => 'LGA ID',
            'uniquewardid' => 'Unique Ward ID',
            'polling_unit_number' => 'Polling Unit Number',
            'polling_unit_name' => 'Polling Unit Name',
            'polling_unit_description' => 'Polling Unit Description',
            'lat' => 'Lat',
            'long' => 'Long',
            'entered_by_user' => 'Entered By User',
            'date_entered' => 'Date Entered',
            'user_ip_address' => 'User IP Address',
        ];
    }

    public function getResults()
    {
        return $this->hasMany(AnnouncedPuResults::class, ['polling_unit_uniqueid' => 'uniqueid']);
    }

    public function getLga()
    {
        return $this->hasOne(Lga::class, ['lga_id' => 'lga_id']);
    }

    public function getWard()
    {
        return $this->hasOne(Ward::class, ['ward_id' => 'ward_id']);
    }
}
