<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teste Vocacional</title>
    <link rel="stylesheet" href="assets/css/teste.css">
    <link rel="shortcut icon" href="assets/img/logo2.jpeg" type="image/x-icon">
    <script>
       document.addEventListener("DOMContentLoaded", function() {
    let currentQuestion = 0;
    const questions = document.querySelectorAll(".question-container");
    const form = document.querySelector("form");
    const nextButton = document.querySelector("#next-button");
    const prevButton = document.querySelector("#prev-button");
    const submitButton = document.querySelector("input[type='submit']");
    const cadastroContainer = document.querySelector("#cadastro-container");

    function showQuestion(index) {
        questions.forEach((question, i) => {
            question.classList.toggle("hidden", i !== index);
        });
        prevButton.classList.toggle("hidden", index === 0);
        nextButton.classList.toggle("hidden", index === questions.length - 1);
        submitButton.classList.toggle("hidden", index !== questions.length - 1);
    }

    function showCadastro() {
        form.classList.add("hidden");
        cadastroContainer.classList.remove("hidden");
    }

    form.addEventListener("submit", function(event) {
        event.preventDefault();

        // Coletar as respostas do teste
        const respostas = [];
        questions.forEach((question, index) => {
            const selectedOption = question.querySelector('input[type="radio"]:checked');
            if (selectedOption) {
                respostas[index] = selectedOption.value;
            } else {
                alert('Por favor, responda todas as perguntas.');
                return;
            }
        });

        // Armazenar as respostas na sessão
        <?php $_SESSION['respostas'] = array(); ?>
        const formData = new FormData();
        formData.append('respostas', JSON.stringify(respostas));

        // Enviar os dados do formulário para o arquivo process.php
        fetch('process.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            console.log(data);
            window.location.href = 'resultado.php';  // Redirecionar para a página de resultado
        })
        .catch(error => console.error(error));
    });

    nextButton.addEventListener("click", function() {
        if (currentQuestion < questions.length - 1) {
            currentQuestion++;
            showQuestion(currentQuestion);
        }
    });

    prevButton.addEventListener("click", function() {
        if (currentQuestion > 0) {
            currentQuestion--;
            showQuestion(currentQuestion);
        }
    });

    showQuestion(currentQuestion);
});

    </script>
</head>
<body>
    <header>
        <img id="logo" src="assets/img/LogoFAMEC.png" alt="logo">
    </header>

    <main>
        <form id="respostas" method="post" action="process.php" name="respostas">
            <!-- Perguntas fixas -->
            <div class='question-container'>
                <p>Você gosta de resolver problemas complexos e encontrar soluções criativas?</p>
                <label><input type='radio' name='q1' value='0'> Não</label><br>
                <label><input type='radio' name='q1' value='1'> Sim</label>
            </div>
            <div class='question-container'>
                <p>Você é bom em trabalhar em equipe e colaborar com outros?</p>
                <label><input type='radio' name='q2' value='0'> Não</label><br>
                <label><input type='radio' name='q2' value='1'> Sim</label>
            </div>
            <div class='question-container'>
                <p>Você tem habilidades de comunicação eficazes e pode se expressar claramente?</p>
                <label><input type='radio' name='q3' value='0'> Não</label><br>
                <label><input type='radio' name='q3' value='1'> Sim</label>
            </div>
            <div class='question-container'>
                <p>Você é interessado em entender o comportamento humano e como as pessoas se desenvolvem?</p>
                <label><input type='radio' name='q4' value='0'> Não</label><br>
                <label><input type='radio' name='q4' value='1'> Sim </label>
            </div>
            <div class='question-container'>
                <p>Você gosta de trabalhar com números e análise de dados?</p>
                <label><input type='radio' name='q5' value='0'> Não</label><br>
                <label><input type='radio' name='q5' value='1'> Sim</label>
            </div>
            <div class='question-container'>
                <p>Você é bom em gerenciar projetos e priorizar tarefas?</p>
                <label><input type='radio' name='q6' value='0'> Não</label><br>
                <label><input type='radio' name='q6' value='1'> Sim</label>
            </div>
            <div class='question-container'>
                <p>Você tem habilidades de liderança e pode motivar os outros?</p>
                <label><input type='radio' name='q7' value='0'> Não</label><br>
                <label><input type='radio' name='q7' value='1'> Sim</label>
            </div>
            <div class='question-container'>
                <p>Você é interessado em entender como as organizações funcionam e como podem ser melhoradas?</p>
                <label><input type='radio' name='q8' value='0'> Não</label><br>
                <label><input type='radio' name='q8' value='1'> Sim</label>
            </div>
            <div class='question-container'>
                <p>Você gosta de trabalhar com pessoas e ajudá-las a alcançar seus objetivos?</p>
                <label><input type='radio' name='q9' value='0'> Não</label><br>
                <label><input type='radio' name='q9' value='1'> Sim</label>
            </div>
            <div class='question-container'>
                <p>Você é bom em resolver conflitos e encontrar soluções pacíficas?</p>
                <label><input type='radio' name='q10' value='0'> Não</label><br>
                <label><input type='radio' name='q10' value='1'> Sim</label>
            </div>
            <div class='question-container'>
                <p>Você tem habilidades de planejamento e pode criar estratégias eficazes?</p>
                <label><input type='radio' name='q11' value='0'> Não</label><br>
                <label><input type='radio' name='q11' value='1'> Sim</label>
            </div>
            <div class='question-container'>
                <p>Você é interessado em entender como as leis e regulamentos afetam a sociedade?</p>
                <label><input type='radio' name='q12' value='0'> Não</label><br>
                <label><input type='radio' name='q12' value='1'> Sim</label>
            </div>
            <div class='question-container'>
                <p>Você gosta de aprender sobre novas tecnologias e como elas podem ser aplicadas?</p>
                <label><input type='radio' name='q13' value='0'> Não</label><br>
                <label><input type='radio' name='q13' value='1'> Sim</label>
            </div>
            <div class='question-container'>
                <p>Você é bom em analisar informações e tomar decisões baseadas em dados?</p>
                <label><input type='radio' name='q14' value='0'> Não</label><br>
                <label><input type='radio' name='q14' value='1'> Sim</label>
            </div>
            <div class='question-container'>
                <p>Você tem interesse em trabalhar em ambientes multiculturais e diversificados?</p>
                <label><input type='radio' name='q15' value='0'> Não</label><br>
                <label><input type='radio' name='q15' value='1'> Sim</label>
            </div>
            <div class='question-container'>
                <p>Você é interessado em ajudar as pessoas a melhorar sua saúde e bem-estar?</p>
                <label><input type='radio' name='q16' value='0'> Não</label><br >
                <label><input type='radio' name='q16' value='1'> Sim</label>
            </div>
            <div class='question-container'>
                <p>Você gosta de trabalhar em ambientes dinâmicos e enfrentar novos desafios?</p>
                < label><input type='radio' name='q17' value='0'> Não</label><br>
                <label><input type='radio' name='q17' value='1'> Sim</label>
            </div>
            <div class='question-container'>
                <p>Você é bom em criar soluções inovadoras para problemas?</p>
                <label><input type='radio' name='q18' value='0'> Não</label><br>
                <label><input type='radio' name='q18' value='1'> Sim</label>
            </div>
            <div class='question-container'>
                <p>Você tem interesse em trabalhar em áreas relacionadas à educação e desenvolvimento infantil?</p>
                <label><input type='radio' name='q19' value='0'> Não</label><br>
                <label><input type='radio' name='q19' value='1'> Sim</label>
            </div>
            <div class='question-container'>
                <p>Você é bom em lidar com situações estressantes e encontrar soluções rápidas?</p>
                <label><input type='radio' name='q20' value='0'> Não</label><br>
                <label><input type='radio' name='q20' value='1'> Sim</label>
            </div>

            <div class="navigation-buttons">
                <button type="button" id="prev-button" class="hidden">Anterior</button>
                <button type="button" id="next-button">Próxima</button>
                <input type="submit" name="submit_teste" value="Enviar" class="hidden">
            </div>
        </form>

        <div id="cadastro-container" class="hidden">
            <h2>Por favor, preencha seus dados</h2>
            <form id="cadastroForm" action="process.php" method="post">
                <label for="nome">Nome:</label>
                <input type="text" id="nome" name="nome" required><br><br>

                <label for="email">Email:</label>
                <input type='email' id="email" name="email" required><br><br>

                <label for="telefone">Telefone:</label>
                <input type="tel" id="telefone" name="telefone" required><br><br>

                <input type="submit" name="submit_cadastro" value="Concluído">
            </form>
        </div>
    </main>

    <footer>
        <p>&copy; 2024 Teste Vocacional. Todos os direitos reservados</p>
    </footer>
</body>
</html>