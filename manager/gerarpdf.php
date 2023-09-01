<?php

include_once('../manager/conexao.php');

$sql = "SELECT pu, nome, SEC_TO_TIME(SUM(TIME_TO_SEC(hora_positivo)) - SUM(TIME_TO_SEC(hora_negativo))) AS saldo_total FROM registros_dados GROUP BY nome HAVING saldo_total <> '00:00:00'";

$result = $conexao->query($sql);

if ($result->num_rows > 0) {
    $html = "<h1 style='text-align: center;'>BANCO DE HORAS</h1>";
    $html .= "<table border='1' style='width: 100%;'>";
    while ($row = $result->fetch_object()) {
        $html .= "<tr>";
        $html .= "<td style='width: 60%; text-align: left;'>" . $row->nome . "</td>";
        $html .= "<td style='width: 20%; text-align: center;'>" . $row->pu . "</td>";
        $html .= "<td style='width: 20%; text-align: center;'>" . $row->saldo_total . "</td>";
        $html .= "</tr>";
    }
    $html .= "</table>";
} else {
    $html = "Nenhum registro encontrado";
}

// Gerar PDF

use Dompdf\Dompdf;
use Dompdf\Options;

require_once '../LIBRARY/dompdf_2-0-1/dompdf/autoload.inc.php';

$options = new Options();
$options->set('defaultFont', 'sans');

$dompdf = new Dompdf($options);

$dompdf->loadHtml($html);

$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$dompdf->stream();
