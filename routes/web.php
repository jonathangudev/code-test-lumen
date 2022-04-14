<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/members', function () use ($router) {
    $members = App\Models\Member::all();

    foreach ($members as $member) {
        $member->subscription_name =$member->subscription->name;
        $member->subscription_price = $member->subscription->price;
        unset($member->subscription);
    }

    return response()->json(['error' => false, 'data' => $members]);
});

$router->get('/subscriptions', function () use ($router) {
    $subscriptions = App\Models\Subscription::all();
    return response()->json(['error' => false, 'data' => $subscriptions]);
});

$router->get('/display-members', function () use ($router) {
    return view('display-members');
});