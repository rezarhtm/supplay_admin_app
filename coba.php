<?php

#$data = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ';
$date = date("Y-m-d");

$act = 'V';
$yy = substr($date, 2, 2);
$mm = substr($date, 5, 2);
#$random = substr(str_shuffle($data), 0, 5);
$random = rand(10000,99999);

echo $act.$yy.$mm.$random;

?>
