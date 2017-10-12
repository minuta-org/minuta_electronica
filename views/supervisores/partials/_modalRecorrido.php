<?php 

use yii\helpers\Html;

?>
<div>

    <div class="row">
        <div class="col-sm-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3>Información del puesto</h3>
                </div>
                <table class="table table-bordered table-striped table-condensed">
                    <tr><th>Codigo: </th><td id="codigo-puesto"></td></tr>
                    <tr><th>Puesto: </th><td id="nombre-puesto"></td></tr>
                    <tr><th>Cliente: </th><td id="cliente-puesto"></td></tr>
                    <tr><th>Cuadrante: </th><td id="cuadrante-puesto"></td></tr>
                    <tr><th>Zona: </th><td id="zona-puesto"></td></tr>
                </table>
            </div>
        </div>
        <div class="col-sm-8">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#novedades-puesto" aria-controls="novedades-puesto" role="tab" data-toggle="tab">Novedades puesto</a></li>
                <li role="presentation"><a href="#novedades-guarda" aria-controls="novedades-guarda" role="tab" data-toggle="tab">Novedades guardas</a></li>
                <li role="presentation"><a href="#novedades-elementos" aria-controls="novedades-elementos" role="tab" data-toggle="tab">Novedades elementos</a></li>
                <li role="presentation"><a href="#novedades-otras" aria-controls="novedades-otras" role="tab" data-toggle="tab">Otras novedades</a></li>
            </ul>

            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="novedades-puesto">
                    <div class="row">
                        <div class="col-sm-12">
                            <?= Html::textarea('recorrido_supervisor', '', ['id' => 'recorrido_supervisor', 'class' => 'tiny-editor', 'rows' => 20]) ?>
                        </div>
                    </div>
                </div>
                <!-- fin panel 1 -->
                <div role="tabpanel" class="tab-pane" id="novedades-guarda">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="row">
				<div class="col-sm-8">
				    <label for="" class="control-label">Guarda</label>
				    <?= Html::dropDownList('detalle_guarda[id]', '', $guardas, ['id' => 'select_guarda', 'class' => 'select-2', 'prompt' => 'Seleccione un guarda']) ?>
				</div>
				<div class="col-sm-4" id="contenedor-boton-agregar-guarda">
				    <label for="" class="col-sm-12  control-label">&nbsp;</label>
				    <button style="display: none;" id="btn-cancelar-guarda" class="btn btn-default btn-xs">Cancelar</button>
				    <button style="display: none;" id="btn-editar-guarda" class="btn btn-primary btn-xs">Editar <i class="fa fa-pencil"></i></button>
				    <button id="btn-agregar-guarda" class="btn btn-success btn-xs btn-block">Añadir <i class="fa fa-plus-circle"></i></button>
				</div>
			    </div>
			    <div class="row">				
				<div class="col-sm-12">
				    <?= Html::textarea('detalle_elemento[observacion]', '', ['name' => 'detalle_guarda[observacion]', 'id' => 'recorrido_detalle_guarda', 'class' => 'tiny-editor', 'rows' => 20]) ?>
				</div>
			    </div>
                        </div>
                        <div class="col-sm-6">
			    <table class="table table-bordered table-condensed">
				<thead>
				    <tr>
					<th>Guarda</th>
					<th>&nbsp;</th>
				    </tr>
				</thead>
				<tbody id="tbl-guardas-novedad">
				</tbody>
			    </table>
                        </div>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane" id="novedades-elementos">
                    <div class="col-sm-6">
                        <div class="row">
                            <div id="campo-select-elemento" class="col-sm-8">
                                <label for="" class="control-label">Elemento</label>
                                <?= Html::dropDownList('detalle_elemento[id]', '', $elementos, ['id' => 'select_elemento', 'class' => 'select-2', 'prompt' => 'Seleccione un elemento']) ?>
                            </div>
                            <div id="contenedor-boton-agregar" class="col-sm-4">
                                <label for="" class="col-sm-12 control-label">&nbsp;</label>
                                <button style="display: none;" id="btn-cancelar-elemento" class="btn btn-default btn-xs">Cancelar</button>
                                <button style="display: none;" id="btn-editar-elemento" class="btn btn-primary btn-xs">Editar <i class="fa fa-pencil"></i></button>
                                <button id="btn-agregar-elemento" class="btn btn-success btn-xs btn-block">Añadir <i class="fa fa-plus-circle"></i></button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <?= Html::textarea('detalle_elemento[observacion]', '', ['id' => 'recorrido_detalle_elementos', 'class' => 'tiny-editor', 'rows' => 20]) ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <table class="table table-bordered table-condensed">
                            <thead>
                                <tr>
                                    <th>Elemento</th>
                                    <th>Observación</th>
                                    <th>&nbsp;</th>
                                    <th>&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody id="tbl-elementos-novedad">
                                <tr>

                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane" id="novedades-otras">
                    <div class="row">
                        <div class="col-sm-12">
                            <?= Html::textarea('detalle_otros[observacion]', '', ['id' => 'recorrido_detalle_otros', 'class' => 'tiny-editor', 'rows' => 20]) ?>
                        </div>
                    </div>
                </div>
            </div>            
        </div>
    </div>
</div>

<script>
    var selectElemento = $("#select_elemento");
    var btnAgregar = $("#btn-agregar-elemento");
    var tablaElementos = $("#tbl-elementos-novedad");
    var maximoCaracteres = 40;

    $(function(){

        btnAgregar.click(function(){
            agregarElemento();
        });

        tinymce.init({
            selector: ".tiny-editor",
            mode : "exact",
            height: 200
        });

    });
    
    var agregarGuarda = function(){
	var idGuarda = selectGuarda.val();
    };

    /**
     * Función para agregar elementos a la tabla del modal.
     * @returns {Boolean}
     */
    var agregarElemento = function(){
        var idElemento = selectElemento.val();
        var observacion = tinymce.get("recorrido_detalle_elementos").getContent();

        if(idElemento == ""){
            alert("por favor seleccione un elemento", "error");
            selectElemento.select2("open");
            return false;
        }

        if($.trim(observacion) == ""){
            alert("por favor ingrese una observacion", "error");
            setTimeout(function(){
                tinymce.execCommand('mceFocus', false, 'recorrido_detalle_elementos');
            }, 1000);
            return false;
        }
	// Asignamos el foco al text area de observaciones en elementos.
        tinymce.execCommand('mceFocus',false,'id_of_textarea');
        var textoObservacion = observacion.length > maximoCaracteres? observacion.substring(0, maximoCaracteres) + "[...]" : observacion;
        var textoElemento = selectElemento.find("option:selected").text();
        var fila = $("<tr/>");
        var icono = $("<i/>", {class: 'fa fa-trash'});
        var iconoEdit = $("<i/>", {class: 'fa fa-pencil'});
        var botonEditar = $("<button/>", {class: "btn btn-warning btn-sm thin"}).html(iconoEdit);
        var botonRemover = $("<button/>", {class: "btn btn-danger btn-sm thin"}).html(icono);
        var inputObservacion = $("<input/>", {type:"hidden", 'class': "el-observacion"}).val(observacion);
        var inputElemento = $("<input/>", {type:"hidden", 'class': "el-id"}).val(idElemento);
        var removerFila = function(){
            fila.remove();
        };
	// Función invocada para iniciar el proceso de edición.
        var editar = function(){
            habilitarEdicion(fila);
        };

        botonRemover.click(function(){ removerFila(); });
        botonEditar.click(function(){ editar(); });
        var filaExistente = $("tr[data-elemento='" + idElemento + "'");
        if(filaExistente.length){
            filaExistente.find(".input-elemento span").html(textoElemento);
            filaExistente.find(".input-observacion span").html(textoObservacion);
            filaExistente.find(".input-elemento input").val(idElemento);
            filaExistente.find(".input-observacion input").val(observacion);
        } else {
            fila.attr("data-elemento", idElemento);
            fila.append($("<td/>", {class: 'input-elemento'}).append($("<span/>").html(textoElemento), inputElemento));
            fila.append($("<td/>", {class: 'input-observacion'}).append($("<span/>").html(textoObservacion), inputObservacion));
            fila.append($("<td/>", {class:"text-center col-sm-1"}).html(botonEditar));
            fila.append($("<td/>", {class:"text-center col-sm-1"}).html(botonRemover));
            tablaElementos.append(fila);
        }
        tinymce.get("recorrido_detalle_elementos").setContent("");
        selectElemento.val("").select2("open");
    };
    /**
     * Esta función permite habilitar la edición de un registro de la tabla de elementos
     * (En el modal, no en la base de datos).
     * @param jQuery fila Fila (tr) del elemento que se va a editar
     */
    var habilitarEdicion = function(fila){
        var contenedorSelectElemento = $("#campo-select-elemento");
        var contenedorBotones = $("#contenedor-boton-agregar");
        var botonAgregar = $("#btn-agregar-elemento");
        var botonEditar = $("#btn-editar-elemento");
        var botonCancelar = $("#btn-cancelar-elemento");
        var observacion = tinymce.get("recorrido_detalle_elementos");
        var inputObservacion = fila.find(".input-observacion input");
        var inputElemento = fila.find(".input-elemento input");
        var celdaObservacion = fila.find(".input-observacion span");
	
        var finalizarEdicion = function(){
            contenedorSelectElemento.attr("class", "").addClass("col-sm-8");
            contenedorBotones.attr("class", "").addClass("col-sm-4 text-right");
            botonAgregar.show();
            botonEditar.hide();
            botonCancelar.hide();
            selectElemento.val("");
            observacion.setContent("");
            select2Enable(selectElemento, true);
            selectElemento.select2("open");
        };

        var editar = function(){
            var contenidoObservacion = observacion.getContent();
            var textoObservacion = contenidoObservacion.length > maximoCaracteres? contenidoObservacion.substring(0, maximoCaracteres) + "[...]" : contenidoObservacion;
            inputObservacion.val(contenidoObservacion);
            celdaObservacion.html(textoObservacion);
            finalizarEdicion();
        };

        if(!contenedorSelectElemento.attr("data-inicializado")){
            botonEditar.click(function(){
                editar();
            });
            botonCancelar.click(function(){
                finalizarEdicion();
            });
            contenedorSelectElemento.attr("data-inicializado", "true");
        }
        contenedorSelectElemento.attr("class", "").addClass("col-sm-7");
        contenedorBotones.attr("class", "").addClass("col-sm-5 text-right");
        botonAgregar.hide();
        botonEditar.show();
        botonCancelar.show();
        observacion.setContent(inputObservacion.val());
        selectElemento.select2("val", inputElemento.val());
        select2Enable(selectElemento, false);
    };
</script>