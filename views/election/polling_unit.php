<?php
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Polling Unit Results';
?>
<div class="election-polling-unit">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-md-4">
            <div class="list-group">
                <h4>Select Polling Unit</h4>
                <?php foreach ($pollingUnits as $pu): ?>
                    <a href="<?= Url::to(['election/polling-unit', 'id' => $pu->uniqueid]) ?>" 
                       class="list-group-item <?= ($selectedPu && $selectedPu->uniqueid == $pu->uniqueid) ? 'active' : '' ?>">
                        <?= Html::encode($pu->polling_unit_name) ?>
                        (<?= Html::encode($pu->polling_unit_number) ?>)
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="col-md-8">
            <?php if ($selectedPu): ?>
                <h3>Results for: <?= Html::encode($selectedPu->polling_unit_name) ?></h3>
                <p><strong>LGA:</strong> <?= $selectedPu->lga ? Html::encode($selectedPu->lga->lga_name) : 'N/A' ?></p>
                <p><strong>Ward:</strong> <?= $selectedPu->ward ? Html::encode($selectedPu->ward->ward_name) : 'N/A' ?></p>
                
                <?php if (!empty($results)): ?>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Party</th>
                                <th>Score</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($results as $result): ?>
                                <tr>
                                    <td><?= Html::encode($result->party_abbreviation) ?></td>
                                    <td><?= Html::encode($result->party_score) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <div class="alert alert-warning">No results found for this polling unit.</div>
                <?php endif; ?>
            <?php else: ?>
                <div class="alert alert-info">Please select a polling unit from the list on the left.</div>
            <?php endif; ?>
        </div>
    </div>
</div>
