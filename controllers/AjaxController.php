<?php

namespace app\controllers;

use yii\web\Controller;
use yii\helpers\ArrayHelper;

class AjaxController extends Controller {

    public function actionBuscarPuestos() {
	$cliente = $_POST['cliente'];
	$cuadrante = $_POST['cuadrante'];
	$zona = $_POST['zona'];
	$programacion = $_POST['programacion'];
	$dia = $_POST['dia'];
	$query = \app\models\TblPuestos::find();
	
		
	if ($cliente != null) $query->where(['id_cliente_fk' => $cliente]);	
	
	if ($zona == "" && $cuadrante != "") {
	    $query->joinWith([
		'idZonaFk' => function($query) use ($cuadrante) {
		    $query->andWhere(['id_cuadrante_fk' => $cuadrante]);
		}
		    ], false);	    
	}	
	if ($zona != null) $query->andWhere(['id_zona_fk' => $zona]);
	
	$puestosProgramados = \app\models\TblDetalleProgSupervisor::find()
			    ->where("id_programacion_supervisor_fk = {$programacion}")
			    ->andWhere("dia_dps = {$dia}")
			    ->all();
	$idPuestosProgramados = ArrayHelper::map($puestosProgramados, 'id_dps', 'id_puesto');
	$query->andWhere(['not in', 'id_puesto', $idPuestosProgramados]);	
	$puestos = $query->all();
	$data = [];
	foreach ($puestos AS $puesto) {
	    $data[] = [
		'id' => $puesto->id_puesto,
		'puesto' => $puesto->nombre_puesto,
		'cliente' => $puesto->idClienteFk->nombreCorto,
		'zona' => $puesto->idZonaFk->nombre_zona,
		'cuadrante' => $puesto->idZonaFk->idCuadranteFk->nombre_cuadrante,
	    ];
	}
	$this->json(['puestos' => $data]);
    }
    
    public function actionConsultarPuestosProgramadosSupervisor()
    {
	$dia = $_POST['dia'];
	$idProgramacion = $_POST['id-programacion'];
	$query = \app\models\TblDetalleProgSupervisor::find()
				    ->where("id_programacion_supervisor_fk = {$idProgramacion}")
				    ->andWhere("dia_dps = {$dia}");
	$detalles = $query->all();
	$puestos = [];
	foreach($detalles AS $detalle){
	    $puesto = $detalle->idPuesto;
	    $puestos[] = [
		'id' => $detalle->id_dps,
		'puesto' => $puesto->nombre_puesto,
		'cliente' => $puesto->idClienteFk->nombreCorto,
		'zona' => $puesto->idZonaFk->nombre_zona,
		'cuadrante' => $puesto->idZonaFk->idCuadranteFk->nombre_cuadrante,
	    ];
	}
	$this->json(['puestos' => $puestos]);
    }
    
    public function actionEliminarPuestosProgramadosSupervisor()
    {
	$ids = $_POST['ids'];
	$error = false;
	foreach($ids AS $idDetalle){
	    if(!\app\models\TblDetalleProgSupervisor::findOne(['id_dps' => $idDetalle])->delete()){
		$error = true;
		break;
	    }
	}
	$this->json([
	    'error' => $error,
	]);
    }

    public function actionGetZonasCuadrante() {
	$id = $_POST['id'];
	$criterios = ['id_cuadrante_fk' => $id];
	$zonas = \app\models\TblZonas::findAll($criterios);
	$opciones = [];
	foreach ($zonas AS $puesto) {
	    $opciones[] = [
		'name' => $puesto->nombre_zona,
		'value' => $puesto->id_zona,
	    ];
	}
	$this->json(['options' => $opciones]);
    }

    public function actionGuardarPuestos() {
	$idProgramacion = $_POST['programacion'];
	$dia = $_POST['dia-a-programar'];
	$ids = $_POST['ids'];
	foreach ($ids AS $idPuesto) {
	    $detalleProgramacion = new \app\models\TblDetalleProgSupervisor();
	    $detalleProgramacion->id_puesto = $idPuesto;
	    $detalleProgramacion->dia_dps = $dia;
	    $detalleProgramacion->id_programacion_supervisor_fk = $idProgramacion;
	    $detalleProgramacion->save();
	}
	$this->json(['error' => false]);
    }

    private function json($array) {
	header("Content-type:application/json");
	echo json_encode($array);
	exit();
    }

}
