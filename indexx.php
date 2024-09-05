<?php
// Iniciar a sessão
session_start();

// Verificar se o usuário já iniciou o teste
if (isset($_SESSION['teste_iniciado'])) {
  header("Location: pergunta.php");
  exit;
}

// Iniciar o teste
$_SESSION['teste_iniciado'] = true;
$_SESSION['pergunta_atual'] = 0;
$_SESSION['respostas'] = array();

// Redirecionar para a página de pergunta
header("Location: pergunta.php");
exit;
?>
i