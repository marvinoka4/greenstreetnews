<?php
/*
     Plugin Name: CORS Configuration
     Description: Enables CORS for REST API access from Next.js.
     */
add_filter('wp_headers', function ($headers) {
    $headers['Access-Control-Allow-Origin'] = 'http://localhost:3001';
    $headers['Access-Control-Allow-Methods'] = 'GET,POST,OPTIONS';
    $headers['Access-Control-Allow-Headers'] = 'Authorization,Content-Type';
    return $headers;
});
