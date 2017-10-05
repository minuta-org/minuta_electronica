<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TblClientes */

$this->title = 'Nuevo Clientes';
$this->params['breadcrumbs'][] = ['label' => 'Clientes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="clientes-create">

    <?= $this->render('_form', [
	'municipioSeleccionado' => null,
	'barrios' => [],
	'dimensiones' => $dimensiones,
	'origenesJudiciales' => $origenesJudiciales,
	'coberturas' => $coberturas,
	'origenesCapitales' => $origenesCapitales,
	'sectoresEconomicos' => $sectoresEconomicos,
	'sectoresComerciales' => $sectoresComerciales,
        'model' => $model,
        'tiposDocumentos' => $tiposDocumentos,
        'municipios' => $municipios,
    ]) ?>

</div>
