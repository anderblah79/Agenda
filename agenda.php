<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agendamento de Serviços</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <header>
        <h1>Salão de Beleza Encanto</h1>
        <nav>
            <ul>
                <li><a href="servicos.php">Página Principal</a></li>
                <li><a href="lista_agendamentos.php">Ver lista de Agendamentos</a></li>
            </ul>
        </nav>
    </header>

    <h2 class="text-center">Agendar Serviço</h2>

    <form action="processar_agendamento.php" method="post">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required><br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br>
        <label for="servico">Serviço:</label>
        <select id="servico" name="servico" required>
            <option value>Selecione um serviço:</option>
            <option value="corte">Corte de Cabelo</option>
            <option value="coloração">Coloração</option>
            <option value="manicure">Manicure e Pedicure</option>
            <option value="maquiagem">Maquiagem</option>
        </select><br>
        <label for="data">Data:</label>
        <input type="date" id="data" name="data" required><br>
        <label for="horario">Horário:</label>
        <input type="time" id="horario" name="horario" required><br>
        <input type="submit" value="Agendar">
    </form>

    </div>
    <footer>
        <h2>Contato</h2>
        <p>Entre em contato conosco para mais informações ou dúvidas:</p>
        <p>Email: contato@salaodebeleza.com</p>
        <p>&copy; 2024 Salão de Beleza</p>
    </footer>

</body>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>

</html>