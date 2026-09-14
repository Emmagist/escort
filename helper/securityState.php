<?php

    require_once("config/phpMailer.php");

    class SecurityState {
        public static function safeRedirectPath($page_url){
            $page_url = trim($page_url);

            // Empty value
            if ($page_url === '') {
                return '/escort/';
            }

            // Decode once
            $page_url = urldecode($page_url);

            // Reject absolute URLs
            if (preg_match('#^[a-z][a-z0-9+\-.]*://#i', $page_url)) {
                return '/escort/';
            }

            // Reject protocol-relative URLs
            if (str_starts_with($page_url, '//')) {
                return '/escort/';
            }

            // Reject backslash-based URLs
            if (str_contains($page_url, '\\')) {
                return '/escort/';
            }

            // Must be a relative path
            if (str_starts_with($page_url, '/')) {
                $page_url = ltrim($page_url, '/');
            }

            // Don't allow another host/domain
            $parts = parse_url($page_url);

            if (isset($parts['host']) || isset($parts['scheme'])) {
                return '/escort/';
            }

            return '/escort/' . $page_url;
        }
    }

    $state = new SecurityState();