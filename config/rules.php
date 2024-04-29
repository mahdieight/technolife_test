<?php
return [
    'order' => [
        'amount' => [
            'min' => 0,
            'max' => 10000000000,
        ],

        'mobile_number' => [
            'max_digits' => 15,
        ],

        'national_code' => [
            'digits' => 10,
        ],
    ],
];
