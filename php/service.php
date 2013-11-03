<?php
require_once(dbConnect.php);
class Weights
{
    private currentDate;
    private mydb;
    public function __construct(){
        $this->currentDate = date("Y-m-d");
        $this->mydb = new Database("anw.aniculescu.com", "appconnect", "w0rk1tB1tch", "anw_weight_tracker");

    }

    public function addExercise($user, $exercise, $weight){
        $query = "Insert into schedule set date=".$this->currentDate.", set user_id=".$user.", set exercise_id=".$exercise.", weight_value=".$weight;
        $this->mydb->connect();
        $this->mydb->query($query);
        $this->mydb->close();
    }
}
?>