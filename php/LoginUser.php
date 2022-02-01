<?php
$error = false;
if(isset($_POST['login'])){
    $username = strtolower($_POST['username']);
    $password = md5($_POST['password']);
    $Usuarios = simplexml_load_file('data/Usuarios.xml');
    foreach($Usuarios as $usuario){
        if($username == $usuario->user && $password== $usuario->contrasena){
            if($usuario->rol == 'A'){
                $rol= 'Administrador';
            }
            if($usuario->rol == 'S'){
                $rol= 'Superusuario';
            }
            if($usuario->rol == 'I'){
                $rol= 'Invitado';
            }
            session_start();
            $_SESSION['username'] = strtoupper($username);
            $_SESSION['rol'] = $rol;
            $_SESSION['password'] = $password;
            header('Location: index.php');   
            die;
        }
    }
    $error = true;
}

?>