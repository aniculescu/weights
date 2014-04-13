<?php

require_once('php/service.php');

$submitWeights = new Weights();

echo "<pre>";
print_r($_GET);
echo "</pre>";

$newWorkout = new Weights();
$newWorkout->addWorkout($_GET);

?>