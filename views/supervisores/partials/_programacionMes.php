<div class="panel panel-success">
    <div class="panel-heading">
        <h3>Detalles</h3>
    </div>
    <div class="table-responsive">
	<input type="hidden" id="id-programacion" value="<?= $programacionMes->id_programacion_supervisor ?>">
        <table class="table table-bordered table-hover table-condensed tabla-programacion">
            <thead>                
                <?= $diasMes ?>
            </thead>
            <tbody>
		<tr>		    
		<?php for($i = 1; $i <= $ultimoDia; $i ++):?>
		    <?php if($i < $diaActual): ?>
		    <td class="celda-bloqueada">&nbsp;</td>
		    <?php elseif(key_exists($i, $diasProgramados)): ?>
		    <td class="programado pointer" data-dia="<?= $i ?>">
			<i class="fa fa-check"></i>
		    </td>
		    <?php else: ?>
		    <td class="">&nbsp;</td>
		    <?php endif ?>
		<?php endfor ?>
		</tr>
            </tbody>
        </table>
    </div>
</div>

<div id="panel-programacion-mes" class="panel panel-success" style="display: none">
    <div class="panel-heading">
	<h3>Programación</h3>
    </div>
    <div class="panel-body">
	<table id="tabla-prog-mes" class="table table-bordered table-striped table-hover table-condensed kv-grid-table">
	    <thead>
		<tr>
		    <th>Código puesto</th>
		    <th>Puesto</th>
		    <th>Cliente</th>
		    <th>Cuadrante</th>
		    <th>Zona</th>
		</tr>
	    </thead>
	    <tbody>
		
	    </tbody>
	</table>
    </div>
</div>

<script>
    var diaProgramado = null;
    var tabla = null;
    $(function(){
	tabla = $("#tabla-prog-mes tbody");
	$(".programado").click(function(){
	    diaProgramado = $(this).attr("data-dia");
	    consultarProgramacionDia();
	});
    });
    
    /**
     * Esta función permite consultar la programación del día de un supervisor.
     */
    var consultarProgramacionDia = function(){
	$.ajax({
	    type: 'POST',
	    url : '<?= yii\helpers\Url::to(['ajax/consultar-programacion-dia-supervisor']) ?>',
	    beforeSend: function(){
		// Ocultamos el panel de programación del mes
		$("#panel-programacion-mes").slideUp();
	    },
	    data: {
		idProgramacion : $("#id-programacion").val(), // este input se encuentra en el formulario.
		diaProgramado : diaProgramado, // Esta variable es definida en el formulario.
	    }
	}).done(function(data){
	    if(data.error){
		console.log("Ocurrió un error al consultar la programación.");
		return false;
	    }
	    tabla.html("");
	    if(data.programacion.length > 0){
		$.each(data.programacion, function(k,programacion){
		    var fila = $("<tr/>");
		    fila.append($("<td/>").html(programacion.codigo_puesto));
		    fila.append($("<td/>").html(programacion.nombre_puesto));
		    fila.append($("<td/>").html(programacion.cliente));
		    fila.append($("<td/>").html(programacion.cuadrante));
		    fila.append($("<td/>").html(programacion.zona));
		    tabla.append(fila);
		});
	    }
	    $("#panel-programacion-mes").slideDown();
	});
    };
</script>
