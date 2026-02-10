<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class AnnouncedPuResults extends ActiveRecord
{
    public static function tableName()
    {
        return 'announced_pu_results';
    }

    public function rules()
    {
        return [
            [['polling_unit_uniqueid', 'party_abbreviation', 'party_score', 'entered_by_user', 'date_entered', 'user_ip_address'], 'required'],
            [['party_score'], 'integer'],
            [['date_entered'], 'safe'],
            [['polling_unit_uniqueid', 'entered_by_user', 'user_ip_address'], 'string', 'max' => 50],
            [['party_abbreviation'], 'string', 'max' => 10],
        ];
    }

    public function attributeLabels()
    {
        return [
            'result_id' => 'Result ID',
            'polling_unit_uniqueid' => 'Polling Unit Unique ID',
            'party_abbreviation' => 'Party Abbreviation',
            'party_score' => 'Party Score',
            'entered_by_user' => 'Entered By User',
            'date_entered' => 'Date Entered',
            'user_ip_address' => 'User IP Address',
        ];
    }

    public function getPollingUnit()
    {
        return $this->hasOne(PollingUnit::class, ['uniqueid' => 'polling_unit_uniqueid']);
    }
}
