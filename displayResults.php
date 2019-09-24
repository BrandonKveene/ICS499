<?php
  require_once('database.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script type="text/javascript">
    google.charts.load('current', {'packages':['gantt']});
    google.charts.setOnLoadCallback(drawChart);

    function daysToMilliseconds(days) {
      return days * 24 * 60 * 60 * 1000;
    }

    function drawChart() {
      
      var data = new google.visualization.DataTable();
      data.addColumn('string', 'id');
      data.addColumn('string', 'name');
      data.addColumn('date', 'Start Date');
      data.addColumn('date', 'End Date');
      data.addColumn('number', 'Duration');
      data.addColumn('number', 'Percent Complete');
      data.addColumn('string', 'Dependencies');

      data.addRows([
        <?php
          $db = dbConnect();
          $sql = "SELECT id, name, open_date, rtm_date FROM releases";
          $result = $db->query($sql);

          
          if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
              echo "['".$row['id']."',"."'".$row['name']."',"."new Date(".str_replace('-',',',$row['open_date'])."),".
              "new Date(".str_replace('-',',',$row['rtm_date'])."),"."10,"."90,"."null]";
            }
          }
          $db->close();
          echo "]";
        ?>
      );

      var options = {
        height: 275
      };

      var chart = new google.visualization.Gantt(document.getElementById('chart_div'));
      chart.draw(data, options);
    }
  </script>
</head>
<body>
    <div id="chart_div"></div>
</body>
</html>