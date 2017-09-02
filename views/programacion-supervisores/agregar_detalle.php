<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $programacion app\models\TblProgramacionSupervisores */

$this->title = $programacion->nombreSupervisor;
$this->params['breadcrumbs'][] = ['label' => 'Programacion Supervisores', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="panel panel-success">
    <div class="panel-heading">
        <h3><?= Html::encode($this->title) ?></h3>
    </div>
    <div class="panel-body">
        <?= Html::input('hidden', 'id-programacion', $programacion->id_programacion_supervisor, ['id' => 'hd-id-programacion']) ?>
        <?= Html::input('hidden', 'id-supervisor-programacion', $programacion->id_supervisor_fk, ['id' => 'id-supervisor-programacion']) ?>
        <table class="table table-bordered table-striped table-hover">
            <tr>
                <th><?= Html::activeLabel($programacion, 'id_supervisor_fk') ?></th>
                <td><?= Html::encode($programacion->nombreSupervisor) ?></td>
                <th><?= Html::activeLabel($programacion, 'id_horario_fk') ?></th>
                <td><?= Html::encode($programacion->nombreHorario) ?></td>
            </tr>
            <tr>
                <th><?= Html::activeLabel($programacion, 'fecha_inicio_programacion_supervisor') ?></th>
                <td><?= Html::encode($programacion->fecha_inicio_programacion_supervisor) ?></td>
                <th><?= Html::activeLabel($programacion, 'fecha_fin_programacion_supervisor') ?></th>
                <td><?= Html::encode($programacion->fecha_fin_programacion_supervisor) ?></td>
            </tr>
            <tr>
                <th><?= Html::activeLabel($programacion, 'id_tipo_programacion_fk') ?></th>
                <td colspan="3"><?= Html::encode($programacion->nombreTipo) ?></td>
            </tr>
        </table>
    </div>
</div>

<div class="panel panel-success">
    <div class="panel-heading">
        <h3>Detalles</h3>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-hover table-condensed tabla-programacion">
            <thead>                
                <?= $diasMes ?>
            </thead>
            <tbody>
                <tr>
                    <?php for ($i = 1; $i <= $totalDiasMes; $i ++) : ?>
                        <?php if ($i >= $diaInicio && $i < $diaInicio + $diasAProgramar): ?>
                            <?php if (in_array($i, $diasProgramacion)): ?>
                                <td class="celda-a-agregar programado" data-dia="<?= $i ?>" data-valor="<?= $i ?>">
                                    <i class="fa fa-check"></i>
                                </td>
                            <?php else: ?>
                                <td class="celda-a-agregar" data-dia="<?= $i ?>" data-valor="<?= $i ?>"></td>
                            <?php endif ?>
                        <?php else: ?>
                            <td class="celda-bloqueada">&nbsp;</td>
                        <?php endif ?>
                    <?php endfor ?>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<div class="panel panel-success" id="panel-previsualizacion" style="display: none">
    <div class="panel-heading">
        <h3>
            Programación del día <span id="dia-previsualizacion"></span>.
        </h3>
    </div>
    <table id="tabla-mostrar-programacion-dia" class="table table-bordered table-hover table-striped">
        <thead>
            <tr>
                <th class="text-center">Puesto</th>
                <th class="text-center">Cliente</th>
                <th class="text-center">Zona</th>
                <th class="text-center">Cuadrante</th>
                <th class="text-center">Estado</th>
                <th class="text-center action-column-sm">&nbsp;</th>
            </tr>
        </thead>
        <tbody>
            
        </tbody>
    </table>
    <div class="panel-footer text-right">
        <button id="btn-reasignar" class="btn btn-primary" disabled="disabled">
            <i class="fa fa-exchange"></i> Reasignar
        </button>
    </div>
</div>

<?php $this->beginBlock('bloque-auxiliar') ?>

<div class="modal fade modal-wide" id="modal-agregar-puesto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Puestos</h4>
                <input type="hidden" id="id-programacion" value="<?= $programacion->id_programacion_supervisor ?>">
                <input type="hidden" id="dia-a-guardar" value="">
            </div>
            <div class="modal-body">
                <ul class="nav nav-tabs">
                    <li class="active" ><a href="#consultar" data-toggle="tab">Consultar puestos</a></li>
                    <li><a href="#agregar" data-toggle="tab">Agregar puestos</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active fade in" id="consultar">
                        <table id="tabla-ver-puestos" class="table table-bordered table-condensed table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center">Puesto</th>
                                    <th class="text-center">Cliente</th>
                                    <th class="text-center">Zona</th>
                                    <th class="text-center">Cuadrante</th>
                                    <th class="text-center">&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="warning">
                                    <td colspan="5" class="text-center">No se han asignado puestos</td>
                                </tr>
                            </tbody>
                        </table>
                        <hr class="col-sm-11">
                        <div class="form-group text-right">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                            <button type="button" class="btn btn-danger" id="eliminar-puestos" data-dismiss="modal">Eliminar</button>
                        </div>
                    </div>
                    <div class="tab-pane fade in" id="agregar">
                        <div class="row">
                            <div class="col-sm-10 col-sm-offset-1">
                                <div class="form-group wide">
                                    <label for="" class="col-sm-2">Cliente</label>
                                    <div class="col-sm-4">
                                        <?= Html::dropDownList('select-cliente', '', $clientes, ['class' => 'select-2', 'prompt' => 'Seleccione un cliente', 'id' => 'select-cliente']); ?>
                                    </div>
                                    <label for="" class="col-sm-2">Cuadrante</label>
                                    <div class="col-sm-4">
                                        <?= Html::dropDownList('select-cuadrante', '', $cuadrantes, ['class' => 'select-2', 'prompt' => 'Seleccione un cuadrante', 'id' => 'select-cuadrante']); ?>
                                    </div>
                                </div>        
                                <div class="form-group wide">
                                    <label for="" class="col-sm-2">Zona</label>
                                    <div class="col-sm-4">
                                        <?= Html::dropDownList('select-zona', '', [], ['class' => 'select-2', 'prompt' => 'Seleccione un cliente', 'id' => 'select-zona']); ?>
                                    </div>
                                    <div class="col-sm-offset-2 col-sm-4">
                                        <button class="btn btn-default btn-xs" id="btn-search-puestos">
                                            Buscar <i class="fa fa-search"></i>
                                        </button>
                                        <button class="btn btn-primary btn-xs" id="btn-add-cliente">
                                            Registrar <i class="fa fa-user-plus"></i>
                                        </button>                                        
                                    </div>                                
                                </div>
                            </div>
                            <hr class="col-sm-10">
                        </div>
                        <div class="row">                        
                            <div class="col-sm-12">
                                <table id="tabla-puestos" class="table table-bordered table-condensed table-hover">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Puesto</th>
                                            <th class="text-center">Cliente</th>
                                            <th class="text-center">Zona</th>
                                            <th class="text-center">Cuadrante</th>
                                            <th class="text-center">&nbsp;</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="warning">
                                            <td colspan="5" class="text-center">Busca puestos</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group text-right">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                            <button type="button" class="btn btn-success" id="guardar-puestos" data-dismiss="modal">Guardar</button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<div id="modal-reasignar" class="modal fade modal-wide">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Reasignar puesto</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="col-sm-6">
                            <div class="form-group wide">
                                <label for="" class="col-sm-3">Supervisor</label>
                                <div class="col-sm-9">
                                    <?= Html::dropDownList('supervisor', '', [], ['id' => 'combo-reasignar-supervisor', 'class' => 'select-2', 'prompt' => 'Seleccione un supervisor'])?>
                                </div>
                            </div>
                            <div class="form-group wide">
                                <label for="" class="col-sm-3">Novedad</label>
                                <div class="col-sm-9">
                                    <?= Html::textarea('novedad', '', ['id' => 'txt-novedad-reasignacion', 'placeholders' => 'Ingrese una novedad...', 'class' => 'form-control']) ?>
                                </div>
                            </div>                            
                        </div>
                        <div class="col-sm-6">
                            <table id="tabla-programaciones-supervisores" class="table table-bordered table-hover table-condensed table-striped">
                                <thead>
                                    <tr>
                                        <th>
                                            Fecha 
                                        </th>
                                        <th>
                                            Horario
                                        </th>
                                        <th>
                                            Tipo
                                        </th>
                                        <th>
                                            &nbsp;
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <hr>
                        <div class="panel panel-success">
                            <div class="panel-heading">
                                <h3>Programación</h3>
                            </div>
                            <div class="table-responsive">
                                <table id="tabla-programacion-supervisores-reasignar" class="table table-bordered table-hover tabla-programacion">
                                    <tr>
                                        <td class="warning text-center">
                                            Seleccione un supervisor y una programación
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button id="btn-reasignar-guardar" type="button" class="btn btn-primary" data-dismiss="modal">Reasignar</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="modal-novedad">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Novedad</h4>
            </div>
            <div class="modal-body" id="previsualizar-novedad">
                    
            </div>
            <div class="modal-footer">
                <div class="btn-group"id="botones-control">
                    <button type="button" class="btn btn-default btn-xs" data-dismiss="modal">Cerrar</button>
                    <button id="btn-editar-novedad"type="button" class="btn btn-info btn-xs">Editar <i class="fa fa-pencil"></i></button>
                </div>
                <div id="botones-acciones" class="btn-group" style="display: none">
                    <button id="btn-cancelar-novedad"type="button" class="btn btn-default btn-xs">Cancelar </button>
                    <button id="btn-guardar-novedad" type="button" class="btn btn-primary btn-xs">Guardar <i class="fa fa-floppy-o"></i></button>                    
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<?php $this->endBlock() ?>

<script>
    var cliente = $("#select-cliente");
    var cuadrante = $("#select-cuadrante");
    var zona = $("#select-zona");
    var celdaSeleccionada = null;
    var puestosReasignar = [];
    var numeroDiaReasignar = null;
    var programacionReasignar = null;
    var idDetalleNovedad = null;
    var idSupervisor = $("#id-supervisor-programacion").val();
    
    /**
     * Plugin para click derechod
     */
    (function($){
        /**
         * Eventos para reasignación
         */
        $("#btn-reasignar").click(function(){
            puestosReasignar = [];
            $(".check-reasignar:checked").each(function(){
                puestosReasignar.push($(this).val());
            });
            console.log(puestosReasignar);
            iniciarReasignacion($("#hd-id-programacion").val());
        });
        $("#combo-reasignar-supervisor").change(function(){
            var parametros = {
                'id-programacion': $("#hd-id-programacion").val(),
                'id-supervisor' : $(this).val(),
                'dia' : celdaSeleccionada.attr("data-dia"),
            };
            $("#tabla-programacion-supervisores-reasignar").html("");
            doAjax("<?= Url::toRoute(['ajax/consultar-programacion-supervisores-reasignar']) ?>", parametros)
                    .done(function(data){
                        var tabla = $("#tabla-programaciones-supervisores tbody");
                        tabla.html("");
                        if(data.programaciones.length > 0){
                            $.each(data.programaciones, function(k,v){
                                var fila = $("<tr/>");
                                var radio = $("<input/>", {type: 'radio', name: 'programacion-reasignar', value:v.id, class: 'check-reasignar'});
                                fila.append($("<td/>").text(v.fecha));
                                fila.append($("<td/>").text(v.horario));
                                fila.append($("<td/>").text(v.tipo));
                                fila.append($("<td/>", {class: 'text-center'}).html(radio));
                                radio.click(function(){
                                    consultarPuestosProgramacion(v.id);
                                    programacionReasignar = v.id;
                                });
                                tabla.append(fila);
                            });                            
                        } else {
                            var fila = $("<tr/>");
                            fila.append($("<td/>", { colspan: 3 }).text("No hay programaciones para este supervisor este mes"));
                            tabla.append(fila);
                        }
                    });
        });

        /**
         * Fin Eventos para reasignación
         */
        $.fn.clickDerecho = function(parametros){
            var opciones = parametros.opciones || {};
            var elementos = $(this);

            var dibujarMenu = function(elemento, valor){
                var posicion = elemento.offset();
                var ancho = elemento.width();

                var contenedor = $("<div/>", {class: "dropdown-opciones"});
                var contenedorOpciones = $("<ul/>");
                var xcontenedor = posicion.left + ancho;
                var ycontenedor = posicion.top;

                $.each(opciones, function(k,v) {
                    var opcion = $("<li/>").text(v.texto);
                    var accion = v.accion || function(){};
                    opcion.click(function(){accion(valor);});
                    contenedorOpciones.append(opcion);
                });
                contenedor.append(contenedorOpciones);
                contenedor.css({
                    left: xcontenedor,
                    top: ycontenedor,
                });
                $("body").append(contenedor);
                contenedor.contextmenu(function(e){
                    e.preventDefault();
                });
            };

            var removerMenu = function(){
                $(".dropdown-opciones").remove();
            };

            $("body").click(function(){
               removerMenu();
            });

            /**
             * Iniciamos los eventos
             */
            $.each(elementos, function(k,v){
                var elemento = $(v);
                elemento.on("contextmenu", function(e){
                    removerMenu();
                    var valor = elemento.attr("data-valor");
                    celdaSeleccionada = elemento;
                    dibujarMenu(elemento, valor);
                    e.preventDefault();
                });
            });
        };
    })(jQuery);

    $(function () {
        $("#btn-editar-novedad").click(function(){
            // id="previsualizar-novedad"
            var novedad = $("#previsualizar-novedad");
            var texto = novedad.text();
            var textarea = $("<textarea/>", {id: 'tmp-text-area', class: 'form-control'}).text(texto);
            $("#botones-control").slideUp(function(){                
                $("#botones-acciones").slideDown();
                novedad.html(textarea);
                textarea.focus().select();
            });
        });        
        
        $("#btn-cancelar-novedad").click(function(){            
            var novedad = $("#previsualizar-novedad");
            var texto = $("#tmp-text-area").val();
            $("#botones-acciones").slideUp(function(){                
                $("#botones-control").slideDown();
                novedad.html(texto);
            });            
        });
        
        $("#btn-guardar-novedad").click(function(){
            var parametros = {
                'idDetalle' : idDetalleNovedad,
                'novedad' : $("#tmp-text-area").val(),
            };            
             doAjax("<?= Url::toRoute(['ajax/actualizar-novedad-programacion']) ?>", parametros)
                    .done(function(data){
                        if(data.error === false){
                            $("#modal-novedad").modal("hide");
                            $("tr[data-id='" + idDetalleNovedad + "']").attr("data-novedad", $("#tmp-text-area").val());
                        } else {
                            console.log("Error al actualizar la novedad");
                        }                        
                    });
        });
    
        $("#btn-reasignar-guardar").click(function(){
            var novedad = $("#txt-novedad-reasignacion");
            if($.trim(novedad.val()) === ""){
                alert("Por favor ingrese una novedad.");
                novedad.focus();
                return false;
            }
            if(numeroDiaReasignar === null){
                alert("Por favor seleccione una programación y un día para reasignar");
                $("#combo-reasignar-supervisor").select2("open");
                return false;
            }
            var parametros = {
                ids : puestosReasignar,
                novedad: novedad.val(),
                idProgramacion: programacionReasignar,
                dia: numeroDiaReasignar,
            };
            doAjax("<?= Url::toRoute(['ajax/guardar-reasignacion-puesto']) ?>", parametros)
                    .done(function(data){
                        if(data.error == false){
                            console.log("Guardado exitoso!");
                            preVisualizarDia(celdaSeleccionada.attr("data-dia"));
                        } else {
                            console.log("Ocurrió un error");
                        }
                        programacionReasignar = null;
                        numeroDiaReasignar = null;
                    }); 
        });
    
        /**
         * Capturamos los click derechos.
         */
        $(".celda-a-agregar").clickDerecho({
            opciones: [
                {texto: "Previsualizar", accion: function(dia){
                    preVisualizarDia(dia);
                }},
            ]
        });
        
        $("#eliminar-puestos").click(function () {
            eliminarPuestos();
        });

        $(".celda-a-agregar").click(function () {
            ocultarPrevisualizacion();
            celdaSeleccionada = $(this);
            verPuestos();
            abrirModal($(this));
        });

        $("#select-cuadrante").change(function () {
            if ($.trim($(this).val()) !== "") {
                consultarClientes($(this).val());
            } else {
                limpiarCombo($("#select-zona"));
            }
        });

        $("#btn-search-puestos").click(function () {
            buscarPuestos();
        });

        $("#guardar-puestos").click(function () {
            guardarPuestos();
        });
    });
    
    var ocultarPrevisualizacion = function(){
        var panel = $("#panel-previsualizacion");
        panel.fadeOut();
    };
    
    var mostrarNovedad = function(novedad, idDetalle){
        $("#previsualizar-novedad").text(novedad);
        idDetalleNovedad = idDetalle;
        $("#modal-novedad").modal("show");
    };
    
    var consultarPuestosProgramacion = function(id){
        doAjax('<?= Url::toRoute(['ajax/consultar-puestos-programacion']) ?>', {'id': id, 'dia' : celdaSeleccionada.attr("data-dia"), 'id-supervisor' : idSupervisor})
                .done(function(data){
                    var tabla = $("#tabla-programacion-supervisores-reasignar");
                    tabla.html(data.html);
                    $(".celda-reasignar").click(function(){
                        $(".celda-reasignar").removeClass("activo");
                        $(this).addClass("activo");
                        numeroDiaReasignar = $(this).attr("data-dia");
                    });
                });
    };

    var preVisualizarDia = function(dia){
        var panel = $("#panel-previsualizacion");
        panel.slideDown();
        $("#dia-previsualizacion").text(celdaSeleccionada.attr("data-dia"));
        var parametros = {
            'dia': dia,
            'id-programacion': $("#hd-id-programacion").val()
        };
        $("#btn-reasignar").attr("disabled", "disabled");
        var tabla = $("#tabla-mostrar-programacion-dia tbody");
        tabla.html("");
        doAjax('<?= Url::toRoute(['ajax/previsualizar-dia']) ?>', parametros)
            .done(function(data){
                if (data.puestos && data.puestos.length > 0) {
                    $.each(data.puestos, function (k, v) {
                        var tr = $("<tr/>", {'data-id': v.id, 'data-novedad' : v.novedad});
                        tr.append($("<td/>").text(v.puesto));
                        tr.append($("<td/>").text(v.cliente));
                        tr.append($("<td/>").text(v.zona));
                        tr.append($("<td/>").text(v.cuadrante));
                        tr.append($("<td/>", {class: 'action-column-sm text-center'}).html(v.estadoEtiqueta));
                        if(v.cambiar){
                            var check = $("<input/>", {class: 'check-reasignar', type: 'checkbox', name: 'puestos-no-visitados[]', value: v.id});
                            check.click(function(){
                                if($(".check-reasignar:checked").length > 0){
                                    $("#btn-reasignar").removeAttr("disabled");
                                } else {
                                    $("#btn-reasignar").attr("disabled", "disabled");
                                }
                            });
                            tr.append($("<td/>", {class:'action-column-sm'}).html(check));
                        } else if(v.reasignado){
                            var boton = $("<a/>").html($("<i/>", {class: 'fa fa-eye'}));
                            boton.click(function(){
                                mostrarNovedad(tr.attr("data-novedad"), v.id);
                            });
                            tr.append($("<td/>", {class:'action-column-sm'}).html(boton));
                        } else {
                            tr.append($("<td/>", {class: 'action-column-sm'}).text(""));
                        }
                        tabla.append(tr);
                    });
                } else {
                    var tr = $("<tr/>");
                    tr.append($("<td/>", {colspan: 6, class: 'text-center warning'}).html("No hay resultados"));
                    tabla.append(tr);
                }
            });
    };
    
    
    
    /**
     * Esta función se encarga de llenar el combo de supervisores para reasignarles el puesto.
     */
    var iniciarReasignacion = function(idProgramacion){
        var parametros = {
            'id-programacion': idProgramacion
        };
        doAjax("<?= Url::toRoute(['ajax/consultar-supervisores-reasignacion']) ?>", parametros)
            .done(function(data){
                var comboSupervisores = $("#combo-reasignar-supervisor");
                comboSupervisores.attr("data-detalle", idProgramacion);
                limpiarCombo(comboSupervisores);
                $.each(data.supervisores, function(k,v){
                    var opcion = $("<option/>", {value: v.id}).html(v.nombre);
                    comboSupervisores.append(opcion);
                    
                });
                $("#modal-reasignar").modal('show');
                setTimeout(function(){
                    comboSupervisores.select2('open');
                }, 700);
            });
    };

    var verPuestos = function () {
        var parametros = {
            'dia': celdaSeleccionada.attr("data-dia"),
            'id-programacion': $("#hd-id-programacion").val()
        };
        doAjax('<?= Url::toRoute(['ajax/consultar-puestos-programados-supervisor']) ?>', parametros)
                .done(function (data) {
                    var tabla = $("#tabla-ver-puestos tbody");
                    tabla.html("");
                    llenarTabla(data, tabla);
                });
    };

    var eliminarPuestos = function () {
        var ids = [];
        $("#tabla-ver-puestos .check-puestos:checked").each(function (k, v) {
            ids.push($(v).val());
        });
        var parametros = {
            'ids': ids,
        };
        doAjax('<?= Url::toRoute(['ajax/eliminar-puestos-programados-supervisor']) ?>', parametros)
                .done(function (data) {
                    if (data.error == false) {
                        console.log("Puesto eliminado correctamente");
                        /* Eliminamos las filas */
                        $.each(ids, function (k, v) {
                            $("#tabla-ver-puestos tr[data-id='" + v + "']").remove();
                        });
                        if ($("#tabla-ver-puestos tbody tr").length == 0) {
                            celdaSeleccionada.removeClass("programado").html("");
                        }
                    } else {
                        console.log("Error al eliminar los puestos");
                    }
                });
    };

    var abrirModal = function (celda) {
        var tabla = $("#tabla-puestos tbody");
        var tr = $("<tr/>", {class: 'warning'});
        $("#dia-a-guardar").val(celda.attr("data-dia"));
        resetSelect2(cliente);
        resetSelect2(cuadrante);
        resetSelect2(zona);
        tr.append($("<td/>", {colspan: 5, class: 'text-center'}).text("Busca puestos"));
        tabla.html(tr);
        $("#modal-agregar-puesto").modal("show");
    };

    var guardarPuestos = function () {
        var ids = [];
        $(".check-puestos:checked").each(function (k, v) {
            ids.push($(v).val());
        });
        if (ids.length === 0)
            return false;
        var url = '<?= Url::toRoute(['ajax/guardar-puestos']) ?>';
        var programacion = $("#id-programacion").val();
        var diaAProgramar = $("#dia-a-guardar").val();
        var params = {
            'ids': ids,
            'programacion': programacion,
            'dia-a-programar': diaAProgramar,
        };
        doAjax(url, params).done(function (data) {
            if (data.error == false) {
                var dia = $("[data-dia='" + $("#dia-a-guardar").val() + "']");
                var icono = $("<i/>", {class: 'fa fa-check'});
                dia.addClass("programado").html(icono);
            }
        });
    };

    var resetSelect2 = function (select) {
        select.val("");
        select.select2("destroy");
        select.select2({width: "100%"});
    };

    var buscarPuestos = function () {
        var url = '<?= Url::toRoute(['ajax/buscar-puestos']) ?>';
        var params = {
            'cliente': cliente.val(),
            'cuadrante': cuadrante.val(),
            'zona': zona.val(),
            'dia': celdaSeleccionada.attr("data-dia"),
            'programacion': $("#hd-id-programacion").val()
        };
        var tabla = $("#tabla-puestos tbody");
        doAjax(url, params).done(function (data) {
            tabla.html("");
            llenarTabla(data, tabla);
        });
    };

    var llenarTabla = function (data, tabla) {
        if (data.puestos && data.puestos.length > 0) {
            $.each(data.puestos, function (k, v) {
                var tr = $("<tr/>", {'data-id': v.id});
                var check = $("<input/>", {type: 'checkbox', 'name': 'puesto-check[]', class: 'check-puestos'}).val(v.id);
                tr.append($("<td/>").text(v.puesto));
                tr.append($("<td/>").text(v.cliente));
                tr.append($("<td/>").text(v.zona));
                tr.append($("<td/>").text(v.cuadrante));
                tr.append($("<td/>", {class: 'text-center'}).append(check));
                tabla.append(tr);
            });
        } else {
            var tr = $("<tr/>");
            tr.append($("<td/>", {colspan: 5, class: 'text-center warning'}).html("No hay resultados"));
            tabla.append(tr);
        }
    };

    var limpiarCombo = function (combo) {
        var primeraOpcion = combo.find("option:first-child");
        combo.html("");
        combo.append(primeraOpcion);
    };

    var consultarClientes = function (idCuadrante) {
        var params = {
            'id': idCuadrante,
            'ajx-rqst': true,
        };
        doAjax('<?= Url::toRoute(['ajax/get-zonas-cuadrante']) ?>', params).done(function (data) {
            var selectPuestos = $("#select-zona");
            var primeraOpcion = selectPuestos.find('option:first-child');
            limpiarCombo(selectPuestos);
            $.each(data.options, function (k, v) {
                selectPuestos.append($("<option/>", {value: v.value}).html(v.name));
            });
            selectPuestos.select2('open');
        });
    }
</script>