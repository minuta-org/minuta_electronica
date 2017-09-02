<?php

namespace app\controllers;

use yii\web\Controller;
use yii\helpers\ArrayHelper;

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
                'puesto' => $puesto->nombre_puesto,
                'cliente' => $puesto->idClienteFk->nombreCorto,
                'zona' => $puesto->idZonaFk->nombre_zona,
                'cuadrante' => $puesto->idZonaFk->idCuadranteFk->nombre_cuadrante,
                'cambiar' => $detalle->estado == \app\models\TblDetalleProgSupervisor::ESTADO_NO_VISITADO,
                'estadoEtiqueta' => $detalle->etiquetaEstado,
            ];
        }
        $this->json(['puestos' => $puestos]);
    }

    /**
     * Esta función permite ver los puestos que tiene programados un supervisor para determinado día.
     */
    public function actionConsultarPuestosProgramadosSupervisor()
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
                'puesto' => $puesto->nombre_puesto,
                'cliente' => $puesto->idClienteFk->nombreCorto,
                'zona' => $puesto->idZonaFk->nombre_zona,
                'cuadrante' => $puesto->idZonaFk->idCuadranteFk->nombre_cuadrante,
            ];
        }
        $this->json(['puestos' => $puestos]);
    }

    /**
     * Esta función permite eliminar los puestos programados a un supervisor.
     */
    public function actionEliminarPuestosProgramadosSupervisor()
    {
        $ids = $_POST['ids'];
        $error = false;
        foreach ($ids AS $idDetalle) {
            if (!\app\models\TblDetalleProgSupervisor::findOne(['id_dps' => $idDetalle])->delete()) {
                $error = true;
                break;
            }
        }
        $this->json([
            'error' => $error,
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
        $programacion = \app\models\TblProgramacionSupervisores::findOne(['id_programacion_supervisor' => $idProgramacion]); 
        $fecha = date_create($programacion->fecha_inicio_programacion_supervisor);
        $mesAnio = $fecha->format("Y-m");
        $programacionesMes = \app\models\TblProgramacionSupervisores::find()
                                    ->where("fecha_inicio_programacion_supervisor LIKE '%{$mesAnio}%'")
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
    
    public function actionConsultarProgramacionSupervisoresReasignar()
    {
        $idSupervisor = $_POST['id-supervisor'];
        $idProgramacion = $_POST['id-programacion'];
        $programacion = \app\models\TblProgramacionSupervisores::findOne(['id_programacion_supervisor' => $idProgramacion]); 
        $fecha = date_create($programacion->fecha_inicio_programacion_supervisor);
        $mesAnio = $fecha->format("Y-m");
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
                'horario' => $programacionMes->idHorarioFk->nombre_horario,
            ];
        }
        $this->json(['programaciones' => $programaciones]);
    }
    
    public function actionConsultarPuestosProgramacion()
    {
        $idProgramacion = $_POST['id'];
        $programacion = \app\models\TblProgramacionSupervisores::find()
                                ->where("id_programacion_supervisor = '{$idProgramacion}'")
                                ->one();
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
        for ($i = 1; $i <= $maxDiasMes; $i ++){
            if($i <= $maxDiasProg) {
                $marcar = in_array($i, $diasProgramados);
                $clase = $marcar? 'programado' : '';
                $icono = $marcar? \yii\helpers\Html::tag('i', '', ['class' => 'fa fa-check']) : '';
                $diasProgramadosHtml[] = \yii\helpers\Html::tag('td', $icono, ['class' => $clase . " turno-seleccionado celda-reasignar", 'data-dia' => $i,  'tabindex' => 10000 + $i]);
            } else {
                $diasProgramadosHtml[] = \yii\helpers\Html::tag('td', '&nbsp;', ['class' => 'celda-bloqueada']);
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

    private function json($array)
    {
        header("Content-type:application/json");
        echo json_encode($array);
        exit();
    }

}
