<?php
require('fpdf/fpdf.php');
include 'ambil_data.php'; // Mengambil data mahasiswa

// Membuat objek FPDF
$pdf = new FPDF();
$pdf->AddPage();

// Judul laporan
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(0, 10, 'DAFTAR SISWA KELAS IX JURUSAN REKAYASA PERANGKAT LUNAK', 0, 1, 'C');
$pdf->Ln(10);

// Membuat tabel untuk data siswa
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(30, 10, 'NIM', 1, 0, 'C');
$pdf->Cell(60, 10, 'Nama Lengkap', 1, 0, 'C');
$pdf->Cell(40, 10, 'Tanggal Lahir', 1, 0, 'C');
$pdf->Cell(50, 10, 'No HP', 1, 1, 'C');

// Mengisi tabel dengan data siswa
$pdf->SetFont('Arial', '', 12);
foreach ($siswa as $row) {
    $pdf->Cell(30, 10, $row['nim'], 1, 0, 'C');
    $pdf->Cell(60, 10, $row['nama_lengkap'], 1, 0, 'L');
    $pdf->Cell(40, 10, $row['tanggal_lahir'], 1, 0, 'C');
    $pdf->Cell(50, 10, $row['no_hp'], 1, 1, 'C');
}

// Output PDF
$pdf->Output();
?>
