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
            const cadastroModal = document.getElementById("cadastroModal");

            function showQuestion(index) {
                questions.forEach((question, i) => {
                    question.classList.toggle("hidden", i !== index);
                });
                prevButton.classList.toggle("hidden", index === 0);
                nextButton.classList.toggle("hidden", index === questions.length - 1);
                submitButton.classList.toggle("hidden", index !== questions.length - 1);
            }

            form.addEventListener("submit", function(event) {
                event.preventDefault();
                const allAnswered = [...questions].every(q => {
                    return q.querySelector('input[type="radio"]:checked') !== null;
                });

                if (!allAnswered) {
                    alert('Por favor, responda todas as perguntas.');
                    return;
                }

                const formData = new FormData(form);

                // Enviar os dados via AJAX
                fetch('process.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Mostrar o modal de cadastro
                        cadastroModal.style.display = "block";
                    } else {
                        alert('Ocorreu um erro ao processar o teste.');
                    }
                })
                .catch(error => {
                    console.error('Erro:', error);
                });
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

        // Fechar o modal de cadastro
        function closeModal() {
            document.getElementById("cadastroModal").style.display = "none";
        }
    </script>
    <style>
        /* Estilos do modal */
        #cadastroModal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <header>
        <img id="logo" src="assets/img/LogoFAMEC.png" alt="logo">
    </header>

    <main>
        <form id="testeForm">
            <?php
            // Array de perguntas
            $perguntas = [
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


            // Exibição das perguntas
            foreach ($perguntas as $index => $pergunta) {
                $questionNumber = $index + 1;
                echo "<div class='question-container'>";
                echo "<p>$pergunta</p>";
                echo "<label><input type='radio' name='q$questionNumber' value='0'> Não</label><br>";
                echo "<label><input type='radio' name='q$questionNumber' value='1'> Sim</label>";
                echo "</div>";
            }
            ?>

            <div class="navigation-buttons">
                <button type="button" id="prev-button" class="hidden">Anterior</button>
                <button type="button" id="next-button">Próxima</button>
                <input type="submit" name="submit_teste" value="Enviar" class="hidden">
            </div>
        </form>

        <!-- Modal de Cadastro -->
        <div id="cadastroModal">
            <div class="modal-content">
                <span class="close" onclick="closeModal()">&times;</span>
                <h2>Cadastro</h2>
                <form id="cadastroForm">
                    <label for="nome">Nome:</label>
                    <input type="text" id="nome" name="nome" required><br>
                    <label for="email">E-mail:</label>
                    <input type="email" id="email" name="email" required><br>
                    <label for="telefone">Telefone:</label>
                    <input type="text" id="telefone" name="telefone" required><br>
                    <button type="submit">Enviar Cadastro</button>
                </form>
            </div>
        </div>
    </main>

    <footer>
        <p>&copy; 2024 Teste Vocacional. Todos os direitos reservados</p>
    </footer>

    <script>
        // Lidar com o envio do formulário de cadastro
        document.getElementById('cadastroForm').addEventListener('submit', function(event) {
            event.preventDefault();

            const formData = new FormData(this);

            fetch('process.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Cadastro realizado com sucesso! O resultado do teste foi: ' + data.resultado);
                    closeModal();
                } else {
                    alert('Erro ao realizar cadastro.');
                }
            })
            .catch(error => {
                console.error('Erro:', error);
            });
        });
    </script>
</body>
</html>
