<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agendamento de Serviços</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <header>
        <h1>Salão de Beleza Encanto</h1>
        <nav>
            <ul>
                <li><a href="servicos.php">Página Principal</a></li>
                <li><a href="agenda.php">Voltar</a></li>
                <li><a href='gerar_pdf.php?id=" . $row_agendamento["id"] . "'>PDF</a></a></li>

            </ul>
        </nav>
    </header>
    <div class="container" id="lista-agendamentos">
        <h2 class="text-center">Lista de Agendamentos</h2>

        <?php
        // Definindo a codificação de caracteres do PHP para UTF-8
        header('Content-Type: text/html; charset=utf-8');

        // Dados de conexão com o banco de dados
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "salao";

        // Cria a conexão
        $conn = new mysqli($servername, $username, $password, $database);

        // Verifica a conexão
        if ($conn->connect_error) {
            die("Falha na conexão: " . $conn->connect_error);
        }

        // Consulta os serviços disponíveis
        $sql_servicos = "SELECT DISTINCT UCASE(servico) AS servico FROM agendamentos ORDER BY servico ASC";
        $result_servicos = $conn->query($sql_servicos);

        // Verifica se existem serviços
        if ($result_servicos->num_rows > 0) {
            // Loop pelos serviços
            while ($row_servico = $result_servicos->fetch_assoc()) {
                $servico_atual = $row_servico["servico"];
                echo "<h3 class='mt-4'>$servico_atual</h3>";
                // Consulta os agendamentos para o serviço atual, ordenando-os pelo nome
                $sql_agendamentos = "SELECT id, nome, DATE_FORMAT(data, '%d/%m/%Y') AS data_formatada, SUBSTR(horario, 1, 5) AS horario FROM agendamentos WHERE UCASE(servico) = '$servico_atual' ORDER BY nome ASC";
                $result_agendamentos = $conn->query($sql_agendamentos);
                // Verifica se existem agendamentos para o serviço atual
                if ($result_agendamentos->num_rows > 0) {
                    echo "<div class='row border-top border-bottom'>
                    <div class='col border-end border-start'><strong>Nome</strong></div>
                    <div class='col border-end'><strong>Data</strong></div>
                    <div class='col border-end'><strong>Horário</strong></div>
                    <div class='col border-end'><strong>Edição</strong></div>
                </div>";
                
                    // Loop pelos agendamentos
                    while ($row_agendamento = $result_agendamentos->fetch_assoc()) {
                        echo "<div class='row border-bottom'>
            <div class='col border-end border-start'>" . $row_agendamento["nome"] . "</div>
            <div class='col border-end'>" . $row_agendamento["data_formatada"] . "</div>
            <div class='col border-end'>" . $row_agendamento["horario"] . "</div>
            <div class='col border-end border-start'>
            
                <a href='editar.php?id=" . $row_agendamento["id"] . "' class='btn btn-primary btn-sm'>Editar</a>
                <button onclick='confirmDelete(" . $row_agendamento["id"] . ")' class='btn btn-danger btn-sm'>Excluir</button>
                
            </div>
            
        </div>";        
                    }
                } else {
                    echo "<p>Não existem agendamentos para este serviço.</p>";
                }
            }
        } else {
            echo "<p>Não existem serviços disponíveis.</p>";
        }

        // Fecha a conexão
        $conn->close();
        ?>
        <script>
            function confirmDelete(id) {
                if (confirm("Tem certeza de que deseja excluir este agendamento?")) {
                    window.location.href = "excluir.php?id=" + id;
                }
            }
            
        </script>
    </div>
    <footer>
        <h2>Contato</h2>
        <p>Entre em contato conosco para mais informações ou dúvidas:</p>
        <p>Email: contato@salaodebeleza.com</p>
        <p>&copy; 2024 Salão de Beleza</p>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    
</body>

</html>