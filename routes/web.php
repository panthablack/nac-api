<?php

use App\Events\GameJoined;
use App\Events\MessageSent;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', fn() => ['Laravel' => app()->version()]);

require __DIR__ . '/auth.php';
