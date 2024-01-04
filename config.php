<?php
session_start();

// Inicializa o número da bomba e as tentativas se não existirem
if (!isset($_SESSION['bomb_number'])) {
    $_SESSION['bomb_number'] = rand(1, 10); // Altere o intervalo conforme necessário
    $_SESSION['attempts'] = 3;
}

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Decrementa o número de tentativas
    $_SESSION['attempts']--;

    // Obtém o palpite do usuário
    $user_guess = $_POST['guess'];

    // Verifica se o palpite é correto
    if ($user_guess == $_SESSION['bomb_number']) {
        header("Location: end.html");
        exit();
    }

    // Verifica se o usuário ainda tem tentativas
    if ($_SESSION['attempts'] > 0) {
        // Redireciona de volta para a página principal com o número de tentativas restantes
        header("Location: page3.php?attempts=" . $_SESSION['attempts']);
        exit();
    } else {
        // Se o usuário não tiver mais tentativas, redireciona para a página de game over
        header("Location: gameover.php");
        exit();
    }
}
?>
