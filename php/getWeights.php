<?php

require_once('service.php');

//header('content-type: application/json; charset=utf-8');



// Create array of all possible exercises with data such as name, reps, exercise ID
$newWorkout = new Weights();
$newWorkout->getAllPrevWeights(1);
// Loop through all exercises based on user ID to last weight lifted to above array

//
//
//@$data->userName = "Russell";
//$data->userArray = array(
//    (object)array('name' => 'Bench Press', 'reps' => '5x5', 'prevWeight' => '150'),
//    (object)array('name' => 'Bench Up', 'reps' => '5x10', 'prevWeight' => '100')
//);
//$json = json_encode($data);
//
//echo isset($_GET['callback'])
//    ? "{$_GET['callback']}($json)"
//    : $json;
//



?>