<?php 

namespace app\controllers;

use yii\web\Controller;

class AjaxController extends Controller{
	public function actionGetPuestosCliente()
	{
		$id = $_POST['id'];
		$criterios = ['id_cliente_fk' => $id];
		$puestos = \app\models\TblPuestos::findAll($criterios);
		$opciones = [];
		foreach($puestos AS $puesto){
			$opciones[] = [
				'name' => $puesto->nombre_puesto,
				'value' => $puesto->id_puesto,
			];
		}
		$this->json(['options' => $opciones]);
	}

	private function json($array)
	{
		header("Content-type:application/json");
		echo json_encode($array);
		exit();
	}
}