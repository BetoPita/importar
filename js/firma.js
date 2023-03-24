$(document).ready(function () {
    //Recuperamos la medida de la pantalla
    // var alto = $( window ).height();
    // var ancho = $( window ).width();
    var alto = screen.height;
    var ancho = screen.width;

    //Verificamos el tamaño de la pantalla
    if (ancho < 501) {
        //Calculamos las medidad de la pantalla
        var nvo_altura = alto * 0.20;
        var nvo_ancho = ancho * 0.80;
        console.log("Movil");
    } else if ((ancho > 499) && (ancho < 1030)) {
        //Calculamos las medidad de la pantalla
        var nvo_altura = alto * 0.22;
        var nvo_ancho = ancho * 0.50;
        console.log("Tablet");
    } else {
        //Calculamos las medidad de la pantalla
        var nvo_altura = alto * 0.22;
        var nvo_ancho = ancho * 0.33;
    }

    // Asignamos los valores al recuadro de la firma
    $("#canvas").prop("width", nvo_ancho.toFixed(2));
    $("#canvas").prop("height", "200");

    //Lienzo para firma general
    var signaturePad = new SignaturePad(document.getElementById('canvas'));

    $("#btnSign").on('click', function () {
        //Recuperamos la ruta de la imagen
        var data = signaturePad.toDataURL('image/png');
        //Comprobamos a donde se enviara
        $("#firma_img").attr("src", data);
        console.log('data',data);
        $('#firma').val(data);

        signaturePad.clear();
    });

    $('#limpiar').on('click', function () {
        $('#firma_actual').val('');
        signaturePad.clear();
    });

    $('#cerrarCuadroFirma').on('click', function () {
        signaturePad.clear();
    });
});

$(".cuadroFirma").on('click', function () {
    var firma = $(this).data("value");
    $('#firma_actual').val(firma);
});


//Enviamos la imagen para generarla y guardarla
function guardar_firma(base_64, firma_ruta) {
    // Usando jQuery AJAX
    var resultado = "";
    $.ajax({
        url: base_url + "autos/Salidas/firmas",
        method: 'post',
        data: {
            base_64: base_64,
        },
        success: function (resp) {
            console.log("url devuelto: " + resp);


            if (resp.indexOf("handler           </p>") < 1) {
                resultado = resp;
            } else {
                resultado = "sin firma";
            }

            if (firma_ruta == "1") {
                $('#url_firma_cliente').val(resultado);
            } else {
                $('#url_firma_asesor').val(resultado);
            }

            return resultado;
            //Cierre de success
        },
        error: function (error) {
            console.log(error);
            //Cierre del error
        }
        //Cierre del ajax
    });

}
