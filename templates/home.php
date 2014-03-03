<?php

$weightDropdown = '';
for($i=0;$i<=500;$i+=5){
    $weightDropdown .= "<option value=\"$i\">$i</option>\n";
}

?>
    
<form action="submit.php" id="weightsForm" method="POST" ng-controller="WeightListCtrl">
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
            <tr ng-repeat="weight in weights" class="day-{{weight.type}}">
                <td class="exercise">
                    <div class="lift-name"><a href="#/chart/user/{{weight.userData.user_id}}/weight/{{weight.id}}">{{weight.name}}</a></div>
                    <div class="set-details">{{weight.repetitions}}</div>
                </td>
                <td class="previous-weight">{{weight.userData.weight}}</td>
                <td class="weight-dropdown">
                    <select name="{{weight.id}}" id="ex{{weight.name|nospaces}}">
                        <?php echo $weightDropdown; ?>
                    </select>
                </td>
            </tr>

            <tr class="date">
                <td colspan="3">Date <input id="date" name="date" type="text" value="<?php echo date("Y-m-d"); ?>"></td>
            </tr>
        </tbody>
    </table>
    <div class="footerLinks">
        <div>
            <button class="main-submit" type="submit">Submit</button>
        </div>
    </div>
</form>