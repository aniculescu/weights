<!DOCTYPE html>
<!--[if IEMobile 7 ]>    <html class="no-js iem7"> <![endif]-->
<!--[if (gt IEMobile 7)|!(IEMobile)]><!--> <html class="no-js"> <!--<![endif]-->
<head>

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

<!-- Add your site or application content here -->
<form action="/index.php" id="weightsForm">
    <table id="weightTable" cellspacing="0" cellpadding="0" border="0">
        <thead>
            <tr>
                <th>Exercise</th>
                <th>Previous</th>
                <th>Today</th>
            </tr>
        </thead>
        <tbody>
            <tr class="day-a day-b">
                <td>Squats</td>
                <td class="previous">120</td>
                <td>
                    <select name="exSquat" id="exSquat">
                        <option value="5">5</option>
                        <option value="10">10</option>
                        <option value="15">15</option>
                    </select>
                </td>
            </tr>
            <tr class="day-a">
                <td>Bench Press</td>
                <td class="previous">120</td>
                <td>
                    <select name="exSquat" id="exSquat">
                        <option value="5">5</option>
                        <option value="10">10</option>
                        <option value="15">15</option>
                    </select>
                </td>
            </tr>
            <tr class="day-b">
                <td>Deadlift</td>
                <td class="previous">120</td>
                <td>
                    <select name="exSquat" id="exSquat">
                        <option value="5">5</option>
                        <option value="10">10</option>
                        <option value="15">15</option>
                    </select>
                </td>
            </tr>
            <tr class="day-b">
                <td>Standing Press</td>
                <td class="previous">120</td>
                <td>
                    <select name="exSquat" id="exSquat">
                        <option value="5">5</option>
                        <option value="10">10</option>
                        <option value="15">15</option>
                    </select>
                </td>
            </tr>
            <tr class="day-a day-b">
                <td>Bent Over Row</td>
                <td class="previous">120</td>
                <td>
                    <select name="exSquat" id="exSquat">
                        <option value="5">5</option>
                        <option value="10">10</option>
                        <option value="15">15</option>
                    </select>
                </td>
            </tr>
            <tr class="day-a">
                <td>Barbell Shrugs</td>
                <td class="previous">120</td>
                <td>
                    <select name="exSquat" id="exSquat">
                        <option value="5">5</option>
                        <option value="10">10</option>
                        <option value="15">15</option>
                    </select>
                </td>
            </tr>
            <tr class="day-b">
                <td>Close Grip Bench Press</td>
                <td class="previous">120</td>
                <td>
                    <select name="exSquat" id="exSquat">
                        <option value="5">5</option>
                        <option value="10">10</option>
                        <option value="15">15</option>
                    </select>
                </td>
            </tr>
            <tr class="day-a">
                <td>Tricep Extensions</td>
                <td class="previous">120</td>
                <td>
                    <select name="exSquat" id="exSquat">
                        <option value="5">5</option>
                        <option value="10">10</option>
                        <option value="15">15</option>
                    </select>
                </td>
            </tr>
            <tr class="day-a day-b">
                <td>Incline Curls</td>
                <td class="previous">120</td>
                <td>
                    <select name="exSquat" id="exSquat">
                        <option value="5">5</option>
                        <option value="10">10</option>
                        <option value="15">15</option>
                    </select>
                </td>
            </tr>
            <tr class="day-a">
                <td>Hyperexentions</td>
                <td class="previous">120</td>
                <td>
                    <select name="exSquat" id="exSquat">
                        <option value="5">5</option>
                        <option value="10">10</option>
                        <option value="15">15</option>
                    </select>
                </td>
            </tr>
            <tr class="day-a day-b">
                <td>Cable Crunches</td>
                <td class="previous">120</td>
                <td>
                    <select name="exSquat" id="exSquat">
                        <option value="5">5</option>
                        <option value="10">10</option>
                        <option value="15">15</option>
                    </select>
                </td>
            </tr>
        </tbody>
    </table>
    <div class="footer-links">
        <div>
            <button type="submit">Submit</button>
        </div>
        <div>
            <a href="status.php">Stats</a>
        </div>
    </div>
</form>

<script src="js/vendor/zepto.min.js"></script>
<script src="js/helper.js"></script>

</body>
</html>
