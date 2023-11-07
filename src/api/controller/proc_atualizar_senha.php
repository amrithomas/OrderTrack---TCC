<?php 
include_once('../../../conection.php');
session_start();
ob_start();

$senha = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
echo "$senha";

?>