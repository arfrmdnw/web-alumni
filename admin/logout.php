<?php
    session_start();
    $id_user=$_SESSION['id_user'];
    $_SESSION['id_user']='';
    $_SESSION['nama']='';
    $_SESSION['username']='';
    $_SESSION['level']='';



    unset($_SESSION['id_user']);
    unset($_SESSION['nama']);
    unset($_SESSION['username']);
    unset($_SESSION['level']);

    session_unset();
    session_destroy();

    header('Location:../admin/index.php?pesan=logout');

?>