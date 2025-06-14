<?php

return [
    'paths' => ['*','api/*', 'sanctum/csrf-cookie','storage/*', 'login', 'logout', 'submit-skin-quiz', 'wishlist'],
    'allowed_methods' => ['*'],
    'allowed_origins' => ['*'], // For development only
    'allowed_origins_patterns' => [],
    'allowed_headers' => ['*'],
    'exposed_headers' => [],
    'max_age' => 0,
    'supports_credentials' => false,
];