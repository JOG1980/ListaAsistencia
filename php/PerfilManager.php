<?php
    if($Admin==false){
        echo '
        <div class="card border shadow rounded mb-2" style="width: 18rem;">
            <div class="card-header cardsColor text-white">
                <h5 class="card-title">Perfil <i class="fas fa-user"></i></h5>
            </div>
            <div class="card-body text-center">
                <h3>Usuario: ' . $_SESSION['username'] . '</h3>
                <h3>Rol: ' . $_SESSION['rol'] . '  </h3>
            </div>
        </div>';
    }
    if($Admin==true){ // Esta parte la veran solo los admin's
        echo' 
        <div class="row">
            <div class="col-4">
                <div class="card border rounded mb-2" style="width: 18rem;">
                    <div class="card-header cardsColor text-white">
                        <h5 class="card-title">Perfil <i class="fas fa-user"></i></h5>
                    </div>
                    <div class="card-body text-center">
                        <h4>Usuario: ' . $_SESSION['username'] . '</h4>
                        <h4>Rol: ' . $_SESSION['rol'] . '  </h4>
                    </div>
                </div>
            </div>
            <div class="col-8 align-self-end mb-2"   >';

    if(count($error)>0){//Si existe un error al momento de agregar un usuario se mostrara este alert
        echo'<div class="alert alert-danger  alert-dismissible fade show" role="alert">
                <p ">No fue posible agregar al usuario debido a: </p><ul>';
        foreach($error as  $e){
                echo '<li>'. $e . '</li>' ;
        }
                echo '</ul>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>';
    }
    
    if(count($errorE)>0){//Si existe un error al momento de editar un usuario se mostrara este alert
        echo'<div class="alert alert-danger  alert-dismissible fade show" role="alert">
                <p ">No fue posible editar el usuario debido a: </p><ul>';
                foreach($errorE as  $e){
                    echo '<li>'. $e . '</li>' ;
            }
                echo '</ul>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>';
    }

    if(isset($_SESSION['eliminado'])){ //Si se elimina correctamente un usuario se mostrara este alert
        if(isset($_SESSION['contadorE'])){
            if( $_SESSION['contadorE']>=1)
            {
                $_SESSION['eliminado']=false;
            }
        }
        if($_SESSION['eliminado']==true){
            $_SESSION['contadorE']= $_SESSION['contadorE'] + 1;
            echo'<div class="alert alert-success  alert-dismissible fade show" role="alert">
                    El usuario <strong>'.$_SESSION['usuarioE'].'</strong> fue eliminado exitosamente!!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
        }
    }

    if(isset($_SESSION['agregado'])){ //Si se agrega correctamente un usuario se mostrara este alert
        if(isset($_SESSION['contadorA'])){
            if( $_SESSION['contadorA']>=1)
            {
                $_SESSION['agregado']=false;
            }
        }
        if($_SESSION['agregado']==true){
            $_SESSION['contadorA']= $_SESSION['contadorA'] + 1;
            echo'<div class="alert alert-success  alert-dismissible fade show" role="alert">
                    El usuario <strong>'.$_SESSION['usuarioA'].'</strong> se agrego exitosamente!!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
        }
    }

    if(isset($_SESSION['editado'])){ //Si se agrega correctamente un usuario se mostrara este alert
        if(isset($_SESSION['contadorEd'])){
            if( $_SESSION['contadorEd']>=1)
            {
                $_SESSION['editado']=false;
            }
        }
        if($_SESSION['editado']==true){
            $_SESSION['contadorEd']= $_SESSION['contadorEd'] + 1;
            echo'<div class="alert alert-success  alert-dismissible fade show" role="alert">
                    El usuario <strong>'.$_SESSION['usuarioEd'].'</strong> se edito exitosamente!!
                    ';
            if($_SESSION['cambiouser'] != $_SESSION['usuarioEd']){
                echo ' y cambio de nombre a <strong>'. $_SESSION['cambiouser'].'</strong>' ;
            }
                    echo '
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
        }
    }

                echo '<p > <button class="btn btn-success float-right " data-toggle="modal"
                    data-target="#AgregarUser"><i class="fas fa-user-plus"></i> Agregar Usuario</button></p >
            </div>
        </div>';
        echo'
        <div class="table-responsive border">
            <table class="table text-center table-hover ">
                <thead class="cardsColor text-white ">
                    <tr>
                    <th scope="col" class="font-weight-light">#</th>
                    <th scope="col" class="font-weight-light">Usuario</th>
                    <th scope="col" class="font-weight-light">Rol</th>
                    <th scope="col" class="font-weight-light">Contraseña</th>
                    <th scope="col" ></th>
                    <th scope="col" ></th>
                    </tr>
                </thead>
                <tbody>';
        $i=1;
        foreach($Usuarios as $usuario) {
            if($usuario->rol == 'A'){
                $rol= 'Administrador';
            }
            if($usuario->rol == 'S'){
                $rol= 'Superusuario';
            }
            if($usuario->rol == 'I'){
                $rol= 'Invitado';
            }
            echo '
            <tr>
                <th scope="row">'.$i.'</th>
                <td>'.$usuario->user.'</td>
                <td id="rol'.$usuario->user.'">'.$rol.'</td>
                <td>'.$usuario->contrasena.'</td>
                <td><button class="btn btn-primary edit" value="'.$usuario->user.'"  > <i class="fas fa-user-edit"></i> Editar</button></td>
                <td><a onclick="return confirmDelete();" class="btn btn-danger text-white" href="perfil.php?eliminar=delete&user='. $usuario->user.'" ><i class="fas fa-user-times"></i> Eliminar</a></td>
            </tr>';
        $i++;
        }
        echo'      
                </tbody>
            </table>
            </div>';
    }
?>