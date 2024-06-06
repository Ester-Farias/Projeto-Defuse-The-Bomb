<?php
session_start();

// Inicializa o número da bomba e as tentativas se não existirem
if (!isset($_SESSION['bomb_number'])) {
    $_SESSION['bomb_number'] = rand(1, 10); // Altere o intervalo conforme necessário
    $_SESSION['attempts'] = 3;
}
//print_r($_SESSION['bomb_number']);
//print_r($_SESSION['attempts']);
// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Decrementa o número de tentativas
    $_SESSION['attempts']--;

    // Obtém o palpite do usuário
    $user_guess = $_POST['number_bomb_user'];

    // Verifica se o palpite é correto
    if ($user_guess == $_SESSION['bomb_number'] and $_SESSION['attempts'] > 0) {
       unset($_SESSION['attempts']);
       session_destroy();
       header("Location: end.html");
       exit();
    } else if ($_SESSION['attempts'] == 0 ){
       unset($_SESSION['attempts']);
       session_destroy();
       header("location: gameover.html");
       exit();
    }else {
        // Redireciona de volta para a página principal com o número de tentativas restantes
        header("Location: page3.php?attempts=" . $_SESSION['attempts']);
        exit();
    
}
}

// Verifica se o número de tentativas está definido
if (isset($_GET['attempts'] )) {
    header("Location: page3.php");
    exit();
}

$remaining_attempts = $_SESSION['attempts'];
?>




<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>2099</title>
    <link rel="shortcut icon" href="img/favicon.svg" type="image/x-icon">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  </head>
  <body>
    <div class="container-body">
      <header>
            <h1>Defuse the bomb</h1>
            <p>賽博朋克</p>
      </header>
      <main>
        <div class="container-main">
          <p class="text-white">
            Digite um número entre 1 e 10 para  desarmar a bomba.
            Você tem <?=  $remaining_attempts; ?> tentativas.
            Lembre-se que a população inteira de Utashinai depende de você.
          </p>
          <form action="page3.php" method="POST"> 
            <input type="number" class="form-control" name="number_bomb_user" id="exampleFormControlInput1" placeholder="Escolha um número para tentar desarmar a bomba">
            <div class="d-flex justify-content-center mt-5">
              <a href="page6.phtml" class="btn btn-sm btn-danger mx-3">Back</a>
              <button type="submit" class="btn btn-sm btn-danger mx-3">Next</button>
            </div> 
          </form>
        </div>
      </main>
      
      
            
        
    </div><!-- Fim container -->
    <footer class="text-center fixed-bottom pb-5 m-0 ps-3">
      2099
    </footer>    <script src="js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
</html>