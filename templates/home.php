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
                <td colspan="3">
                    <!-- <span class="name">Name:</span> -->
                    <select name="user_id" class="user-id" ng-model="userId" ng-change="showUserWeights()">
                        <option value="2">Russell</option>
                        <option value="1">Andrew</option>
                    </select>
                </td>
            </tr>
            <tr>
                <th class="lift-name">Exercise</th>
                <th class="previous-weight">Previous</th>
                <th class="weight-dropdown">Today</th>
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
                <td colspan="3">
                    <!-- <span class="date">Date:</span> -->
                    <select id="dateMonth" name="dateMonth" ng-model="todaysMonth" ng-change="updateDate()">
                        <option value="01">January</option>
                        <option value="02">February</option>
                        <option value="03">March</option>
                        <option value="04">April</option>
                        <option value="05">May</option>
                        <option value="06">June</option>
                        <option value="07">July</option>
                        <option value="08">August</option>
                        <option value="09">September</option>
                        <option value="10">October</option>
                        <option value="11">November</option>
                        <option value="12">December</option>
                    </select>
                    <select id="dateDay" name="dateDay" ng-model="todaysDay" ng-change="updateDate()">
                        <option value="01">01</option>
                        <option value="02">02</option>
                        <option value="03">03</option>
                        <option value="04">04</option>
                        <option value="05">05</option>
                        <option value="06">06</option>
                        <option value="07">07</option>
                        <option value="08">08</option>
                        <option value="09">09</option>
                        <option value="10">10</option>
                        <option value="11">11</option>
                        <option value="12">12</option>
                        <option value="13">13</option>
                        <option value="14">14</option>
                        <option value="15">15</option>
                        <option value="16">16</option>
                        <option value="17">17</option>
                        <option value="18">18</option>
                        <option value="19">19</option>
                        <option value="20">20</option>
                        <option value="21">21</option>
                        <option value="22">22</option>
                        <option value="23">23</option>
                        <option value="24">24</option>
                        <option value="25">25</option>
                        <option value="26">26</option>
                        <option value="27">27</option>
                        <option value="28">28</option>
                        <option value="29">29</option>
                        <option value="30">30</option>
                        <option value="31">31</option>
                    </select>
                    <select id="dateYear" name="dateYear" ng-model="todaysYear" ng-change="updateDate()">
                        <option value="2010">2010</option>
                        <option value="2011">2011</option>
                        <option value="2012">2012</option>
                        <option value="2013">2013</option>
                        <option value="2014">2014</option>
                        <option value="2015">2015</option>
                        <option value="2016">2016</option>
                        <option value="2017">2017</option>
                        <option value="2018">2018</option>
                        <option value="2019">2019</option>
                        <option value="2020">2020</option>
                    </select>
                </td>
            </tr>
        </tbody>
    </table>
</form>

<div id="chartContainer">
</div> <!-- #chartContainer -->
