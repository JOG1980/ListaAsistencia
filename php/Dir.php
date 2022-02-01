<?php
$Arch = $_POST['Archivo'];
$AUX = $_POST['ListaAux'];
$list = $_POST["ListaRPE"];
$ZOTGM = simplexml_load_file("../XML/".$Arch."");
$response = "";
foreach($ZOTGM as $usuario)
{
    $validador = true;
    $exist = true;
    foreach ($list as $RPE) {
        if( $RPE == $usuario->RPE ){
            $validador = false;
        }
    }
    foreach ($AUX as $aca) {
        if( $aca[0] == $usuario->RPE ){
            $exist = false;
        }
    }
    if( $validador ){
        if($exist){
            $response = $response .'<tr id="usuO" class="table-default">
                        <th scope="row" id="usuRPE">' . $usuario->RPE . '</th>
                        <td id="usuNombre">' . $usuario->Nombre . '</td>
                        <td id="usuArea">' . $usuario->Area .'</td>
                        <td id="usuCorreo">' . $usuario->Correo .'</td>';
                        
            $response =$response ."</tr>";
        }
        else{
            $response = $response .'<tr id="usuO" class="table-success">
                        <th scope="row" id="usuRPE">' . $usuario->RPE . '</th>
                        <td id="usuNombre">' . $usuario->Nombre . '</td>
                        <td id="usuArea">' . $usuario->Area .'</td>
                        <td id="usuCorreo">' . $usuario->Correo .'</td>';
                        
            $response =$response ."</tr>";
        }
    }
}
echo $response;
?>