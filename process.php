<?php
session_start();
include 'database.php';

$answers = $_SESSION['answers'];
$nome = $_POST['nome'];
$email = $_POST['email'];
$telefone = $_POST['telefone'];

// Cursos e suas respectivas respostas e descrições
$cursos = [
    'Direito' => [
        'respostas' => [0, 1, 1, 0, 1, 1, 1, 0, 1, 1, 1, 0, 0, 1, 1, 1, 1, 1, 0, 0],
        'descricao' => 'O curso de Direito forma profissionais capacitados para atuar na área jurídica, com uma duração média de cinco anos. Seu objetivo principal é preparar os alunos para compreender e interpretar as leis, desenvolvendo habilidades de argumentação e análise crítica. O currículo abrange disciplinas como Direito Civil, Penal, Constitucional e Administrativo, preparando os graduados para diversas carreiras, como advogados, juízes e promotores. Além de fornecer um conhecimento profundo do sistema legal, o curso também incentiva a ética profissional e a empatia, tornando os formados agentes importantes na promoção da justiça e defesa dos direitos na sociedade.'
    ],
    'Enfermagem' => [
        'respostas' => [1, 0, 1, 0, 1, 1, 1, 0, 0, 1, 0, 0, 0, 0, 0, 1, 1, 0, 1, 0],
        'descricao' => 'O curso de Enfermagem é voltado para a formação de profissionais que atuam na promoção, prevenção e recuperação da saúde. Com duração média de quatro anos, os alunos aprendem sobre anatomia, fisiologia, farmacologia e técnicas de atendimento ao paciente. O curso combina aulas teóricas com práticas em laboratórios e estágios em hospitais e clínicas. Os enfermeiros desempenham um papel crucial na assistência a pacientes, realizando procedimentos, administrando medicamentos e orientando famílias sobre cuidados de saúde. Ao se formarem, os graduados podem trabalhar em diversas áreas, como hospitais, clínicas, unidades de saúde, e também em gestão e ensino.'
    ],
    'Psicologia' => [
        'respostas' => [0, 1, 0, 1, 1, 1, 0, 1, 0, 0, 1, 0, 0, 1, 1, 1, 1, 0, 0, 1],
        'descricao' => 'O curso de Psicologia é destinado ao estudo do comportamento humano e dos processos mentais. Com uma duração média de cinco anos, os estudantes exploram áreas como desenvolvimento humano, psicopatologia, psicologia social e técnicas de intervenção terapêutica. O curso combina teoria e prática, com disciplinas que abrangem desde a pesquisa em psicologia até estágios supervisionados em contextos clínicos e organizacionais. Os psicólogos são profissionais capacitados para compreender e ajudar pessoas a lidar com questões emocionais, comportamentais e sociais, atuando em clínicas, hospitais, escolas, empresas e em pesquisas.'
    ],
    'Administração' => [
        'respostas' => [0, 1, 1, 1 , 1, 0, 1, 1, 1, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1],
        'descricao' => 'O curso de Administração forma profissionais capacitados para gerenciar e otimizar o funcionamento de organizações. Ao longo da graduação, os alunos aprendem sobre áreas fundamentais como finanças, marketing, recursos humanos e logística. O curso enfatiza o desenvolvimento de habilidades de liderança, tomada de decisões e resolução de problemas, preparando os estudantes para enfrentar os desafios do ambiente corporativo. Os graduados podem atuar em diversos setores, incluindo empresas privadas, públicas, startups e até mesmo abrir seus próprios negócios, contribuindo para o crescimento e a inovação nas organizações.'
    ],
    'Logística' => [
        'respostas' => [1, 0, 1, 1, 0, 1, 1, 0, 1, 0, 0, 0, 1, 0, 0, 1, 1, 1, 0, 0],
        'descricao' => 'O curso de Logística capacita profissionais a planejar, implementar e controlar a movimentação e o armazenamento de bens e serviços de forma eficiente. Os alunos aprendem sobre gestão de cadeias de suprimentos, transporte, distribuição, e estratégias de redução de custos. O curso combina teoria e prática, abordando ferramentas tecnológicas e metodologias para otimizar processos logísticos. Graduados em Logística podem atuar em diversas áreas, como transportadoras, empresas de varejo, indústrias e consultorias, contribuindo para a melhoria da eficiência operacional e a satisfação do cliente.'
    ],
    'Pedagogia' => [
        'respostas' => [0, 1, 0, 1, 0, 0, 1, 1, 0, 1, 1, 0, 0, 1, 1, 0, 1, 1, 1, 0],
        'descricao' => 'O curso de Pedagogia forma profissionais capacitados para atuar na área da educação, preparando-os para trabalhar em diversas instituições de ensino, como escolas, creches e centros de formação. Os estudantes aprendem sobre teorias educacionais, práticas pedagógicas, psicologia do desenvolvimento e gestão escolar. Além disso, o curso aborda temas como inclusão, diversidade e metodologias de ensino. Os pedagogos desempenham papéis fundamentais na elaboração de currículos, na orientação de professores e na promoção de um ambiente de aprendizado eficaz, contribuindo para a formação integral dos alunos e o desenvolvimento da sociedade.'
    ],
    'Ciências Contábeis' => [
        'respostas' => [1, 0, 1, 1, 1, 0, 1, 0, 0, 1, 1, 0, 0, 1, 0, 1, 0, 1, 1, 0],
        'descricao' => 'O curso de Ciências Contábeis tem como objetivo formar profissionais capazes de gerenciar e analisar as finanças de empresas e organizações. Com uma duração média de quatro a cinco anos, o curso abrange disciplinas como Contabilidade Geral, Auditoria, Análise de Balanços, e Gestão Financeira. Os estudantes aprendem a elaborar demonstrações financeiras, realizar auditorias e interpretar dados contábeis para auxiliar na tomada de decisões. Ao final da formação, os graduados podem atuar em diversas áreas, como auditoria, consultoria, controladoria e contabilidade fiscal, contribuindo para a saúde financeira das organizações e a conformidade com a legislação.'
    ],
    'Recursos Humanos' => [
        'respostas' => [1, 1, 0, 1, 1, 1, 0, 0, 1, 0, 0, 1, 0, 1, 1, 1, 1, 0, 0, 1],
        'descricao' => 'O curso de Recursos Humanos prepara profissionais para gerenciar e desenvolver o capital humano dentro das organizações. Os estudantes aprendem sobre recrutamento, seleção, treinamento, avaliação de desempenho e desenvolvimento de carreira. Além disso, o curso abrange temas como legislação trabalhista, relações interpessoais e estratégias de motivação e retenção de talentos. Os profissionais de recursos humanos desempenham um papel essencial na criação de um ambiente de trabalho saudável e produtivo, garantindo que a organização tenha as habilidades e competências necessárias para alcançar seus objetivos, ao mesmo tempo em que promovem o bem-estar dos colaboradores.'
    ]
];

// Função para determinar um curso baseado nas respostas
function determinarCurso($respostas_usuario, $cursos) {
    foreach ($cursos as $curso => $detalhes) {
        $respostas_curso = $detalhes['respostas'];
        // Aqui você pode adicionar lógica para associar o curso a uma resposta específica
        // Neste exemplo, estamos apenas retornando o curso, mas você pode adicionar a lógica conforme necessário
        if ($respostas_usuario == $respostas_curso) {
            return $curso;
        }
    }
    // Se nenhuma resposta corresponder, retorne um curso padrão ou aleatório
    return array_rand($cursos); // Retorna um curso aleatório
}

// Determinar o curso recomendado antes de salvar no banco de dados
$curso_recomendado = determinarCurso($answers, $cursos);
$descricao_curso = $cursos[$curso_recomendado]['descricao'];

// Salvar os resultados no banco de dados
$sql = "INSERT INTO resultados (nome, email, telefone, respostas, curso_recomendado) VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$respostas_serializadas = serialize($answers);
$stmt->bind_param('sssss', $nome, $email, $telefone, $respostas_serializadas, $curso_recomendado);
$stmt->execute();

$_SESSION['curso_recomendado'] = $curso_recomendado;
$_SESSION['descricao_curso'] = $descricao_curso;

header("Location: resultado.php");
exit();
?>
