<?php
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'LGA Summed Results';
?>
<div class="election-lga-results">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-md-12">
            <form method="get" action="<?= Url::to(['election/lga-results']) ?>" class="form-inline mb-4">
                <input type="hidden" name="r" value="election/lga-results">
                <div class="form-group">
                    <label for="lga_id">Select Local Government: </label>
                    <select name="lga_id" id="lga_id" class="form-control mx-sm-3" onchange="this.form.submit()">
                        <option value="">-- Select LGA --</option>
                        <?php foreach ($lgas as $lga): ?>
                            <option value="<?= $lga->lga_id ?>" <?= ($selectedLga && $selectedLga->lga_id == $lga->lga_id) ? 'selected' : '' ?>>
                                <?= Html::encode($lga->lga_name) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </form>

            <?php if ($selectedLga): ?>
                <h3>Summed Results for LGA: <?= Html::encode($selectedLga->lga_name) ?></h3>
                <div class="alert alert-info">
                    Note: These results are calculated by summing up all polling unit results within this LGA.
                </div>

                <?php if (!empty($partyTotals)): ?>
                    <table class="table table-bordered table-striped mt-4">
                        <thead>
                            <tr>
                                <th>Party</th>
                                <th>Total Summed Score</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $grandTotal = 0;
                            foreach ($partyTotals as $party => $total): 
                                $grandTotal += $total;
                            ?>
                                <tr>
                                    <td><strong><?= Html::encode($party) ?></strong></td>
                                    <td><?= number_format($total) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr class="table-dark">
                                <th>GRAND TOTAL</th>
                                <th><?= number_format($grandTotal) ?></th>
                            </tr>
                        </tfoot>
                    </table>
                <?php else: ?>
                    <div class="alert alert-warning">No results found for any polling unit in this LGA.</div>
                <?php endif; ?>
            <?php else: ?>
                <div class="alert alert-info">Please select a Local Government Area to see the summed results.</div>
            <?php endif; ?>
        </div>
    </div>
</div>
