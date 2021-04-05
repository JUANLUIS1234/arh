	<?php
		if (isset($con))
		{
	?>
	<!-- Modal -->
	<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div style="background-color: #3498db" class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel"><i class='glyphicon glyphicon-edit'></i> Editar registro</h4>
		  </div>
		  <div class="modal-body">
			<form class="form-horizontal" method="post" id="editar_registro" name="editar_registro">
			<div id="resultados_ajax2"></div>
			<div class="form-group">
				<label for="descripcion2" class="col-sm-3 control-label">Descripcion</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="descripcion2" name="descripcion2" placeholder="Descripcion" readonly="" >
				  <input type="hidden" id="mod_id" name="mod_id">
				</div>
			  </div>
			  <div class="form-group">
				<label for="monto2" class="col-sm-3 control-label">Monto</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="monto2" name="monto2" placeholder="Monto" >
				</div>
			  </div>
			  <div class="form-group">
				<label for="periodo2" class="col-sm-3 control-label">Periodo</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="periodo2" name="periodo2" placeholder="Periodo" readonly="" >
				</div>
			  </div>
			    <div class="form-group">
				<label for="periodo" class="col-sm-3 control-label">Concepto</label>
				<div class="col-sm-8">
				  <select class='form-control input-sm ' id="concepto2" name="concepto2">
					<option >Egreso </option>
					<option >Ingreso </option>
				  </select>
				</div>
			  </div>
			  
						 	 
			
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
			<button type="submit" class="btn btn-primary" id="actualizar_datos">Actualizar datos</button>
		  </div>
		  </form>
		</div>
	  </div>
	</div>
	<?php
		}
	?>