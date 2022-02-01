<!--
<div id="dialog" title="Dialogo básico" class="ui-dialog ui-corner-all ui-widget ui-widget-content ui-front ui-dialog-buttons ui-draggable">
    <p>Diálogo básico amodal. Puede ser movido, redimensionado y cerrado haciendo clic sobre el botón 'X'.</p>
</div>
-->

<!-- $('#lider_id').append("<option value='1' >Josh_reder</option>") -->

<div id="UsuariosOtros" title="Listas de Usuarios" class="OTROS ui-dialog ui-corner-all ui-widget ui-widget-content ui-front ui-dialog-buttons ui-draggable etiquetascampos" style="width: 800px;">        
                <p>Elige la lista en la cual buscar. &nbsp; &nbsp; 
                    <select class="form-control" style="width: 30%; display: inline;" id="ArchivosSelect">
                    <?php 
                            $directorio = "./XML";
                            $ListaArchivos = array_diff(scandir($directorio), array("..", "."));
                            foreach($ListaArchivos as $Archivo)
                            {
                                $extra = substr($Archivo, 0, -4);
                                echo    '<option value="'.$Archivo.'">'.$extra.'</option>';
                            }
                    ?>
                        
    </select> 
                    &nbsp; &nbsp;
                    <input id="SearchOtros" type="text" placeholder="Search"/>
                </p>
                <table class="table table-hover">
                    <thead>
                        <tr class="text-center etiquetascampos">
                            <th scope="col" style="width: 7%;">RPE</th>
                            <th scope="col" style="width: 30%;">Nombre</th>
                            <th scope="col" style="width: 32%;">Area</th>
                            <th scope="col" style="width: 31%;">Correo Electronico/Tel</th>
                        </tr>
                    </thead>
                    <tbody id="ListUsuO" class="etiquetascampos">
                        
                    </tbody>
                </table>
            </div>