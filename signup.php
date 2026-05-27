<?php
include('config/database.php');

// 1. Recepción de datos
$f_name  = $_POST['fname'];
$l_name  = $_POST['lname'];
$e_mail  = $_POST['email'];
$m_phone = $_POST['mphone'];
$p_sswd  = $_POST['password'];


$enc_pass = md5($p_sswd);

// --- INICIO DE VALIDACIONES ---

// Funcionalidad 1: Validar unicidad del correo electrónico
$check_email = "SELECT email FROM users WHERE email = '$e_mail'";
$res_email = pg_query($local_conn, $check_email); 

if (pg_num_rows($res_email) > 0) {
    echo "Error: El correo electrónico ya se encuentra registrado.";
    exit; 
}


// Funcionalidad 2: Validar unicidad del número móvil
$check_phone = "SELECT mobile_phone FROM users WHERE mobile_phone = '$m_phone'";
$res_phone = pg_query($local_conn, $check_phone);

if (pg_num_rows($res_phone) > 0) {
    echo "Error: El número de teléfono móvil ya está vinculado a otra cuenta.";
    exit;
}

$sql = "INSERT INTO users (firstname, lastname, email, mobile_phone, password)
VALUES('$f_name','$l_name','$e_mail','$m_phone','$enc_pass')" ;

$res_local = pg_query($local_conn, $sql); 

if ($res_local) {

    $res_supa = pg_query($supa_conn, $sql);

    if ($res_supa) {
        echo "¡Listo! Guardado en ambos lados.";
        echo "<script>alert('Listo. Usuario registrado')</script>";
        header('refresh:0;url=login.php');
    } else {
        echo "Error: Se guardó en local pero no en la nube.";
    }
} else {
    echo "Error: No se pudo guardar ni en local.";
}


$enc_pass = password_hash($p_sswd, PASSWORD_BCRYPT);
