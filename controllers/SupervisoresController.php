<?php

namespace app\controllers;

use Yii;
use app\models\TblSupervisores;
use app\models\search\TblSupervisoresSearch;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

/**
 * SupervisoresController implements the CRUD actions for TblSupervisores model.
 */
class SupervisoresController extends Controller
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
    
    public function actionConsultarProgramacion()
    {
	$request = Yii::$app->request;
	$limite = 15;
	$pagina = $request->get('p') == ""? 1 : $request->get('p');
        $diaActual = intval(date("d"));
        $idUsuario = Yii::$app->user->getIdentity()->id_usuario;
	$mesActual = date("Y-m");
        $supervisor = TblSupervisores::findOne(['id_usuario_fk' => $idUsuario]);
        $query = \app\models\TblDetalleProgSupervisor::find()
                                ->joinWith([
                                    'idProgramacionSupervisorFk' => function($query) use($supervisor, $mesActual){
                                        
                                        $query->andWhere("fecha_inicio_programacion_supervisor LIKE '%{$mesActual}%'")
                                              ->andWhere("id_supervisor_fk = {$supervisor->id_supervisor}");
                                    },
                                ])
                                ->joinWith([
                                    'idPuesto' => function($query){
                                        $query->orderBy(['tbl_puestos.id_cliente_fk' => SORT_ASC]);
                                    }
                                ])
                                ->andWhere("dia_dps = {$diaActual}")
                                ->orderBy(new \yii\db\Expression('tbl_detalle_prog_supervisor.estado = 1 ASC'));
	$programacionMes = \app\models\TblProgramacionSupervisores::find()
					->where("fecha_inicio_programacion_supervisor LIKE '%{$mesActual}%'")
					->andWhere("id_supervisor_fk = {$supervisor->id_supervisor}")
					->one();
	$ultimoDia = intval(date("t"));
	$dias = $this->getDiasProgramados($programacionMes, date_create("{$mesActual}-01"));	
	$total = $query->count();
	$programacionDia = $query->limit($limite)
				->offset(($pagina - 1) * $limite)
				->all();
	$totalPaginas = ceil($total / $limite);		
        return $this->render('consultar-programacion', [
            'programacionDia' => $programacionDia,
	    'programacionMes' => $programacionMes,
	    'totalPaginas' => $totalPaginas,
	    'pagina' => $pagina,
	    'diasProgramados' => $dias['diasProgramados'],
	    'ultimoDia' => $ultimoDia,
	    'diaActual' => $diaActual,
	    'diasMes' => $dias['diasEncabezados']
        ]);
    }
   
    /**
     * 
     * @param \app\models\TblProgramacionSupervisores $programacion
     */
    private function getDiasProgramados($programacion, $mes)
    {
	$objProgramacion = new ProgramacionSupervisoresController("p", "p");
	return [
	    'diasProgramados' => $objProgramacion->getDiasProgramados($programacion->id_programacion_supervisor),
	    'diasEncabezados' => $objProgramacion->getDiasMes($mes)
	];
    }

    /**
     * Lists all TblSupervisores models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TblSupervisoresSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination->pageSize = 30;
        
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TblSupervisores model.
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
     * Creates a new TblSupervisores model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TblSupervisores();
        $tiposDocumento = \app\models\TblTiposDocumentos::find()->all();
        $departamentos = \app\models\TblDepartamentos::find()->all();
        $model->id_matricula_fk = 1;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'id' => $model->id_supervisor]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'tiposDocumento' => ArrayHelper::map($tiposDocumento, 'id_tipo_documento', 'nombre'),
                'departamentos' => ArrayHelper::map($departamentos, 'id_departamento', 'nombre_departamento'),
            ]);
        }
    }
    
    public function actionAjax(){
        $post = Yii::$app->request->post();
        if(count($post) == 0 || !isset($post['ajx_rqst'])){
            return $this->redirect(['index', 'id' => $model->id_supervisor]);
        }
        
        $opciones = [];        
        
        if($post['type'] == 'mun'){
            $municipios = \app\models\TblMunicipios::findAll(['id_departamento_fk' => $post['id']]);
            $opciones[] = \yii\helpers\Html::tag('option', 'Seleccione un municipio', ['value' => null]);
            foreach($municipios AS $barrio){
                $opciones[] = \yii\helpers\Html::tag('option', $barrio->nombre_municipio, ['value' => $barrio->id_municipio]);
            }
        } else if($post['type'] == 'bar'){
            $barrios = \app\models\TblBarrios::findAll(['id_municipio_fk' => $post['id']]);
            $opciones[] = \yii\helpers\Html::tag('option', 'Seleccione un barrio', ['value' => null]);
            foreach($barrios AS $barrio){
                $opciones[] = \yii\helpers\Html::tag('option', $barrio->nombre_barrio, ['value' => $barrio->id_barrio]);
            }
        }
        
        header("Content-type:application/json");
        echo json_encode([
            'html' => implode('', $opciones)
        ]);
        exit();
    }

    /**
     * Updates an existing TblSupervisores model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $tiposDocumento = \app\models\TblTiposDocumentos::find()->all();
        
        $departamentos = \app\models\TblDepartamentos::find()->all();
        $barrios = \app\models\TblBarrios::findAll(['id_municipio_fk' => $model->idBarrioFk->id_municipio_fk]);
        $municipios = \app\models\TblMunicipios::findAll(['id_departamento_fk' => $model->idBarrioFk->idMunicipioFk->id_departamento_fk]);        
        
        $municipioId = $model->idBarrioFk->id_municipio_fk;
        $departamentoId = $model->idBarrioFk->idMunicipioFk->id_departamento_fk;
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'id' => $model->id_supervisor]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'tiposDocumento' => ArrayHelper::map($tiposDocumento, 'id_tipo_documento', 'nombre'),
                'departamentos' => ArrayHelper::map($departamentos, 'id_departamento', 'nombre_departamento'),
                'municipios' => ArrayHelper::map($municipios, 'id_municipio', 'nombre_municipio'),
                'barrios' => ArrayHelper::map($barrios, 'id_barrio', 'nombre_barrio'),
                'departamentoId' => $departamentoId,
                'municipioId' => $municipioId,
            ]);
        }
    }

    /**
     * Deletes an existing TblSupervisores model.
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
     * Finds the TblSupervisores model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TblSupervisores the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TblSupervisores::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function actionGuardarRecorrido()
    {
        $idPuesto = $_POST['id_puesto'];
        $idProgramacion = $_POST['id_programacion'];
        $observacion = $_POST['observacion'];
        $latitud = $_POST['latitud'];
        $longitud = $_POST['longitud'];        
        $idDetalle = $_POST['detalle'];
        $recorrido = new \app\models\TblRecorridosSupervisores();
        $recorrido->id_puesto_fk = $idPuesto;
        $recorrido->id_programacion_fk = $idProgramacion;
        $recorrido->observacion_recorrido_supervisor = $observacion;
        $recorrido->latitud_recorrido_supervisor = $latitud;
        $recorrido->longitud_recorrido_supervisor = $longitud;
        $recorrido->hora_recorrido_supervisor = date("H:i:s");
        $recorrido->fecha_recorrido_supervisor = date("Y-m-d");
        $error = false;
        if($recorrido->save()){
            $detalleProgramacion = \app\models\TblDetalleProgSupervisor::findOne(['id_dps' => $idDetalle]);
            $detalleProgramacion->estado = \app\models\TblDetalleProgSupervisor::ESTADO_VISITADO;
            $detalleProgramacion->save();
        } else {
            $error = true;
        }
        
        $this->json([
            'error' => $error,
        ]);
    }
}
