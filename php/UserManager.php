<?php
session_start();
$Admin = false;
$Super = false;
$Invi = false;
$errorE = array();
$error = array();
if(isset($_SESSION['username'], $_SESSION['usuarioEd'])){
    if(strtolower($_SESSION['username']) == strtolower($_SESSION['usuarioEd'])){
        session_destroy();
        echo"<script>alert('Se modifico la session actual, vuelva a iniciar session con sus nuevas credenciales');
        window.location.href='login.php';
        </script>";
    }
}

$Usuarios = simplexml_load_file('data/Usuarios.xml');

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
    }else{
        header('Location: index.php');  //Evita que un usuario que conosca la ruta pero no este logueado entre en la pagina
        die;
    }

    if(isset($_POST['Save'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $password2 = $_POST['password2'];
        $rol = $_POST['rol'];
        $permitidos = $permitidos = "abcdefghijklmnñopqrstuvwxyzABCDEFGHIJKLMNÑOPQRSTUVWXYZ0123456789-_";

        $Usuarios = simplexml_load_file('data/Usuarios.xml');
        foreach($Usuarios as $usuario){
            if(strtolower($username) == $usuario->user){
                $error[] = 'El usuario '. $username .' ya existe!!';
            }
        }

        for ($i=0; $i<strlen($username); $i++){ 
            if (strpos($permitidos, substr($username,$i,1))===false){ 
                $error[] = 'El usuario ' . $username . " contiene caracteres no permitidos"; 
                break;
            } 
         }

        if(strlen($username) < 5) {
            $error[] = 'El usuario '. $username .' es demasiado corto, debé contener entre 5 y 20 caracteres ';
        }

        if(strlen($username) > 20) {
            $error[] = 'El usuario '. $username .' es demasiado largo, debé contener entre 5 y 20 caracteres ';
        } 

        if($password != $password2 ){
            $error[]= 'Las contraseña no coinciden!!';
        }

        if(count($error) == 0){
            if($rol == 'Administrador'){
                $LetraRol = 'A';
            }
            if($rol == 'Superusuario'){
                $LetraRol = 'S';
            }
            if($rol == 'Invitado'){
                $LetraRol = 'I';
            }

            $usuario = $Usuarios->addChild('usuario');
            $usuario->addChild('user', strtolower($username));
            $usuario->addChild('contrasena', md5($password));
            $usuario->addChild('rol', $LetraRol);

            $_SESSION['contadorA']=0;
            $_SESSION['agregado'] = true;
            $_SESSION['usuarioA'] = $username;
            
            file_put_contents('data/Usuarios.xml', $Usuarios->asXML());
            header('Location: perfil.php');
            die;
        }
    }
    
    if(isset($_GET['eliminar'])) {
        $Usuarios = simplexml_load_file('data/Usuarios.xml');
        $id = $_GET['user'];
        $index = 0;
        $i = 0;
        foreach($Usuarios->usuario as $usuario){ //Busca el usuario dentro del archivo XML
            if($usuario->user==$id){
                $index = $i;
                break;
            }
            $i++;
        }
        $_SESSION['contadorE']=0;
        $_SESSION['eliminado'] = true;
        $_SESSION['usuarioE'] = $id;
        unset($Usuarios->usuario[$index]); // Elimina el usuario del archivo XML
        file_put_contents('data/Usuarios.xml', $Usuarios->asXML()); //Guarda todas las direciones
        header('Location: perfil.php');
        die;
    }

    if(isset($_POST['editar'])) {

        $Usuarios = simplexml_load_file('data/Usuarios.xml');

        $usernameedithidden = $_POST['usernameedithidden'];
        $usernameedit = $_POST['usernameedit'];
        $roledit = $_POST['roledit'];
        $passwordedit = $_POST['passwordedit'];
        $password2edit = $_POST['password2edit'];
        $permitidos = $permitidos = "abcdefghijklmnñopqrstuvwxyzABCDEFGHIJKLMNÑOPQRSTUVWXYZ0123456789-_";
        
        if($usernameedithidden != $usernameedit){
            foreach($Usuarios->usuario as $usuario){
                if(strtolower($usernameedit) == $usuario->user){
                    $errorE[] = 'El usuario '. $usernameedit .' ya existe!!';
                }
            }
        }

        for ($i=0; $i<strlen($usernameedit); $i++){ 
            if (strpos($permitidos, substr($usernameedit,$i,1))===false){ 
                $errorE[] = 'El usuario ' . $usernameedit . " contiene caracteres no permitidos"; 
                break;
            } 
         }

        if(strlen($usernameedit) < 5) {
            $errorE[] = 'El usuario '. $usernameedit .' es demasiado corto, debé contener entre 5 y 20 caracteres ';
        }

        if(strlen($usernameedit) > 20) {
            $errorE[] = 'El usuario '. $usernameedit .' es demasiado largo, debé contener entre 5 y 20 caracteres ';
        } 
       
        if($passwordedit != $password2edit){
            $errorE[] = 'Las contraseña no coinciden!!';
        }

        if(count($errorE) == 0){
            foreach($Usuarios->usuario as $usuario){
                if($roledit == 'Administrador'){
                    $LetraRol = 'A';
                }
                if($roledit == 'Superusuario'){
                    $LetraRol = 'S';
                }
                if($roledit == 'Invitado'){
                    $LetraRol = 'I';
                }

                if($usuario->user == $usernameedithidden){
                    $usuario->user = strtolower($usernameedit);
                    $usuario->rol = $LetraRol;
                    $usuario->contrasena = md5($passwordedit);
                    break;
                }
            }

            $_SESSION['contadorEd']=0;
            $_SESSION['editado'] = true;
            $_SESSION['usuarioEd'] = $usernameedithidden;
            $_SESSION['cambiouser'] = $usernameedit;
            file_put_contents('data/Usuarios.xml', $Usuarios->asXML());

            header('Location: perfil.php');
            die;
        }
    }
?>