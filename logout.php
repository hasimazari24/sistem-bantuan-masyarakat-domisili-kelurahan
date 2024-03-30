<?php
    include ('koneksi.php');
    session_start();
    // $id_user = $_SESSION['user']['id_user'];
    // $koneksi->query("UPDATE tb_user SET session=session-1 WHERE id_user='$id_user'");
    session_destroy();

    header("location:login.php");
?>