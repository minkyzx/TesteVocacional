<?php
// Iniciar a sessão
session_start();

// Perguntas do teste
$perguntas = array(
  "Você gosta de resolver problemas complexos e encontrar soluções criativas?",
  "Você é bom em trabalhar em equipe e colaborar com outros?",
  "Você tem habilidades de comunicação eficazes e pode se expressar claramente?",
  "Você é interessado em entender o comportamento humano e como as pessoas se desenvolvem?",
  "Você gosta de trabalhar com números e análise de dados?",
  "Você é bom em gerenciar projetos e priorizar tarefas?",
  "Você tem habilidades de liderança e pode motivar os outros?",
  "Você é interessado em entender como as organizações funcionam e como podem ser melhoradas?",
  "Você gosta de trabalhar com pessoas e ajudá-las a alcançar seus objetivos?",
  "Você é bom em resolver conflitos e encontrar soluções pacíficas?",
  "Você tem habilidades de planejamento e pode criar estratégias eficazes?",
  "Você é interessado em entender como as leis e regulamentações afetam a sociedade?",
  "Você gosta de trabalhar em um ambiente dinâmico e em constante mudança?",
  "Você é bom em trabalhar com tecnologia e sistemas de informação?",
  "Você tem habilidades de análise crítica e pode avaliar informações de forma objetiva?",
  "Você é interessado em entender como as pessoas aprendem e se desenvolvem?",
  "Você gosta de trabalhar em um ambiente de equipe e colaborar com outros profissionais?",
  "Você é bom em gerenciar recursos e priorizar gastos?",
  "Você tem habilidades de comunicação escrita e pode criar relatórios eficazes?",
  "Você é interessado em entender como as organizações podem ser mais eficientes e eficazes?",
);

// Verificar se o usuário já respondeu a todas as perguntas
if ($_SESSION['pergunta_atual'] >= count($perguntas)) {
  // Calcular a pontuação do usuário
  $pontuacao = 0;
  foreach ($_SESSION['respostas'] as $resposta) {
    if ($resposta == 'sim') {
      $pontuacao += 5;
    } else {
      $pontuacao += 1;
    }
  }

  // Exibir o resultado do teste
  echo "<h1>Resultado do Teste</h1>";
  if ($pontuacao >= 15 && $pontuacao <= 18) {
    echo "Você é mais adequado para uma carreira em desenvolvimento de software.";
  } elseif ($pontuacao >= 19 && $pontuacao <= 22) {
    echo "Você é mais adequado para uma carreira em análise de dados.";
  } elseif ($pontuacao >= 23 && $pontuacao <= 25) {
    echo "Você é mais adequado para uma carreira em liderança.";
  }

  // Limpar a sessão
  session_unset();
  session_destroy();
  exit;
}

// Exibir a pergunta atual
echo "<h1>Pergunta " . ($_SESSION['pergunta_atual'] + 1) . " de " . count($perguntas) . "</h1>";
echo "<p>" . $perguntas[$_SESSION['pergunta_atual']] . "</p>";
echo "<form action='pergunta.php' method='post'>";
echo "<input type='radio' name='resposta' value='sim'> Sim";
echo "<input type='radio' name='resposta' value='nao'> Não";
echo "<input type='submit' value='Responder'>";
echo "</form>";

// Verificar se o usuário respondeu a pergunta
if (isset($_POST['resposta'])) {
  // Armazenar a resposta do usuário
  $_SESSION['respostas'][] = $_POST['resposta'];

  // Atualizar a pergunta atual
  $_SESSION['pergunta_atual']++;
}
?>