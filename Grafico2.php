<?php

include "conectar2.php";

if ($con->connect_error) {
	die("A conexão falhou: " . $con->connect_error);
}

$es1 = 0;
$es2 = 0;
$es3 = 0;
$es4 = 0;
$es5 = 0;

$result_niveis_ava = "SELECT * FROM users where nivel='0'";
$resultado_niveis_ava = mysqli_query($con, $result_niveis_ava);
while($row_niveis_ava = mysqli_fetch_assoc($resultado_niveis_ava)){
    if($row_niveis_ava['estado_civil'] == "S"){
        $es1++;
    } else  if($row_niveis_ava['estado_civil'] == "C"){
        $es2++;
    } if($row_niveis_ava['estado_civil'] == "Z"){
      $es3++;
    } if($row_niveis_ava['estado_civil'] == "D"){
        $es4++;
    } if($row_niveis_ava['estado_civil'] == "V"){
        $es5++;
  }
}



?>

<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Task', 'Estado Civil'],
          ['Solteiro',     <?=$es1?>],
          ['Casado',     <?=$es2?>],
          ['Separado',     <?=$es3?>],
          ['Divorciado',     <?=$es4?>],
          ['Viúvo',     <?=$es5?>]
        ]);

        var options = {
          title: '',
          pieHole: 0,
          width: 700,
          height:400,
        };

        var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <div id="donutchart" style="width: 900px; height: 500px;"></div>
  </body>
</html>
