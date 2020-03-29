<?php
// Load config
require_once 'config/config.php';

// Helpers go here
require_once 'helpers/url_redirect.php';
require_once 'helpers/session_helper.php';


// Autoload Core Libries

spl_autoload_register(function ($className) {
    require_once 'libraries/' . $className . '.php';
});
