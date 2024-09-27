<?php
session_start();
session_unset(); // Limpa todas as variáveis de sessão
session_destroy(); // Destrói a sessão

// Redireciona de volta para a página do teste
header("Location: testev.php");
exit();
?>