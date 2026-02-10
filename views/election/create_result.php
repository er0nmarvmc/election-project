<?php
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Create New Polling Unit Result';
?>
<div class="election-create-result">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-body">
                    <form method="post" action="<?= Url::to(['election/create-result']) ?>">
                        <?= Html::hiddenInput(Yii::$app->request->csrfParam, Yii::$app->request->csrfToken) ?>
                        
                        <div class="form-group mb-3">
                            <label for="lga_select" class="form-label">Local Government Area (LGA)</label>
                            <select id="lga_select" class="form-control" required>
                                <option value="">-- Select LGA --</option>
                                <?php foreach ($lgas as $lga): ?>
                                    <option value="<?= $lga->lga_id ?>"><?= Html::encode($lga->lga_name) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label for="ward_select" class="form-label">Ward</label>
                            <select id="ward_select" class="form-control" disabled required>
                                <option value="">-- Select Ward --</option>
                            </select>
                        </div>

                        <div class="form-group mb-4">
                            <label for="polling_unit_select" class="form-label">Polling Unit</label>
                            <select id="polling_unit_select" name="polling_unit_id" class="form-control" disabled required>
                                <option value="">-- Select Polling Unit --</option>
                            </select>
                        </div>

                        <hr>
                        <h4>Party Scores</h4>
                        <div class="row">
                            <?php foreach ($parties as $party): ?>
                                <div class="col-md-6 mb-3">
                                    <label for="party_<?= $party->partyid ?>"><?= Html::encode($party->partyname) ?></label>
                                    <input type="number" 
                                           name="party_scores[<?= Html::encode($party->partyid) ?>]" 
                                           id="party_<?= $party->partyid ?>" 
                                           class="form-control" 
                                           min="0" 
                                           required 
                                           placeholder="Enter score for <?= Html::encode($party->partyname) ?>">
                                </div>
                            <?php endforeach; ?>
                        </div>

                        <div class="form-group mt-4">
                            <?= Html::submitButton('Save Results', ['class' => 'btn btn-success btn-lg w-100']) ?>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
$getWardsUrl = Url::to(['election/get-wards']);
$getPuUrl = Url::to(['election/get-polling-units']);

$script = <<<JS
$(function() {
    // LGA change -> Load Wards
    $('#lga_select').on('change', function() {
        var lga_id = $(this).val();
        $('#ward_select').html('<option value="">-- Select Ward --</option>').prop('disabled', true);
        $('#polling_unit_select').html('<option value="">-- Select Polling Unit --</option>').prop('disabled', true);
        
        if (lga_id) {
            $.get('$getWardsUrl', {lga_id: lga_id}, function(data) {
                $.each(data, function(id, name) {
                    $('#ward_select').append($('<option>', {value: id, text: name}));
                });
                $('#ward_select').prop('disabled', false);
            });
        }
    });

    // Ward change -> Load Polling Units
    $('#ward_select').on('change', function() {
        var ward_id = $(this).val();
        $('#polling_unit_select').html('<option value="">-- Select Polling Unit --</option>').prop('disabled', true);
        
        if (ward_id) {
            $.get('$getPuUrl', {ward_id: ward_id}, function(data) {
                $.each(data, function(id, name) {
                    $('#polling_unit_select').append($('<option>', {value: id, text: name}));
                });
                $('#polling_unit_select').prop('disabled', false);
            });
        }
    });
});
JS;
$this->registerJs($script);
?>
