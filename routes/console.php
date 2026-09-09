<?php

use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment('Build useful things with care.');
})->purpose('Display a short message');
