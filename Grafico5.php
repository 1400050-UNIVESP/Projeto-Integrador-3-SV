<?php

include "conectar2.php";

if ($con->connect_error) {
	die("A conexão falhou: " . $con->connect_error);
}

$fs1 = 0;
$fs2 = 0;
$fs3 = 0;
$fs4 = 0;
$fs5 = 0;


$result_niveis_ava = "SELECT * FROM users where nivel='0'";
$resultado_niveis_ava = mysqli_query($con, $result_niveis_ava);
while($row_niveis_ava = mysqli_fetch_assoc($resultado_niveis_ava)){
    if($row_niveis_ava['renda'] == "E"){
        $fs1++;
    } else  if($row_niveis_ava['renda'] == "D"){
        $fs2++;
    } if($row_niveis_ava['renda'] == "C"){
      $fs3++;
    } if($row_niveis_ava['renda'] == "B"){
        $fs4++;
    } if($row_niveis_ava['renda'] == "A"){
        $fs5++;
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
        ['Faixa Salarial', 'Faixa Etária'],
          ['Até 2 Salários Mínimos',     <?=$fs1?>],
          ['De 2 a 4 Salários Mínimos',     <?=$fs2?>],
          ['De 4 a 10 Salários Mínimos',     <?=$fs3?>],
          ['De 10 a 20 Salários Mínimos',     <?=$fs4?>],
          ['Acima de 20 Salários Mínimos',     <?=$fs5?>]
        ]);

        var options = {
          title: '',
          width: 400,
          height:300,
          legend: { position: 'none' },
          chart: { title: '',
                   subtitle: '' },
          bars: 'horizontal', // Required for Material Bar Charts.
          axes: {
            x: {
              0: { side: 'top', label: ''} // Top x-axis.
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