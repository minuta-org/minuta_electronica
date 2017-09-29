<?php

namespace app\controllers;

use yii\helpers\ArrayHelper;
use Yii;

class AjaxController extends Controller
{

    public function actionBuscarPuestos()
    {
        $cliente = $_POST['cliente'];
        $cuadrante = $_POST['cuadrante'];
        $zona = $_POST['zona'];
        $programacion = $_POST['programacion'];
        $dia = $_POST['dia'];
        $query = \app\models\TblPuestos::find();
	$paginaActual = $_POST['paginaActual'];
	$maximoRegistros = $_POST['maximoRegistros'];
        
        # Consultar programaciones para el mismo día.
        $programacionSupervisor = \app\models\TblProgramacionSupervisores::findOne(['id_programacion_supervisor' => $programacion]);
        $fecha = date_create($programacionSupervisor->fecha_inicio_programacion_supervisor)->format('Y-m');
        $programacionDetalleDia = \app\models\TblDetalleProgSupervisor::find()
                   ->joinWith([
                       'idProgramacionSupervisorFk' => function($query) use ($fecha){
                            $query->andWhere("fecha_inicio_programacion_supervisor LIKE '%{$fecha}%'");
                       },                   
                   ])
                   ->andWhere("dia_dps = '{$dia}'")
		   ->andWhere("id_puesto IS NOT NULL")
                   ->all();
        $idsPuestosProgramadosOtros = array_map(function($detalle){ return $detalle->id_puesto; }, $programacionDetalleDia);
        
        if ($cliente != null) $query->where(['id_cliente_fk' => $cliente]);

        if ($zona == "" && $cuadrante != "") {
            $query->joinWith([
                'idZonaFk' => function ($query) use ($cuadrante) {
                    $query->andWhere(['id_cuadrante_fk' => $cuadrante]);
                }
            ], false);
        }
        if ($zona != null) $query->andWhere(['id_zona_fk' => $zona]);

        $puestosProgramados = \app\models\TblDetalleProgSupervisor::find()
            ->where("id_programacion_supervisor_fk = {$programacion}")
            ->andWhere("dia_dps = {$dia}")
            ->all();
        
        $idPuestosProgramados = array_merge(ArrayHelper::map($puestosProgramados, 'id_dps', 'id_puesto'), $idsPuestosProgramadosOtros);
        
        $query->andWhere(['not in', 'id_puesto', $idPuestosProgramados]);
	$totalPuestos = $query->count();
	$totalPaginas = ceil($totalPuestos / $maximoRegistros);
	$query->limit($maximoRegistros);
	$query->offset(($paginaActual - 1) * $maximoRegistros);
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
        $this->json([
	    'totalPaginas' => $totalPaginas,
	    'totalRegistros' => $totalPuestos,
	    'puestos' => $data
	]);
    }

    /**
     * Esta función permite previsualizar los puestos programados a un supervisor.
     */
    public function actionPrevisualizarDia()
    {
        $dia = $_POST['dia'];
        $idProgramacion = $_POST['id-programacion'];
        $query = \app\models\TblDetalleProgSupervisor::find()
            ->where("id_programacion_supervisor_fk = {$idProgramacion}")
            ->andWhere("dia_dps = {$dia}");
        $detalles = $query->all();
        $puestos = [];
        foreach ($detalles AS $detalle) {
            $puesto = $detalle->idPuesto;
            $puestos[] = [
                'id' => $detalle->id_dps,
                'novedad' => $detalle->novedad,
                'puesto' => $puesto->nombre_puesto,
                'puesto' => $puesto->nombre_puesto,
                'cliente' => $puesto->idClienteFk->nombreCorto,
                'zona' => $puesto->idZonaFk->nombre_zona,
                'cuadrante' => $puesto->idZonaFk->idCuadranteFk->nombre_cuadrante,
                'cambiar' => $detalle->estado == \app\models\TblDetalleProgSupervisor::ESTADO_NO_VISITADO,
                'estadoEtiqueta' => $detalle->etiquetaEstado,
                'reasignado' => $detalle->estado == \app\models\TblDetalleProgSupervisor::ESTADO_REASIGNADO,
            ];
        }
        $this->json(['puestos' => $puestos]);
    }

    /**
     * Esta función permite ver los puestos que tiene programados un supervisor para determinado día.
     */
    public function actionConsultarPuestosProgramadosSupervisor()
    {
	$paginaActual = $_POST['paginaActual'];
	$maximoRegistros = $_POST['maximoRegistros'];	
        $dia = $_POST['dia'];
        $idProgramacion = $_POST['id-programacion'];
        $query = \app\models\TblDetalleProgSupervisor::find()
            ->where("id_programacion_supervisor_fk = {$idProgramacion}")
            ->andWhere("dia_dps = {$dia}");
	    
	$totalPuestos = $query->count();
	$totalPaginas = ceil($totalPuestos / $maximoRegistros);
	$query->limit($maximoRegistros);
	$query->offset(($paginaActual - 1) * $maximoRegistros);
	
        $detalles = $query->all();
        $puestos = [];
        foreach ($detalles AS $detalle) {
            $puesto = $detalle->idPuesto;
            $puestos[] = [
                'id' => $detalle->id_dps,
                'puesto' => $puesto->nombre_puesto,
                'cliente' => $puesto->idClienteFk->nombreCorto,
                'zona' => $puesto->idZonaFk->nombre_zona,
                'cuadrante' => $puesto->idZonaFk->idCuadranteFk->nombre_cuadrante,
            ];
        }
        $this->json([
	    'totalPaginas' => $totalPaginas,
	    'totalRegistros' => $totalPuestos,
	    'puestos' => $puestos
	]);
    }

    /**
     * Esta función permite eliminar los puestos programados a un supervisor.
     */
    public function actionEliminarPuestosProgramadosSupervisor()
    {
        $ids = $_POST['ids'];
        $error = false;
	$idsDps = implode(", ", $ids);
	$resultado = Yii::$app->db->createCommand()->delete("tbl_detalle_prog_supervisor", "id_dps IN ({$idsDps})")->execute();
        $this->json([
            'error' => $resultado == 0,
        ]);
    }

    public function actionGetZonasCuadrante()
    {
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

    public function actionConsultarSupervisoresReasignacion()
    {
        $idProgramacion = $_POST['id-programacion'];
	$dia = $_POST['dia'];
	# Traemos la programación.
        $programacion = \app\models\TblProgramacionSupervisores::findOne(['id_programacion_supervisor' => $idProgramacion]); 
        $fecha = date_create($programacion->fecha_inicio_programacion_supervisor);
        $mesAnio = $fecha->format("Y-m");
	$supervisoresDescanso = \app\models\TblDetalleProgSupervisor::find()
					->where(['<>', 'id_turno_fk', ''])
					->andWhere("dia_dps = {$dia}")
					->all();
	$idsSupervisoresDescanso = array_map(function($obj){ return $obj->idProgramacionSupervisorFk->id_supervisor_fk; }, $supervisoresDescanso);
	
	# Traemos las programaciones cuyo mes sea igual al mes de la programación seleccionada.
        $programacionesMes = \app\models\TblProgramacionSupervisores::find()
                                    ->where("fecha_inicio_programacion_supervisor LIKE '%{$mesAnio}%'")
				    ->andWhere(['not in', 'id_supervisor_fk', $idsSupervisoresDescanso])
                                    ->groupBy('id_supervisor_fk')
                                    ->all();
        $supervisores = [];
        foreach($programacionesMes AS $programacionMes){
            $supervisores[] = [
                'id' => $programacionMes->id_supervisor_fk,
                'nombre' => $programacionMes->idSupervisorFk->nombreCompleto,
            ];
        }
        $this->json(['supervisores' => $supervisores]);
    }
    
    private function validarSigDia($horaInicial, $horaFinal)
    {
	$fechaInicial = strtotime(date("Y-d-m") . " {$horaInicial}");
	$fechaFinal = strtotime(date("Y-d-m") . " {$horaFinal}");	
	return $fechaFinal < $fechaInicial;
    }
    
    public function actionConsultarProgramacionSupervisoresReasignar()
    {
        $idSupervisor = $_POST['id-supervisor'];
        $idProgramacion = $_POST['id-programacion'];
        $dia = $_POST['dia'];
	# Programación sobre la que se está trabajando
        $programacion = \app\models\TblProgramacionSupervisores::findOne(['id_programacion_supervisor' => $idProgramacion]); 
        $fecha = date_create($programacion->fecha_inicio_programacion_supervisor);
        $mesAnio = $fecha->format("Y-m");
	
	# Fecha sobre la cual se está haciendo la reasignación.
	$fechaActual = date_create("{$mesAnio}-{$dia} {$programacion->idHorarioFk->finaliza_horario}");
	
	if($this->validarSigDia($programacion->idHorarioFk->inicio_horario, $programacion->idHorarioFk->finaliza_horario)) {
	    $fecha = date_add($fecha, date_interval_create_from_date_string("1 day"));
	}
	$fechaAComparar = $fecha->format("Y-m-d");
	
        $programacionesMes = \app\models\TblProgramacionSupervisores::find()
                                    ->where("fecha_inicio_programacion_supervisor LIKE '%{$mesAnio}%'")
                                    ->andWhere("id_supervisor_fk = '{$idSupervisor}'")				    
                                    ->all();
        $programaciones = [];
        
        foreach($programacionesMes AS $programacionMes){
            $programaciones[] = [
                'id' => $programacionMes->id_programacion_supervisor,
                'fecha' => $programacionMes->fecha_inicio_programacion_supervisor . " / " . $programacionMes->fecha_fin_programacion_supervisor,
                'tipo' => $programacionMes->idTipoProgramacionFk->nombre_tipo_programacion,
                'horario' => $programacionMes->idHorarioFk->nombreHorario,
            ];
        }
        $this->json(['programaciones' => $programaciones, 'fecha_arranque' => $fechaAComparar]);
    }
    
    public function actionConsultarPuestosProgramacion()
    {
        $idProgramacion = $_POST['id'];
        $idSupervisor = $_POST['id-supervisor'];	
        $fechaArranque = date_create($_POST['fecha-arranque']);
        $dia = $_POST['dia']; #intval($fechaArranque->format("d"));
	$idProgramacionActual = $_POST['id-programacion-actual'];
        
        $programacion = \app\models\TblProgramacionSupervisores::find()
                                ->where("id_programacion_supervisor = '{$idProgramacion}'")
                                ->one();
	$programacionActual = \app\models\TblProgramacionSupervisores::find()
                            ->where("id_programacion_supervisor = '{$idProgramacionActual}'")
                            ->one();
	$horaInicial = strtotime($programacionActual->idHorarioFk->finaliza_horario);
	$horaFinal = strtotime($programacion->idHorarioFk->inicio_horario);
        $restringirDiasAnt = $idSupervisor == $programacion->id_supervisor_fk;
	
	if($this->validarSigDia($programacionActual->idHorarioFk->inicio_horario, $programacionActual->idHorarioFk->finaliza_horario)){
	    $horaInicial = strtotime(date("Y-m-d", strtotime("+1 day")) . " " . $programacion->idHorarioFk->inicio_horario);
	}
	if($this->validarSigDia($programacion->idHorarioFk->inicio_horario, $programacion->idHorarioFk->finaliza_horario)){
	    $horaFinal = strtotime(date("Y-m-d", strtotime("+1 day")) . " " . $programacion->idHorarioFk->inicio_horario);
	}
	
	$horarioMenor = $horaFinal <= $horaInicial;
	
        $ctrlProgramacionSupervisores = new ProgramacionSupervisoresController("prog-supervisores", "none");
        $desde = date_create($programacion->fecha_inicio_programacion_supervisor);
        $hasta = date_create($programacion->fecha_fin_programacion_supervisor);
        
        $dias = $ctrlProgramacionSupervisores->getDiasMes($desde); # Obtenemos el html del encabezado de la tabla ( nombre de días y número de días ).
        $puestosProgramados = $programacion->tblDetalleProgSupervisors; # Obtenemos los detalles de la programación
        $diasProgramados = array_map(function($puestoProg){ return $puestoProg->dia_dps; }, $puestosProgramados); # Convertimos esos detalles a un array
                                                                                                                  # con el fin de iterar más fácil.
        
        $maxDiasMes = intval($desde->format("t")); # Último día del mes.
        $maxDiasProg = intval($hasta->format("d"));
        
        $diasProgramadosHtml = [];
        $celdaBloqueada = \yii\helpers\Html::tag('td', '&nbsp;', ['class' => 'celda-bloqueada']);
        for ($i = 1; $i <= $maxDiasMes; $i ++){
            if(($horarioMenor && $i == $dia) || $i <= $dia && $restringirDiasAnt || $i < $dia && !$restringirDiasAnt){
                $diasProgramadosHtml[] = $celdaBloqueada;
            } else if($i <= $maxDiasProg) {
                $marcar = in_array($i, $diasProgramados);
                $clase = $marcar? 'programado' : '';
                $icono = $marcar? \yii\helpers\Html::tag('i', '', ['class' => 'fa fa-check']) : '';
                $diasProgramadosHtml[] = \yii\helpers\Html::tag('td', $icono, ['class' => $clase . " turno-seleccionado celda-reasignar", 'data-dia' => $i,  'tabindex' => 10000 + $i]);
            } else {
                $diasProgramadosHtml[] = $celdaBloqueada;
            }
        }
        $dias .=  \yii\helpers\Html::tag('tr', implode('', $diasProgramadosHtml));
        $this->json(['html' => $dias]);
    }
    

    public function actionGuardarPuestos()
    {
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
    
    public function actionGuardarReasignacionPuesto()
    {
        $ids = $_POST['ids'];
        $novedad = $_POST['novedad'];
        $idProgramacion = $_POST['idProgramacion'];
        $dia = $_POST['dia'];
        $error = false;
        foreach($ids AS $idDetalleProgramacion){
            $detalleProgramacion = \app\models\TblDetalleProgSupervisor::findOne(['id_dps' => $idDetalleProgramacion]);
            $detalleProgramacion->novedad = $novedad;
            $detalleProgramacion->estado = \app\models\TblDetalleProgSupervisor::ESTADO_REASIGNADO;
            $nuevoDetalle = new \app\models\TblDetalleProgSupervisor();
            $nuevoDetalle->id_puesto = $detalleProgramacion->id_puesto;
            $nuevoDetalle->id_programacion_supervisor_fk = $idProgramacion;
            $nuevoDetalle->dia_dps = $dia;
            if(!$detalleProgramacion->save() || !$nuevoDetalle->save()){
                $error = true;
                break;
            }
        }
        $this->json([
            'error' => $error,
        ]);
    }
    
    public function actionActualizarNovedadProgramacion()
    {
        $idDetalle = $_POST['idDetalle'];
        $novedad = $_POST['novedad'];
        $detalleProgramacion = \app\models\TblDetalleProgSupervisor::findOne(['id_dps' => $idDetalle]);
        $detalleProgramacion->novedad = $novedad;
        $this->json([
            'error' => !$detalleProgramacion->save(),
        ]);
    }
    
    public function actionConsultarProgramacionDiaSupervisor()
    {
	$idProgramacion = $_POST['idProgramacion'];
	$diaProgramado = $_POST['diaProgramado'];
	
	$detallesProgramacion = \app\models\TblDetalleProgSupervisor::find()
					->where(['id_programacion_supervisor_fk' => $idProgramacion])
					->andWhere(['dia_dps' => $diaProgramado])
					->all();
	$programacionDia = [];
	foreach($detallesProgramacion AS $detalle){
	    $programacionDia[] = [
		'codigo_puesto' => $detalle->idPuesto->codigo_puesto,
		'nombre_puesto' => $detalle->idPuesto->nombre_puesto,
		'cliente' => $detalle->idPuesto->idClienteFk->nombreCorto,
		'cuadrante' => $detalle->idPuesto->idZonaFk->idCuadranteFk->nombre_cuadrante,
		'zona' => $detalle->idPuesto->idZonaFk->nombre_zona,
	    ];
	}

	$this->json([
	    'error' => false,
	    'programacion' => $programacionDia,
	]);
    }

}
