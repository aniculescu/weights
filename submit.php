<?php

require_once('php/service.php');

$submitWeights = new Weights();


echo "<pre>";
print_r($_POST);
// print_r($weightDropdown);
echo "</pre>";

//$whichService = $_POST['service'];
//$postData = $_POST;

//switch ($whichService) {
//    case 'addWorkout':
//        $newWorkout = new Weights();
//        $newWorkout->addExercise($postData);
//        break;
//    default:
//        break;
//}

$newWorkout = new Weights();
$newWorkout->addWorkout($_POST);

?>