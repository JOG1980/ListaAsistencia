
$(document).ready(function(){
    Validar();
    Diga();
    botones();
    Fecha();

    //AutoCompletar();

});

var adin = $('#adicionados input');
    Ides =  13; 


//Función para agregar fila de la lista de los campos de texto
function agregar(r,n,a,c,f,id){
    var Sel;
        gar=id+1;
    if(f=="VideoConferencia"){
        Sel='<td style="padding: 8px; margin: 0px;"><select class="form-control Infila" id="LFirma"><option value="Firma">Firma</option><option selected="true" value="VideoConferencia">VideoConferencia</option></select></td>'
    }
    else{
        Sel='<td style="padding: 8px; margin: 0px;"><select class="form-control Infila" id="LFirma"><option selected="true" value="Firma">Firma</option><option value="VideoConferencia">VideoConferencia</option></select></td>'
    }
    var dina=   '<tr class="table-primary" id="LFila">'+
                    '<th style="padding: 8px; margin: 0px;" scope="row"><label class="IdAd" id="'+gar+'" style="text:center;">'+gar+'</label></th>'+
                    '<th style="padding: 8px; margin: 0px;" scope="row"><input type="text" class="form-control Infila" id="LRPE" maxlength=5 value="'+r+'"></th>'+
                    '<td style="padding: 8px; margin: 0px;"><input type="text" class="form-control Infila" id="LNombre" maxlength=50 value="'+n+'"></td>'+
                    '<td style="padding: 8px; margin: 0px;"><input type="text" class="form-control Infila" id="LArea" maxlength=40 value="'+a+'"></td>'+
                    Sel+
                    '<td style="padding: 8px; margin: 0px;"><input type="text" class="form-control Infila" id="LCorreo" maxlength=33 value="'+c+'"></td>'+
                    '<th style="padding: 8px; margin: 0px;"><button id="Delate"><i class="fas fa-trash-alt"></i></button></th>'+
                '</tr>';
    if(id == ""){
        $('#adicionados').prepend(dina);
    }
    else{
        $('#adicionados').find("#"+id+"").parent().parent().after(dina);
    }
    IDarreglar();
    Ides++;
    //$("tr#LFila").after(dina);
    //$('#adicionados').append(dina);
}

function IDarreglar(){
    var k = 1;
    $("#adicionados").find(".IdAd").each(
        function() {
            var label = $(this);
            label.html(""+k+"");
            label.removeAttr("id");
            label.attr("id",""+k+"");
            k++;
        }
    );
}

//Función para borrar contenido de la ultima lista.
// function borrar(){
//     $("#BlankLRPE").val("");
//     $("#BlankLNombre").val("");
//     $("#BlankLArea").val("");
//     $("#BlankLFirma").val("");
//     $("#BlankLCorreo").val("");
// }

var MensajeER = {
    MSSERTitulo: '',
    MSSERForms: '',
    MSSERChecks: '',
    MSSERLista: '',
    Salida : "",
    ConstructorMss : function() {
        var Comienzo = '<div class = "row"><div class = "col-1" style = "padding-right: 2px; padding-left: 8px;"> <span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span>';
            Cabecera = '</strong></div><div class = "col-11" style = "padding-left: 2px;">'
            SAL = "";

        if(this.MSSERTitulo != ""){
            SAL = SAL + Comienzo + '<strong>Titulo:'+Cabecera+this.MSSERTitulo+"</div></div>";
        }
        if(this.MSSERForms != ""){
            SAL = SAL + Comienzo + '<strong>Datos:'+Cabecera+this.MSSERForms+"</div></div>";
        }
        if(this.MSSERChecks != ""){
            SAL = SAL + Comienzo + '<strong>Checks:'+Cabecera+this.MSSERChecks+"</div></div>";
        }
        if(this.MSSERLista != ""){
            SAL = SAL + Comienzo + '<strong>Lista:'+Cabecera+this.MSSERLista+"</div></div>";
        }
        this.Salida = SAL;
    },
    Sacar : function() {
        this.ConstructorMss();
        return this.Salida;
    }
};

var check = checkCampos();
    checkboxes = checkcheckbox("Inicio");
    checkTitles = checkTituloshoras();

//Función para iniciar la validacion
function Validar(){
    //Validar lista
    $("#adicionados").on("change","input, select",
        function(){
            check = checkCampos();
            $("#MenAlertmain").show();
            MensajeError();
            checkForm();
        }
    );
    
    $("#auditoria,#difusion,#reunion,#curso").on("click",'input[type="checkbox"]',
        function(){
            var CHs = $(this);
            checkboxes = checkcheckbox(CHs);
            MensajeError();
            checkForm();
        }
    );

    $("#Titulo, #Tema, #Expo, #Fname, #HC, #HT").on("change",
        function(){
            checkTitles = checkTituloshoras();
            MensajeError();
            checkForm();
        }
    );
    
    //validar Titulo TextArea
    // $("textarea").keydown(
    //     function(e){
    //         var contenido=this.value;
    //         lineas=contenido.split("\n");
    //         if(lineas.length==2){
    //             if (e.keyCode == 13 && !e.shiftKey)
    //             {
    //                 e.preventDefault();
    //             }
    //         }
    //     }
    // );
    
    //Validacion de las horas
    $("#HC").on("change",
        function(){
            document.getElementById("HT").value="";
        }
    );

    $("#HT").on("mouseenter",
        function(){
            var x = document.getElementById("HC").value; 
            var Horas = x.split(':')[0];
            var y = x.split(':')[1]; 
            var Minutos = y.split(' ')[0];
            var Per = y.split(' ')[1];
            var op;
            if(Per=="PM"){
                if(Horas!="12"){op=parseInt(Horas);op=op+13;Horas="";Horas=""+op;}
                else{Horas="13";}
            }
            if(Per=="AM"){
                if(Horas!="12"){op=parseInt(Horas);op=op+1;Horas="";Horas=""+op;}
                else{Horas="01";}
            }
            $('#HT').timepicker('option', { minTime: { hour: Horas, minute: Minutos} });
        }
    );
}

function checkForm(){
    if(check && checkboxes && checkTitles) {
        enableB();
    }
    else {
        disableB();
    }
}

//Función para comprobar los campos de texto.
function checkCampos() {

        var obj = $("#adicionados");
            TempERC = "";
            TempERB = "";
            TempERE = "";
            
    //Patrones a validar
        //var RPEPattern = "^[a-zA-Z0-9]{5}$";
        //var namePattern = "^[a-z A-Z]{9,50}$";
        //var areaPattern = "^[a-z A-Z.]{8,40}$";
        //var emailPattern = "(^([a-zA-Z0-9._%+-]{3,20})+@+(hotmail|gmail|yahoo|outlook|dt.cfe|cfe.gob|live)+.[a-zA-Z]{2,4}$)|(^[0-9]{6,15}$)";
		var RPEPattern = "^[a-zA-Z0-9]{5}$";
        var namePattern = "^[a-z A-Záéíóú]{9,50}$";
        var areaPattern = "^[a-z A-Z.áéíóú]{8,40}$";
        var emailPattern = "(^([a-zA-Z0-9._%+-]{3,20})+@+(hotmail|gmail|yahoo|outlook|dt.cfe|cfe.gob|live)+.[a-zA-Z]{2,4}$)|(^[0-9]{6,15}$)";

    //Validar lista

        var camposRellenados = true;

    //Fin validar lista

    var BlankRellenados = true;
    var voi = 0;
        ful = 0;

    //Validar entrada

    obj.find("input#LRPE").each(
        function() {
            var $this = $(this);
            if(checkInput($this,RPEPattern) && $this.val().length > 0) {
                BlankRellenados = false;
                TempERB = TempERB + "El RPE que intenta ingresar es incorrecto <br>";
                return false;
            }
        }
    );

    obj.find("input#LNombre").each(
        function() {
            var $this = $(this);
            if(checkInput($this,namePattern) && $this.val().length > 0) {
                BlankRellenados = false;
                TempERB = TempERB + "El Nombre que intenta ingresar es incorrecto <br>";
                return false;
            }
        }
    );

    obj.find("input#LArea").each(
        function() {
            var $this = $(this);
            if(checkInput($this,areaPattern) && $this.val().length > 0) {
                BlankRellenados = false;
                TempERB = TempERB + "El Area que intenta ingresar es incorrecto <br>";
                return false;
            }
        }
    );

    obj.find("input#LCorreo").each(
        function() {
            var $this = $(this);
            if(checkInput($this,emailPattern) && $this.val().length > 0) {
                BlankRellenados = false;
                TempERB = TempERB + "El correo que intenta ingresar es incorrecto <br>";
                return false;
            }
        }
    );

    var Exist=0;
    obj.find("tr#LFila").each(
        function() {
            Exist++;
        }
    );
    

    var TempERF = "";


    // // // if(BlankRellenados && ful == 4) {
    // // //     var r = document.getElementById("BlankLRPE").value;
    // // //     var n = document.getElementById("BlankLNombre").value; 
    // // //     var a = document.getElementById("BlankLArea").value; 
    // // //     var c = document.getElementById("BlankLCorreo").value; 
    // // //     var f = $("#BlankLFirma option:selected").val();
    // // //         EX = false;
    // // //     var comp = [];
    // // //     comp = Existe();
        
    // // //     comp[0].forEach(function (elemento, indice, array) {
    // // //         var ValorBusqueda = new RegExp(elemento, 'i');
    // // //         if( elemento == r ){
    // // //             EX = true;
    // // //         }
    // // //     });
    // // //     comp[1].forEach(function (elemento, indice, array) {
    // // //         var ValorBusqueda = new RegExp(elemento, 'i');
    // // //         if( elemento == n ){
    // // //             EX = true;
    // // //         }
    // // //     });
    // // //     // // comp[2].forEach(function (elemento, indice, array) {
    // // //     // //     var ValorBusqueda = new RegExp(elemento, 'i');
    // // //     // //     if( elemento == a ){
    // // //     // //         EX = true;
    // // //     // //     }
    // // //     // // });
    // // //     comp[3].forEach(function (elemento, indice, array) {
    // // //         var ValorBusqueda = new RegExp(elemento, 'i');
    // // //         //ValorBusqueda.test(c)
    // // //         if( elemento == c ){
    // // //             EX = true;
    // // //         }
    // // //     });

    // // //     if( EX == false ){
    // // //         agregar(r,n,a,c,f);
    // // //         borrar();
    // // //         Exist++;
    // // //     }
    // // //     else{TempERB = TempERB + "El valor a ingresar ya esta repetido <br>";}
    // // // }


    //Fin validar entrada

    var DefaultRellenados = true;
    if(Exist == 0) {
        DefaultRellenados = false;
        TempERE ="Tu lista esta vacia <br>";
    }
    
    MensajeER.MSSERLista = TempERC + TempERB + TempERF + TempERE;
    
    
    if(camposRellenados == false || BlankRellenados == false || DefaultRellenados == false) {
        return false;
    }
    else {
        return true;
    }
}

function checkInput(Input, pattern) {
    //alert(Input.val());
    //alert(pattern);
    //alert(Input.val().match(pattern) ? true : false)
    return Input.val().match(pattern) ? false : true;
}

function checkcheckbox(Fami) {
    var CBoxT = false;

    if(Fami == "Inicio"){
        MensajeER.MSSERChecks = 'Se necesita que marques una opcion de tipo de reunion.';
        console.log("Entro");
        return false;
    }

    if(Fami.parent().parent().parent().attr("id") == "auditoria"){
        if(Fami.attr("id")=="audiApe"){
            $("#audiCie").attr('checked', false);
        }
        if(Fami.attr("id")=="audiCie"){
            $("#audiApe").attr('checked', false);
        }
        $("#difusion").find('input[type="checkbox"]').each(
            function(){
                $(this).attr('checked', false);
            }
        );
        $("#reunion").find('input[type="checkbox"]').each(
            function(){
                $(this).attr('checked', false);
            }
        );
        $("#curso").find('input[type="checkbox"]').each(
            function(){
                $(this).attr('checked', false);
            }
        );
    }
    if(Fami.parent().parent().parent().attr("id") == "difusion"){
        $("#auditoria").find('input[type="checkbox"]').each(
            function(){
                $(this).attr('checked', false);
            }
        );
        $("#reunion").find('input[type="checkbox"]').each(
            function(){
                $(this).attr('checked', false);
            }
        );
        $("#curso").find('input[type="checkbox"]').each(
            function(){
                $(this).attr('checked', false);
            }
        );
    }
    if(Fami.parent().parent().parent().attr("id") == "reunion"){
        if(Fami.attr("id")=="reunRev"){
            $("#reunOtro").attr('checked', false);
        }
        if(Fami.attr("id")=="reunOtro"){
            $("#reunRev").attr('checked', false);
        }
        $("#difusion").find('input[type="checkbox"]').each(
            function(){
                $(this).attr('checked', false);
            }
        );
        $("#auditoria").find('input[type="checkbox"]').each(
            function(){
                $(this).attr('checked', false);
            }
        );
        $("#curso").find('input[type="checkbox"]').each(
            function(){
                $(this).attr('checked', false);
            }
        );
    }
    if(Fami.parent().parent().parent().attr("id") == "curso"){
        if(Fami.attr("id")=="curInte"){
            $("#curExte").attr('checked', false);
        }
        if(Fami.attr("id")=="curExte"){
            $("#curInte").attr('checked', false);
        }
        $("#difusion").find('input[type="checkbox"]').each(
            function(){
                $(this).attr('checked', false);
            }
        );
        $("#reunion").find('input[type="checkbox"]').each(
            function(){
                $(this).attr('checked', false);
            }
        );
        $("#auditoria").find('input[type="checkbox"]').each(
            function(){
                $(this).attr('checked', false);
            }
        );
    }
    $("#auditoria").find('input[type="checkbox"]').each(
        function(){
            if (this.checked) {
                CBoxT = true;
                return true;
            }
        }
    );
    $("#difusion").find('input[type="checkbox"]').each(
        function(){
            if (this.checked) {
                CBoxT = true;
                return true;
            }
        }
    );
    $("#reunion").find('input[type="checkbox"]').each(
        function(){
            if (this.checked) {
                CBoxT = true;
                return true;
            }
        }
    );
    $("#curso").find('input[type="checkbox"]').each(
        function(){
            if (this.checked) {
                CBoxT = true;
                return true;
            }
        }
    );

    if(CBoxT == false) {
        MensajeER.MSSERChecks = 'Se necesita que marques una opcion de tipo de reunion.';
        return false;
    }
    else {
        MensajeER.MSSERChecks = '';
        return true;
    }
}

function checkTituloshoras() {

    var CTema = false;
        CExpo = false;
        CFecha = false;
        CHC = false;
        CHT = false;
        temoER = "";

    if($("#Tema").val().length  != 0 ){
        CTema = true;
    }
    else{temoER = "El campo tema esta vacio, por favor de rellenar <br>";}
    
    if($("#Expo").val().length  != 0 ){
        CExpo = true;
    }
    else{temoER = temoER + "El campo Expositor esta vacio, por favor de rellenar <br>";}
    
    if($("#Fname").val().length  != 0 ){
        CFecha = true;
    }
    else{temoER = temoER + "La Fecha esta vacia, por favor de rellenar <br>";}
    
    if($("#HC").val().length  != 0 ){
        CHC = true;
    }
    else{temoER = temoER + "El campo Hora inicio esta vacio, por favor de rellenar <br>";}
    
    if($("#HT").val().length  != 0 ){
        CHT = true;
    }
    else{temoER = temoER + "El campo Hora Termino esta vacio, por favor de rellenar <br>";}


    MensajeER.MSSERForms = temoER;
    

    if(CTema == false || CExpo == false || CFecha == false || CHC == false || CHT == false) {
        return false;
    }
    else {
        return true;
    }
}

function Existe() {
    var ad = $("#adicionados");
    var LRPE = [];
    var LNombre = [];
    var LArea = [];
    var LCorreo = [];
    var LLISTA = [];

    ad.find("tr#LFila").each(
        function() {
            var $this = $(this);
            LRPE.push($this.find("input#LRPE").val());
            LNombre.push($this.find("input#LNombre").val());
            LArea.push($this.find("input#LArea").val());
            LCorreo.push($this.find("input#LCorreo").val());
        }
    );

    LLISTA.push(LRPE);
    LLISTA.push(LNombre);
    LLISTA.push(LArea);
    LLISTA.push(LCorreo);

    return LLISTA;
}

function VERLista(li) {

    var comp = [];

    comp = Existe();

    //borrar
    // // comp.forEach(function (elemento, indice, array) {
    // //     console.log(elemento, indice);
    // // });

    li.find("tr:hidden.ui-state-error").each(
        function() {
            var da = $(this);
                C = false;

            comp[0].forEach(function (elemento, indice, array) {
                var ValorBusqueda = new RegExp(elemento, 'i');
                if( ValorBusqueda.test(da.text()) ){
                    C = true;
                }
            });

            if( C == false ){
                da.removeClass("ui-state-error");
                da.addClass("table-default");
                da.show();
            }
        }
    );

    li.find("tr:visible").each(
        function() {
            var da = $(this);

            comp[0].forEach(function (elemento, indice, array) {
                var ValorBusqueda = new RegExp(elemento, 'i');
                if( ValorBusqueda.test(da.text()) ){
                    da.removeClass("table-default");
                    da.addClass("ui-state-error");
                    da.hide();
                }
            });
        }
    );
}

function MensajeError() {
    
    /*  
        $("#TituloArea").tooltip(
            {
                content: "Awesome title!",
                items: "[title]",
                position: {
                    my: "center bottom-20",
                    at: "center top",
                    using: function( position, feedback ) {
                    $( this ).css( position );
                    $( "<div>" )
                        .addClass( "arrow" )
                        .addClass( feedback.vertical )
                        .addClass( feedback.horizontal )
                        .appendTo( this );
                    }
                }
            }
        );
    */


    var Mensaje = MensajeER.Sacar();
    // console.log("Mensajefuncion");
    // console.log(Mensaje);
    // console.log(Mensaje.length);
    if(Mensaje.length > 0){
        $( "#MenAlert" ).html(Mensaje);
    }
    else{$("#MenAlertmain").hide();$( "#MenAlert" ).html("");}

}

//Inicialisacion de TimePicker y DatePicker
function Fecha(){

    $('#HC').timepicker({
        hourText: 'Horas',
        minuteText: 'Minutos',
        showPeriodLabels: true,
        amPmText: ['AM', 'PM'],
        showPeriod: true,
        showLeadingZero: true
    });
    $('#HT').timepicker({
        hourText: 'Horas',
        minuteText: 'Minutos',
        showPeriodLabels: true,
        amPmText: ['AM', 'PM'],
        showPeriod: true,
        showLeadingZero: true
    });

    
        $.datepicker.regional['es'] = {
            closeText: 'Cerrar',
            prevText: '< Ant',
            nextText: 'Sig >',
            currentText: 'Hoy',
            monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
            monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
            dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
            dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
            dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
            weekHeader: 'Sm',
            dateFormat: 'dd/mm/yy',
            firstDay: 1,
            isRTL: false,
            showMonthAfterYear: false,
            yearSuffix: ''
            };
        $.datepicker.setDefaults($.datepicker.regional['es']);

        $( "#Fname" ).datepicker({
             beforeShowDay: $.datepicker.noWeekends,
             dateFormat: " d 'de' MM 'del' yy",
             minDate: "-3W",
             maxDate: "+1M, 1W"
         });

        // // $("#Fname").datepicker({
        // //     beforeShowDay: nationalDays,
        // //     minDate: "-3W",
        // //     maxDate: "+1M, 1W"
        // // });
        
        natDays = [ 
            [1, 26, 'au'], [2, 6, 'nz'], [3, 17, 'ie'], [4, 27, 'za'], [5, 25, 'ar'], [6, 6, 'se'], 
            [7, 4, 'us'], [8, 17, 'id'], [9, 7, 'br'], [10, 1, 'cn'], [11, 22, 'lb'], [12, 12, 'ke'] 
        ]; 

        natDays = [[8, 12, 'au']];
        
        function nationalDays(date) { 
            for (i = 0; i < natDays.length; i++) { 
                if (date.getMonth() == natDays[i][0] - 1 && date.getDate() == natDays[i][1]) { 
                    return [false, natDays[i][2] + '_day']; 
                } 
            } 
            return [true, '']; 
        } 
    
}

//esta funcion esta hecha para pintar y validar el checkbox
function pintarPDFCheckBox(doc,x,y,valor_ref,valor){
	let L = 3;
	doc.rect(x, y, L, L);
	//si apertura esta seleccinada
	if( valor == valor_ref){
		doc.line(x, y  , x+L, y+L);
		doc.line(x, y+L, x+L, y  );
	}
}
//Area de los botones de la pagina
function botones(){
    $('#bayuda').click(function(){$("#dialog").dialog("open");});

    //listener del boton PDF -------------------
    $('#PDF').click(
        function(){
            //window.open("PDF.php");
            if(check && checkboxes && checkTitles){
                var title = "";
                title = ""+$("#Titulo option:selected").html()+"";
                tema = $("#Tema").val();
                expositor = $("#Expo").val();
                box = ["","","","","","","","","",""];
                cbox = 0;
                list = [];
                Fila = [];
            
				//buscamos las opciones seleccionadas
                $("#Checks").find('input').each(
                    function(){
                        if (this.checked) {
                            box[cbox] = this.value;
                        }
                        cbox++;
                    }
                );

				//obtenemos los renglones ------------------------------------------------
                var obj = $("#adicionados");
                obj.find("tr#LFila").each(
                    function() {
                        var $this = $(this);
                        //Fila.push($this.find("input#LRPE").val());
                        Fila.push($this.find("input#LNombre").val());
                        Fila.push($this.find("input#LArea").val());
                        Fila.push($this.find("#LFirma option:selected").val());
                        Fila.push($this.find("input#LCorreo").val());
                        list.push(Fila);
                        Fila = [];
                    }
                );

                var parametros = {
                        "title": title,
                        "tema" : tema,
                        "expositor" : expositor,
                        "Fecha" : $("#Fname").val(),
                        "HC" : $("#HC").val(),
                        "HT" : $("#HT").val(),
                        "checkboxes" : box,
                        "Lista" : list
                };

                var doc = new jsPDF('l','mm','letter');

                var logo_url1 = "css/images/cafelogo1.png";
                var logo_url2 = "css/images/logos2-1.png";
                var img1 = new Image();
                    img1.src = logo_url1;
                var img2 = new Image();
                    img2.src = logo_url2;

                //var columns = ["RPE", "Nombre", "Area", "Firma", "Correo electronico/Tel."];
                var columns = ["Nombre", "Area", "Firma", "Correo electronico/Tel."];
                
				var data = parametros["Lista"];
                data.forEach(function (elemento, indice, array) {
                    //2022-01-26 se quito el rpe del formato por eso se recorrio el indice del arreglo
					//if( elemento[3] == "Firma" ){
                    //    elemento[3] = "                             "
                    //}
					if( elemento[2] == "Firma" ){
                        elemento[2] = "                             "
                    }
                });
                    //13 - 21
                var ni = data.length;
                    na = Math.ceil((ni-13)/21);
                    ne = Math.floor((ni-13)/21);
                var Tabla = [];
                    Fila = [];

                //si son menos de 13 registros (para la primera pagina, la que tiene encabezados)
                if(ni<=13){
                    for(j=0;j<ni;j++){
                        Fila.push(data[j]);
                    }
                    Tabla.push(Fila);
                }
                //si son mas de 13 renglones
                if(ni>13){
                    for(j=0;j<13;j++){
                        Fila.push(data[j]);
                    }
                    Tabla.push(Fila);
                    Fila = [];
                    for(k=0;k<ne;k++){
                        var va=j+21;
                        for(j;j<va;j++){
                            Fila.push(data[j]);
                        }
                        Tabla.push(Fila);
                        Fila = [];
                    }
                    var va=ni-j;
                    for(j,l=0;l<va;j++,l++){
                        Fila.push(data[j]);
                    }
                    Tabla.push(Fila);
                    Fila = [];
                }

				//trazo del formato -----------------------------------------------------------------------------------
                for(i=0;i<na+1;i++){
                    var i1 = i+1;
                        it = na+1;
                    //altura donde se traza la tabla en todas las paginas excepto en la  primera pagina
                    top1 = 30;
                    var pagina = ""+i1+"";
                    var pagina1 = ""+it+"";

					doc.setFontType("bold");
                    doc.setFontSize(14);
                    doc.text(106,13,"Comisíon Federal de Electricidad");
                    doc.setFontSize(11);
                    doc.text(110,19,"Política Transversal de Calidad de CFE");
                    doc.text(111,25,"Sistema Integral de Gestion (SIG-CFE)");

                    doc.addImage(img1, 'png', 16, 10, 35, 15);
                    doc.addImage(img2, 'png', 226, 10, 35, 15);

                    //si es la peimera pagina --------------
                    if(i1==1){
                        
                        //altura donde se traza la tabla en la primera pagina
                        //top1 = 90;
                        top1 = 75;
                        doc.setDrawColor(0,0,0);
                        //doc.setFontSize(14);
						doc.setFontSize(12);
                        doc.setFontType("bold");
                        //doc.rect(16, 28, 247, 7);
                        doc.rect(16, 29, 247, 6);
                        //doc.text(115,33,"LISTA DE ASISTENCIA");
                        doc.text(115,33.5,"LISTA DE ASISTENCIA");
                        
                        
                        //zona de operacion ------------------------------
                        //doc.setFillColor(0,155,110);
                        doc.setFillColor(179,229,252);
						doc.rect(16, 37, 247, 7, 'FD');
						//doc.setFontSize(12);
						doc.setFontSize(11);
                        if(title == "Zona de Operación de Transmision Guerrero Morelos"){
                            doc.text(90,42,title);
                        }
                        else{
                            doc.text(113,42,title);
                        }
                        

                        doc.text(18,49,"Fecha: "+parametros["Fecha"]+" Hora: "+parametros["HC"]+" a "+parametros["HT"]+" Hrs");
						
						//rectangulo contenedor ----------
                        doc.setDrawColor(0,0,0);
                        //doc.rect(16, 50, 247, 25);
						//doc.rect(112, 50, 28, 25);
                        //doc.rect(192, 50, 42, 25);
                        //doc.rect(112, 50, 151, 8);
						doc.rect(16, 51, 247, 20);
						doc.rect(129, 51, 24, 20);//cuadro de auditoria
                        doc.rect(203, 51, 39, 20); //cuadro de reunion de trabajo
                        doc.rect(129, 51, 134, 6);  //cuadro de los titulos: auditoria, difusion, reunion der trabajo, curso

                        doc.text(132,55.6,"Auditoría:");
                        doc.text(171,55.6,"Difusión:");
                        doc.text(204,55.6,"Reunion de trabajo:");
                        doc.text(246,55.6,"Curso:");
                        doc.setFontType(""); //reiniciamos el formato
     
						//apertura ---------------	
                        //doc.rect(131, 61, 4, 4);
						cb_primeralinea_y = 60;
						cb_segundalinea_y = 66;
                        cbtexto_primeralinea_y = 63;
						cbtexto_segundalinea_y = 69;
                        /*doc.rect(cb_apertura_x, cb_apertura_y, 4, 4);
						//si apertura esta seleccinada
                        if(box[0]=="Apertura"){
                            //doc.line(131,61,135,64);
                            //doc.line(131,64,135,61);
							doc.line(cb_apertura_x,cb_calidad_y,cb_calidad_x+4,cb_calidad_y+4);
                            doc.line(cb_apertura_x,cb_apertura_y+4,cb_calidad_x+4,cb_calidad_y);
                        }*/
						pintarPDFCheckBox(doc, 147, cb_primeralinea_y,"Apertura",box[0]);
                        doc.text(131,cbtexto_primeralinea_y,'Apertura');
                        
						//cierre --------------------------
						
						/*doc.rect(129, 68, 4, 4);
                        if(box[1]=="Cierre"){
							//doc.line(115,63+8,119,67+8);
                            //doc.line(115,67+8,119,63+8);
                            doc.line(129,68,133,72);
                            doc.line(129,72,133,68);
                        }*/
						pintarPDFCheckBox(doc, 145, cb_segundalinea_y,"Cierre",box[1]);
                        doc.text(133,cbtexto_segundalinea_y,'Cierre');

						//calidad -------------------
                        //doc.rect(142, 63, 4, 4);
						/*cb_calidad_x = 156;
						cb_calidad_y = 61;
                        doc.rect(cb_calidad_x, cb_calidad_y, 4, 4);
                        if(box[2]=="Calidad"){
                            //doc.line(142,63,146,67);
                            //doc.line(142,67,146,63);
							doc.line(cb_calidad_x,cb_calidad_y,cb_calidad_x+4,cb_calidad_y+4);
                            doc.line(cb_calidad_x,cb_calidad_y+4,cb_calidad_x+4,cb_calidad_y);
                        }*/
						pintarPDFCheckBox(doc, 172, cb_primeralinea_y,"Calidad",box[2]);
                        doc.text(158,cbtexto_primeralinea_y,'Calidad');
						
						//seguridad -------------------------
                        /*doc.rect(146+21, 63, 4, 4);
                        if(box[3]=="Seguridad"){
                            doc.line(167,63,171,67);
                            doc.line(167,67,171,63);
                        }*/
						pintarPDFCheckBox(doc, 196, cb_primeralinea_y,"Seguridad",box[3]);
                        doc.text(179,cbtexto_primeralinea_y,'Seguridad');
						
						//ambiental----------
                        /*doc.rect(142, 71, 4, 4);
                        if(box[4]=="Ambiental"){
                            doc.line(142,63+8,146,67+8);
                            doc.line(142,67+8,146,63+8);
                        }*/
						pintarPDFCheckBox(doc, 173, cb_segundalinea_y,"Ambiental",box[4]);
                        doc.text(155,cbtexto_segundalinea_y,'Ambiental');
                        
						//otro tema
						/*doc.rect(146+21, 71, 4, 4);
                        if(box[5]=="Otro Tema"){
                            doc.line(167,63+8,171,67+8);
                            doc.line(167,67+8,171,63+8);
                        }*/
						pintarPDFCheckBox(doc, 197, cb_segundalinea_y,"Otro Tema",box[5]);
                        doc.text(179,cbtexto_segundalinea_y,'Otro Tema');

						
						
						
						//revisado por la direccion -------------------------
                        /*doc.rect(194, 63, 4, 4);
                        if(box[6]=="Rev X la Dir"){
                            doc.line(194,63,198,67);
                            doc.line(194,67,198,63);
                        }*/
						pintarPDFCheckBox(doc, 237, cb_primeralinea_y,"Rev X la Dir",box[6]);
                        doc.text(205,cbtexto_primeralinea_y,'Revision por la Dir.');
						
						//otro tema --------------------------------
                        /*doc.rect(194, 71, 4, 4);
                        if(box[7]=="Otro Tema"){
                            doc.line(194,63+8,198,67+8);
                            doc.line(194,67+8,198,63+8);
                        }*/
						pintarPDFCheckBox(doc, 229, cb_segundalinea_y,"Otro Tema",box[7]);
                        doc.text(210,cbtexto_segundalinea_y,'Otro Tema');

						//interno ------------------------------
                        /*doc.rect(236, 63, 4, 4);
                        if(box[8]=="Interno"){
                            doc.line(236,63,240,67);
                            doc.line(236,67,240,63);
                        }*/
						pintarPDFCheckBox(doc, 257, cb_primeralinea_y,"Interno",box[8]);
                        doc.text(244,cbtexto_primeralinea_y,'Interno');
                        
						//externo -----------------------------------
						/*doc.rect(236, 71, 4, 4);
                        if(box[9]=="Externo"){
                            doc.line(236,63+8,240,67+8);
                            doc.line(236,67+8,240,63+8);
                        }*/
						pintarPDFCheckBox(doc, 258, cb_segundalinea_y,"Externo",box[9]);
                        doc.text(244,cbtexto_segundalinea_y,'Externo');

						//titulo y expositor -------------------------------------
                        doc.setFontSize(11);
                        if(parametros["tema"].length>30){
                            doc.text(17,62,"Tema: "+parametros["tema"]);
                            doc.text(17,68,"Expositor: "+parametros["expositor"]);
                        }
                        else{
                            doc.text(17,60,"Tema: "+parametros["tema"]);
                            //doc.text(19,65,"Tema: "+parametros["tema"]);
                            doc.text(17,70,"Expositor: "+parametros["expositor"]);
                        }
                        //doc.line(16,85,263,85);
                    }// fin de si es la primera pagina

					//pie de pagina -----------------------------------------------------------
                    doc.line(16,204,263,204);
                    doc.setFontSize(9);
                    doc.text(17,208,"Ver. 05");
                    doc.text(132,208,"Página "+pagina+" de "+ pagina1 +"");
                    doc.text(239,208,"P-1020-003-R-04");

					//creacion de la tabla -----------------------------
                    doc.autoTable(
                        columns,
                        Tabla[i],
                        { 
                            tableLineColor: [255, 255, 255],
                            styles: {
                                //font: 'Meta',
                                fontSize: 10,
                                lineColor: [0, 0, 0],
                                lineWidth: 0.10,
                                cellPadding: 2.4
                            },
                            margin:{ top: top1, left: 16, right:16},
                            headerStyles: {
                                //fillColor: [0,155,110],
                                fillColor: [255,255,140],
                                font: "bold",
                                fontSize: 12,
                                textColor: 50,
                                halign: 'center',
                                valign: 'middle'
                            },
                            columnStyles: {
                                //cambio 2022-01-26
                                //0: {halign: 'center',
                                //    valign: 'middle',
                                //    columnWidth: 25},
                                //1: {columnWidth: 60},
                                //2: {columnWidth: 60},
                                //3: {halign: 'center',
                                //    valign: 'middle',
                                //   columnWidth: 30},
                                //4: {columnWidth: 40}
                                0: {halign: 'center',
                                    valign: 'middle',
                                    columnWidth: 70},
                                1: {columnWidth: 60},
                                2: {halign: 'center',
                                    valign: 'middle',
                                    columnWidth: 30},
                                3: {columnWidth: 55}
                            }
                        },
                    );

                    if(i<na){
                        doc.addPage("letter","l");
                    }
                }
                doc.save('Lista de asistencia.pdf');
        
            }
            else{alert("Error al enviar datos.")}
        }
    );
    $('#FVacia').click(
        function(){
            agregar("","","","","",Ides);
        }
    );
    $('#agregar').click(
        function (){

            $("button:contains('Aceptar')").attr("disabled", "disabled");
            $("button:contains('Borrar Seleccionados')").attr("disabled", "disabled");
            //$("body").css("overflow-y", "hidden");

            var Afiltrar = $("#ListUsuO");

            $("#UsuariosOtros").dialog("open");

            $('#ListUsuO tr.table-success').addClass("table-default").removeClass("table-success");
            $("#SearchOtros").val("");
            Filtrar("",Afiltrar);

            var ad = $("#adicionados");
            var comp = [];

            var Arch = $("#ArchivosSelect option:selected").val();

            if(Arch.length > 0 ){
                ad.find("tr#LFila").each(
                    function() {
                        var $this = $(this);
                        comp.push($this.find("input#LRPE").val());
                    }
                );
    
                if(comp.length <= 0){
                    comp.push("?");
                }
    
                var parametros = {
                    "Archivo": Arch,
                    "ListaAux": ListaAuxiliar,
                    "ListaRPE": comp
                };
                $.ajax({
                        data:  parametros,
                        url:   'php/Dir.php',
                        type:  'post',
                        beforeSend: function () {
                                $("#resultado").html("Procesando, espere por favor...");
                        },
                        success:  function (response) { 
                            $("#ListUsuO").html(response);
                        }
                });
            }
        }
    );
    
    $('#borrar').click(
        function(){
            var obj = $("#adicionados");

            obj.find(".ui-state-error").each(
                function() {
                    var da = $(this)
                    da.remove();
                    Ides--;
                }
            );
            check = checkCampos();
            IDarreglar();
            checkForm();
        }
    );
    $("#adicionados").on("click","#Delate",
        function(){
            var check = $(this).parent().parent();
            var va = check.attr("class");
            if(va=="table-primary") {
                check.removeClass("table-primary");
                check.addClass("ui-state-error");
            }
            if(va=="ui-state-error") {
                check.removeClass("ui-state-error");
                check.addClass("table-primary");
            }
        }
    );
}

function enableB () {
    $("#PDF").removeAttr("disabled");
}
     
function disableB () {
    $("#PDF").attr("disabled", "disabled");
}

function Leer(){
    var ad = $("#adicionados");
        ID = "";
    ad.find("tr#LFila").each(
        function() {
            var F = $(this);
            if(F.find("input#LNombre").val().length >= 7){
                ID = F.find("label").attr("id");
            }
        }
    );
    
    return ID;
}

function Filtrar(Filtro,Afiltr) {
    var ValorBusqueda = new RegExp(Filtro, 'i');
    $(Afiltr).find('tr.table-default, tr.table-success').hide();
    $(Afiltr).find('tr.table-default, tr.table-success').filter(
        function () {
        return ValorBusqueda.test($(this).text());
        }
    ).show();
}

//Funcion que crea y define las pestañas extra (Dialog)
function Diga(){
    
    $("#dialog").dialog({
        autoOpen: false,
        resizable: false,
        draggable: false,
        fluid: true,
        modal: true
    });

    $(".OTROS").dialog({
        autoOpen: false,
        resizable: false,
        draggable: false,
        height: 500,
        width: 1100,
        fluid: true,
        modal: true,
        //open: function(event, ui) { $(this).parent().find(".ui-dialog-titlebar-close").remove(); },
        buttons: {
            "Aceptar": function() {
                var obj = $("#ListUsuO");
                obj.find(".table-success:visible").each(
                    function() {
                        var da = $(this)
                        var RPE = da.find("#usuRPE").html();
                        var Nom = da.find("#usuNombre").html();
                        var Area = da.find("#usuArea").html();
                        var Corr = da.find("#usuCorreo").html();
                        var ID = Leer();
                        agregar(RPE,Nom,Area,Corr,"",ID);
                        da.removeClass("table-success");
                        da.addClass("ui-state-error");
                        da.hide();
                        $("#MenAlertmain").show();
                        MensajeError();
                    }
                );
                check = checkCampos();
                checkForm();
                //$("body").css("overflow-y", "scroll");
                $( this ).dialog( "close" );
            },
            "Salir": function() {
                //$("body").css("overflow-y", "scroll");
                $( this ).dialog("close");
            }
        }
    });

    $("#Alert").dialog({
        autoOpen: false,
        resizable: false,
        draggable: false,
        height: 500,
        width: 500,
        fluid: true,
        modal: true
    });

    $("#ListUsuO").on("click","#usuRPE, #usuNombre, #usuArea, #usuCorreo",
        function(){
            var check = $(this).parent();
                exi = 0;
            var va = check.attr("class");
            if(va=="table-default" || va=="ui-state-error") {
                check.removeClass("table-default");
                check.removeClass("ui-state-error");
                check.addClass("table-success");
                ListaAuxiliar2[0] = check.children('#usuRPE').html();
                ListaAuxiliar2[1] = check.children('#usuNombre').html();
                ListaAuxiliar.push(ListaAuxiliar2);
                //ListaAuxiliar.push(check.children('#usuRPE').html(),check.children('#usuNombre').html());
                ListaAuxiliar2 = ["",""];
            }
            if(va=="table-success") {
                check.removeClass("table-success");
                check.addClass("table-default");
                ListaAuxiliar.forEach(function (elemento, indice) {
                    if(elemento[0] == check.children('#usuRPE').html()){ListaAuxiliar.splice(indice,1);}
                });
            }
            $("#ListUsuO").find(".table-success:visible").each(function (){exi++;});
            if( exi > 0 ){
                $("button:contains('Aceptar')").removeAttr("disabled");
            }
            else{
                $("button:contains('Aceptar')").attr("disabled", "disabled");
            }

        }
    );

    $("#ArchivosSelect").on("change",
        function(){
            var Arch = $("#ArchivosSelect option:selected").val();
            var ad = $("#adicionados");
            var comp = [];
                li = $("#ListUsuO");

            $("#SearchOtros").val("");
            Filtrar("",li);

            ad.find("tr#LFila").each(
                function() {
                    var $this = $(this);
                    comp.push($this.find("input#LRPE").val());
                }
            );

            if(comp.length <= 0){
                comp.push("?");
            }

            var parametros = {
                "Archivo": Arch,
                "ListaAux": ListaAuxiliar,
                "ListaRPE": comp
            };
            $.ajax({
                    data:  parametros,
                    url:   'php/Dir.php',
                    type:  'post',
                    beforeSend: function () {
                            
                    },
                    success:  function (response) { 
                        li.html(response);
                        ListaAuxiliar = ["?"];
                    }
            });

        }
    );

    //Filtro
    $("#SearchOtros").on("keyup",
        function(){
            var da = $(this).val();
                list = $("#ListUsuO");
            Filtrar(da,list);
        }
    );
}

var ListaAuxiliar = ["?"];
    ListaAuxiliar2 = ["",""];

/*
    function AutoCompletar() {
        //var ad = $("#ListUsu");
        var ZOTGMBRPE = [];
            ZOTGMBNombre = [];
            ZOTGMBArea = [];
            ZOTGMBCorreo = [];
            ZOTGMB = [];


            $.ajax({
                url: 'php/AutoCompletarAyuda.php', //Tu archivo donde estará tu consulta
                type: 'POST', 
                dataType: 'json',
            })
            .done(function(data) {
                ZOTGMB = data;
                ZOTGMB[0].forEach(function (elemento, indice, array) {
                    if(elemento != "Default"){ZOTGMBRPE.push({value : indice, label : elemento});}
                });
                ZOTGMB[1].forEach(function (elemento, indice, array) {
                    if(elemento != "Default"){ZOTGMBNombre.push({value : indice, label : elemento});}
                });
                ZOTGMB[2].forEach(function (elemento, indice, array) {
                    if(elemento != "Default"){ZOTGMBArea.push({value : indice, label : elemento});}
                });
                ZOTGMB[3].forEach(function (elemento, indice, array) {
                    if(elemento != "Default"){ZOTGMBCorreo.push({value : indice, label : elemento});}
                });

                $( "#BlankLRPE" ).autocomplete({
                    source: ZOTGMBRPE,
                    select: function( event, ui ) {
                        var val = parseInt(ui.item.value);
                        $( "#BlankLRPE" ).val(ui.item.label);
                        $( "#BlankLNombre" ).val(ZOTGMBNombre[val-1].label);
                        $( "#BlankLArea" ).val(ZOTGMBArea[val-1].label);
                        $( "#BlankLCorreo" ).val(ZOTGMBCorreo[val-1].label);
                        event.preventDefault();
                    }
                });

                $( "#BlankLNombre" ).autocomplete({
                    source: ZOTGMBNombre,
                    select: function( event, ui ) {
                        var val = parseInt(ui.item.value);
                        $( "#BlankLRPE" ).val(ZOTGMBRPE[val-1].label);
                        $( "#BlankLNombre" ).val(ui.item.label);
                        $( "#BlankLArea" ).val(ZOTGMBArea[val-1].label);
                        $( "#BlankLCorreo" ).val(ZOTGMBCorreo[val-1].label);
                        event.preventDefault();
                    }
                });

    // // //             // // $( "#BlankLArea" ).autocomplete({
    // // //             // //     source: ZOTGMBArea,
    // // //             // //     select: function( event, ui ) {
    // // //             // //         var val = parseInt(ui.item.value);
    // // //             // //         $( "#BlankLRPE" ).val(ZOTGMBRPE[val-1].label);
    // // //             // //         $( "#BlankLNombre" ).val(ZOTGMBNombre[val-1].label);
    // // //             // //         $( "#BlankLArea" ).val(ui.item.label);
    // // //             // //         $( "#BlankLCorreo" ).val(ZOTGMBCorreo[val-1].label);
    // // //             // //         event.preventDefault();
    // // //             // //     }
    // // //             // // });

                $( "#BlankLCorreo" ).autocomplete({
                    source: ZOTGMBCorreo,
                    select: function( event, ui ) {
                        var val = parseInt(ZOTGMBRPE[val-1].label);
                        $( "#BlankLRPE" ).val(ui.item.label);
                        $( "#BlankLNombre" ).val(ZOTGMBNombre[val-1].label);
                        $( "#BlankLArea" ).val(ZOTGMBArea[val-1].label);
                        $( "#BlankLCorreo" ).val(ui.item.label);
                        event.preventDefault();
                    }
                });

            })
            .fail(function() {
                console.log("Error al cargar el arreglo");
            });


        // ad.find("tr#usu").each(
        //     function() {
        //         var $this = $(this);
        //         ZOTGMBRPE.push({value : main, label : $this.find("#usuRPE").text()});
        //         ZOTGMBNombre.push({value : main, label : $this.find("#usuNombre").text()});
        //         ZOTGMBArea.push({value : main, label : $this.find("#usuArea").text()});
        //         ZOTGMBCorreo.push({value : main, label : $this.find("#usuCorreo").text()});
        //         main++;
        //     }
        // );

    }
*/

