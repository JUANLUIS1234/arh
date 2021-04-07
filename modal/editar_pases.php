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
			<h4  class="modal-title" id="myModalLabel"><i class='glyphicon glyphicon-edit'></i> Modificar Pases</h4>
		  </div>
		  <div class="modal-body">
			<form class="form-horizontal" method="post" id="editar_jugador" name="editar_jugador">
			<div id="resultados_ajax2"></div> 
			<div class="form-group">
				<label for="dni2" class="col-sm-3 control-label">Documento</label>
				<div class="col-sm-8">
				  <input  type="text" class="form-control" id="dni2" name="dni2" placeholder="Dni">
				  <input type="hidden" id="mod_id" name="mod_id">
				</div>
			  </div>
			  <div class="form-group">
				<label for="nombre2" class="col-sm-3 control-label">Apellidos y Nombres</label>
				<div class="col-sm-8">
				  <input  type="text" class="form-control" id="nombre2" name="nombre2" placeholder="apellido y nombre" >
				</div>
			  </div>
			  <div class="form-group">
				<label for="fecha2" class="col-sm-3 control-label">Fecha </label>
				<div class="col-sm-8">
				  <input style="background-color: lightgray" type="text" class="form-control" id="fecha2" name="fecha2"  readonly="">
				</div>
			  </div>
			  
			  
			  <div class="form-group">
				<label for="direccion2" class="col-sm-3 control-label">Origen</label>
				<div class="col-sm-8">
				  <input type="text" style="background-color: lightgray" class="form-control" id="club2" name="club2" placeholder="Club Origen" readonly="">
				</div>
			  </div>
			  
			  
			  <div class="form-group">
				<label for="telefono2" class="col-sm-3 control-label">Monto</label>
				<div class="col-sm-8">
				  <input type="text" style="background-color: lightgray" class="form-control" id="monto2" name="monto2" placeholder="Telefono" readonly="">
				</div>
			  </div>
			
			  <div class="form-group">
				<label for="club2" class="col-sm-3 control-label">Club</label>
				<div class="col-sm-8">
				  <input type="text" style="background-color: lightgray" class="form-control" id="destino2" name="destino2" placeholder="Club" readonly="">
				</div>
			  </div>
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
			<button type="submit" class="btn btn-primary" id="actualizar_datos2">Actualizar datos</button>
		  </div>
		  </form>
		</div>
	  </div>
	</div>
	<?php
		}
	?>