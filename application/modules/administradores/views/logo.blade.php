<div id="divfileupload_imagen" style="{{(($imagen != '') ? 'display:none;' : '')}}">
	<span class="btn btn-success fileinput-button btn-xs" title="Agregar imagen">
	    <i class="fa fa-plus"></i>
	    <span>Agregar logo</span>
	    <!-- The file input field used as target for the file upload widget -->
	    <input id="fileupload_img" type="file" name="file[]" data-url="{{ site_url('administradores/upload_imagen/').$id }}" multiple class="fileupload_img btn-success">
	</span>

	<div id="progress_imagen" class="progress_imagen" style="display:none;">
	    <div class="progress-bar_pdf progress-bar-azul"></div>
	</div>
</div>

<div id="files_imagen" class="files_imagen">
<?php if($imagen != ''){ ?>
	<?php echo anchor(base_url('assets_admin/images/logos_dres/'.$imagen),'<i class="fa fa-save-file"></i> Descargar','title="'.$imagen.'" class="btn btn-info btn-xs" target="_blank"') ?>
	<?php echo anchor('administradores/upload_delete_imagen/'.$imagen,'<i class="fa fa-trash"></i>','data-id="" data-pdf="'.$imagen.'" title="Eliminar'.$imagen.'" class="btn btn-xs eliminar_imagen text-centernteright" target="_blank"') ?>
<?php } ?>
</div>


