<?php
require_once("Config.php");


$user = new User();
$user->login("gabril@gmail.com","123456");
var_dump($user);
?>