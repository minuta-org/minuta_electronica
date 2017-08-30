<?php 

namespace app\controllers;

use yii\web\Controller;

class AjaxController extends Controller{

	public function actionBuscarPuestos()
	{
		$cliente = $_POST['cliente'];
		$cuadrante = $_POST['cuadrante'];
		$zona = $_POST['zona'];
		$query = \app\models\TblPuestos::find();
		if($cliente != null)  $query->where (['id_cliente_fk' => $cliente]);
		if($zona == "" && $cuadrante != "") {
			$query->joinWith([
				'idZonaFk' => function($query) use ($cuadrante) {
					$query->andWhere(['id_cuadrante_fk' => $cuadrante]);
				}
			], false);			
		}
		if($zona != null) $query->andWhere (['id_zona_fk' => $zona]);
		$puestos = $query->all();
		$data = [];
		foreach($puestos AS $puesto){
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

	public function actionGetZonasCuadrante()
	{
		$id = $_POST['id'];
		$criterios = ['id_cuadrante_fk' => $id];
		$zonas = \app\models\TblZonas::findAll($criterios);
		$opciones = [];
		foreach($zonas AS $puesto){
			$opciones[] = [
				'name' => $puesto->nombre_zona,
				'value' => $puesto->id_zona,
			];
		}
		$this->json(['options' => $opciones]);
	}
	
	public function actionGuardarPuestos()
	{
		$idProgramacion = $_POST['programacion'];
		$dia = $_POST['dia-a-programar'];
		$ids = $_POST['ids'];
		foreach($ids AS $idPuesto){
			$detalleProgramacion = new \app\models\TblDetalleProgSupervisor();
			$detalleProgramacion->id_puesto = $idPuesto;
			$detalleProgramacion->dia_dps = $dia;
			$detalleProgramacion->id_programacion_supervisor_fk = $idProgramacion;
			$detalleProgramacion->save();
		}
		$this->json(['error' => false]);
	}

	private function json($array)
	{
		header("Content-type:application/json");
		echo json_encode($array);
		exit();
	}
}