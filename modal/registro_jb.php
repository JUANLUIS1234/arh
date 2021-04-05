	<?php
		if (isset($con))
		{
	?>
	<!-- Modal -->
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div style="background-color: #3498db" class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel"><i class='glyphicon glyphicon-edit'></i> Agregar nuevo registro</h4>
		  </div>
		<div class="modal-body">
		<form class="form-horizontal" method="post" id="guardar_registro" name="guardar_registro">
			<div id="resultados_ajax"></div>
			 <div class="form-group">
				<label for="factura" class="col-sm-3 control-label">Factura</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="factura" name="factura" placeholder="Nº Factura" >
				</div>
			  </div>
			  <div class="form-group">
				<label for="descripcion" class="col-sm-3 control-label">Descripcion</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="descripcion" name="descripcion" placeholder="Descripcion" required>
				</div>
			  </div>
			  <div class="form-group">
				<label for="monto" class="col-sm-3 control-label">Monto</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="monto" name="monto" placeholder="Monto" required>
				</div>
			  </div>
			  <div class="form-group">
				<label for="periodo" class="col-sm-3 control-label">Periodo</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="periodo" name="periodo" placeholder="Periodo" required>
				</div>
			  </div>
			  <div class="form-group">
				<label for="concepto" class="col-sm-3 control-label">Concepto</label>
				<div class="col-sm-8">
				<select class="form-control" id="concepto"  name="concepto" required="">
					<option selected disabled required value="0">Elige el concepto</option>
					<option value="Ingreso">Ingreso</option>
					<option value="Egreso">Egreso</option>
				</select>
			  </div>
			</div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
			<button type="submit" class="btn btn-primary" id="guardar_datos">Guardar datos</button>
		  </div>
		</form>
		</div>
	  </div>
	</div>
</div>
	<?php
		}
	?>