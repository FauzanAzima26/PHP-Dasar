<?php
require 'vendor/autoload.php';
require 'config/app.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// ekspor data tabel film menjadi excel
function exportCategoriesToExcel()
{

    $spreadsheet = new Spreadsheet();
    $activeWorksheet = $spreadsheet->getActiveSheet();

    //  membuat header tabel
    $activeWorksheet->setCellValue('B2', 'No')->getColumnDimension('B')->setAutoSize(true);
    $activeWorksheet->setCellValue('C2', 'Nama')->getColumnDimension('C')->setAutoSize(true);
    $activeWorksheet->setCellValue('D2', 'Studio')->getColumnDimension('D')->setAutoSize(true);
    $activeWorksheet->setCellValue('E2', 'Category')->getColumnDimension('E')->setAutoSize(true);
    $activeWorksheet->setCellValue('F2', 'Status')->getColumnDimension('F')->setAutoSize(true);
    $activeWorksheet->setCellValue('G2', 'Created at')->getColumnDimension('G')->setAutoSize(true);

    //   memberi style tabel
    $styleBorder = [
        'borders' => [
            'allBorders' => [
                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                'color' => ['argb' => '00000000'],
            ],
        ],
    ];

    $styleBorderFill = [
        'fill' => [
            'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
            'color' => ['argb' => 'ADD8E6'],
        ]
    ];


    // query untuk menngambil data dari database
    $categories = query("SELECT f.title, f.studio, f.is_private, f.created_at, c.title AS category_title 
    FROM films f JOIN categories c ON f.category_id = c.id_categories WHERE f.is_private = 0 ORDER BY f.created_at DESC");

    // mengisi data yang diambil kedalam tabel
    $no = 1;
    $loc = 3;
    foreach ($categories as $category) {
        $activeWorksheet->setCellValue('B' . $loc, $no++);
        $activeWorksheet->setCellValue('C' . $loc, $category['title']);
        $activeWorksheet->setCellValue('D' . $loc, $category['studio']);
        $activeWorksheet->setCellValue('E' . $loc, $category['category_title']);
        $activeWorksheet->setCellValue('F' . $loc, $category['is_private'] ? 'Private' : 'Public');
        $activeWorksheet->setCellValue('G' . $loc, $category['created_at']);

        $loc++;
    }

    // menerapkan style tabel
    $activeWorksheet->getStyle('B2:G' . ($loc - 1))->applyFromArray($styleBorder,);
    $activeWorksheet->getStyle('B2:G2')->applyFromArray($styleBorderFill,);

    // mengatur tipe file
    $writer = new Xlsx($spreadsheet);

    // nama file yang didownload
    $file_name = 'film.xlsx';

    // menyimpan file
    $writer->save($file_name);

    // membuat file yang didowload tersimpan kedalam file eksplorer
    header('content-type: application/vnd.openxmlformats officedocument.spreadsheetml');
    header('content-length: ' . filesize($file_name));
    header('content-disposition: attachment;filename="' . $file_name . '"');
    
    readfile($file_name);
    unlink($file_name);
}

exportCategoriesToExcel();
