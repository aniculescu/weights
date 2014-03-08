<?php
require_once('dbConnect.php');

class Weights
{   
    private $currentDate;
    private $mydb;
    public function __construct(){
        global $__dbConfig;
        $this->currentDate = date("Y-m-d");
        $this->mydb = new Database($__dbConfig["hostname"], $__dbConfig["username"], $__dbConfig["password"], $__dbConfig["dbName"]);
    }

    public function addExercise(){
        // Add a new exercise to the list of exercises
    }

    private function addWeight($user_id, $exercise, $weight, $date){
        // Check to see if date/weight combo already exists
        $checkQuery = "SELECT id FROM schedule WHERE date = '{$date}' AND exercise_id = {$exercise} AND user_id = {$user_id} LIMIT 1";
        $checkResult = $this->mydb->query($checkQuery);
        $checkRows = mysql_fetch_row($checkResult);
                
        if(!$checkRows){
            // If data does not exist, add new row
            $insertQuery = "INSERT INTO schedule (date, user_id, exercise_id, weight) VALUES ('{$date}',{$user_id},{$exercise},{$weight})";
            $this->mydb->query($insertQuery);
        } else {
            // If data exists, update
            $updateQuery = "UPDATE schedule SET weight = {$weight} WHERE id = {$checkRows[0]} LIMIT 1";
            $this->mydb->query($updateQuery);
        }
    }
        
    public function getAllPrevWeights($userId){
        // Grab a list of all exercises
        $allExercisesQuery = "SELECT * FROM exercises ORDER BY id ASC";
        $allExercises = $this->mydb->fetch_all_array($allExercisesQuery);
        if($userId){
            // Find the weight for the last time the specified user performed the exercise
            foreach($allExercises as $key => $exercise){
                $userExerciseQuery = "SELECT * FROM  schedule WHERE user_id = {$userId} AND exercise_id = {$exercise['id']} ORDER BY date DESC LIMIT 1";
                $userExercise = $this->mydb->fetch_all_array($userExerciseQuery);
                if(count($userExercise) > 0){
                    $allExercises[$key]['userData'] = $userExercise[0];
                }
            }
        }
        return $allExercises;
    }
    
    public function addWorkout($data){
        // Add a whole day of exercises all at once from a JSON object which includes user and array of exercises
        $date = $data['date'];
        $user_id = $data['user_id'];
        
        unset($data['date']);
        unset($data['user_id']);
                
        foreach($data as $exid => $weight){
            if($weight > 0){
                $this->addWeight($user_id, $exid, $weight, $date);
            }
        }
    }

    public function getWeightHistory($userId, $weightId){
        if($userId && $weightId){
            $numberOfDays = 7;
            // Grab a list of all exercises
            $weightHistoryQuery = "SELECT * FROM  schedule WHERE user_id = {$userId} AND exercise_id = {$weightId} ORDER BY date ASC LIMIT {$numberOfDays}";
            $weightHistory = $this->mydb->fetch_all_array($weightHistoryQuery);
            return $weightHistory;
        }
    } 
}

header('content-type: application/json; charset=utf-8');

$userId = (isset($_GET['user_id'])) ? $_GET['user_id'] : false;
$weightId = (isset($_GET['weight_id'])) ? $_GET['weight_id'] : false;
$requestedService = (isset($_GET['service'])) ? $_GET['service'] : false;
$newWorkout = new Weights();

switch($requestedService){
    case 'weightsList':
        // Create array of all possible exercises with data such as name, reps, exercise ID
        $userData = $newWorkout->getAllPrevWeights($userId);
        break;

    case 'weightHistory':
        // Create array of all possible exercises with data such as name, reps, exercise ID
        $userData = $newWorkout->getWeightHistory($userId, $weightId);
        break;
}

if(isset($userData)){
    // Format JSON or JSONP depending on callback parameter
    $json = json_encode($userData);
    echo isset($_GET['callback']) ? "{$_GET['callback']}($json)" : $json;
}

?>