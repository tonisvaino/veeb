<?php
session_start();
error_reporting(~E_NOTICE & ~E_WARNING);

// config
require_once 'config/config.php';
// helpers
require_once  'helpers/session_helper.php';
require_once  'helpers/url_helper.php';
// libs
require_once 'libs/Core.php';
require_once 'libs/Controller.php';
require_once 'libs/Database.php';