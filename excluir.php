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

    // Exclui o agendamento do banco de dados
    $sql = "DELETE FROM agendamentos WHERE id = $agendamento_id";

    if ($conn->query($sql) === TRUE) {
        // Agendamento excluído com sucesso, redireciona para a lista de agendamentos após 2 segundos
        echo "<script>setTimeout(function(){ window.location.href = 'lista_agendamentos.php'; }, 2000);</script>";
        echo "Agendamento excluído com sucesso. Redirecionando...";
    } else {
        echo "Erro ao excluir agendamento: " . $conn->error;
    }

    // Fecha a conexão
    $conn->close();
} else {
    echo "ID do agendamento não fornecido.";
    exit;
}
?>
