<?php

use App\Models\User;
use Spark\Features;

return [

    /*
    |--------------------------------------------------------------------------
    | Spark Path
    |--------------------------------------------------------------------------
    |
    | This configuration option determines the URI at which the Spark billing
    | portal is available. You are free to change this URI to a value that
    | you prefer. You shall link to this location from your application.
    |
    */

    'path' => 'subscription',

    /*
    |--------------------------------------------------------------------------
    | Spark Middleware
    |--------------------------------------------------------------------------
    |
    | These are the middleware that requests to the Spark billing portal must
    | pass through before being accepted. Typically, the default list that
    | is defined below should be suitable for most Laravel applications.
    |
    */

    'middleware' => ['web', 'auth'],

    /*
    |--------------------------------------------------------------------------
    | Branding
    |--------------------------------------------------------------------------
    |
    | These configuration values allow you to customize the branding of the
    | billing portal, including the primary color and the logo that will
    | be displayed within the billing portal. This logo value must be
    | the absolute path to an SVG logo within the local filesystem.
    |
    */

    'brand' =>  [
        // 'logo' => realpath(__DIR__.'/../public/svg/billing-logo.svg'),
        'color' => 'bg-green-700',
    ],

    /*
    |--------------------------------------------------------------------------
    | Proration Behavior
    |--------------------------------------------------------------------------
    |
    | This value determines if charges are prorated when making adjustments
    | to a plan such as incrementing or decrementing the quantity of the
    | plan. This also determines proration behavior if changing plans.
    |
    */

    'prorates' => true,

    /*
    |--------------------------------------------------------------------------
    | Features
    |--------------------------------------------------------------------------
    |
    | Some of Spark's features are optional. You may disable the features by
    | removing them from this array. By removing features from this array
    | you can customize your Spark experience for your own application.
    |
    */

    'features' => [
        Features::billingAddressCollection(),
        Features::mustAcceptTerms(),
        // Features::euVatCollection(['home-country' => 'BE']),
        Features::receiptEmails(['custom-addresses' => true]),
        Features::paymentNotificationEmails(),
    ],


    /*
    |--------------------------------------------------------------------------
    | Receipt Configuration
    |--------------------------------------------------------------------------
    |
    | The following configuration options allow you to configure the data that
    | appears in PDF receipts generated by Spark. Typically, this data will
    | include a company name as well as your company contact information.
    |
    */

    'receipt_data' => [
        'vendor' => 'Homeschool Connections',
        'product' => 'Course Subscription',
        'street' => 'P.O. Box 136',
        'location' => 'Keller, TX 76244',
        'phone' => '1-888-372-4757',
    ],

    /*
    |--------------------------------------------------------------------------
    | Spark Billable
    |--------------------------------------------------------------------------
    |
    | Below you may define billable entities supported by your Spark driven
    | application. The Stripe edition of Spark currently only supports a
    | single billable model entity (team, user, etc.) per application.
    |
    | In addition to defining your billable entity, you may also define its
    | plans and the plan's features, including a short description of it
    | as well as a "bullet point" listing of its distinctive features.
    |
    */

    'billables' => [

        'user' => [
            'model' => User::class,

            'trial_days' => 7,

            'default_interval' => 'monthly',

            'plans' => [
                [
                    'name' => 'Unlimited Access',
                    'short_description' => 'Full access to 300+ recorded courses. It\'s awesome.',
                    'monthly_id' => 'price_1I5x3WC2W0OS1sebmUfWPdjZ',
                    'yearly_id' => 'price_1I5x3WC2W0OS1sebcBlbJiQJ',
                    'features' => [
                        'Over 300+ courses',
                        'Free new content',
                        'High quality instruction',
                    ],
                ],
                [
                    'name' => 'Single Access',
                    'short_description' => 'Full access to one recorded course at a time.',
                    'monthly_id' => 'price_1I5x40C2W0OS1sebuWFw4VFj',
                    'features' => [
                        'Low cost',
                        'One recorded course',
                        'High quality instruction'
                    ]
                ]
            ],
        ],
    ]
];
