<?php
error_reporting(E_ALL|E_NOTICE);
session_start();

require_once (__DIR__.'/autoload.php');

require_once(__DIR__.'/routes/api.php');
require_once(__DIR__.'/routes/web.php');