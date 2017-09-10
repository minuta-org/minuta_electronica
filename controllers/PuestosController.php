<?php

namespace app\controllers;

use Yii;
use app\models\TblPuestos;
use app\models\search\TblPuestosSearch;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

/**
 * PuestosController implements the CRUD actions for TblPuestos model.
 */
class PuestosController extends Controller
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
     * Lists all TblPuestos models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TblPuestosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $clientes = \app\models\TblClientes::find()->all();
        $zonas = \app\models\TblZonas::find()->all();
        $municipios = \app\models\TblMunicipios::find()->all();
        
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'clientes' => ArrayHelper::map($clientes, 'id_cliente', 'nombreCorto'),
            'zonas' => ArrayHelper::map($clientes, 'id_cliente', 'nombreCorto'),
            'municipios' => ArrayHelper::map($municipios, 'id_municipio', 'municipioMasDepartamento'),
        ]);
    }

    /**
     * Displays a single TblPuestos model.
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
     * Creates a new TblPuestos model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TblPuestos();
        $clientes = \app\models\TblClientes::find()->all();
        $zonas = \app\models\TblZonas::find()->all();
        $departamentos = \app\models\TblDepartamentos::find()->all();
                
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'id' => $model->id_puesto]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'clientes' => ArrayHelper::map($clientes, 'id_cliente', 'nombreCorto'),
                'zonas' => ArrayHelper::map($zonas, 'id_zona', 'nombre_zona'),
                'departamentos' => ArrayHelper::map($departamentos, 'id_departamento', 'nombre_departamento'),
            ]);
        }
    }

    /**
     * Updates an existing TblPuestos model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $clientes = \app\models\TblClientes::find()->all();
        $zonas = \app\models\TblZonas::find()->all();
        $departamentos = \app\models\TblDepartamentos::find()->all();
        $barrios = \app\models\TblBarrios::findAll(['id_municipio_fk' => $model->idBarrioFk->id_municipio_fk]);
        $municipios = \app\models\TblMunicipios::findAll(['id_departamento_fk' => $model->idBarrioFk->idMunicipioFk->id_departamento_fk]);                
        $municipioId = $model->idBarrioFk->id_municipio_fk;
        $departamentoId = $model->idBarrioFk->idMunicipioFk->id_departamento_fk;
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'id' => $model->id_puesto]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'clientes' => ArrayHelper::map($clientes, 'id_cliente', 'nombreCorto'),
                'zonas' => ArrayHelper::map($zonas, 'id_zona', 'nombre_zona'),
                'departamentos' => ArrayHelper::map($departamentos, 'id_departamento', 'nombre_departamento'),
                'municipios' => ArrayHelper::map($municipios, 'id_municipio', 'nombre_municipio'),
                'barrios' => ArrayHelper::map($barrios, 'id_barrio', 'nombre_barrio'),
                'departamentoId' => $departamentoId,
                'municipioId' => $municipioId,                
            ]);
        }
    }

    /**
     * Deletes an existing TblPuestos model.
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
     * Finds the TblPuestos model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TblPuestos the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TblPuestos::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
