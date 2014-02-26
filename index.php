<!DOCTYPE html>
<!--[if IEMobile 7 ]>    <html class="no-js iem7"> <![endif]-->
<!--[if (gt IEMobile 7)|!(IEMobile)]><!--> <html class="no-js"> <!--<![endif]-->
<head>
    
<!-- Russell Note: Try AngularJS -->    
    
<meta charset="utf-8">
<title></title>
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

<script src="js/vendor/modernizr-2.6.2.min.js"></script>

</head>

<body>

<?php

$weightDropdown = '';
for($i=0;$i<=500;$i+=5){
    $weightDropdown .= "<option value=\"$i\">$i</option>\n";
}

?>

<!-- Add your site or application content here -->
<form action="submit.php" id="weightsForm" method="POST">
    <table id="weightTable" cellspacing="0" cellpadding="0" border="0">
        <thead>
            <tr>
                <td class="name">Name:</td>
                <td colspan="2">
                    <select name="user_id" id="user_id" style="width: 100%;">
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
            <tr class="day-a day-b">
                <td>
                    <div class="lift-name">Squats</div>
                    <div class="set-details">5x5</div>
                </td>
                <td class="previous-weight">0</td>
                <td>
                    <select name="1" id="1">
                        <?php echo $weightDropdown; ?>
                    </select>
                </td>
            </tr>
            <tr class="day-a">
                <td>
                    <div class="lift-name">Bench Press</div>
                    <div class="set-details">5x5</div>
                </td>
                <td class="previous-weight">0</td>
                <td>
                    <select name="11" id="11">
                        <?php echo $weightDropdown; ?>
                    </select>
                </td>
            </tr>
            <tr class="day-b">
                <td>
                    <div class="lift-name">Deadlift</div>
                    <div class="set-details">1x5</div>
                </td>
                <td class="previous-weight">0</td>
                <td>
                    <select name="2" id="2">
                        <?php echo $weightDropdown; ?>
                    </select>
                </td>
            </tr>
            <tr class="day-b">
                <td>
                    <div class="lift-name">Standing Press</div>
                    <div class="set-details">5x5</div>
                </td>
                <td class="previous-weight">0</td>
                <td>
                    <select name="3" id="3">
                        <?php echo $weightDropdown; ?>
                    </select>
                </td>
            </tr>
            <tr class="day-a day-b">
                <td>
                    <div class="lift-name">Bent Over Row</div>
                    <div class="set-details">5x5</div>
                </td>
                <td class="previous-weight">0</td>
                <td>
                    <select name="4" id="4">
                        <?php echo $weightDropdown; ?>
                    </select>
                </td>
            </tr>
            <tr class="day-a">
                <td>
                    <div class="lift-name">Barbell Shrugs</div>
                    <div class="set-details">3x8</div>
                </td>
                <td class="previous-weight">0</td>
                <td>
                    <select name="5" id="5">
                        <?php echo $weightDropdown; ?>
                    </select>
                </td>
            </tr>
            <tr class="day-b">
                <td>
                    <div class="lift-name">Close Grip Bench Press</div>
                    <div class="set-details">3x8</div>
                </td>
                <td class="previous-weight">0</td>
                <td>
                    <select name="6" id="6">
                        <?php echo $weightDropdown; ?>
                    </select>
                </td>
            </tr>
            <tr class="day-a">
                <td>
                    <div class="lift-name">Tricep Extensions</div>
                    <div class="set-details">3x8</div>
                </td>
                <td class="previous-weight">0</td>
                <td>
                    <select name="7" id="7">
                        <?php echo $weightDropdown; ?>
                    </select>
                </td>
            </tr>
            <tr class="day-a day-b">
                <td>
                    <div class="lift-name">Incline Curls</div>
                    <div class="set-details">3x8</div>
                </td>
                <td class="previous-weight">0</td>
                <td>
                    <select name="8" id="8">
                        <?php echo $weightDropdown; ?>
                    </select>
                </td>
            </tr>
            <tr class="day-a">
                <td>
                    <div class="lift-name">Hyperextensions</div>
                    <div class="set-details">2x10</div>
                </td>
                <td class="previous-weight">0</td>
                <td>
                    <select name="9" id="9">
                        <?php echo $weightDropdown; ?>
                    </select>
                </td>
            </tr>
            <tr class="day-a day-b">
                <td>
                    <div class="lift-name">Cable Crunches</div>
                    <div class="set-details">3x10</div>
                </td>
                <td class="previous-weight">0</td>
                <td>
                    <select name="10" id="10">
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
            <button type="submit">Submit</button>
        </div>
        <div>
            <!-- <a href="status.php">Stats</a> -->
            <a id="showJson" href="#">Show JSON</a>
        </div>
    </div>
    <textarea id="jsonOutput"></textarea>
</form>


<script src="js/vendor/zepto.min.js"></script>
<script src="js/helper.js"></script>
<script src="js/main.js"></script>

</body>
</html>
