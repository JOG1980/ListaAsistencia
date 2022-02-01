<?php
session_start();
$Admin = false;
$Super = false;
$Invi = false;
    if(isset( $_SESSION['rol'])){
        if ($_SESSION['rol']=='Administrador'){
            $Admin = true;
        }
        if ($_SESSION['rol']=='Superusuario'){
            $Super = true;
        }
        if ($_SESSION['rol']=='Invitado'){
            $Invi = true;
        }
    }
?>