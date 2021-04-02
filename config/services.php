<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],
    'facebook' => [
        'client_id' => '2885020805072226',  //client face của bạn
        'client_secret' => 'fbae94612ea8580b2ba941742169bf4e',  //client app service face của bạn
        'redirect' => 'http://localhost/shopbanhang/admin/callback' //callback trả về
    ],
    'google' => [
        'client_id' => '205505125041-dv0bh8sc2d2jq3p1jl679vakqga9lo29.apps.googleusercontent.com',
        'client_secret' => 'sQu05rkn1SEBYi6g3SNygIUa',
        'redirect' => 'http://localhost/shopbanhang/google/callback'
    ],



];
