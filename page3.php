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
    <link rel="shortcut icon" href="favicon.svg" type="image/x-icon">
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  </head>
  <body class="d-flex align-items-center justify-content-center" style="height: 100vh;">
    <div class="container w-75 p-3">
        <header class="p-0 m-0">
            <h1 class="defuse">Defuse the bomb</h1>
            <div class="hero">賽博朋克</div>
        </header>
        <main class="d-flex flex-column align-items-center justify-content-between h-50 p-4">
          <div class="w-75 d-flex flex-column align-items-center">
            <p class="text-white ">Digite um número entre 1 e 10 para  desarmar a bomba.
               <span class="text-tentativas">Você tem <?=  $remaining_attempts; ?> tentativas.</span>
                Lembre-se que a população inteira de Utashinai depende de você.</p>
              <!-- Conteúdo adicional, se necessário -->
             <div class="w-50 d-flex justify-content-center align-items-center text-center">
              <form action="page3.php" method="POST"> 
              <input type="number" class="form-control" name="number_bomb_user" id="exampleFormControlInput1" placeholder="Escolha um número para tentar desarmar a bomba">
             </div>
            
          </div>
          <div class="d-flex text-white">
            <a href="page2.html" class="btn btn-danger mx-5">Back</a>
            
              <button type="submit" class="btn btn-danger mx-5">NEXT</button>
            </form>
          </div>
      </main>
      
      
      
        <footer class="text-center p-0 m-0 ps-3">
          2099
        </footer>

        
    </div>








    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
</html>