<?php
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

// Processamento do formulário
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitiza e valida os dados do formulário
    $nome = mysqli_real_escape_string($conn, $_POST['nome']);
    $servico = mysqli_real_escape_string($conn, $_POST['servico']);
    $data = $_POST['data']; // Supondo que a data já esteja no formato correto
    $horario = $_POST['horario']; // Supondo que o horário já esteja no formato correto

    // Insere os dados no banco de dados
    $sql = "INSERT INTO agendamentos (nome, servico, data, horario) VALUES ('$nome', '$servico', '$data', '$horario')";

    if ($conn->query($sql) === TRUE) {
        // Redireciona para a página de confirmação com uma mensagem de sucesso
        header("Location: confirmacao.php?msg=success");
        exit();
    } else {
        echo "Erro ao salvar registro: " . $conn->error;
    }
}

// Fecha a conexão
$conn->close();
?>
