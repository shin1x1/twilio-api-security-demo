<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
/**
 * @type \Illuminate\Routing\Router $router
 */

use Psr\Log\LoggerInterface;

$router->get('/', function () {
    return view('welcome');
});

$router->group(['prefix' => 'api', 'middleware' => ['api']], function () use ($router) {
    $router->get('/log_sample', function (LoggerInterface $logger) {
        $logger->info('hoge');
    });
});
