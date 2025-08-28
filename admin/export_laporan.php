<?php
require '../db.php';
require '../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Header kolom
$headers = ["ID", "User", "Jenis Konsultasi", "Pengacara", "Spesialis", "Via", "Pertanyaan", "Waktu"];
$col = 'A';
foreach ($headers as $h) {
    $sheet->setCellValue($col.'1', $h);
    $col++;
}

// Data dari DB
$result = $conn->query("SELECT * FROM klik_laporan ORDER BY id DESC");
$rowIndex = 2;
while ($row = $result->fetch_assoc()) {
    $sheet->setCellValue("A$rowIndex", $row['id']);
    $sheet->setCellValue("B$rowIndex", $row['user_nama']);
    $sheet->setCellValue("C$rowIndex", $row['jenis_konsultasi']);
    $sheet->setCellValue("D$rowIndex", $row['pengacara_nama'] ?? '-');
    $sheet->setCellValue("E$rowIndex", $row['pengacara_spesialis'] ?? '-');
    $sheet->setCellValue("F$rowIndex", $row['klik_via']);
    $sheet->setCellValue("G$rowIndex", $row['pertanyaan']);
    $sheet->setCellValue("H$rowIndex", $row['created_at'] ?? '-');
    $rowIndex++;
}

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="laporan_klik.xlsx"');

$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
exit;
