<?php

require_once('service.php');

header('content-type: application/json; charset=utf-8');

// Create array of all possible exercises with data such as name, reps, exercise ID
$newWorkout = new Weights();
$userData = $newWorkout->getAllPrevWeights(1);

// Format JSON or JSONP depending on callback parameter
$json = json_encode($userData);
echo isset($_GET['callback']) ? "{$_GET['callback']}($json)" : $json;

?>