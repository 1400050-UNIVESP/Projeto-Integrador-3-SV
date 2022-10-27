<?php

include "conectar2.php";

if ($con->connect_error) {
	die("A conexão falhou: " . $con->connect_error);
}

$is1 = 0;
$is2 = 0;
$is3 = 0;
$is4 = 0;
$is5 = 0;
$is6 = 0;

$result_niveis_ava = "SELECT * FROM users where nivel='0' ";
$resultado_niveis_ava = mysqli_query($con, $result_niveis_ava);
while($row_niveis_ava = mysqli_fetch_assoc($resultado_niveis_ava)){
    if($row_niveis_ava['idade'] == "I1"){
        $is1++;
    } else  if($row_niveis_ava['idade'] == "I2"){
        $is2++;
    } if($row_niveis_ava['idade'] == "I3"){
      $is3++;
    } if($row_niveis_ava['idade'] == "I4"){
        $is4++;
    } if($row_niveis_ava['idade'] == "I5"){
        $is5++;
    } if($row_niveis_ava['idade'] == "I6"){
            $is6++;
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
        ['Faixa Etária', 'Faixa Etária'],
          ['até 19 anos',     <?=$is1?>],
          ['entre 20 e 30 anos',     <?=$is2?>],
          ['entre 31 e 40 anos',     <?=$is3?>],
          ['entre 41 e 50 anos',     <?=$is4?>],
          ['entre 51 e 59 anos',     <?=$is5?>],
          ['acima de 60 anos',     <?=$is6?>]
        ]);

        var options = {
          title: '',
          width: 600,
          height:350,
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