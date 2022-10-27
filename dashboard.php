<?php
// Inicialize a sessão
session_start();
 
// Verifique se o usuário está logado, se não, redirecione-o para uma página de login
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<!-- saved from url=(0014)about:internet -->
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="https://getbootstrap.com.br/favicon.ico">

    <title>Dashboard</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css" integrity="sha256-+N4/V/SbAFiW1MPBCXnfnP9QSN3+Keu+NlB+0ev/YKQ=" crossorigin="anonymous" />

    <style>
      @media only screen and (max-width: 600px) {
        body {
          width: 300px;
          margin-bottom: 70px;
          text-align: center;
        }
      }
    </style>
  <body>
  <nav class="navbar navbar-expand-lg" style="background-color: #250352; color: #FFF;">
      <a class="navbar-brand" href="#" style="text-decoration: none; color: #FFF;">
        <img src="https://www.freeiconspng.com/uploads/dashboard-icon-3.png" width="35px" height="35px"> Dashboard
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#conteudoNavbarSuportado" aria-controls="conteudoNavbarSuportado" aria-expanded="false" aria-label="Alterna navegação">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="conteudoNavbarSuportado">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
            <a class="nav-link" href="#" style="text-decoration: none; color: #FFF;"><?php echo htmlspecialchars($_SESSION["username"]);?> <span class="sr-only">(página atual)</span></a>
          </li>
          <li class="nav-item active">
          <a class="nav-link" href="welcome2.php">Voltar</a>
          </li>
        </ul>
      </div>
    </nav>

    <div class="container-fluid">
      <div class="row">
        <nav class="col-md-2 d-none d-md-block sidebar" style="border-right: 1px solid #DDD;">
          <div class="sidebar-sticky">
            <ul class="nav flex-column">
              <li class="nav-item">
                <a class="nav-link active" href="?pagina">
                  <i class="fas fa-tachometer-alt"></i>&nbsp;Dashboard <span class="sr-only">(atual)</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="?pagina=gênero">
                  <i class="fas fa-transgender"></i>&nbsp;Gênero
				</a>
				</li>
              <li class="nav-item">
                <a class="nav-link" href="?pagina=estado_civil">
                  <i class="fas fa-user"></i>&nbsp;Estado Civil
                </a>
				</li>
              <li class="nav-item">
                <a class="nav-link" href="?pagina=faixa_etaria">
                  <i class="fas fa-calendar"></i>&nbsp;Faixa Etária
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="?pagina=renda">
                  <i class="fas fa-money-check-alt"></i>&nbsp;Renda Familiar
                </a>
				<li class="nav-item">
                <a class="nav-link" href="?pagina=escolaridade">
                  <i class="fas fa-graduation-cap"></i></i>&nbsp;Escolaridade
                </a>
              </li>
            </ul>
          </div>
        </nav>

        <!-- Conteúdo -->
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Dashboard</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
				<div class="btn-group mr-2">               
					</div>
					
				</div>
			</div>
			<!-- Corpo do Dashboard -->
			
          <?php
            if (isset($_GET['pagina'])) {
              
              switch ($_GET['pagina']) {
                case 'gênero':
                  echo '<h2>Gênero</h2>';
                  include 'grafico1.php';
                break;
                case 'estado_civil':
					echo '<h2>Estado Civil</h2>';
                  include 'grafico2.php';
                break;
                case 'faixa_etaria':
					echo '<h2>Faixa Etária</h2>';
                  include 'grafico3.php';
				break;
				case 'escolaridade':
					echo '<h2>Escolaridade</h2>';
                  include 'grafico4.php';
				break;
				case 'renda':
					echo '<h2>Renda Familiar</h2>';
                  include 'grafico5.php';
                break;
                default:
                break;
              }

            }
          ?>        
        </main>
      </div>
    </div>

    
</body></html>