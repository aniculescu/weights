<?php

$weightDropdown = '<option value=\"0\">-</option>\n';
for($i=0;$i<=500;$i+=5){
    $weightDropdown .= "<option value=\"$i\">$i</option>\n";
}

?>
    
<form action="submit.php" id="weightsForm" method="GET" ng-controller="WeightListCtrl">
    <table id="weightTable" cellspacing="0" cellpadding="0" border="0">
        <thead>
            <tr>
                <td class="name">Name:</td>
                <td colspan="2">
                    <select name="user_id" class="user-id" ng-model="userId" ng-change="showUserWeights()">
                        <option value="2">Russell</option>
                        <option value="1">Andrew</option>
                    </select>
                </td>
            </tr>
            <tr>
                <th>Exercise</th>
                <th>Previous</th>
                <th>Today</th>
            </tr>
        </thead>
        <tbody>
            <tr ng-repeat="exercise in exercises" class="day-{{exercise.type}}">
                <td class="exercise">
                    <div class="lift-name" ng-click="showGraph(exercise.userData.user_id, exercise.id)">{{exercise.name}}</div>
                    <div class="set-details">{{exercise.repetitions}}</div>
                </td>
                <td class="previous-weight">{{exercise.userData.weight}}</td>
                <td class="weight-dropdown">
                    <select name="{{exercise.id}}" id="ex{{exercise.name|nospaces}}" ng-model="weight" ng-change="addSingleExercise(userId, exercise.id, weight, todaysDate)">
                        <?php echo $weightDropdown; ?>
                    </select>
                </td>
            </tr>

            <tr class="date">
                <td colspan="3">Date <input id="date" name="date" type="text" ng-model="todaysDate"></td>
            </tr>
        </tbody>
    </table>
<!--    <div class="footerLinks">
        <div>
            <button class="main-submit" type="submit">Submit</button>
        </div>
    </div>  .footerLinks -->
</form>

<div id="chartContainer">
    <canvas id="weightsChart"></canvas>
</div> <!-- #chartContainer -->
