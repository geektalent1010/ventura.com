<?php

if ( ! function_exists('urlHelper')) {
    function urlHelper(): array
    {
        $parsedUrl = [
            'protocol' => '',
            'fullDomain' => '',
            'baseDomain' => '',
            'url' => '',
        ];

        if (isset($_SERVER['HTTP_HOST'])) {
            $host = $_SERVER['HTTP_HOST'];
            $protocol = ( ! empty($_SERVER['HTTPS']) && 'off' !== $_SERVER['HTTPS']) || 443 === $_SERVER['SERVER_PORT'] ? 'https://' : 'http://';

            $hostArray = explode('.', $protocol . $host);
            $baseDomain = $host;

            if (count($hostArray) > 2) {
                $baseDomain = implode('.', [$hostArray[count($hostArray) - 2], $hostArray[count($hostArray) - 1]]);
            }

            $parsedUrl = [
                'protocol' => $protocol,
                'fullDomain' => $host,
                'baseDomain' => $baseDomain,
                'url' => $protocol . $host,
            ];
        }

        return $parsedUrl;
    }
}

if ( ! function_exists('generateAppTitle')) {
    function generateAppTitle($default = 'BUDDIES'): string
    {

        return config('app.name', $default);
    }
}
