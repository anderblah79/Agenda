<?php
require_once('tcpdf/tcpdf.php');

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

// Consulta os agendamentos
$sql = "SELECT nome, CONCAT(UCASE(SUBSTRING(servico, 1, 1)), LCASE(SUBSTRING(servico, 2))) AS servico, DATE_FORMAT(data, '%d/%m/%Y') AS data_formatada, SUBSTR(horario, 1, 5) AS horario FROM agendamentos";
$result = $conn->query($sql);

// Inicializar o PDF
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// Definir informações do documento
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetTitle('Lista de Agendamentos');
$pdf->SetSubject('Lista de Agendamentos');
$pdf->SetKeywords('Agendamentos, PDF');

// Adicionar uma página
$pdf->AddPage();

// Definir fonte
$pdf->SetFont('helvetica', '', 10);

// Adicionar o nome do salão no cabeçalho
$pdf->SetFont('helvetica', 'B', 14);
$pdf->Cell(0, 10, 'Salão de Beleza', 0, 1, 'C');

// Cabeçalho da tabela
$header = array('Nome', 'Serviço', 'Data', 'Horário');

// Definir largura das colunas
$widths = array(50, 50, 30, 30);

// Imprimir cabeçalho da tabela
$pdf->SetFont('helvetica', 'B', 10);
$pdf->SetTextColor(0);
$pdf->SetDrawColor(0);
$pdf->SetLineWidth(0.3);
$pdf->Cell($widths[0], 7, $header[0], 'LTRB', 0, 'C');
$pdf->Cell($widths[1], 7, $header[1], 'LTRB', 0, 'C');
$pdf->Cell($widths[2], 7, $header[2], 'LTRB', 0, 'C');
$pdf->Cell($widths[3], 7, $header[3], 'LTRB', 1, 'C');

// Definir cor e estilo do texto
$pdf->SetTextColor(0);
$pdf->SetFont('');

// Iterar sobre os resultados e adicionar à tabela
while ($row = $result->fetch_assoc()) {
    $pdf->Cell($widths[0], 6, $row['nome'], 'LTRB', 0, 'C');
    $pdf->Cell($widths[1], 6, $row['servico'], 'LTRB', 0, 'C');
    $pdf->Cell($widths[2], 6, $row['data_formatada'], 'LTRB', 0, 'C');
    $pdf->Cell($widths[3], 6, $row['horario'], 'LTRB', 1, 'C');
}

// Saída do PDF
$pdf->Output('lista_agendamentos.pdf', 'I');

// Fechar conexão
$conn->close();
?>
