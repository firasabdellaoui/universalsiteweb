<?php
/*
$conn_id = ftp_connect("192.168.1.195");
ftp_login($conn_id, "ftpuser", "Test 2020");
ftp_pasv($conn_id, true);
$file_path = "Dossier_Agent/100.pdf";
$size = ftp_size($conn_id, $file_path);
header("Content-Type: application/octet-stream");
header("Content-Disposition: attachment; filename=" . basename($file_path));
header("Content-Length: $size");
ftp_get($conn_id, "php://output", $file_path, FTP_BINARY);
*/

if (isset($_POST['filename'])) {
  require '../data/Database.php';
  $ftp_conn = Database::ftp_conn();
  ftp_pasv($ftp_conn, true);
  $file_path = $_POST['filename'];
  $size = ftp_size($conn_id, $file_path);
  header("Content-Type: application/octet-stream");
  header("Content-Disposition: attachment; filename=" . basename($file_path));
  header("Content-Length: $size");
  ftp_get($conn_id, "php://output", $file_path, FTP_BINARY);
}
?>
