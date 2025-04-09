<?php

return [
    'domains' => [
        'example.com' => [
            'blocked_ips' => ['192.168.1.1', '10.0.0.1'],
        ],
        'anotherdomain.com' => [
            'blocked_ips' => ['192.168.2.1'],
        ],
        'some.com' => [
            'blocked_ips' => ['192.168.10.1', '10.0.0.1'],
        ],
    ],
];