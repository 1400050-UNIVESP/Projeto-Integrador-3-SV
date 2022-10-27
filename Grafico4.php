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
$es6 = 0;

$result_niveis_ava = "SELECT * FROM users where nivel='0'";
$resultado_niveis_ava = mysqli_query($con, $result_niveis_ava);
while($row_niveis_ava = mysqli_fetch_assoc($resultado_niveis_ava)){
    if($row_niveis_ava['escolaridade'] == "1"){
        $es1++;
    } else  if($row_niveis_ava['escolaridade'] == "2"){
        $es2++;
    } if($row_niveis_ava['escolaridade'] == "3"){
      $es3++;
    } if($row_niveis_ava['escolaridade'] == "4"){
        $es4++;
    } if($row_niveis_ava['escolaridade'] == "5"){
        $es5++;
    } if($row_niveis_ava['escolaridade'] == "6"){
            $es6++;
  }
}



?>

<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawStuff);

      function drawStuff() {
        var data = new google.visualization.arrayToDataTable([
        ['Escolaridade', 'Escolaridade'],
          ['Fundamental',     <?=$es1?>],
          ['Médio',     <?=$es2?>],
          ['Superior',     <?=$es3?>],
          ['Pós Graduado',     <?=$es4?>],
          ['Mestrado',     <?=$es5?>],
          ['Doutorado',     <?=$es6?>]
        ]);

        var options = {
          title: '',
          width: 500,
          height:400,
          legend: { position: 'none' },
          chart: { title: ''
        },
          bars: 'vertical', // Required for Material Bar Charts.
          axes: {
            x: {
              0: { side: 'under', label: ''} // Top x-axis.
            }
          },
          bar: { groupWidth: "90%" }
        };

        var chart = new google.charts.Bar(document.getElementById('top_x_div'));
        chart.draw(data, options);
      };
    </script>
  </head>
  <body>
    <div id="top_x_div" style="width: 900px; height: 500px;"></div>
  </body>
</html>