<?php

$config = config('orderable-models');

Route::post($config['url'], [
    'middleware' => $config['middleware'],
    'uses' => 'SortController@saveSort',
    'as' => $config['as'],
]);
