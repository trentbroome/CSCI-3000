<?php

$host = "198.71.225.54:3306";
$username = "trentbroome";
$password = "E%6jrx40";
$database = "ph12975858231__";
try {
    $db = new PDO("mysql:host=$host; dbname=$database;", $username, $password);
} catch (Exception $e) {}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $vote_option = $_POST['vote_option'];
    $error_msg = '';

    if ($vote_option != '') {
        $queryins = $db->prepare("INSERT INTO votes (vote_option) VALUES (?)");
        $queryins->bindParam(1, $vote_option);

        $queryins->execute();
    } else {
        $error_msg = 'Please choose a valid option.';
    }
}

$query = $db->prepare("SELECT * FROM votes");

$query->execute();
$results = $query->fetchAll(PDO::FETCH_ASSOC);

$count1 = 0;
$count2 = 0;
$count3 = 0;
$count4 = 0;
$count5 = 0;

foreach ($results as $vote) {
    if ($vote['vote_option'] == 1) $count1++;
    if ($vote['vote_option'] == 2) $count2++;
    if ($vote['vote_option'] == 3) $count3++;
    if ($vote['vote_option'] == 4) $count4++;
    if ($vote['vote_option'] == 5) $count5++;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">

        // Load the Visualization API and the corechart package.
        google.charts.load('current', {'packages':['corechart']});

        // Set a callback to run when the Google Visualization API is loaded.
        google.charts.setOnLoadCallback(drawChart);

        // Callback that creates and populates a data table,
        // instantiates the pie chart, passes in the data and
        // draws it.
        function drawChart() {
            const rows = [
                ['Outer Banks', <? echo $count1 ?>],
                ['The Mandalorian', <? echo $count2 ?>],
                ['Big Mouth', <? echo $count3 ?>],
                ['That 70s Show', <? echo $count4 ?>],
                ['The Office', <? echo $count5 ?>]
            ]

            // Create the data table.
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Topping');
            data.addColumn('number', 'Slices');
            data.addRows(rows);

            // Set chart options
            var options = {'title':'Favorite Show:',
                'width':600,
                'height':400};

            // Instantiate and draw our chart, passing in some options.
            var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
            chart.draw(data, options);
        }
    </script>

</head>
<body>
<div class="container">
    <div class="row mt-5 mb5">
        <div class="col-4">
            <form method="POST">
                <label for="vote_option">Favorite Show:</label>
                <? if($error_msg != '') echo "<div class='alert alert-danger'>".$error_msg."</div>" ?>
                <select class="form-control" name="vote_option" id="vote_option">
                    <option value="">------</option>
                    <option value="1">Outer Banks</option>
                    <option value="2">The Mandalorian</option>
                    <option value="3">Big Mouth</option>
                    <option value="4">That 70s Show</option>
                    <option value="5">The Office</option>
                </select>
                <br>
                <button type="submit" class="btn btn-primary">Submit Vote</button>
            </form>
        </div>
        <div class="col-8">
            <div id="chart_div"></div>
        </div>
    </div>
</div>

</body>
</html>
