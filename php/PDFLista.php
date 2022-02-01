<?php
    require("../MPDF57/mpdf.php");

    $checked='checked="checked"';
    $aux="";

    $Title = $_POST['title'];
    $Fecha = $_POST['Fecha'];
    $HC = $_POST['HC'];
    $HT = $_POST['HT'];
    $Tema = $_POST['tema']; 
    $Expo = $_POST['expositor'];
    $box = $_POST["checkboxes"];
    $list = $_POST["Lista"];

    foreach($box as &$valor){
        if($valor != ""){
            $valor = $checked;
        }
    }

    foreach($list as &$Lista){
        if($Lista[3] == "Firma"){
            $Lista[3] = "     ";
        }
        $aux=$aux."<tr>
                        <td>".$Lista[0]."</td>
                        <td>".$Lista[1]."</td>
                        <td>".$Lista[2]."</td>
                        <td>".$Lista[3]."</td>
                        <td>".$Lista[4]."</td>
                    </tr>";
    }

    $date = explode("/", $Fecha);
    $Dia = array(
        "Lunes",
        "Martes",
        "Miercoles",
        "Jueves",
        "Viernes",
        "Sabado",
        "Domingo"
        );
    $Mes = array(
        "01" => "Enero",
        "02" => "Febrero",
        "03" => "Marzo",
        "04" => "Abril",
        "05" => "Mayo",
        "06" => "Junio",
        "07" => "Julio",
        "08" => "Agosto",
        "09" => "Septiembre",
        "10" => "Octubre",
        "11" => "Noviembre",
        "12" => "Diciembre"
        );
    $CDia = date("N",strtotime("".$date[2]."-".$date[1]."-".$date[0].""));
    $CDia = $CDia-1;

    $FechaCom="".$Dia[$CDia].", ".$date[0]." de ".$Mes[$date[1]]." de ".$date[2]."";
    //$FechaCom="".$Dia[2].", ".$date[0]." de ".$Mes["09"]." de ".$date[2]."";

    $Header = '
                <div style="width: 100%;">
                    <div class="text-center col-3" style="float: left; width: 25%;">
                        <img src="../css/images/cafelogo1.png" />
                    </div>
                    <div class=" text-center col-4" style="float: left; width: 41%;">
                        <div class="pt-3">
                            <p class="encabezado p-0" style=" margin: 0;">Comisión Federal de Electricidad</p>
                            <p class="encabezado p-0" style="font-size:20px;  margin: 0;">Sistema Integral de Gestión</p>
                        </div>
                    </div>
                    <div class="text-center col-3" style="float: left; width: 25%;">
                        <img src="../css/images/logos2-1.png" />
                    </div>
                </div>
                ';

    $titulo = '
                <div style="width: 100%;">
                    <div class="p-0" style=" height: auto; margin: 0;">
                        <p class="encabezado2 p-0" style="margin: 0;">LISTA DE ASISTENCIA</p>
                    </div>
                    <div class=" page p-0 text-center" style=" height: auto;">
                        <p class=" titulo p-0 text-center">'.$Title.'</p>
                    </div>
                </div>
                ';
    
    $datos = 
                '<div class="">

                    <div class="col-5  p-0" style="width: 48%; float: left;">

                        <div class=" p-0" style="float: left; width: 13%; height: auto; margin-top:auto;margin-boton:auto;"><p class="textoremarcado Margenes">Fecha:</p></div>
                        <div class=" p-0" style="float: left; width: 43%; height: auto;"><p class="datos Margenes">'.$FechaCom.'</p></div>
                        <div class=" p-0" style="float: left; width: 7%; height: auto; margin-top:auto;margin-boton:auto;"><p class="textoremarcado Margenes">De:</p></div>
                        <div class=" p-0" style="float: left; width: 15%; height: auto;"><p class="datos Margenes">'.$HC.'</p></div>
                        <div class=" p-0" style="float: left; width: 6%; height: auto; margin-top:auto;margin-boton:auto;"><p class="textoremarcado Margenes"> a </p></div>
                        <div class=" p-0" style="float: left; width: 15%; height: auto;"><p class="datos Margenes">'.$HT.'</p></div>
                    
                        <div class=" p-0" style="float: left; width: 12%; height: auto; margin-top:auto;margin-boton:auto;"><p class="textoremarcado Margenes">Tema:</p></div>
                        <div class=" p-0" style="float: left; width: 88%; height: auto;"><p class="datos2" >'.$Tema.'</p></div>
                        
                        <div class=" p-0" style="float: left; width: 18%; height: auto; margin-top:auto;margin-boton:auto;"><p class="textoremarcado Margenes">Expositor:</p></div>
                        <div class=" p-0" style="float: left; width: 82%; height: auto;"><p class="datos2" >'.$Expo.'</p></div>
                    </div>

                    <div class="col-5  p-0" style="width: 52%; float: left;">
                        <div class="col-5  p-0" style="width: 17%; float: left;">
                            <div class=" p-0" style="float: left; width: 100%; height: auto; margin-top:auto;margin-boton:auto;"><p class="textoremarcado text-center">Auditoria</p></div>
                            <div class=" p-0" style="float: left; width: 100%; height: auto;"><p class="datos text-center"><input type="checkbox" '.$box[0].'/>Apertura</p></div>
                            <div class=" p-0" style="float: left; width: 100%; height: auto;"><p class="datos text-center"><input type="checkbox" '.$box[1].'/>Cierre</p></div>
                        </div>
                        <div class="col-5  p-0" style="width: 35%; float: left;">
                            <div class=" p-0" style="float: left; width: 100%; height: auto; margin-top:auto;margin-boton:auto;"><p class="textoremarcado text-center">Difusion</p></div>
                            <div class=" p-0 " style="float: left; width: 50%; height: auto;"><p class="datos text-center "><input type="checkbox" '.$box[2].'/> Calidad</p></div>
                            <div class=" p-0 " style="float: left; width: 50%; height: auto;"><p class="datos text-center "><input type="checkbox" '.$box[3].'/> Seguridad</p></div>
                            <div class=" p-0 " style="float: left; width: 50%; height: auto;"><p class="datos text-center "><input type="checkbox" '.$box[4].'/> Ambiental</p></div>
                            <div class=" p-0 " style="float: left; width: 50%; height: auto;"><p class="datos text-center "><input type="checkbox" '.$box[5].'/>Otro Tema</p></div>
                        </div>
                        <div class="col-5  p-0" style="width: 32%; float: left;">
                            <div class=" p-0" style="float: left; width: 100%; height: auto; margin-top:auto;margin-boton:auto;"><p class="textoremarcado text-center">Reunion de Trabajo</p></div>
                            <div class=" p-0" style="float: left; width: 100%; height: auto;"><p class="datos text-center"><input type="checkbox" '.$box[6].'/> Rev X la Dir</p></div>
                            <div class=" p-0" style="float: left; width: 100%; height: auto;"><p class="datos text-center"><input type="checkbox" '.$box[7].'/> Otro Tema</p></div>
                        </div>
                        <div class="col-5  p-0" style="width: 16%; float: left;">
                            <div class=" p-0" style="float: left; width: 100%; height: auto; margin-top:auto;margin-boton:auto;"><p class="textoremarcado text-center">Curso</p></div>
                            <div class=" p-0" style="float: left; width: 100%; height: auto;"><p class="datos text-center"><input type="checkbox" '.$box[8].'/> Interno</p></div>
                            <div class=" p-0" style="float: left; width: 100%; height: auto;"><p class="datos text-center"><input type="checkbox" '.$box[9].'/> Externo</p></div>
                        </div>
                    </div>

                </div>';

    $tabla = '
                <table class="table table-bordered">
                    <thead style="background-color: #ffff99;">
                        <tr>
                            <th class="FEnc" >RPE</th>
                            <th class="FEnc" >Nombre</th>
                            <th class="FEnc" >Área</th>
                            <th class="FEnc" style="width: 200px;">Firma</th>
                            <th class="FEnc" >Correo electrónico/Tel.</th>
                        </tr>
                    </thead>
                    <tbody>
                        '.$aux.'
                    </tbody>
                </table> 
    ';
    
    $EJEM='
            <div style="width: 100%;">
                <div class="page p-0 text-center" style=" height: auto; margin: 0;">
                    <p class="titulo p-0 text-center">'.$auditoria.'</p>
                    <p class="titulo p-0 text-center">'.$box[2].'</p>
                    <p class="titulo p-0 text-center">'.$reunion.'</p>
                    <p class="titulo p-0 text-center">'.$CDia.'</p>
                    <p class="titulo p-0 text-center">'.$Mes["01"].'</p>
                    <p class="titulo p-0 text-center">'.$FechaCom.'</p>
                </div>
            </div>
            ';

    //echo $resultado; //haciendo este echo estas respondiendo la solicitud ajax
    
    $mpdf = new mPDF('c','A4-L');
    $stylePDF = file_get_contents('../css/stylePDF.css');
    $mpdf->WriteHTML($stylePDF,1);
    $mpdf->writeHTML($Header);
    $mpdf->writeHTML($titulo);
    $mpdf->writeHTML($datos);
    $mpdf->writeHTML($tabla);

    //$mpdf->writeHTML($EJEM);
    
    //$mpdf->Output('Reporte.pdf',"I");
    echo json_encode($mpdf->Output('Reporte.pdf',"I"));
?>