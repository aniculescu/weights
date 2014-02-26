<?php
require_once('dbConnect.php');

class Weights
{
    private $currentDate;
    private $mydb;
    public function __construct(){
        $this->currentDate = date("Y-m-d");
//      $this->$mydb = new Database("anw.aniculescu.com", "appconnect", "w0rk1tB1tch", "anw_weight_tracker");   // Could not connect
        $this->mydb = new Database("68.178.216.145 ", "weighttracker", "w0rk1tB1tch!", "weighttracker");
    }

    public function addExercise(){
        // Add a new exercise to the list of exercises
    }

    private function addWeight($user_id, $exercise, $weight, $date){
        $this->mydb->connect();
        // Check to see if date/weight combo already exists\
        $checkQuery = "SELECT id FROM schedule WHERE date = '{$date}' AND exercise_id = {$exercise} AND user_id = {$user_id} LIMIT 1";
        $checkResult = $this->mydb->query($checkQuery);
        $checkRows = mysql_fetch_row($checkResult);
                
        if(!$checkRows){
            // If data does not exist, add new row
            $insertQuery = "INSERT INTO schedule (date, user_id, exercise_id, weight) VALUES ('{$date}',{$user_id},{$exercise},{$weight})";
            $this->mydb->query($insertQuery);
            $this->mydb->close();
        } else {
            // If data exists, update
            $updateQuery = "UPDATE schedule SET weight = {$weight} WHERE id = {$checkRows[0]} LIMIT 1";
            $this->mydb->query($updateQuery);
        }
    }
    
    private function showLastWeight($exercise){
        // Show the weight for the last time the exercise was performed
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
}

?>