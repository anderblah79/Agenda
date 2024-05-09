<?php
// Verifica se os dados do formulário foram enviados
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica se todos os campos necessários foram preenchidos
    if (isset($_POST['id']) && isset($_POST['nome']) && isset($_POST['servico']) && isset($_POST['data']) && isset($_POST['horario'])) {
        // Obtém os dados do formulário
        $id = $_POST['id'];
        $nome = $_POST['nome'];
        $servico = $_POST['servico'];
        $data = $_POST['data'];
        $horario = $_POST['horario'];

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

        // Atualiza os dados do agendamento no banco de dados
        $sql = "UPDATE agendamentos SET nome='$nome', servico='$servico', data='$data', horario='$horario' WHERE id=$id";

        if ($conn->query($sql) === TRUE) {
            // Exibe o pop-up de sucesso
            echo "<script>alert('Atualização realizada com sucesso.');</script>";
            // Redireciona após 2 segundos
            echo "<script>setTimeout(function(){ window.location.href = 'lista_agendamentos.php'; }, 100);</script>";
        } else {
            echo "Erro ao atualizar agendamento: " . $conn->error;
        }

        // Fecha a conexão
        $conn->close();
    } else {
        echo "Todos os campos são obrigatórios.";
    }
} else {
    echo "Ocorreu um erro ao processar a requisição.";
}
?>
