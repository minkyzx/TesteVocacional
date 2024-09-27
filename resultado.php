<?php
session_start();
$curso_recomendado = $_SESSION['curso_recomendado'];
$descricao_curso = $_SESSION['descricao_curso'];
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado do Teste</title>
    <link rel="stylesheet" href="assets/css/result.css"> <!-- Link para o CSS -->
    <link rel="shortcut icon" href="assets/img/logo2.jpeg" type="image/x-icon">
</head>
<body>
    <header>
    <img src="assets/img/logoFAMEC.png" alt="">
    </header>

    <main>
        <div class="result-container"> <!-- Contêiner para os resultados -->
            <h2>Seu curso recomendado é: <?php echo $curso_recomendado; ?></h2>
            <p class="description"><?php echo $descricao_curso; ?></p>
            <p id="obg">Obrigado por participar do teste vocacional!</p>

            <!-- Botão para refazer o teste -->
            <form action="refazer.php" method="post">
                <button type="submit">Refazer o teste</button>
            </form>
        </div>
    </main>

    <footer>
        <p>&copy; 2024 Teste Vocacional. Todos os direitos reservados.</p>
    </footer>
</body>
</html>
