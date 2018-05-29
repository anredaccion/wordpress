<?php

function anred_keep_alive($headers, $wp) {
    foreach ($headers as $key => $value) {
        if ('connection' === strtolower($key)) {
            unset($headers[$key]);
        }
    }

    $headers['Connection'] = 'Keep-Alive';

    return $headers;
}

add_filter('wp_headers', 'anred_keep_alive', 10, 2);