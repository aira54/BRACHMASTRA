<?php
error_reporting(0);
ini_set('display_errors', 0);

require '../vendor/autoload.php';
use Dompdf\Dompdf;

$conn = new mysqli("localhost", "root", "", "brachmastra");

$id = (int) ($_GET['id'] ?? 0);
$res = $conn->query("SELECT * FROM toko_laporan WHERE id = $id");

if (!$res || $res->num_rows === 0) {
    die("Data layanan tidak ditemukan.");
}
$data = $res->fetch_assoc();

$html = "
<!DOCTYPE html>
<html><head>
  <meta charset='UTF-8'>
  <style>
    body { font-family: DejaVu Sans, sans-serif; font-size: 12pt; line-height: 1.6; }
    h2 { text-align: center; color: #2c3e50; }
    .footer { margin-top: 40px; text-align: right; }
  </style>
</head><body>
  <h2>Laporan Layanan Hukum</h2>
  <p>Kepada Yth.<br>
  Admin Toko Hukum - Website Brachmastra</p>

  <p>Dengan hormat,</p>
  <p>Saya <b>".htmlspecialchars($data['user_nama'] ?? '-')."</b> dari website <b>Brachmastra</b>, 
  bermaksud untuk menyampaikan laporan permintaan layanan hukum dengan detail sebagai berikut:</p>

  <ul>
    <li><b>Produk:</b> ".htmlspecialchars($data['produk_nama'] ?? '-')."</li>
    <li><b>Kategori:</b> ".htmlspecialchars($data['kategori'] ?? '-')."</li>
    <li><b>Harga:</b> ".htmlspecialchars($data['harga'] ?? '-')."</li>
    <li><b>Pertanyaan/Kasus:</b> ".htmlspecialchars($data['pertanyaan'] ?? '-')."</li>
    <li><b>Via:</b> ".htmlspecialchars($data['klik_via'] ?? '-')."</li>
    <li><b>Waktu Permintaan:</b> ".($data['tanggal'] ?? '-')."</li>
  </ul>

  <p>Demikian laporan ini saya sampaikan.<br>
  Atas perhatian dan bantuannya, saya ucapkan terima kasih.</p>

  <div class='footer'>
    Hormat saya,<br><br>
    <b>".htmlspecialchars($data['user_nama'] ?? '-')."</b>
  </div>
</body></html>
";

$dompdf = new Dompdf();
$dompdf->loadHtml($html, 'UTF-8');
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();

$filename = "Laporan_Toko_".$data['id'].".pdf";
$dompdf->stream($filename, ["Attachment" => true]);
