<div class="col header_menu pb-2">
    <nav class="navbar navbar-expand-lg navbar-light " style="background-color:#006e4c">                
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto header_nav ">
                <li class="nav-item">
                    <a style="color:white;" class="nav-link" href="../../zotgm/inicio.php">Inicio<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a style="color:white;" class="nav-link" href="../../zotgm/Superintendencia.php">Superintendencia</a>
                </li>
                <li class="nav-item">
                    <a style="color:white;" class="nav-link" href="../../zotgm/Operacion.php">Operación</a>
                </li>
                <li class="nav-item">
                    <a style="color:white;" class="nav-link" href="../../zotgm/PyE-ZOTGM.php">PyE-ZOTGM</a>
                </li>
                <li class="nav-item">
                    <a style="color:white;" class="nav-link" href="../../zotgm/SIGDO.php">SIGDO</a>
                </li>
                <li class="nav-item">
                    <a style="color:white;" class="nav-link" href="../../zotgm/enlaces_links.php">Enlaces</a>
                </li>
            </ul>
            <?php
            if($Admin == true || $Super == true || $Invi == true){
                echo '<span class="navbar-text text-white "><a href="perfil.php" class="btn btn-outline-light text-white sesion">  Bienvenido: ' 
                . $_SESSION['username'] . ' <i class="fas fa-user-cog"></i></a><a class="btn btn-outline-light text-white ml-4 sesion" href="php/SessionDestroy.php">
                Cerrar Sesión <i class="far fa-times-circle"></i></a>
                </span> ';
            }else{
                echo ' <span class="navbar-text">
                <a class="btn btn-outline-light text-white sesion" href="login.php" >
                    Iniciar sesión <i class="fas fa-sign-in-alt"></i>
                </a>
                </span> ';
            }
            ?>
        </div>
    </nav>
</div>