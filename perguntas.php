<?php
// Perguntas do teste
$perguntas = array(
  "Você gosta de resolver problemas complexos?",
);

// Exibir as perguntas
echo "<h1>Perguntas do Teste</h1>";
foreach ($perguntas as $pergunta) {
  echo "<p>$pergunta</p>";
  echo "<input type='radio' name='resposta[]' value='sim'> Sim";
  echo "<input type='radio' name='resposta[]' value='nao'> Não";
  echo "<br><br>";
}
echo "<input type='submit' value='Enviar Respostas'>";

$respostas = $_POST['resposta'];
?>