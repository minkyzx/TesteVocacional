<?php
// Obter as respostas do usuário
$respostas = $_POST['resposta'];

// Calcular a pontuação do usuário
$pontuacao = 0;
foreach ($respostas as $resposta) {
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
?>