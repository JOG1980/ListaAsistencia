<?php
require('php/RolManager.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <LINK REL="shortcut icon" href="css/images/cenace.ico">
    <title>Lista de Asistencia</title>
        <!--CSS-->
            <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
            <link rel="stylesheet" type="text/css" href="css/jquery.ui.timepicker.css">
            <link rel="stylesheet" type="text/css" href="css/jquery-ui.min.css">
            <link rel="stylesheet" type="text/css" href="css/jquery-ui.structure.min.css">
            <link rel="stylesheet" type="text/css" href="css/jquery-ui.theme.min.css">
            <link rel="stylesheet" type="text/css" href="css/styleLista.css">
            <link rel="stylesheet" type="text/css" href="css/style.css">
            <link rel="stylesheet" type="text/css" href="css/iconos/css/all.css">
            <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
        <!--CSS-->
</head>
<body>
    <?php include('layout/Navbar.php');?>
    
    <!--HEADER-->
    
            <!--HEADERP-->
                <div class="row">
                    <div class="p-3 text-center col-6 col-sm-6 col-md-6 col-lg-4 col-xl-4 order-1 order-sm-1 order-md-1 order-lg-1 order-xl-1">
                        <img id="Foto1" src="css/images/cafelogo1.png" />
                    </div>
                    <div class="pt-2 text-center col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4 order-3 order-sm-3 order-md-3 order-lg-2 order-xl-2">
                        <div class="pt-3">
                            <p class="encabezado">Comisión Federal de Electricidad</p>
                        </div>
                        <div>
                            <p class="encabezado" style="font-size:large; height: 16px; margin-top: 10px;">Sistema Integral de Gestión</p>
                        </div>
                    </div>
                    <div class="p-3 text-center col-6 col-sm-6 col-md-6 col-lg-4 col-xl-4 order-2 order-sm-2 order-md-2 order-lg-3 order-xl-3">
                        <img id="Foto2" src="css/images/logos2-1.png" />
                    </div>
                </div>
            <!--HEADERP-->

    <!--Header End-->

    <!--Contenido-->
        <div  class="page">

            <!--Titulo-->
                <div class="row" style="background-color: #fffffffd; border: 1px solid #313A3F;border-radius: 1px;">
                    <div class="pt-2 text-center col-11">
                        <p class="textocentrado">LISTA DE ASISTENCIA</p>
                    </div>
                    <div class="pt-2 text-right col-1 bt-primary">
                    <button type="button" id="bayuda" class="Ayuda ui-button-icon ui-icon ui-icon-help" title="Mostrar una guía de Usuario">
                    </button>    
                    </div>
                </div>
            <!--Titulo-->
        <br>
            <!--Titulo-->
                <div id="TituloArea" class="row py-2" style="background-color:  #e0ddddfd; border: 1px solid #313A3F;border-radius: 1px;">
                    <div class="col-5 mx-auto" style="text-align:center;">
                        <select class="form-control" id="Titulo">
                            <option selected value="ZOTGM">Zona de Operación de Transmision Guerrero Morelos</option>
                            <option value="ZTG">Zona Transmision Guerrero </option>
                        </select>
                    </div>
                </div>
            <!--Titulo End-->
                <br/>
            <!--Calculoo de Fecha-->
                <?php 
                    
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
                    $Fecha = "" . date("d") . " de " . $Mes[date("m")] . " del " . date("Y") . "";
                    $HC = "".date("h").":".date("i")." ".date("A")."";
                    $HF = date("h")+1;
                    if($HF==13){
                        $HF=1;
                    }
                    if($HF == 10 || $HF == 11 || $HF == 12){
                        $HT = "".($HF).":".date("i")." ".date("A")."";
                    }
                    else{
                        $HT = "0".($HF).":".date("i")." ".date("A")."";
                    }
                ?>
            <!--Calculoo de Fecha End-->

            <!--Formulario-->
                <div class="row">

                    <!--Datos-->
                        <div id="DatosArea" title = "" style="border: 1px solid #313A3F;border-radius: 1px;" class="pt-1 col-12 col-sm-12 col-md-12 col-lg-5 col-xl-5 order-1 order-sm-1 order-md-1 order-lg-1 order-xl-1">
                            <div class="row">
                                <div class=" mx-1 p-0 textoremarcado" style="width:10%;height:30px;">Fecha:</div>
                                <div class=" mx-0 px-0" style="width:44%;height:30px;"><input type="text"  name="FName" id="Fname" value="<?php echo $Fecha;?>" style="width:100%;height:30px; margin:0px;padding:0px;" maxlength=55></div>
                                <div class=" mx-1 p-0 textoremarcado" style="width:4%;height:30px;">De</div>
                                <div class=" mx-0 px-0 p-0"   style="width:14%;"><input type="text"  name="HComienzo" id="HC" value="<?php echo $HC;?>" readonly="readonly" style="width:100%;height:30px; text-align: center; "></div>
                                <div class=" mx-1 p-0 textoremarcado" style="width:2%;height:30px;">a</div>
                                <div class=" mx-0 px-0 p-0"   style="width:14%;"><input type="text"  name="HTermino" id="HT" value="<?php echo $HT;?>" readonly="readonly" style="width:100%;height:30px; text-align: center;"></div>
                                <div class=" mx-1 p-0 textoremarcado" style="width:4%;height:30px;">Hrs</div>

                                <div class="w-100"></div>

                                <div class="col-2 p-2 textoremarcado">Tema:</div>
                                <div class="col p-2"><input id="Tema" type="text" class="datos" placeholder="Nombre del tema" maxlength=50></div>
                                <div class="w-100"></div>
                                <div class="col-2 p-2 textoremarcado">Expositor:</div>
                                <div class="col p-2"><input id="Expo" type="text" class="datos" placeholder="Nombre del Expositor" maxlength=50></div>
                            </div>
                        </div>
                    <!--Datos end-->

                    <!--CHECK-->
                        <div style="border: 1px solid #313A3F;border-left: 0px solid #313A3F;border-radius: 1px;" class=" col-12 col-sm-12 col-md-12 col-lg-7 col-xl-7 order-1 order-sm-1 order-md-1 order-lg-2 order-xl-2">
                            <div class="row" id="Checks" title = "">
                                <div class="col-6 col-sm-6 col-md-6 col-lg-2 col-xl-2">
                                    <div class="row" id="auditoria">
                                        <div style="border: 1px solid #313A3F;border-left: 0px solid #313A3F;border-top: 0px solid #313A3F;border-radius: 1px;" class="pt-2 pb-2 col text-center">Auditoria</div>
                                        <div class="w-100"></div>
                                        <div style="border-right: 1px solid #313A3F;"class="pt-2 col"><label><input id="audiApe" type="checkbox" value="Apertura"> Apertura</label></div>
                                        <div class="w-100"></div>
                                        <div style="border-right: 1px solid #313A3F;"class="pt-2 col"><label><input id="audiCie" type="checkbox" value="Cierre"> Cierre</label></div>
                                    </div>
                                </div>
                                <div class="col-6 col-sm-6 col-md-6 col-lg-5 col-xl-5">
                                    <div class="row" id="difusion">
                                        <div style="border: 1px solid #313A3F;border-left: 0px solid #313A3F;border-top: 0px solid #313A3F;border-radius: 1px;" class="pt-2 pb-2 col text-center">Difusion</div>
                                        <div class="w-100"></div>
                                        <div class="pt-2 col"><label><input id="difuCal" type="checkbox" value="Calidad"> Calidad</label></div>
                                        <div style="border-right: 1px solid #313A3F;"class="pt-2 col"><label><input id="difuSeg" type="checkbox" value="Seguridad"> Seguridad</label></div>
                                        <div class="w-100"></div>
                                        <div class="pt-2 col"><label><input id="difuAmb" type="checkbox" value="Ambiental"> Ambiental</label></div>
                                        <div style="border-right: 1px solid #313A3F;"class="pt-2 col"><label><input id="difuOtro" type="checkbox" value="Otro Tema"> Otro Tema</label></div>
                                    </div>
                                </div>
                                <div class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3" >
                                    <div class="row" id="reunion">
                                        <div style="border: 1px solid #313A3F;border-left: 0px solid #313A3F;border-top: 0px solid #313A3F;border-radius: 1px;" class="pt-2 pb-2 col text-center">Reunion de Trabajo</div>
                                        <div class="w-100"></div>
                                        <div style="border-right: 1px solid #313A3F;"class="pt-2 col"><label><input id="reunRev" type="checkbox" value="Rev X la Dir"> Rev X la Dir</label></div>
                                        <div class="w-100"></div>
                                        <div style="border-right: 1px solid #313A3F;"class="pt-2 col"><label><input id="reunOtro" type="checkbox" value="Otro Tema"> Otro Tema</label></div>
                                    </div>
                                </div>
                                <div class="col-6 col-sm-6 col-md-6 col-lg-2 col-xl-2">
                                    <div class="row" id="curso">
                                        <div style="border-bottom: 1px solid #313A3F;border-radius: 1px;" class="pt-2 pb-2 col text-center">Curso</div>
                                        <div class="w-100"></div>
                                        <div class="pt-2 col"><label><input id="curInte" type="checkbox" value="Interno"> Interno</label></div>
                                        <div class="w-100"></div>
                                        <div class="pt-2 col"><label><input id="curExte" type="checkbox" value="Externo"> Externo</label></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <!--Check End-->
                    
                </div>
            <!--Formulario End-->
                
            <!--Lista y acciones-->
                <div class="row">
                    <!--Botones-->
                        <div class="centbotones p-1 col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 order-1 order-sm-1 order-md-1 order-lg-1 order-xl-1">
                            
                            <div class="row p-0 m-0">
                                <div id="boton" class="pt-0 pb-1 pr-0 pl-0 col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 order-1 order-sm-1 order-md-1 order-lg-1 order-xl-1">
                                    <button class="form-control boton" id="PDF" type="button" disabled = "diabled">Generar PDF</button>
                                </div>
                                <div id="boton" class="pt-0 pb-1 pr-0 pl-0 col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 order-2 order-sm-2 order-md-2 order-lg-2 order-xl-2">
                                    <button class="form-control boton" id="agregar" type="button">Agregar Participante</button>
                                </div> 
                                <div id="boton" class="pt-0 pb-0 pr-0 pl-0 col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 order-1 order-sm-1 order-md-1 order-lg-3 order-xl-3">
                                    <button class="form-control boton" id="borrar" type="button">Borrar</button>
                                </div>
                                <div id="boton" class="pt-0 pb-1 pr-0 pl-0 col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 order-2 order-sm-2 order-md-2 order-lg-4 order-xl-4">
                                    <button class="form-control boton" id="FVacia" type="button">Agregar Fila</button>
                                </div>
                            </div>

                        </div>
                    <!--Botones-->

                    <!--Lista-->
                        <div class="p-1 col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 order-2 order-sm-2 order-md-2 order-lg-2 order-xl-2" >
                            <div id="contescroll" class="p-1" title = "">
                                <table class="table table-hover" style="width: 100%;">
                                    <thead>
                                        <tr class="text-center">
                                            <th scope="col" style="width: 4%;">ID</th>
                                            <th scope="col" style="width: 7%;">RPE</th>
                                            <th scope="col" style="width: 25%;">Nombre</th>
                                            <th scope="col" style="width: 25%;">Area</th>
                                            <th scope="col" style="width: 14%;">Firma</th>
                                            <th scope="col" style="width: 21%;">Correo Electronico/Tel</th>
                                            <th scope="col" style="width: 4%;"></th>
                                        </tr>
                                    </thead>
                                    <tbody id="adicionados">
                                        <?php 
                                        for($i=1;$i<14;$i++){
                                            echo '<tr class="table-primary" id="LFila">';
                                            echo '<th style="padding: 8px; margin: 0px;" scope="row"><label class="IdAd" id="'.$i.'" style="text:center;">'.$i.'</label></th>';
                                            echo '<th style="padding: 8px; margin: 0px;"><input type="text" class="form-control Infila" id="LRPE" maxlength="5" value=""></th>';
                                            echo '<td style="padding: 8px; margin: 0px;"><input type="text" class="form-control Infila" id="LNombre" maxlength="50" value=""></td>';
                                            echo '<td style="padding: 8px; margin: 0px;"><input type="text" class="form-control Infila" id="LArea" maxlength="40" value=""></td>';
                                            echo '<td style="padding: 8px; margin: 0px;"><select class="form-control Infila" id="LFirma"><option selected="true" value="Firma">Firma</option><option value="VideoConferencia">VideoConferencia</option></select></td>';
                                            echo '<td style="padding: 8px; margin: 0px;"><input type="text" class="form-control Infila" id="LCorreo" maxlength="33" value=""></td>';
                                            echo '<th style="padding: 8px; margin: 0px;"><button id="Delate"><i class="fas fa-trash-alt"></i></button></th>';
                                            echo '</tr>';
                                        }
                                        ?>
                                        
                                    </tbody>
                                    
                                </table>
                            </div>
                        </div>
                    <!--Lista-->

                   

                </div>
            <!--Listay  acciones End-->

        </div>
        <br>
        <!--Mensaje de Alerta-->
            <div id="MenAlertmain" class="ui-widget" style = "display:none;">
                <br>
                <div id="MenAlert" class="ui-state-highlight ui-corner-all" style="padding: 0 .7em; padding-top: 8px; padding-bottom: 8px; margin-bottom: 2px;">
                    <div class = "row">
                        <div class = "col-1" style = "padding-right: 2px; padding-left: 8px;"> <span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span><strong>Alert:</strong> </div>
                        <div class = "col-11" style = "padding-left: 2px;"> Sample ui-state-error style /n asdasdas \n asdasdasdas <br>adsasdasdafasdada. </div>
                    </div>

                    <div class = "row">
                        <div class = "col-1" style = "padding-right: 2px; padding-left: 8px;"> <span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span><strong>Alert:</strong> </div>
                        <div class = "col-11" style = "padding-left: 2px;"> Sample ui-state-error style /n asdasdas \n asdasdasdas <br>adsasdasdafasdada. </div>
                    </div>
                </div>
                <br>
            </div>
        <!--Mensaje de alerta end-->
        <br>
    <!--Contenido-->

    <?php include('php/Dialogos.php');?>

    <?php include('../zotgm/layout/Footer.php');?>

    <!--SCRIPT'S-->
        <script src="js/bootstrap.min.js"></script>
        <script src="js/jquery-3.3.1.slim.min.js"></script>
        <script src="js/jquery.js"></script>
        <script src="js/jquery-ui.min.js"></script>
        <script src="js/jquery.ui.timepicker.js"></script>
        <script src="js/popper.min.js"></script>
        <script src="JSPDF2/jsPDF/dist/jspdf.min.js"></script>
        <script src="JSPDF AUTOTABLE/jsPDF/dist/jspdf.plugin.autotable.min.js"></script>
        
        <script src="js/jscfe.js"></script>
        
    <!--SCRIPT'S-->

</body>
</html>