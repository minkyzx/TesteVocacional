<?php
function calcularPontuacao($respostas, $questoes) {
    $pontuacao = 0;
    foreach ($questoes as $questao) {
        $pontuacao += isset($respostas[$questao]) ? (int)$respostas[$questao] : 0;
    }
    return $pontuacao;
}

$respostas = $_POST;

$cursos = [
    'Direito' => [1, 6, 12, 15],
    'Enfermagem' => [2, 9, 13, 17],
    'Psicologia' => [4, 8, 11, 16],
    'Administração Logística' => [3, 5, 7, 18],
    'Pedagogia' => [2, 9, 14, 19],
    'Ciências Contábeis' => [5, 10, 15, 18],
    'Recursos Humanos' => [3, 6, 8, 17]
];


$pontuacoes = [];
foreach ($cursos as $curso => $questoes) {
    $pontuacoes[$curso] = calcularPontuacao($respostas, $questoes);
}


$cursoRecomendado = array_keys($pontuacoes, max($pontuacoes))[0];
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado do Teste Vocacional</title>
</head>
<body>
    <h1>Resultado do Teste Vocacional</h1>
    <p>O curso recomendado para você é: <strong><?php echo $cursoRecomendado; ?></strong></p>
</body>
</html>
