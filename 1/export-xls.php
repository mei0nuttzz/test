<?php
if (!isset($_GET[apikey])) {
    echo 'Te rugam sa introduci api key-ul de la ipbase.com';
} else {
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="1.xls"');
    header('Cache-Control: max-age=0');
    require_once ('PHPExcel/PHPExcel.php');
    $ips = explode("\n", file_get_contents('ips.txt'));
    $array = array();
    foreach ($ips as $ip) {
        $url = 'https://api.ipbase.com/v2/info?ip=' . $ip . '&apikey=' . $_GET['apikey'];
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        $ip_info = json_decode(curl_exec($curl));
        curl_close($curl);
        foreach ($ip_info as $info) {
            $array[] = array($info->ip, $info->location->country->name, $info->location->region->name, $info->location->city->name);
        }
    }
    $objPHPExcel = new PHPExcel();
    $objWorksheet = $objPHPExcel->getActiveSheet();
    $i = 1;
    $objWorksheet->setTitle('Data');
    $objWorksheet->setCellValue('A1', 'IP');
    $objWorksheet->setCellValue('B1', 'TARA');
    $objWorksheet->setCellValue('C1', 'REGIUNE');
    $objWorksheet->setCellValue('D1', 'ORAS');
    foreach ($array as $values) {
        $i++;
        $objWorksheet->setCellValue('A' . $i, $values[0]);
        $objWorksheet->setCellValue('B' . $i, $values[1]);
        $objWorksheet->setCellValue('C' . $i, $values[2]);
        $objWorksheet->setCellValue('D' . $i, $values[3]);
    }
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
    $objWriter->save('php://output');
    exit();
}
