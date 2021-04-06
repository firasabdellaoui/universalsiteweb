<?php
$server="192.168.1.195";
$connect = ftp_connect($server);
$result = ftp_login($connect, "ftpuser", "Test 2020");
$a = ftp_nlist($connect, "./Dossier_Agent/");
foreach($a as $value){
  echo '<a href="http://'.$server.'/'.basename($value).'">'.basename($value).'</a> <BR>';
}
?>
