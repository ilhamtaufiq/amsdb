<?php

if (! function_exists('layoutConfig')) {
    function layoutConfig()
    {
        if (Request::is('app/*')) {
            $__getConfiguration = Config::get('app-config.layout.vlm');
        } elseif (Request::is('modern-dark-menu/*')) {
            $__getConfiguration = Config::get('app-config.layout.vdm');
        } elseif (Request::is('collapsible-menu/*')) {
            $__getConfiguration = Config::get('app-config.layout.cm');
        } elseif (Request::is('horizontal-light-menu/*')) {
            $__getConfiguration = Config::get('app-config.layout.hlm');
        } elseif (Request::is('horizontal-dark-menu/*')) {
            $__getConfiguration = Config::get('app-config.layout.hlm');
        }

        // RTL

        // Login

        elseif (Request::is('login')) {
            $__getConfiguration = Config::get('app-config.layout.vlm');
        } else {
            $__getConfiguration = Config::get('barebone-config.layout.bb');
        }
        if (Request::is('register')) {
            $__getConfiguration = Config::get('app-config.layout.cm-rtl');
        }

        return $__getConfiguration;
    }
}

if (! function_exists('getRouterValue')) {
    function getRouterValue()
    {
        if (Request::is('app/*')) {
            $__getRoutingValue = '/app';
        } elseif (Request::is('modern-dark-menu/*')) {
            $__getRoutingValue = '/modern-dark-menu';
        } elseif (Request::is('collapsible-menu/*')) {
            $__getRoutingValue = '/collapsible-menu';
        } elseif (Request::is('horizontal-light-menu/*')) {
            $__getRoutingValue = '/horizontal-light-menu';
        } elseif (Request::is('horizontal-dark-menu/*')) {
            $__getRoutingValue = '/horizontal-dark-menu';
        } elseif (Request::is('app/*')) {
            $__getRoutingValue = '2022';
        }

        // Login

        elseif (Request::is('login')) {
            $__getRoutingValue = '/app';
        } else {
            $__getRoutingValue = '';
        }

        return $__getRoutingValue;
    }
}
