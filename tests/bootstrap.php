<?php

$includePath = explode(PATH_SEPARATOR, get_include_path());
$includePath[] = realpath(dirname(__FILE__)) . '/../library';
set_include_path(implode(PATH_SEPARATOR, $includePath));

require_once 'Midday/AutoLoader.php';
