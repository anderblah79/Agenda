<?php
// Verifica se o ID do agendamento foi fornecido via parâmetro GET
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $agendamento_id = $_GET['id'];

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

    // Consulta os dados do agendamento com base no ID
    $sql = "SELECT * FROM agendamentos WHERE id = $agendamento_id";
    $result = $conn->query($sql);

    // Verifica se o agendamento existe
    if ($result->num_rows == 1) {
        $agendamento = $result->fetch_assoc();

        // Fecha a conexão
        $conn->close();
    } else {
        echo "Agendamento não encontrado.";
        exit;
    }
} else {
    echo "ID do agendamento não fornecido.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Agendamento</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <h2 class="text-center">Editar Agendamento</h2>
    <form action="processar_edicao.php" method="post">
        <input type="hidden" name="id" value="<?php echo $agendamento['id']; ?>">
        <div class="mb-3">
            <label for="nome" class="form-label">Nome:</label>
            <input type="text" class="form-control" id="nome" name="nome" value="<?php echo $agendamento['nome']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="servico" class="form-label">Serviço:</label>
            <input type="text" class="form-control" id="servico" name="servico" value="<?php echo $agendamento['servico']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="data" class="form-label">Data:</label>
            <input type="date" class="form-control" id="data" name="data" value="<?php echo $agendamento['data']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="horario" class="form-label">Horário:</label>
            <input type="time" class="form-control" id="horario" name="horario" value="<?php echo $agendamento['horario']; ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Salvar Alterações</button>
        <a href="lista_agendamentos.php" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>

