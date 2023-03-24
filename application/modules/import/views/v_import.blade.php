@layout('layout')
@section('contenido')
<section class="content">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Importar productos</h3>
        </div>
        <div class="card-body">
            <form id="form-upload-user" method="post" autocomplete="off">
                <div class="sub-result"></div>
                <div class="form-group">
                    <label class="control-label">Seleccionar archivo<small class="text-danger">*</small></label>
                    <input type="file" class="form-control form-control-sm" id="file" name="file" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" required>
                    <small class="text-danger">Solamente anexar archivos xlsx.</small>
                    </div>
                <div class="form-group">
                    <div class="text-center">
                        <div class="user-loader" style="display: none;">
                            <i class="fa fa-spinner fa-spin"></i> <h1>Subiendo archivo...</h1>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-sm waves-effect waves-light" id="btnUpload">Upload</button>
                </div>
            </form>
        </div>
    </div>
</section>
<!-- /.content -->
@endsection
@section('included_js')
<script>
    $(document).ready(function() {
        $("body").on("submit", "#form-upload-user", function(e) {
            e.preventDefault();
            var data = new FormData(this);
            $.ajax({
                type: 'POST',
                url: "<?php echo base_url('import/import_data') ?>",
                data: data,
                dataType: 'json',
                contentType: false,
                cache: false,
                processData:false,
                beforeSend: function() {
                    $("#btnUpload").prop('disabled', true);
                    $(".user-loader").show();
                }, 
                success: function(result) {
                    $("#btnUpload").prop('disabled', false);
                    if(result.exito){
                        ExitoCustom(result.message,() => {
                            location.reload();
                        });
                    }else{
                        ErrorCustom(result.message);
                    }
                    $(".user-loader").hide();
                }
            });
        });
    });
</script>
@endsection