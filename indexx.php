<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teste Vocacional</title>
    <link rel="stylesheet" href="assets/css/teste.css">
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let currentQuestion = 0;
            const questions = document.querySelectorAll(".question-container");
            const form = document.querySelector("form");
            const nextButton = document.querySelector("#next-button");
            const prevButton = document.querySelector("#prev-button");
            const submitButton = document.querySelector("input[type='submit']");

            function showQuestion(index) {
                questions.forEach((question, i) => {
                    question.classList.toggle("hidden", i !== index);
                });
                prevButton.classList.toggle("hidden", index === 0);
                nextButton.classList.toggle("hidden", index === questions.length - 1);
                submitButton.classList.toggle("hidden", index !== questions.length - 1);
            }

            function handleSubmit(event) {
                // Verifica se todas as perguntas foram respondidas
                for (let i = 0; i < questions.length; i++) {
                    const question = questions[i];
                    const radioButtons = question.querySelectorAll('input[type="radio"]');
                    const checked = Array.from(radioButtons).some(rb => rb.checked);
                    if (!checked) {
                        alert('Por favor, responda todas as perguntas antes de enviar.');
                        event.preventDefault();
                        return;
                    }
                }
            }

            form.addEventListener("submit", handleSubmit);

            showQuestion(currentQuestion);

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
        });
    </script>
</head>
<body>
    <header>
        <img id="logo" src="assets/img/LogoFAMEC.png" alt="logo">
    </header>

    <main>
        <?php
        // Inicialização da mensagem de resultado e do curso recomendado
        $mensagem = '';
        $cursoRecomendado = '';

        // Definição das respostas associadas a cada curso
        $associacaoRespostasCursos = [
            'Direito' => [0, 1, 1, 0, 1, 1, 1, 0, 1, 1, 1, 0, 0, 1, 1, 1, 1, 1, 0, 0],
            'Enfermagem' => [1, 0, 1, 0, 1, 1, 1, 0, 0, 1, 0, 0, 0, 0, 0, 1, 1, 0, 1, 0],
            'Psicologia' => [0, 1, 0, 1, 1, 1, 0, 1, 0, 0, 1, 0, 0, 1, 1, 1, 1, 0, 0, 1],
            'Administração' => [0, 1, 1, 1, 0, 1, 1, 0, 1, 0, 0, 0, 1, 0, 1, 0, 1, 1, 0, 1],
            'Logística' => [0, 1, 1, 1, 0, 1, 0, 1, 1, 0, 1, 0, 1, 0, 1, 0, 1, 0, 1, 0],
            'Pedagogia' => [1, 0, 1, 0, 1, 1, 0, 1, 0, 0, 0, 0, 1, 0, 0, 1, 1, 1, 1, 1],
            'Ciências Contábeis' => [0, 1, 1, 0, 1, 0, 1, 1, 0, 1, 1, 0, 0, 1, 1, 0, 1, 1, 0, 0],
            'Recursos Humanos' => [0, 1, 1, 0, 1, 1, 1, 1, 0, 0, 0, 0, 0, 1, 1, 1, 1, 1, 0, 1]
        ];

        // Processar o formulário
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $respostas = [];
            for ($i = 1; $i <= 20; $i++) {
                $respostas[] = isset($_POST['q' . $i]) && $_POST['q' . $i] == '0' ? 0 : 1;
            }

            $melhorCurso = null;
            $pontuacaoMaxima = -1;

            foreach ($associacaoRespostasCursos as $curso => $respostasCurso) {
                $pontuacao = 0;
                foreach ($respostasCurso as $index => $resposta) {
                    if ($resposta == $respostas[$index]) {
                        $pontuacao++;
                    }
                }
                // Atualiza o melhor curso se a pontuação for maior
                if ($pontuacao > $pontuacaoMaxima) {
                    $pontuacaoMaxima = $pontuacao;
                    $melhorCurso = $curso;
                }
            }

            if ($melhorCurso) {
                $mensagem = "O curso recomendado para você é: <strong>" . $melhorCurso . "</strong>";
            }
        }
        ?>

        <?php if ($mensagem): ?>
            <h2>Resultado</h2>
            <p class='question-container'><?php echo $mensagem; ?></p>
        <?php else: ?>
            <form action="" method="post">
                <?php
                // Definição das perguntas e respostas
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
                    'Você é interessado em entender como as leis e regulamentações afetam a sociedade?',
                    'Você gosta de trabalhar em um ambiente dinâmico e em constante mudança?',
                    'Você é bom em trabalhar com tecnologia e sistemas de informação?',
                    'Você tem habilidades de análise crítica e pode avaliar informações de forma objetiva?',
                    'Você é interessado em entender como as pessoas aprendem e se desenvolvem?',
                    'Você gosta de trabalhar em um ambiente de equipe e colaborar com outros profissionais?',
                    'Você é bom em gerenciar recursos e priorizar gastos?',
                    'Você tem habilidades de comunicação escrita e pode criar relatórios eficazes?'
                ];

                // Gerar o HTML das perguntas
                foreach ($perguntas as $index => $pergunta) {
                    $questao = 'q' . ($index + 1);
                    echo "<div class='question-container'>";
                    echo "<p>" . ($index + 1) . ". $pergunta</p>";
                    echo "<input type='radio' name='$questao' value='0' required> Sim ";
                    echo "<input type='radio' name='$questao' value='1'> Não";
                    echo "</div>";
                }
                ?>

                <button type="button" id="prev-button" class="hidden">Anterior</button>
                <button type="button" id="next-button">Próxima</button>
                <input type="submit" value="Enviar" class="hidden">
            </form>
        <?php endif; ?>
    </main>

    <footer>
        <p>&copy; 2024 Teste Vocacional. Todos os direitos reservados.</p>
    </footer>
</body>
</html>
