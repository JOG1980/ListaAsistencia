
$(function () {
    //Se activa cuando se de un click en el link con clase open
    $(".open").click(
        function () {
            //El script pasara los valores data-title y data-image al modal
            //El valor en data-title se pasara a la etiqueta con id llamado: image-gallery-title
            //El valor en data-image se pasara a la etiqueta con id llamado: image-gallery-image especificamente en el atributo "src"
            $('#image-gallery-title').text($(this).data('title'));
            $('#image-gallery-image').attr( 'src' , $(this).data('image') );
        })
});