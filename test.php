<?php

print "<pre>";
$arr = array(0 => array('pending'   => 0,
                       'completed' => 1,
                       'approved'  => 2,
                        'rejected' => 3),
                        1 => array('pending'   => 0,
                       'completed' => 1,
                       'approved'  => 2,
                        'rejected' => 3), 
                        2=> array('pending'   => 0,
                       'completed' => 1,
                       'approved'  => 2,
                        'rejected' => 3));

var_dump($arr);
echo "<br><br><br>";
$pending   = array();
$completed = array();
$approved  = array();
$rejected  = array();

foreach ($arr as $arr1) {
$pending['pending']     = $pending['pending'] + $arr1['pending'];
$completed['completed'] = $completed['completed'] + $arr1['completed'];
$approved['approved']   = $approved['approved']+$arr1['approved'];
$rejected['rejected']   = $rejected['rejected']+$arr1['rejected']; 
}
var_dump($pending);
var_dump($completed);
var_dump($approved);
var_dump($rejected);
?>
