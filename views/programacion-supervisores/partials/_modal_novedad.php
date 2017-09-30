<?php
 use yii\helpers\Html;
 use yii\helpers\Url;
?>
<div class="modal fade" id="modal-novedad-turno">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Añadir novedad</h4>
            </div>
            <div class="modal-body" id="previsualizar-novedad">
                <input type="hidden" id="dia-seleccionado-novedad">
                <div class="form-group">
                    <label for="">Tipo de novedad</label>
                    <?= Html::dropDownList('dl-tipo-novedad', '', $tiposNovedades, ['class' => 'form-control', 'prompt' => "Seleccione un tipo de novedad", 'id' => 'dl-tipo-novedad']) ?>
                </div>
                <div class="form-group">
                    <label for="">Descripción</label>
                    <?= Html::textarea('ta-novedad-descripcion', '', ['id' => 'ta-novedad-descripcion', 'class' => 'form-control']) ?>
                </div>
            </div>
            <div class="modal-footer">
                <div class="btn-group">
                    <button type="button" class="btn btn-default btn-xs" data-dismiss="modal">Cancelar </button>
                    <button id="btn-guardar-novedad-turno" type="button" class="btn btn-primary btn-xs">Guardar <i class="fa fa-floppy-o"></i></button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(function(){
        $("#btn-guardar-novedad-turno").click(function(){
            var tipoNovedad = $("#dl-tipo-novedad").val();
            var dia = $("#dia-seleccionado-novedad").val();
            if($.trim(tipoNovedad) === ""){
                alert("Seleccione el tipo de novedad.");
                return false;
            }

            doAjax("<?= Url::to(['ajax/guardar-novedad-turno']) ?>", {
                dia: dia,
                idProgramacion: $("#id-programacion").val(),
                tipoNovedad: tipoNovedad,
                descripcionNovedad: $("#ta-novedad-descripcion").val()
            }).done(function(data){
                if(data.error === false){
                    $("#modal-novedad-turno").modal("hide");
                    var celda = $("[data-dia='" + dia + "']");
                    celda.addClass("celda-bloqueada");
                    celda.css("background-color", data.color);
                    celda.off();
                    div = $("<div/>");
                    div.text(data.nombreTurno.substring(0, 1));
                    div.attr("data-toggle", "tooltip");
                    div.attr("data-placement", "top");
                    div.attr("title", data.nombreTurno);
                    celda.html(div);
                    div.tooltip();
                }
            });
        });
    });
</script>