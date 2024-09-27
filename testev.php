<?php
session_start();


$current_question = isset($_SESSION['current_question']) ? $_SESSION['current_question'] : 0;
$questions = [
    'Você gosta de resolver problemas complexos e encontrar soluções criativas?',
    'Você é bom em trabalhar em equipe e colaborar com outros?',
    'Você tem habilidades de comunicação eficazes e pode se expressar claramente?',
    'Você é interessado em entender o comportamento humano e como as pessoas se desenvolvem?',
    'Você gosta de trabalhar com números e análise de dados?',
    'Você é bom em gerenciar projetos e priorizar tarefas?',
    'Você tem habilidades de liderança e pode motivar os outros?',
    'Você é interessado em entender como as organizações funcionam e como podem ser melhoradas?',
    'Você gosta de trabalhar com pessoas e ajudá-las a alcançar seus objetivos?',
    'Você é bom em resolver conflitos e encontrar soluções pacíficas?',
    'Você tem habilidades de planejamento e pode criar estratégias eficazes?',
    'Você é interessado em entender como as leis e regulamentos afetam a sociedade?',
    'Você gosta de aprender sobre novas tecnologias e como elas podem ser aplicadas?',
    'Você é bom em analisar informações e tomar decisões baseadas em dados?',
    'Você tem interesse em trabalhar em ambientes multiculturais e diversificados?',
    'Você é interessado em ajudar as pessoas a melhorar sua saúde e bem-estar?',
    'Você gosta de trabalhar em ambientes dinâmicos e enfrentar novos desafios?',
    'Você é bom em criar soluções inovadoras para problemas?',
    'Você tem interesse em trabalhar em áreas relacionadas à educação e desenvolvimento infantil?',
    'Você é bom em lidar com situações estressantes e encontrar soluções rápidas?'
];
?>



<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teste Vocacional</title>
    <link rel="stylesheet" type="text/css" href="assets/css/teste.css"> <!-- Incluindo o CSS -->
    <link rel="shortcut icon" href="assets/img/logo2.jpeg" type="image/x-icon">
</head>
<body>
    <header>
        <img src="assets/img/logoFAMEC.png" alt="">
    </header>

    <?php if ($current_question < count($questions)) : ?>
        <form method="POST" action="testev.php" id="f1">
            <p><?php echo $questions[$current_question]; ?></p>
            <input type="radio" name="answer" value="sim" required> Sim<br>
            <input type="radio" name="answer" value="nao" required> Não<br>
            <button type="submit">Próxima</button>
        </form>
    <?php else : ?>
        <!-- Formulário de dados pessoais -->
        <form method="POST" action="process.php">
            <h3>Por favor, insira seus dados:</h3>
            Nome: <input type="text" name="nome" required><br>
            E-mail: <input type="email" name="email" required><br>
            Telefone: <input type="text" name="telefone" required  placeholder="(00) 0000-0000"><br>
            <button type="submit">Enviar</button>
        </form>
    <?php endif; ?>

    <?php
    // Processando a resposta e avançando a pergunta
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['answer'])) {
        $_SESSION['answers'][$current_question] = $_POST['answer'];
        $_SESSION['current_question'] = ++$current_question;
        header("Location: testev.php");
        exit();
    }
    ?>

    <footer>
        <p>Teste Vocacional © 2024</p>
    </footer>
</body>
</html>

