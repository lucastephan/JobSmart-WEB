<?php
//setting header to json
header('Content-Type: application/json');

//database
define('DB_HOST', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'jobsmart');

$mysql = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

if (!$mysql) {
    die("Connection Failed: " . $mysql->error);
}

$query = "SELECT
            COUNT(id_venda) 'qtdVendas',
            month(dt_venda) AS 'mes'
          FROM venda
          WHERE MONTH(dt_venda) between 1 and 12
          AND YEAR(dt_venda) = 2019 GROUP BY mes;";

$result = $mysql->query($query);

$data = array();

foreach ($result as $row) {

    switch ($row['mes']) {
        case 1:
            $row['mes'] = "Janeiro";
            break;
        case 2:
            $row['mes'] = "Feveiro";
            break;
        case 3:
            $row['mes'] = "Março";
            break;
        case 4:
            $row['mes'] = "Abril";
            break;
        case 5:
            $row['mes'] = "Maio";
            break;
        case 6:
            $row['mes'] = "Junho";
            break;
        case 7:
            $row['mes'] = "Julho";
            break;
        case 8:
            $row['mes'] = "Agosto";
            break;
        case 9:
            $row['mes'] = "Setembro";
            break;
        case 10:
            $row['mes'] = "Outubro";
            break;
        case 11:
            $row['mes'] = "Novembro";
            break;
        case 12:
            $row['mes'] = "Dezembro";
            break;
        default:
            break;
    }

    $data[] = $row;
}

$result->close();
$mysql->close();

print json_encode($data);