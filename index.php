<!DOCTYPE html>
<html class="no-js" ng-app="weightsApp">
<head>
    
<!-- Russell Note: Try AngularJS -->    
    
<meta charset="utf-8">
<title>Weights</title>
<meta name="description" content="">
<meta name="HandheldFriendly" content="True">
<meta name="MobileOptimized" content="320">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="cleartype" content="on">

<link rel="apple-touch-icon-precomposed" sizes="144x144" href="img/touch/apple-touch-icon-144x144-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="img/touch/apple-touch-icon-114x114-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="img/touch/apple-touch-icon-72x72-precomposed.png">
<link rel="apple-touch-icon-precomposed" href="img/touch/apple-touch-icon-57x57-precomposed.png">
<link rel="shortcut icon" href="img/touch/apple-touch-icon.png">

<!-- Tile icon for Win8 (144x144 + tile color) -->
<meta name="msapplication-TileImage" content="img/touch/apple-touch-icon-144x144-precomposed.png">
<meta name="msapplication-TileColor" content="#222222">

<link rel="stylesheet" href="css/normalize.css">
<link rel="stylesheet" href="css/main.css">

</head>

<body ng-controller="WeightListCtrl">

<?php

$weightDropdown = '';
for($i=0;$i<=500;$i+=5){
    $weightDropdown .= "<option value=\"$i\">$i</option>\n";
}

?>
    
<form action="submit.php" id="weightsForm" method="POST">
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
                <td>
                    <div class="lift-name">{{weight.name}}</div>
                    <div class="set-details">{{weight.repetitions}}</div>
                </td>
                <td class="previous-weight">{{weight.userData.weight}}</td>
                <td>
                    <select name="{{weight.id}}" id="ex{{weight.name}}">
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

<!-- <script src="js/vendor/modernizr-2.6.2.min.js"></script> -->
<!-- <script src="js/helper.js"></script> -->
<script src="js/vendor/zepto.min.js"></script>
<script src="js/lib/angular/angular.js"></script>
<!-- <script src="js/lib/angular/angular-resource.js"></script> -->
<script src="js/app.js"></script>
<script src="js/controller.js"></script>
<!-- <script src="js/services.js"></script> -->
<script src="js/main.js"></script>

</body>
</html>
