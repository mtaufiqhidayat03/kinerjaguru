<?php
class M_homeadmin extends CI_Model {
    
    function input_teks ($data, $referrer) {
        if ( !empty( $data ) && !empty( $referrer ) ) {
            $fname = 'info/' . $referrer . '.txt';
            $file = fopen( $fname, 'w' );
            fwrite( $file, $data );
            fclose( $file );
            echo "";
        } else {
            echo "<strong>Perhatian!</strong> Terjadi kesalahan dalam proses simpan data.<br/><br/><b>Silahkan, ulangi lagi.</b>";
        }
    }     
}
?>
