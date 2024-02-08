<?php

$html  = file_get_contents("запчасти на cangan.html");

$dom = new DOMDocument();
$dom->loadHTML(mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8'));

$table = $dom->getElementsByTagName('table')->item(0);
$rows = $table->getElementsByTagName('tr');

$data = array();

foreach ($rows as $row) {
    $cells = $row->getElementsByTagName('td');
    $rowData = array();
    foreach ($cells as $cell) {
        $rowData[] = $cell->nodeValue;
    }
    $data[] = $rowData;
}

file_put_contents("zp.json",json_encode($data,JSON_UNESCAPED_UNICODE));
// Вывод данных
header('Content-Type: text/html; charset=utf-8');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
echo "<pre>";
foreach ($data as $row) {
    echo implode("\t", $row) . "\n";
}
?>    
</body>
</html>
