<?php
    $Arch = $_POST['Archivo'];
    $list = $_POST["ListaRPE"];
    $Rol = $_POST["ROL"];
    
    $ZOTGM = simplexml_load_file("../XML/".$Arch."");

    foreach($list as $key){
        $i = 0;
        foreach ($ZOTGM->usuario as $usuario) {
            if($usuario->RPE==$key){
                unset($ZOTGM->usuario[$i]);
                break;
            }
            $i++;
        }
    }

    file_put_contents("../XML/".$Arch."", $ZOTGM->asXML());
    //unset($ZOTGM->ruta[$index]); // Elimina la direcion del archivo XML
    //file_put_contents("XML/".$Arch."", $ZOTGM->asXML()); //Guarda todas las direciones


    $ZOTGM = simplexml_load_file("../XML/".$Arch."");

    $response = "";
    foreach($ZOTGM as $usuario)
    {
        $response =$response ."<tr id='usuO' class='table-default'>
                    <input type='hidden' id='RPEOculto' value=". $usuario->RPE .">
                    <input type='hidden' id='NombreOculto' value=". $usuario->Nombre .">
                    <input type='hidden' id='CorreoOculto' value=". $usuario->Correo .">
                    <th scope='row' id='usuRPE'>" . $usuario->RPE . "</th>
                    <td id='usuNombre'>" . $usuario->Nombre . "</td>
                    <td id='usuArea'>" . $usuario->Area ."</td>
                    <td id='usuCorreo'>" . $usuario->Correo ."</td>";
        if( $Rol == "True" ){
            $response =$response .'
                    <td id="BotonesUA">
                    <button class="" id="usuModificar" type="button" style="display: none;">Agregar Cambios</button>
                    <button class="" id="usuEditar" type="button">Editar</button>
                    <button class="" id="usuEliminar" type="button">Eliminar</button>
                    </td>';
        }
                    
        $response =$response ."</tr>";
    }
    echo $response;
?>