<?php
session_start();
include 'database.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['submit_teste'])) {
        // Processar respostas do teste
        $respostas = [];
        for ($i = 1; $i <= 20; $i++) {
            $respostas[] = isset($_POST['q' . $i]) && $_POST['q' . $i] == '0' ? 0 : 1;
        }

        // Associações de respostas aos cursos e descrições
        $associacaoRespostasCursos = [
            'Direito' => [
                'respostas' => [0, 1, 1, 0, 1, 1, 1, 0, 1, 1, 1, 0, 0, 1, 1, 1, 1, 1, 0, 0],
                'descricao' => 'O curso de Direito oferece uma compreensão profunda do sistema jurídico e das normas que regem a sociedade. Durante a graduação, os alunos estudam as leis fundamentais que 
                organizam a vida social e econômica, abordando temas como Direito Constitucional, Civil, Penal e Administrativo.
                Os estudantes aprendem a analisar e interpretar leis, a entender o funcionamento dos tribunais e a desenvolver habilidades de 
                argumentação e defesa. A formação em Direito prepara os profissionais para atuar em diversas áreas, como advocacia, consultoria jurídica e funções no setor público. A carreira jurídica exige uma combinação 
                de conhecimento técnico, habilidades analíticas e um compromisso com a justiça e a equidade.'
            ],
            'Enfermagem' => [
                'respostas' => [1, 0, 1, 0, 1, 1, 1, 0, 0, 1, 0, 0, 0, 0, 0, 1, 1, 0, 1, 0],
                'descricao' => 'O curso de Enfermagem prepara os alunos para oferecer cuidados essenciais à saúde, abrangendo desde a administração de medicamentos até o suporte direto em procedimentos médicos. 
                Ao longo da graduação, os estudantes 
                adquirem conhecimentos fundamentais sobre o funcionamento do corpo humano, doenças e as melhores práticas para promover a saúde e a recuperação dos pacientes.
                A formação em Enfermagem desenvolve habilidades práticas e teóricas, permitindo que os profissionais atuem em diversos contextos, como hospitais, clínicas e unidades de saúde comunitária. A profissão exige não 
                apenas conhecimento técnico, mas também uma profunda empatia e habilidades de comunicação para oferecer suporte eficaz e humanizado aos pacientes. Os enfermeiros desempenham um papel vital na manutenção da saúde
                 e no bem-estar das pessoas, contribuindo significativamente para a qualidade do atendimento médico e a recuperação dos pacientes.'
            ],
            'Psicologia' => [
                'respostas' => [0, 1, 0, 1, 1, 1, 0, 1, 0, 0, 1, 0, 0, 1, 1, 1, 1, 0, 0, 1],
                'descricao' => 'O curso de Psicologia é dedicado ao estudo do comportamento humano e dos processos mentais. Ele explora como pensamos, sentimos e agimos,
                 oferecendo uma compreensão abrangente das emoções e comportamentos. Durante a graduação, os alunos aprendem sobre diversas abordagens teóricas, técnicas de avaliação e intervenções terapêuticas.
                Os psicólogos podem atuar em várias áreas, como clínica, organizacional, escolar e forense, ajudando pessoas a superar desafios emocionais, promover o bem-estar e melhorar 
                a qualidade de vida. A formação em Psicologia desenvolve habilidades essenciais, como empatia, comunicação e análise crítica, preparando os profissionais para contribuir de forma significativa na compreensão e no suporte à saúde mental.'
            ],
            'Administração' => [
                'respostas' => [0, 1, 1, 1, 0, 1, 1, 0, 1, 0, 0, 0, 1, 0, 1, 0, 1, 1, 0, 1],
                'descricao' => 'O curso de Administração capacita os alunos a gerir e coordenar organizações, desenvolvendo habilidades essenciais para otimizar recursos 
                e alcançar objetivos empresariais. Durante a graduação, os estudantes exploram conceitos e práticas fundamentais para a gestão eficiente de empresas e instituições.
                Os alunos aprendem sobre planejamento estratégico, finanças, marketing, e recursos humanos, adquirindo competências para analisar e resolver problemas organizacionais. A formação 
                abrange a criação e implementação de estratégias que visam melhorar o desempenho e a competitividade das organizações.
                Os profissionais formados em Administração podem atuar em diversos setores, incluindo empresas privadas, instituições públicas e organizações não-governamentais.
                A carreira exige habilidades analíticas, de liderança e de tomada de decisão, preparando os administradores para enfrentar desafios e contribuir para o sucesso e crescimento das organizações onde atuam.'
            ],
            'Logística' => [
                'respostas' => [0, 1, 1, 1, 0, 1, 0, 1, 1, 0, 1, 0, 1, 0, 1, 0, 1, 0, 1, 0],
                'descricao' => 'O curso de Logística prepara os alunos para gerenciar e otimizar o fluxo de produtos e serviços dentro e entre organizações. A graduação abrange a coordenação e a supervisão de atividades 
                essenciais para garantir que bens e serviços cheguem de forma eficiente ao consumidor final.
                Os estudantes aprendem a planejar e controlar a cadeia de suprimentos, desde o armazenamento e transporte até a distribuição e gestão de inventários. A formação inclui o estudo de técnicas para melhorar a 
                eficiência operacional, reduzir custos e lidar com a complexidade das operações logísticas.
                Os profissionais formados em Logística podem atuar em diversos segmentos, como transporte, armazenamento, distribuição e gestão da cadeia de suprimentos. A carreira exige habilidades de análise, organização 
                e resolução de problemas, permitindo que os especialistas em logística desempenhem um papel crucial na eficiência e sucesso das operações empresariais.'
            ],
            'Pedagogia' => [
                'respostas' => [1, 0, 1, 0, 1, 1, 0, 1, 0, 0, 0, 0, 1, 0, 0, 1, 1, 1, 1, 1],
                'descricao' => 'O curso de Pedagogia prepara os alunos para atuar na educação infantil e nas primeiras séries do ensino fundamental, focando no desenvolvimento e aprendizado das crianças. A graduação oferece 
                uma compreensão aprofundada dos processos de ensino e aprendizagem, capacitando os futuros pedagogos a criar ambientes educacionais eficazes e inclusivos.
                Durante o curso, os estudantes exploram teorias educacionais, práticas pedagógicas e estratégias para promover o desenvolvimento cognitivo, emocional e social das crianças. A formação inclui 
                o estudo de metodologias de ensino, planejamento de atividades e avaliação do progresso dos alunos.
                Os profissionais formados em Pedagogia podem trabalhar como professores, coordenadores pedagógicos e gestores educacionais em escolas, creches e instituições de ensino. A carreira exige 
                habilidades de comunicação, criatividade e uma paixão pela educação, permitindo que os pedagogos desempenhem um papel vital na formação e desenvolvimento das novas gerações.'
            ],
            'Ciências Contábeis' => [
                'respostas' => [0, 1, 1, 0, 1, 0, 1, 1, 0, 1, 1, 0, 0, 1, 1, 0, 1, 1, 0, 0],
                'descricao' => 'O curso de Ciências Contábeis forma profissionais capacitados para gerenciar e analisar as finanças de empresas e organizações. Durante a graduação, os alunos estudam princípios contábeis, 
                normas fiscais e técnicas de auditoria, adquirindo habilidades essenciais para a administração financeira e a tomada de decisões empresariais.
                Os estudantes aprendem a elaborar e interpretar relatórios financeiros, a realizar auditorias e a garantir a conformidade com as regulamentações fiscais. A formação também aborda a gestão de recursos,
                planejamento financeiro e controle de custos, preparando os futuros contadores para enfrentar desafios financeiros e otimizar o desempenho econômico das organizações.
                Os profissionais de Ciências Contábeis podem atuar em diversos setores, incluindo empresas privadas, organizações governamentais e escritórios de contabilidade. A carreira exige habilidades analíticas, atenção aos 
                detalhes e conhecimento sólido das normas contábeis, permitindo que os contadores desempenhem um papel crucial na saúde financeira e na transparência das organizações onde trabalham.'
            ],
            'Recursos Humanos' => [
                'respostas' => [0, 1, 1, 0, 1, 1, 1, 1, 0, 0, 0, 0, 0, 1, 1, 1, 1, 1, 0, 1],
                'descricao' => 'O curso de Recursos Humanos prepara os alunos para gerenciar o capital humano das organizações, focando na contratação, desenvolvimento e bem-estar dos funcionários. A graduação abrange uma 
                variedade de práticas e estratégias para otimizar o ambiente de trabalho e garantir que a equipe esteja alinhada com os objetivos organizacionais.
                Durante o curso, os estudantes aprendem sobre recrutamento e seleção, treinamento e desenvolvimento, gestão de desempenho, e legislação trabalhista. A formação inclui a criação de políticas de recursos humanos, 
                a resolução de conflitos e a implementação de programas de engajamento e motivação.
                Os profissionais formados em Recursos Humanos podem atuar em diferentes tipos de organizações, desde empresas privadas e instituições públicas até organizações sem fins lucrativos. A carreira exige habilidades de 
                comunicação, empatia e capacidade de análise, permitindo que os especialistas em RH desempenhem um papel fundamental no desenvolvimento de uma cultura organizacional positiva e na maximização do potencial dos colaboradores.'
            ]
        
        ];

        // Lógica para encontrar o curso mais recomendado
        $melhorCurso = null;
        $pontuacaoMaxima = -1;

        foreach ($associacaoRespostasCursos as $curso => $dadosCurso) {
            $pontuacao = 0;
            foreach ($dadosCurso['respostas'] as $index => $resposta) {
                if ($resposta == $respostas[$index]) {
                    $pontuacao++;
                }
            }

            if ($pontuacao > $pontuacaoMaxima) {
                $pontuacaoMaxima = $pontuacao;
                $melhorCurso = $curso;
                $descricaoCurso = $dadosCurso['descricao'];
            }
        }

        // Armazenar o resultado na sessão temporariamente
        $_SESSION['resultado_teste'] = [
            'curso' => $melhorCurso,
            'descricao' => $descricaoCurso
        ];

        echo json_encode(['success' => true]);
    } elseif (isset($_POST['cadastro'])) {
        // Processar o cadastro
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $telefone = $_POST['telefone'];

        $resultado_teste = $_SESSION['resultado_teste'];

<<<<<<<< HEAD:process.php
        // Salvar no banco de dados
        $stmt = $conn->prepare("INSERT INTO usuarios (nome, email, telefone) VALUES (?, ?, ?)");
        $stmt->execute([$nome, $email, $telefone]);

        $stmt = $conn->prepare("INSERT INTO resultado_teste (nome, telefone, resultado) VALUES (?, ?, ?)");
        $stmt->execute([$nome, $telefone, $resultado_teste['curso']]);

        echo json_encode(['success' => true, 'resultado' => $resultado_teste['curso']]);
    }
}
========
    <footer>
        <p>&copy; 2024 Teste Vocacional - FAMEC. Todos os direitos reservados.</p>
    </footer>
</body>
</html>
>>>>>>>> 38300f1d25da00d89d1ae7faf1a9ac4d1cb8eaa5:testev.php
