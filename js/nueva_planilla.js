
		$(document).ready(function(){
			load(1);
		});

		function load(page){
			var q= $("#q").val();
			$("#loader").fadeIn('slow');
			$.ajax({
				url:'./ajax/jugadores_planilla.php?action=ajax&page='+page+'&q='+q,
				 beforeSend: function(objeto){
				 $('#loader').html('<img src="./img/ajax-loader.gif"> Cargando...');
			  },
				success:function(data){
					$(".outer_div").html(data).fadeIn('slow');
					$('#loader').html('');
					
				}
			})
		}

	function agregar (id)
		{
			
			var camiseta=document.getElementById('camiseta_'+id).value;
			var edad=document.getElementById('edad_'+id).value;
			//Inicia validacion
			if (isNaN(camiseta))
			{
			alert('Esto no es un numero');
			document.getElementById('camiseta_'+id).focus();
			return false;
			}
			if (isNaN(edad))
			{
			alert('Esto no es un numero');
			document.getElementById('edad_'+id).focus();
			return false;
			}
			
			//Fin validacion
			
			$.ajax({
        type: "POST",
        url: "./ajax/agregar_planilla.php",
        data: "id="+id+"&camiseta="+camiseta+"&edad="+edad,
		 beforeSend: function(objeto){
			$("#resultados").html("Mensaje: Cargando...");
		  },
        success: function(datos){
		$("#resultados").html(datos);
		}
			});
		}
		
			function eliminar (id)
		{
			
			$.ajax({
        type: "GET",
        url: "./ajax/agregar_planilla.php",
        data: "id="+id,
		 beforeSend: function(objeto){
			$("#resultados").html("Mensaje: Cargando...");
		  },
        success: function(datos){
		$("#resultados").html(datos);
		}
			});

		}
		
		$("#datos_planilla").submit(function(){
		  var club = $("#club").val();
		  var user_id = $("#user_id").val();
		  var categoria = $("#categoria").val();
		  var torneo = $("#torneo").val();
		  
		  
		 VentanaCentrada('./pdf/documentos/planilla_pdf.php?club='+club+'&user_id='+user_id+'&categoria='+categoria+'&torneo='+torneo,'Planilla','','1024','768','true');
	 	});
		
	
