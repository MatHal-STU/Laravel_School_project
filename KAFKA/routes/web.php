<?php

use Illuminate\Support\Facades\Route;
use App\Kafka\Consumer;
use App\Kafka\Producer;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/consume', function (Consumer $consumer) {
    $consumer->consume();
    return 'Consuming messages from Kafka...';
});

Route::get('/produce', function (Producer $producer) {
    $producer->produce('Hello Kafka!');
    return 'Producing message to Kafka...';
});
