<?php
$ftp_server = "192.168.1.195";
$conn_id = ftp_connect($ftp_server) or die("Couldn't connect to $ftp_server");
ftp_login($conn_id,"ftpuser","Test 2020");
$path = "/Dossier_Agent/";
$file = "100.pdf";
$check_file_exist = $path.$file;
$contents_on_server = ftp_nlist($conn_id, $path);
if (in_array($check_file_exist, $contents_on_server))
{
  echo "exist";
}
else
{
  echo "not found";
};

var_dump($contents_on_server);
ftp_close($conn_id);
?>
