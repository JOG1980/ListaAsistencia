<?php
    // Eliminar imagen
    if(isset($_GET['action'])) {
        $Rutas = simplexml_load_file('data/rutas.xml');
        $id = $_GET['src'];
        $index = 0;
        $i = 0;
        foreach($Rutas->ruta as $ruta){ //Busca la direccion dentro del archivo XML
            if($ruta->src==$id){
                $index = $i;
                break;
            }
            $i++;
        }
        unlink($id); //Elimina el archivo de la imagen del servidor 
        unset($Rutas->ruta[$index]); // Elimina la direcion del archivo XML
        file_put_contents('data/rutas.xml', $Rutas->asXML()); //Guarda todas las direciones
        echo"<script>alert('La imagen fue eliminada correctamente!'); 
                window.location.href='inicio_recuerdos.php';
                </script>";
    }

    // Guardar imagen
    if(isset($_POST['Save'])) {
        $dir_subida = 'img/';//Carpeta donde guardaremos las imagenes subidas
        // basename — Devuelve el último componente de nombre de una ruta del cliente
        // CONCATENAMOS dir_subida con el resultado de basename
        $fichero_subido = $dir_subida . basename($_FILES['src']['name']);
        $Rutas = simplexml_load_file('data/rutas.xml');
        foreach($Rutas as $ruta){
            if($fichero_subido == $ruta->src){
                echo"<script>alert('La imagen ya existe en el servidor o contiene el mismo nombre que una de las que ya esta guardada. NO SE GUARDO!'); 
                window.location.href='inicio_recuerdos.php';
                </script>";
                goto a; // Buscamos un fichero con el mismo nombre de existir nos dirjimos a la etiqueta a despues del else
            }
        } 
        if (move_uploaded_file($_FILES['src']['tmp_name'], $fichero_subido)) {
            $ruta = $Rutas->addChild('ruta');
            $ruta->addChild('src', $fichero_subido);
            $ruta->addChild('title', $_POST['title']);
            file_put_contents('data/rutas.xml', $Rutas->asXML());
            echo"<script>alert('El recuerdo se subio correctamente');
            window.location.href='inicio_recuerdos.php';
            </script>"; 

        } else {
            echo"<script>alert('Error!! ¡Posible ataque de subida de ficheros!');
            window.location.href='inicio_recuerdos.php';
            </script>";
            a:
            unset($_POST);

        }

    }
    
?>