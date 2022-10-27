<?php

include "conectar2.php";

if ($con->connect_error) {
	die("A conexão falhou: " . $con->connect_error);
}

$sx1 = 0;
$sx2 = 0;
$sx3 = 0;

$result_niveis_ava = "SELECT * FROM users where nivel='0' ";
$resultado_niveis_ava = mysqli_query($con, $result_niveis_ava);
while($row_niveis_ava = mysqli_fetch_assoc($resultado_niveis_ava)){
    if($row_niveis_ava['sexo'] == "F"){
        $sx1++;
    } else  if($row_niveis_ava['sexo'] == "M"){
        $sx2++;
    } if($row_niveis_ava['sexo'] == "B"){
      $sx3++;
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
          ['Task', 'Gênero (F-M)'],
          ['Feminino',     <?=$sx1?>],
          ['Masculino',     <?=$sx2?>],
          ['Não Binário',     <?=$sx3?>]
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
