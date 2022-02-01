<?php
$ZOTGM = simplexml_load_file("../XML/ZOTGM.xml");
$response = array(
    0 => array("Default"),
    1 => array("Default"),
    2 => array("Default"),
    3 => array("Default")
);
foreach($ZOTGM as $usuario)
{
    $response[0][] = "".$usuario->RPE;
    $response[1][] = "".$usuario->Nombre;
    $response[2][] = "".$usuario->Area;
    $response[3][] = "".$usuario->Correo;
}

echo json_encode($response);

?>