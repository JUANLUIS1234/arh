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
			<h4 class="modal-title" id="myModalLabel"><i class='glyphicon glyphicon-edit'></i> Editar Fichas</h4>
		  </div>
		  <div class="modal-body">
			<form class="form-horizontal" method="post" id="editar_fichas" name="editar_fichas">
			<div id="resultados_ajax2"></div>
			<div class="form-group">
				<label for="recibo2" class="col-sm-3 control-label">Recibo</label>
				<div class="col-sm-8">
				  <input style="background-color: lightgray" type="text" class="form-control" id="recibo2" name="recibo2" placeholder="Recibo" readonly=""> 
				  <input type="hidden" id="mod_id" name="mod_id">
				</div>
			  </div>
			<div class="form-group">
				<label for="dni2" class="col-sm-3 control-label">Documento</label>
				<div class="col-sm-8">
				  <input style="background-color: lightgray" type="text" class="form-control" id="dni2" name="dni2" placeholder="Dni" readonly="">
				</div>
			  </div>
			  <div class="form-group">
				<label for="contribuyente2" class="col-sm-3 control-label">Jugador</label>
				<div class="col-sm-8">
				  <input style="background-color: lightgray" type="text" class="form-control" id="contribuyente2" name="contribuyente2" placeholder="Jugador" readonly="">
				</div>
			  </div>
			  <div class="form-group">
				<label for="club2" class="col-sm-3 control-label">Club</label>
				<div class="col-sm-8">
				  <input style="background-color: lightgray" type="text" class="form-control" id="club2" name="club2"  readonly="">
				</div>
			  </div>
			  <div class="form-group">
				<label for="periodo2" class="col-sm-3 control-label">Periodo</label>
				<div class="col-sm-8">
				  <input style="background-color: lightgray" type="text" class="form-control" id="periodo2" name="periodo2" placeholder="Periodo" readonly="">
				</div>
			  </div>
			  <div class="form-group">
				<label for="cuota2" class="col-sm-3 control-label">Cuota</label>
				<div class="col-sm-8">
				  <input type="number" class="form-control" id="cuota2" name="cuota2" placeholder="Cuota">
				</div>
			  </div>
			  <div class="form-group">
				<label for="monto2" class="col-sm-3 control-label">Monto</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="monto2" name="monto2" placeholder="Monto">
				</div>
			  </div>
			 <div class="form-group">
				<label for="estado2" class="col-sm-3 control-label">Estado</label>
				<div class="col-sm-8">
				<select class='form-control input-sm ' id="estado2" name="estado2"  class="col-sm-8"  >
					<option selected disabled required value="0" >Elige el estado</option>
					<option value="Habilitado">Habilitado</option>
					<option value="Deshabilitado">Deshabilitado</option>
				</select>
			</div>
			  </div>
			  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
			<button type="submit" class="btn btn-primary" id="guardar_datos">Actualizar datos</button>
		  </div>
		  </form>
		</div>
	  </div>
	</div>
	<?php
		}
	?>