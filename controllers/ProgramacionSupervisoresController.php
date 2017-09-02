<?php

namespace app\controllers;

use Yii;
use app\models\TblProgramacionSupervisores;
use app\models\search\TblProgramacionSupervisoresSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/**
 * ProgramacionSupervisoresController implements the CRUD actions for TblProgramacionSupervisores model.
 */
class ProgramacionSupervisoresController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all TblProgramacionSupervisores models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TblProgramacionSupervisoresSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $supervisores = \app\models\TblSupervisores::find()->all();
        $horarios = \app\models\TblHorarios::find()->all();
        $tipos = \app\models\TblTiposProgramacion::find()->all();
        
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'supervisores' => ArrayHelper::map($supervisores, "id_supervisor", "nombreCompleto"),
            'horarios' => ArrayHelper::map($horarios, "id_horario", "nombreHorario"),
            'tipos' => ArrayHelper::map($tipos, "id_tipo_programacion", "nombre_tipo_programacion"),
        ]);
    }

    /**
     * Displays a single TblProgramacionSupervisores model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new TblProgramacionSupervisores model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TblProgramacionSupervisores();
        $supervisores = \app\models\TblSupervisores::find()->all();
        $horarios = \app\models\TblHorarios::find()->all();
        $tipos = \app\models\TblTiposProgramacion::find()->all();
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'id' => $model->id_programacion_supervisor]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'supervisores' => ArrayHelper::map($supervisores, "id_supervisor", "nombreCompleto"),
                'horarios' => ArrayHelper::map($horarios, "id_horario", "nombreHorario"),
                'tipos' => ArrayHelper::map($tipos, "id_tipo_programacion", "nombre_tipo_programacion"),
            ]);
        }
    }

    /**
     * Updates an existing TblProgramacionSupervisores model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $supervisores = \app\models\TblSupervisores::find()->all();
        $horarios = \app\models\TblHorarios::find()->all();
        $tipos = \app\models\TblTiposProgramacion::find()->all();
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'id' => $model->id_programacion_supervisor]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'supervisores' => ArrayHelper::map($supervisores, "id_supervisor", "nombreCompleto"),
                'horarios' => ArrayHelper::map($horarios, "id_horario", "nombreHorario"),
                'tipos' => ArrayHelper::map($tipos, "id_tipo_programacion", "nombre_tipo_programacion"),                
            ]);
        }
    }

    /**
     * Deletes an existing TblProgramacionSupervisores model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the TblProgramacionSupervisores model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TblProgramacionSupervisores the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TblProgramacionSupervisores::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function actionProgramar($id)
    {
        $programacion = TblProgramacionSupervisores::findOne($id);
        
        $periodicidad = intval($programacion->idTipoProgramacionFk->intervalo_tipo_programacion);
        $fechaInicio = strtotime($programacion->fecha_inicio_programacion_supervisor);
        $fechaFinal = strtotime($programacion->fecha_fin_programacion_supervisor);        
        $diferencia = (($fechaFinal - $fechaInicio) / 60 / 60 / 24) + 1;
        
        $mes = date_create($programacion->fecha_inicio_programacion_supervisor);
        $diasMes = $this->getDiasMes($mes);
        $totalDiasMes = intval($mes->format('t'));
        $clientes = \app\models\TblClientes::find()->all();
        $cuadrantes = \app\models\TblCuadrantes::find()->all();
        $diasProgramados = $this->getDiasProgramados($programacion->id_programacion_supervisor);
        $diaInicio = intval($mes->format('d'));
        return $this->render('agregar_detalle', [
            'programacion' => $programacion,
            'periodicidad' => $periodicidad,
            'diasAProgramar' => $diferencia,
            'diasMes' => $diasMes,
            'diaInicio' => $diaInicio,
            'totalDiasMes' => $totalDiasMes,
            'clientes' => ArrayHelper::map($clientes, 'id_cliente', 'nombreCorto'),
            'cuadrantes' => ArrayHelper::map($cuadrantes, 'id_cuadrante', 'nombre_cuadrante'),
            'diasProgramacion' => $diasProgramados,
        ]);
    }
	
	private function getDiasProgramados($idProgramacion)
	{
		$detalles = \app\models\TblDetalleProgSupervisor::find()
								->select(['COUNT(*) AS total, dia_dps'])
								->where("id_programacion_supervisor_fk = {$idProgramacion}")
								->groupBy(['dia_dps'])
								->all();
		$dias = [];
		foreach($detalles AS $detalle){
			$dias[$detalle->dia_dps] = $detalle->dia_dps;
		}
		return $dias;
	}
    
    public function getDiasMes($mes)
    {        
        $maxDiasMes = intval($mes->format('t'));
        $diasSemana = ['L', 'M', 'X', 'J', 'V', 'S', 'D'];
        $numerosDias = [];
        $letrasDias = [];
        
        for($i = 1; $i <= $maxDiasMes; $i ++){
            $fechaRecorrida = date_create($mes->format("Y-m-{$i}"));
            $numeroDia = intval($fechaRecorrida->format('N')) - 1;
            $numerosDias[] = Html::tag('th', $i);
            $letrasDias[] = Html::tag('th', $diasSemana[$numeroDia]);
        }
        $encabezadoLetras = Html::tag('tr', implode('', $letrasDias));
        $encabezadoNumeros = Html::tag('tr', implode('', $numerosDias));
        return $encabezadoLetras . $encabezadoNumeros;
    }
}
