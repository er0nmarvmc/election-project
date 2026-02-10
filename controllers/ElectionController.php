<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;
use app\models\PollingUnit;
use app\models\AnnouncedPuResults;
use app\models\Lga;
use app\models\Ward;
use app\models\Party;
use yii\helpers\ArrayHelper;

class ElectionController extends Controller
{
    public function actionPollingUnit($id = null)
    {
        $pollingUnits = PollingUnit::find()->all();
        $selectedPu = null;
        $results = [];

        if ($id) {
            $selectedPu = PollingUnit::findOne(['uniqueid' => $id]);
            if ($selectedPu) {
                $results = AnnouncedPuResults::find()
                    ->where(['polling_unit_uniqueid' => $id])
                    ->all();
            }
        }

        return $this->render('polling_unit', [
            'pollingUnits' => $pollingUnits,
            'selectedPu' => $selectedPu,
            'results' => $results,
        ]);
    }

    public function actionLgaResults($lga_id = null)
    {
        $lgas = Lga::find()->where(['state_id' => 25])->all();
        $selectedLga = null;
        $partyTotals = [];

        if ($lga_id) {
            $selectedLga = Lga::findOne(['lga_id' => $lga_id, 'state_id' => 25]);
            if ($selectedLga) {
                $puIds = PollingUnit::find()
                    ->select('uniqueid')
                    ->where(['lga_id' => $lga_id])
                    ->column();

                if (!empty($puIds)) {
                    $results = AnnouncedPuResults::find()
                        ->select(['party_abbreviation', 'SUM(CAST(party_score AS UNSIGNED)) as party_score'])
                        ->where(['polling_unit_uniqueid' => $puIds])
                        ->groupBy('party_abbreviation')
                        ->asArray()
                        ->all();
                    
                    if (empty($results)) {
                        $lgaResults = (new \yii\db\Query)
                            ->select(['party_abbreviation', 'party_score'])
                            ->from('announced_lga_results')
                            ->where(['lga_name' => (string)$selectedLga->lga_id])
                            ->all();
                        
                        foreach ($lgaResults as $res) {
                            $partyTotals[$res['party_abbreviation']] = $res['party_score'];
                        }
                    } else {
                        foreach ($results as $res) {
                            $partyTotals[$res['party_abbreviation']] = $res['party_score'];
                        }
                    }
                }
            }
        }

        return $this->render('lga_results', [
            'lgas' => $lgas,
            'selectedLga' => $selectedLga,
            'partyTotals' => $partyTotals,
        ]);
    }

    public function actionCreateResult()
    {
        $parties = Party::find()->all();
        $lgas = Lga::find()->where(['state_id' => 25])->all();

        if (Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            $pu_id = $post['polling_unit_id'];
            $scores = $post['party_scores'];

            $transaction = Yii::$app->db->beginTransaction();
            try {
                foreach ($scores as $party_abbr => $score) {
                    $result = new AnnouncedPuResults;
                    $result->polling_unit_uniqueid = $pu_id;
                    $result->party_abbreviation = $party_abbr;
                    $result->party_score = (int)$score;
                    $result->entered_by_user = 'Admin';
                    $result->date_entered = date('Y-m-d H:i:s');
                    $result->user_ip_address = Yii::$app->request->userIP;
                    
                    if (!$result->save()) {
                        throw new \Exception("Failed to save result for party: $party_abbr");
                    }
                }
                $transaction->commit();
                Yii::$app->session->setFlash('success', 'Results stored successfully!');
                return $this->redirect(['polling-unit', 'id' => $pu_id]);
            } catch (\Exception $e) {
                $transaction->rollBack();
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }

        return $this->render('create_result', [
            'parties' => $parties,
            'lgas' => $lgas,
        ]);
    }

    public function actionGetWards($lga_id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $wards = Ward::find()->where(['lga_id' => $lga_id])->all();
        return ArrayHelper::map($wards, 'ward_id', 'ward_name');
    }

    public function actionGetPollingUnits($ward_id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $pus = PollingUnit::find()->where(['ward_id' => $ward_id])->all();
        return ArrayHelper::map($pus, 'uniqueid', 'polling_unit_name');
    }
}
