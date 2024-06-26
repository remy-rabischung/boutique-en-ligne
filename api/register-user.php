<?php

require_once(__DIR__ . '/../utils/Utils.php');
require_once(__DIR__ . '/../classes/Register.php');


$register = new Register();

echo $register->register(Utils::getDataFromRequest());


