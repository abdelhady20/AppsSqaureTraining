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

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'resend' => [
        'key' => env('RESEND_KEY'),
    ],

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],

    'unifonic' => [
        'UNIFONIC_BASe_URL' => env('UNIFONIC_BASe_URL', 'https://el.cloud.unifonic.com/rest/SMS/messages'),
        'AppSid' => env('UNIFONIC_APP_SID'),
        'SenderID' => env('UNIFONIC_SENDER_ID'),
    ],
    'api_key' => env('API_KEY'),
    'erp' => [
        'products_url' => env('PRODUCTS_URL', 'http://5.9.55.62:7013/WebSiteInt-RESTWebService-context-root/rest/V1/StItemViewVO?limit=1000000'),
        'categories_url' => env('CATEGORIES_URL', 'http://5.9.55.62:7013/WebSiteInt-RESTWebService-context-root/rest/V1/StCategoryViewVO?limit=1000000'),
        'sub_categories_url' => env('SUB_CATEGORIES_URL', 'http://5.9.55.62:7013/WebSiteInt-RESTWebService-context-root/rest/V1/StCategorySubViewVO?limit=1000000'),
        'governorates_url' => env('GOVERNORATES_URL', 'http://5.9.55.62:7013/WebSiteInt-RESTWebService-context-root/rest/V1/StGovernorateVO?limit=1000000'),
        'cities_url' => env('CITIES_URL', 'http://5.9.55.62:7013/WebSiteInt-RESTWebService-context-root/rest/V1/StCitiesVO?limit=1000000'),
        'branches_url' => env('BRANCHES_URL', 'http://5.9.55.62:7013/WebSiteInt-RESTWebService-context-root/rest/V1/StStoreViewVO?limit=1000000'),
        'brands_url' => env('BRANDS_URL', 'http://5.9.55.62:7013/WebSiteInt-RESTWebService-context-root/rest/V1/StBrandViewVO?limit=1000000'),
        'quantities_url' => env('QUANTITY_URL', 'http://5.9.55.62:7013/WebSiteInt-RESTWebService-context-root/rest/V1/StItemBalOnlineVO?limit=1000000'),
    ],
    'hyperpay' => [
        'HYPERPAY_BASE_URL' => env('HYPERPAY_BASE_URL', "https://eu-test.oppwa.com"),
        'HYPERPAY_URL' => env('HYPERPAY_URL', env('HYPERPAY_BASE_URL') . "/v1/checkouts"),
        'HYPERPAY_TOKEN' => env('HYPERPAY_TOKEN'),
        'HYPERPAY_CREDIT_ID' => env('HYPERPAY_CREDIT_ID'),
        'HYPERPAY_MADA_ID' => env('HYPERPAY_MADA_ID'),
        'HYPERPAY_APPLE_ID' => env('HYPERPAY_APPLE_ID'),
        'HYPERPAY_CURRENCY' => env('HYPERPAY_CURRENCY', "SAR"),
        'VERIFY_ROUTE_NAME' => "verify-payment",
        'APP_NAME' => env('APP_NAME'),
    ],
    // firebase
    'project_id' => env('FIREBASE_PROJECT_ID'),
    'google' => [
        'maps_api_key' => env('GOOGLE_MAPS_API_KEY'),
    ],
    'samsa' => [
        'api_url' => env('SAMSHA_API_URL'),
        'api_key' => env('SAMSHA_API_KEY'),
        'service_code' => env('SAMSA_DEFAULT_SERVICE_CODE', 'EDDL'),
        'currency' => env('SAMSA_DEFAULT_CURRENCY', 'SAR'),
        'weight_unit' => env('SAMSA_DEFAULT_WEIGHT_UNIT', 'GM'),
    ]

];
