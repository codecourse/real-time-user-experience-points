<?php

use App\Points\Actions\SolvedTopic;
use App\User;

Route::get('/', function () {
    $user = User::find(1);

    $user->givePoints(new SolvedTopic());

    dd($user->points()->shorthand());
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
