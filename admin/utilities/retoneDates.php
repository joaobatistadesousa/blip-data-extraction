<?php
function calcularDatas() {
    // Obter a data atual
    $endDate = date('Y-m-d');

    // Subtrair 94 dias da data atual para obter a start_date
    $startDate = date('Y-m-d', strtotime('-94 days', strtotime($endDate)));

    return array('start_date' => $startDate, 'end_date' => $endDate);
}


