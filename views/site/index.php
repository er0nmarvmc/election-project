<?php
use yii\helpers\Url;
use yii\helpers\Html;

/** @var yii\web\View $this */

$this->title = 'Delta State Election Portal';
?>
<div class="site-index">

    <div class="jumbotron text-center bg-transparent mt-5 mb-5">
        <h1 class="display-4">Election Results Portal</h1>
        <p class="lead">Delta State Election Management System</p>
    </div>

    <div class="body-content">
        <div class="row">
            <!-- Question 1 -->
            <div class="col-lg-4 mb-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-body text-center">
                        <h2 class="card-title h4">Polling Unit Results</h2>
                        <p class="card-text">View individual results for any polling unit across the state.</p>
                        <a class="btn btn-primary" href="<?= Url::to(['election/polling-unit']) ?>">View Results &raquo;</a>
                    </div>
                </div>
            </div>

            <!-- Question 2 -->
            <div class="col-lg-4 mb-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-body text-center">
                        <h2 class="card-title h4">LGA Summed Results</h2>
                        <p class="card-text">Check the total summed results for all polling units within an LGA.</p>
                        <a class="btn btn-success" href="<?= Url::to(['election/lga-results']) ?>">LGA Totals &raquo;</a>
                    </div>
                </div>
            </div>

            <!-- Question 3 -->
            <div class="col-lg-4 mb-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-body text-center">
                        <h2 class="card-title h4">Add New Result</h2>
                        <p class="card-text">Enter and store results for all parties at a new polling unit.</p>
                        <a class="btn btn-info text-white" href="<?= Url::to(['election/create-result']) ?>">Add Result &raquo;</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .card {
        transition: transform 0.2s;
        border: none;
        background: #f8f9fa;
    }
    .card:hover {
        transform: translateY(-5px);
    }
    .jumbotron h1 {
        font-weight: 700;
        color: #2c3e50;
    }
</style>
