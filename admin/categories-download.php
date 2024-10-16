<?php

require 'vendor/autoload.php';
require 'config/app.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Ods\Content;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();
$activeWorksheet = $spreadsheet->getActiveSheet();
$activeWorksheet->setCellValue('B2', 'No')->getColumnDimension('B')->setAutoSize(true);
$activeWorksheet->setCellValue('C2', 'Title')->getColumnDimension('C')->setAutoSize(true);
$activeWorksheet->setCellValue('D2', 'Slug')->getColumnDimension('D')->setAutoSize(true);
$activeWorksheet->setCellValue('E2', 'Created at')->getColumnDimension('E')->setAutoSize(true);

$styleBorder = [
    'borders' => [
        'allBorders' => [
            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
            'color' => ['argb' => '00000000'],
        ],
    ],
];

$no = 1;
$loc = 3;

$categories = query("SELECT * FROM categories ORDER BY created_at DESC");

foreach ($categories as $category) {
    $activeWorksheet->setCellValue('B' . $loc, $no++);
    $activeWorksheet->setCellValue('C' . $loc, $category['title']);
    $activeWorksheet->setCellValue('D' . $loc, $category['slug']);
    $activeWorksheet->setCellValue('E' . $loc, $category['created_at']);
    $loc++;
}

$activeWorksheet->getStyle('B2:E' . ($loc - 1))->applyFromArray($styleBorder);

$writer = new Xlsx($spreadsheet);
$file_name = 'categories.xlsx';
$writer->save($file_name);

// ganti prosses download ke folder download pada PC atau laptop
header('content-type: application/vnd.openxmlformats officedocument.spreadsheetml');
header('content-length: ' . filesize($file_name));
header('content-disposition: attachment;filename="' . $file_name . '"');
readfile($file_name);
unlink($file_name);
