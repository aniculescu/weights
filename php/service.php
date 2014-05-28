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

    public function addWeight($user_id, $exercise, $weight, $date){
        $jsonSuccess = "{'success' : true}";
        $jsonFalse = "{'success' : false}";
        $this->mydb->connect();
        // Check to see if date/weight combo already exists
        $checkQuery = "SELECT id FROM schedule WHERE date = '{$date}' AND exercise_id = {$exercise} AND user_id = {$user_id} LIMIT 1";
        $checkResult = $this->mydb->query($checkQuery);
        $checkRows = mysql_fetch_row($checkResult);
                
        if(!$checkRows){
            if($weight > 0){
                // If data does not exist, add new row
                $insertQuery = "INSERT INTO schedule (date, user_id, exercise_id, weight) VALUES ('{$date}',{$user_id},{$exercise},{$weight})";
                $this->mydb->query($insertQuery);
            }
        } else {
            if($weight == 0) {
                // If weight equals 0, delete the row
                $deleteQuery = "DELETE FROM schedule WHERE id = {$checkRows[0]} LIMIT 1";
                $this->mydb->query($deleteQuery);
            } else {
                // If data exists, update
                $updateQuery = "UPDATE schedule SET weight = {$weight} WHERE id = {$checkRows[0]} LIMIT 1";
                $this->mydb->query($updateQuery);
            }
        }
        $this->mydb->close();
        return $jsonSuccess;
    }
        
    public function getAllPrevWeights($userId){
        $this->mydb->connect();
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
        $this->mydb->close();
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

    public function getWeightHistory($userId, $exerciseId){
        if($userId && $exerciseId){
            $numberOfDays = 7;
            $this->mydb->connect();
            // Grab a list of all exercises
            $weightHistoryQuery = "SELECT * FROM  schedule WHERE user_id = {$userId} AND exercise_id = {$exerciseId} ORDER BY date DESC LIMIT {$numberOfDays}";
            $weightHistory = $this->mydb->fetch_all_array($weightHistoryQuery);
            $weightHistory = array_reverse($weightHistory);
	    $this->mydb->close();
            return $weightHistory;
        }
    } 
}

header('content-type: application/json; charset=utf-8');

$userId = (isset($_GET['user_id'])) ? $_GET['user_id'] : false;
$exerciseId = (isset($_GET['weight_id'])) ? $_GET['weight_id'] : false;
$weight = (isset($_GET['weight'])) ? $_GET['weight'] : false;
$date = (isset($_GET['date'])) ? $_GET['date'] : false;
$requestedService = (isset($_GET['service'])) ? $_GET['service'] : false;
$newWorkout = new Weights();

switch($requestedService){
    case 'weightsList':
        // Create array of all possible exercises with data such as name, reps, exercise ID
        $userData = $newWorkout->getAllPrevWeights($userId);
        break;

    case 'weightHistory':
        // Create array of all possible exercises with data such as name, reps, exercise ID
        $userData = $newWorkout->getWeightHistory($userId, $exerciseId);
        break;

    case 'addWeight':
        // Create array of all possible exercises with data such as name, reps, exercise ID
        $userData = $newWorkout->addWeight($userId, $exerciseId, $weight, $date);
        break;
}

if(isset($userData)){
    // Format JSON or JSONP depending on callback parameter
    $json = json_encode($userData);
    echo isset($_GET['callback']) ? "{$_GET['callback']}($json)" : $json;
}

?>