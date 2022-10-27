<?php
// Incluir arquivo de configuração
require_once "config.php";
 
// Defina variáveis e inicialize com valores vazios
$username = $password = $confirm_password = $sexo = $idade = $email = $nivel = $estado_civil = $escolaridade = $renda ="";
$username_err = $password_err = $confirm_password_err = $sexo_err = $idade_err = $email_err = $estado_civil_err = $escolaridade_err = $renda_err= "";
$nivel = 0;

// Processando dados do formulário quando o formulário é enviado
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validar nome de usuário
    if(empty(trim($_POST["username"]))){
        $username_err = "Por favor coloque um nome de usuário.";
    } elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))){
        $username_err = "O nome de usuário pode conter apenas letras, números e sublinhados.";
    } else{
        // Prepare uma declaração selecionada
        $sql = "SELECT id FROM users WHERE username = :username";
        
        if($stmt = $pdo->prepare($sql)){
            // Vincule as variáveis à instrução preparada como parâmetros
            $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
            
            // Definir parâmetros
            $param_username = trim($_POST["username"]);
            
            // Tente executar a declaração preparada
            if($stmt->execute()){
                if($stmt->rowCount() == 1){
                    $username_err = "Este nome de usuário já está em uso.";
                } else{
                    $username = trim($_POST["username"]);
                    $sexo = trim($_POST["sexo"]);
                    $idade = trim($_POST["idade"]);
                    $estado_civil = trim($_POST["estado_civil"]);
                    $escolaridade = trim($_POST["escolaridade"]);
                    $email = trim($_POST["email"]);
                    $renda = trim($_POST["renda"]);
                    
                }
            } else{
                echo "Ops! Algo deu errado. Por favor, tente novamente mais tarde.";
            }

            // Fechar declaração
            unset($stmt);
        }
    }
    
    // Validar senha
    if(empty(trim($_POST["password"]))){
        $password_err = "Por favor insira uma senha.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "A senha deve ter pelo menos 6 caracteres.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validar e confirmar a senha
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Por favor, confirme a senha.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "A senha não confere.";
        }
    }
    
    // Verifique os erros de entrada antes de inserir no banco de dados
    if(empty($username_err) && empty($password_err) && empty($sexo_err) && empty($idade_err) && empty($estado_civil_err) && empty($escolaridade_err) && empty($renda_err)&& empty($confirm_password_err)){
        
        // Prepare uma declaração de inserção
        $sql = "INSERT INTO users (username, sexo, idade, estado_civil, escolaridade, email, password, nivel, renda) VALUES (:username, :sexo, :idade, :estado_civil, :escolaridade,:email, :password, :nivel, :renda)";
         
        if($stmt = $pdo->prepare($sql)){
            // Vincule as variáveis à instrução preparada como parâmetros
            $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
            $stmt->bindParam(":sexo", $param_sexo, PDO::PARAM_STR);
            $stmt->bindParam(":idade", $param_idade, PDO::PARAM_STR);
            $stmt->bindParam(":estado_civil", $param_estado_civil, PDO::PARAM_STR);
            $stmt->bindParam(":escolaridade", $param_escolaridade, PDO::PARAM_STR);
            $stmt->bindParam(":email", $param_email, PDO::PARAM_STR);
            $stmt->bindParam(":password", $param_password, PDO::PARAM_STR);
            $stmt->bindParam(":nivel", $param_nivel, PDO::PARAM_STR);
            $stmt->bindParam(":renda", $param_renda, PDO::PARAM_STR);

            
            // Definir parâmetros
            $param_username = $username;
            $param_sexo = $sexo;
            $param_idade = $idade;
            $param_estado_civil = $estado_civil;
            $param_escolaridade = $escolaridade;
            $param_email = $email;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            $param_nivel = $nivel;
            $param_renda = $renda;
            
            
            
            // Tente executar a declaração preparada
            if($stmt->execute()){
                // Redirecionar para a página de login
                header("location: index.php");
            } else{
                echo "Ops! Algo deu errado. Por favor, tente novamente mais tarde.";
            }

            // Fechar declaração
            unset($stmt);
        }
    }
    
    // Fechar conexão
    unset($pdo);
}
?>
 
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif; }
        .wrapper{ width: 360px; padding: 20px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>Cadastro</h2>
        <p>Por favor, preencha este formulário para criar uma conta.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>Nome do usuário</label>
                <input type="text" name="username" class="form-control-sm <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                <span class="invalid-feedback"><?php echo $username_err; ?></span>
            </div>  
            <div class="form-group">
                <label>e-mail</label>
                <input type="text" name="email" class="form-control-sm <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>">
                <span class="invalid-feedback"><?php echo $email_err; ?></span>
            </div>
            <div class="form-group">
                <label>Gênero</label>
                <select id= "inserir_dados1" name ="sexo">
                    <option></option>
                    <option value="F">Feminino</option>
                    <option value="M">Masculino</option>
                    <option value="B">Não-Binário</option>
                </select>
            </div>     
            <div class="form-group">
                <label>Faixa Etária</label>
                <select id= "inserir_dados3" name ="idade">
                    <option></option>
                    <option value="I1">até 19 anos</option>
                    <option value="I2">entre 20 e 30 anos</option>
                    <option value="I3">entre 31 e 40 anos</option>
                    <option value="I4">entre 41 e 50 anos</option>
                    <option value="I5">entre 51 e 59 anos</option>
                    <option value="I6">acima de 60 anos</option>
                </select>
            </div>
            <div class="form-group">
                <label>Estado Civil</label>
                <select id= "inserir_dados2" name ="estado_civil">
                    <option></option>
                    <option value="S">Solteiro</option>
                    <option value="C">Casado</option>
                    <option value="Z">Separado</option>
                    <option value="D">Divorciado</option>
                    <option value="V">Viúvo</option>
                </select>
            </div>
            <div class="form-group">
                <label>Escolaridade</label>
                <select id= "inserir_dados3" name ="escolaridade">
                    <option></option>
                    <option value="1">Fundamental</option>
                    <option value="2">Médio</option>
                    <option value="3">Superior</option>
                    <option value="4">Pós Graduado</option>
                    <option value="5">Mestrado</option>
                    <option value="6">Doutorado</option>
                </select>
            </div>     
            <div class="form-group">
                <label>Renda Familiar</label>
                <select id= "inserir_dados4" name ="renda">
                    <option></option>
                    <option value="E">Até 2 Salários Mínimos</option>
                    <option value="D">De 2 a 4 Salários Mínimos</option>
                    <option value="C">De 4 a 10 Salários Mínimos</option>
                    <option value="B">De 10 a 20 Salários Mínimos</option>
                    <option value="A">Acima de 20 Salários Mínimos</option>
                </select>
            </div>
            <div class="form-group">
                <label>Senha</label>
                <input type="password" name="password" class="form-control-sm <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>">
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <label>Confirme a senha</label>
                <input type="password" name="confirm_password" class="form-control-sm <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirm_password; ?>">
                <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Criar Conta">
                <input type="reset" class="btn btn-secondary ml-2" value="Apagar Dados">
            </div>
            <p>Já tem uma conta? <a href="index.php">Entre aqui</a>.</p>
        </form>
    </div>    
</body>
</html>