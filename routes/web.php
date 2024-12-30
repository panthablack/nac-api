<?php

use App\Events\GameJoined;
use App\Events\MessageSent;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', fn() => ['Laravel' => app()->version()]);
// Route::get('/', function () {
//     $message = Request::query('message') ?? 'no message found';
//     MessageSent::dispatch($message);
//     return ['message' => "Message sent with following content: $message"];
// });

require __DIR__ . '/auth.php';
