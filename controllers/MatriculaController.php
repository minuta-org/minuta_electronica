<?php

namespace app\controllers;

use Yii;
use app\models\TblMatricula;
use app\models\search\TblMatriculaSearch;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

/**
 * MatriculaController implements the CRUD actions for TblMatricula model.
 */
class MatriculaController extends Controller
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
     * Lists all TblMatricula models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TblMatriculaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TblMatricula model.
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
     * Creates a new TblMatricula model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TblMatricula();
        $departamentos = \app\models\TblDepartamentos::find()->all();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'id' => $model->id_matricula]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'departamentos' => ArrayHelper::map($barrios, 'id_departamento', 'nombre_departamento'),
            ]);
        }
    }

    /**
     * Updates an existing TblMatricula model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $departamentos = \app\models\TblDepartamentos::find()->all();
        $barrios = \app\models\TblBarrios::findAll(['id_municipio_fk' => $model->idBarrioFk->id_municipio_fk]);
        $municipios = \app\models\TblMunicipios::findAll(['id_departamento_fk' => $model->idBarrioFk->idMunicipioFk->id_departamento_fk]);        
        
        $municipioId = $model->idBarrioFk->id_municipio_fk;
        $departamentoId = $model->idBarrioFk->idMunicipioFk->id_departamento_fk;
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'id' => $model->id_matricula]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'departamentos' => ArrayHelper::map($departamentos, 'id_departamento', 'nombre_departamento'),
                'municipios' => ArrayHelper::map($municipios, 'id_municipio', 'nombre_municipio'),
                'barrios' => ArrayHelper::map($barrios, 'id_barrio', 'nombre_barrio'),
                'departamentoId' => $departamentoId,
                'municipioId' => $municipioId,
            ]);
        }
    }

    /**
     * Deletes an existing TblMatricula model.
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
     * Finds the TblMatricula model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TblMatricula the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TblMatricula::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
