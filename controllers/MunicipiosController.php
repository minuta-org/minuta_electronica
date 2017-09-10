<?php

namespace app\controllers;

use Yii;
use app\models\TblMunicipios;
use app\models\search\TblMunicipiosSearch;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

/**
 * MunicipiosController implements the CRUD actions for TblMunicipios model.
 */
class MunicipiosController extends Controller
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
     * Lists all TblMunicipios models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TblMunicipiosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination->pageSize = 40;
        $departamentos = \app\models\TblDepartamentos::find()->all();
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'departamentos' => ArrayHelper::map($departamentos, "id_departamento", "nombre_departamento"),
        ]);
    }

    /**
     * Displays a single TblMunicipios model.
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
     * Creates a new TblMunicipios model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TblMunicipios();
        $departamentos = \app\models\TblDepartamentos::find()->all();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'id' => $model->id_municipio]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'departamentos' => ArrayHelper::map($departamentos, "id_departamento", "nombre_departamento"),
            ]);
        }
    }

    /**
     * Updates an existing TblMunicipios model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if($model->estado == \app\models\TblMunicipios::ESTADO_INACTIVO){
            # Alerta
            return $this->redirect(['index']);
        } 
        $departamentos = \app\models\TblDepartamentos::find()->all();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'id' => $model->id_municipio]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'departamentos' => ArrayHelper::map($departamentos, "id_departamento", "nombre_departamento"),
            ]);
        }
    }

    /**
     * Deletes an existing TblMunicipios model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {   
        # Obtenemos el modelo.
        $model = $this->findModel($id);        
        $barrios = $model->tblBarrios;
        if(count($barrios) > 0){
            # alerta
        } else {
            $model->delete();
        }
        return $this->redirect(['index']);
    }
    
    public function actionState($id){
        $model = $this->findModel($id);
        $model->estado = !$model->estado;
        $model->save();
        return $this->redirect(['index']);
    }

    /**
     * Finds the TblMunicipios model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TblMunicipios the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TblMunicipios::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
