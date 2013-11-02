<?php

require_once('php/service.php');

$submitWeights = new Weights();


echo "<pre>";
print_r($_POST);
// print_r($weightDropdown);
echo "</pre>";

//For each exercise, check if not zero, then commit to db (checking for errors)

$submitWeights->addExercise($_POST(user_id),3,150);

//print_r(Weights);

?>