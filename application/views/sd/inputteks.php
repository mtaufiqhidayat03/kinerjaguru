<?php
//if( isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ( $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest' ) )
//{
ini_set('session.bug_compat_42',0);
ini_set('session.bug_compat_warn',0);
session_start();
include('../../config.inc.php');
include('../../koneksi.inc.php');
include('../../folder.inc.php');
if (!empty($_SESSION['level'])) { 
$data = $_POST['data'];
$referrer = $_POST['referrer'];
if(!empty($data) && !empty($referrer)){
$fname = '../../info/'.$referrer.'.txt';
$file = fopen($fname, 'w');
fwrite($file, $data);
fclose($file);
} else {
echo "<strong>Perhatian!</strong> Terjadi kesalahan dalam proses simpan data.<br/><br/><b>Silahkan, ulangi lagi.</b>";
}
} else {
echo "<strong>Perhatian!</strong> Terjadi kesalahan dalam proses simpan data.<br/><br/><b>Maaf, sesi anda telah berakhir. <br/><br/>Silahkan login kembali.</b>";
?>
<script>
$.post("session.php", function( data ) {
if(data == "-1")
{
setTimeout(function() {window.location.href = "login.php"}, 4000);
}
});
</script>
<?php
}
//} else { 
//	include "../../error403.html";
// }
?>