<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/deploy-bpmn', [CamundaController::class, 'deployBpmn']);
Route::get('/deployment-list', [CamundaController::class, 'getDeploymentList']);