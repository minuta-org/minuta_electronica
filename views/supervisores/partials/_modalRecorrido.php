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
                        <div class="col-sm-12">
                            <?= Html::textarea('recorrido_detalle_guarda', '', ['id' => 'recorrido_detalle_guarda', 'class' => 'tiny-editor', 'rows' => 20]) ?>
                        </div>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane" id="novedades-elementos">
                    <div class="row">
                        <div class="col-sm-12">
                            <?= Html::textarea('recorrido_detalle_elementos', '', ['id' => 'recorrido_detalle_elementos', 'class' => 'tiny-editor', 'rows' => 20]) ?>
                        </div>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane" id="novedades-otras">
                    <div class="row">
                        <div class="col-sm-12">
                            <?= Html::textarea('recorrido_detalle_otros', '', ['id' => 'recorrido_detalle_otros', 'class' => 'tiny-editor', 'rows' => 20]) ?>
                        </div>
                    </div>
                </div>
            </div>            
        </div>
    </div>
</div>

<script>
    $(function(){
        tinymce.init({
            selector: ".tiny-editor",
            mode : "exact",
            height: 200
        });
    });
</script>