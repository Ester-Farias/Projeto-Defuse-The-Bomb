<?php
session_start();

$number_bomb = (rand(1, 10));
echo "Número da bomba: $number_bomb<br>";
$number_life = 3;
//$number_life = isset($_SESSION['number_life']) ? $_SESSION['number_life'] : 3;
echo "Número de vidas antes do laço: $number_life<br>";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $number_bomb_user = $_POST['number_bomb_user'];
    header('Location: end.html');
    while ($number_bomb != $number_bomb_user ) {
        $number_life--;
        

        echo "Você tem " . $number_life . " tentativas restantes.";
        echo 'Encaminhando para a página page3.php';
        // Redireciona para page3.php passando o número de vidas
       header("Location: page3.php?number_life=$number_life");
    } 
}
?>
