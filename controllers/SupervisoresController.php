<?php

namespace app\controllers;

use Yii;
use app\models\TblSupervisores;
use app\models\search\TblSupervisoresSearch;
use yii\web\Controller;
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
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'id' => $model->id_supervisor]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'tiposDocumento' => ArrayHelper::map($tiposDocumento, 'id_tipo_documento', 'nombre'),
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
}
