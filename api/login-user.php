<?php

require_once(__DIR__ . '/../utils/Utils.php');
require_once(__DIR__ . '/../classes/Login.php');

$login = new Login();
$login->login(Utils::getDataFromRequest());