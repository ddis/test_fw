<?php

switch(ENVIRONMENT) {
    case 'dev':
        ini_set('display_errors', 1);
        error_reporting(E_ALL);
        break;

    case 'production':
        ini_set('display_errors', 0);
        error_reporting(0);
        break;
}

require_once 'routs.php';
