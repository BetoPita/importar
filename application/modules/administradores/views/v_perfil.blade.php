@layout('layout')
<link href="{{ base_url('css/jquery.fileupload.css') }}" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
@section('contenido')
    <br>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title">Mi perfil</h2>
                    <form id="frm" class="form-material m-t-40" enctype="multipart/form-data" method="POST">
                        <input type="hidden" name="imagen" id="imagen" value="{{ $imagen }}">
                        <input type="hidden" name="path_imagen" id="path_imagen" value="{{ $path_imagen }}">
                        <input type="hidden" id="firma" name="firma" value="{{ isset($firma) ? $firma : '' }}">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Correo electrónico</label>
                                    {{ $input_email }}
                                    <span class="error error_email"></span>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Nombre</label>
                                    {{ $input_nombre }}
                                    <span class="error error_nombre"></span>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Teléfono</label>
                                    {{ $input_telefono }}
                                    <span class="error error_telefono"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Cédula</label>
                                    {{ $input_cedula }}
                                    <span class="error error_cedula"></span>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Nivel de estudios</label>
                                    {{ $input_nivel_estudios }}
                                    <span class="error error_nivel_estudios"></span>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Escuela</label>
                                    {{ $input_escuela }}
                                    <span class="error error_escuela"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Logo</label>
                                    {{ $this->blade->render('administradores/logo', ['imagen' => $imagen, 'id' => $id], true) }}
                                    <span class="error">** Sólo se permiten imágenes</span>
                                    <span class="error error_imagen"></span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <img style="width: 150px;height:150px" src="{{ isset($firma) ? $firma : '' }}" id="firma_img" alt=""><br>
                                @if (isset($firma) && $firma == '')
                                    <a id="firma" class="cuadroFirma btn btn-w-md btn-inf mt-4"
                                        style="color:#ffff !important;" data-value="firma" data-target="#firmaDigital"
                                        data-toggle="modal" style="color:white;">Generar firma</a>
                                    @if ($firma != '')
                                        <button class="btn btn-danger">Eliminar firma</button>
                                    @endif
                                @else
                                    <a id="firma" class="cuadroFirma btn btn-info"
                                        style="color:#ffff !important;" data-value="firma" data-target="#firmaDigital"
                                        data-toggle="modal" style="color:white;">Generar firma</a>
                                    @if ($firma != '')
                                        <button id="eliminar-firma" class="btn btn-danger">Eliminar firma</button>
                                    @endif
                                @endif
                                
                            </div>
                        </div>
                    </form>
                    <button type="button" id="guardar"
                        class="btn waves-effect waves-light btn-md btn-success pull-right">Guardar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="firmaDigital" role="dialog" data-backdrop="static" data-keyboard="false"
        style="z-index:3000;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h4 class="modal-title">Firma</h4>
                </div>
                <div class="modal-body">
                    <!-- signature -->
                    <div class="signatureparent_cont_1" class="text-center">
                        <canvas id="canvas" width="430" height="200" style='border: 1px solid #CCC;'>
                            Su navegador no soporta canvas
                        </canvas>
                    </div>
                    <!-- signature -->
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="" id="firma_actual" value="">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"
                        id="cerrarCuadroFirma">Cerrar</button>
                    <button type="button" class="btn btn-info" id="limpiar">Limpiar firma</button>
                    <button type="button" class="btn btn-primary" name="btnSign" id="btnSign"
                        data-dismiss="modal">Aceptar</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('included_js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/signature_pad/1.5.3/signature_pad.min.js"></script>
    <script src="{{ base_url() }}/js/jquery-ui.min.js"></script>
    <script src="{{ base_url() }}/js/jquery.fileupload.js"></script>
    <script src="{{ base_url('js/firma.js') }}"></script>
    <script>
        var site_url = "{{ site_url() }}";
        const callbackEliminarFirma = () => {
            $("#firma").val('');
            $("#firma_img").attr("src",'');
        }
        $("body").on('click', '#eliminar-firma', function(e) {
            e.preventDefault();
            ConfirmCustom("¿Está seguro de eliminar la firma? UNA VEZ ELIMINADA LA FIRMA ES NECESARIO GUARDAR EL FORMULARIO", callbackEliminarFirma, "", "Confirmar",
                "Cancelar");
        });
        $(".fileupload_img").each(function() {
            $(this).fileupload({
                    dataType: 'json',
                    done: function(e, data) {
                        $.each(data.result, function(index, file) {
                            if (file.isok) {
                                $("#imagen").val(file.file_name);
                                $("#path_imagen").val(file.path);
                                var html =
                                    "<a href='{{ base_url() }}assets_admin/images/logos_dres/" +
                                    file
                                    .file_name + "' target='_blank' title='" + file.client_name +
                                    "' class='btn btn-info btn-xs'><i class='fa fa-save'></i> Descargar</a>";
                                html = html +
                                    "<a href='{{ base_url() }}administradores/upload_delete_imagen/" +
                                    file
                                    .file_name + "' data-id='" + file.file_name +
                                    "' 'title='Eliminar " + file.client_name +
                                    "' class='btn btn-xs eliminar_imagen text-right'><i class='fa fa-trash'></i></a>";

                                $("#files_imagen").html(html);
                                $("#divfileupload_imagen").hide();
                            } else {
                                ErrorCustom("Error al procesar el documento:<br/>" + file.error,
                                    "warning");
                            }
                        });
                    },

                    start: function(e, data) {
                        $('#progress_imagen').show();
                        $('#progress_imagen .progress-bar_pdf').html('0%');
                        $('#progress_imagen .progress-bar_pdf').css(
                            'width',
                            '0%'
                        );
                    },
                    progressall: function(e, data) {
                        var progress = parseInt(data.loaded / data.total * 100, 10);
                        $('#progress_imagen .progress-bar_pdf').html(progress + '%');
                        $('#progress_imagen .progress-bar_pdf').css(
                            'width',
                            progress + '%'
                        );
                        setTimeout(function() {
                            $('#progress_imagen').hide();
                        }, 1000);

                    },
                    progress: function(e, data) {
                        var progress = parseInt(data.loaded / data.total * 100, 10);
                        $('#progress_imagen .progress-bar_pdf').html(progress + '%');
                        $('#progress_imagen .progress-bar_pdf').css(
                            'width',
                            progress + '%'
                        );
                    }
                }).prop('disabled', !$.support.fileInput)
                .parent().addClass($.support.fileInput ? undefined : 'disabled');

        }); //fileupload pdf
        $("body").on("click", '.eliminar_imagen', function(e) {
            e.preventDefault();
            archivo_eliminar = $("#path_imagen").val();
            tipo_factura = 'pdf';
            ConfirmCustom("¿Está seguro de eliminar el logo?", callbackEliminarLogo, "", "Confirmar",
                "Cancelar");
        });

        function callbackEliminarLogo() {
            ajaxJson(site_url + "/administradores/upload_delete_imagen", {
                "path_imagen": $("#path_imagen").val(),
            }, "POST", true, function(j) {
                var j = $.parseJSON(j);
                if (j.isok) {
                    ExitoCustom("Archivo eliminado correctamente");
                    $("#files_imagen").html("");
                    $("#divfileupload_imagen").show();
                    $("#imagen").val('');
                    $("#path_imagen").val('');
                }
            });
        }
        $("#guardar").on('click', function() {
            ajaxJson(site_url + '/administradores/perfil', $("#frm").serialize(), "POST", "async", function(
                result) {
                if (isNaN(result)) {
                    data = JSON.parse(result);
                    //Se recorre el json y se coloca el error en la div correspondiente
                    $.each(data, function(i, item) {
                        $(".error_" + i).empty();
                        $(".error_" + i).append(item);
                        $(".error_" + i).css("color", "red");
                    });
                } else {
                    if (result == 1) {
                        ExitoCustom("Guardado correctamente", function() {
                            window.location.href = site_url + '/administradores/perfil';
                        });
                    } else {
                        ErrorCustom('No se pudo guardar, intenta otra vez.');
                    }
                }
            });
        })
    </script>
@endsection
