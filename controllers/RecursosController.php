<?php

namespace app\controllers;

use Yii;
use app\models\TblRecursos;
use app\models\search\TblRecursosSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

/**
 * RecursosController implements the CRUD actions for TblRecursos model.
 */
class RecursosController extends Controller
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
     * Lists all TblRecursos models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TblRecursosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $municipios = \app\models\TblMunicipios::find()->all();
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'municipios' => ArrayHelper::map($municipios, 'id_municipio', 'municipioMasDepartamento'),
        ]);
    }

    /**
     * Displays a single TblRecursos model.
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
     * Creates a new TblRecursos model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TblRecursos();
        $tiposDocumento = \app\models\TblTiposDocumentos::find()->all();
        $departamentos = \app\models\TblDepartamentos::find()->all();
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'id' => $model->id_recurso]);
        } else {
            return $this->render('create', [
                'tiposDocumento' => ArrayHelper::map($tiposDocumento, 'id_tipo_documento', 'nombre'),
                'estados' => [
                    TblRecursos::ESTADO_ACTIVO => 'ACTIVO',
                    TblRecursos::ESTADO_INACTIVO => 'INACTIVO',
                ],
                'model' => $model,
                'departamentos' => ArrayHelper::map($departamentos, 'id_departamento', 'nombre_departamento'),
            ]);
        }
    }

    /**
     * Updates an existing TblRecursos model.
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
            return $this->redirect(['index', 'id' => $model->id_recurso]);
        } else {
            return $this->render('update', [
                'tiposDocumento' => ArrayHelper::map($tiposDocumento, 'id_tipo_documento', 'nombre'),
                'model' => $model,
                'estados' => [
                    TblRecursos::ESTADO_ACTIVO => 'ACTIVO',
                    TblRecursos::ESTADO_INACTIVO => 'INACTIVO',
                ],
                'departamentos' => ArrayHelper::map($departamentos, 'id_departamento', 'nombre_departamento'),
                'municipios' => ArrayHelper::map($municipios, 'id_municipio', 'nombre_municipio'),
                'barrios' => ArrayHelper::map($barrios, 'id_barrio', 'nombre_barrio'),
                'departamentoId' => $departamentoId,
                'municipioId' => $municipioId,
            ]);
        }
    }

    /**
     * Deletes an existing TblRecursos model.
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
     * Finds the TblRecursos model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TblRecursos the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TblRecursos::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
