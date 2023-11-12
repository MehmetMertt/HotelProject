<?php

defined('SECURE') or die('Du hast hier leider nichts zu suchen...');

$db_host = 'localhost';
$db_user = 'root';
$db_pw = '';
$db_db = 'hotel';


ini_set('display_errors',true);
//ini_set('display_errors',false);


$db = new mysqli($db_host,$db_user,$db_pw,$db_db);

if($db->connect_error) {
    echo "Connection Error";
    exit();
}




?>