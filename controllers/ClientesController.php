<?php

namespace app\controllers;

use app\models\TblMunicipios;
use app\models\TblTiposDocumentos;
use Yii;
use app\models\TblClientes;
use app\models\TblOpciones;
use app\models\search\TblClientesSearch;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ClientesController implements the CRUD actions for TblClientes model.
 */
class ClientesController extends Controller
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
     * Lists all TblClientes models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TblClientesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TblClientes model.
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
     * Creates a new TblClientes model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TblClientes();
        $tiposDocumento = TblTiposDocumentos::find()->all();
        $municipios = TblMunicipios::find()->all();
	$sectoresComerciales = \app\models\TblSectoresComerciales::find()->all();
	$sectoresEconomicos = \app\models\TblSectoresEconomicos::find()->all();
	
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'id' => $model->id_cliente]);
        } else {
            return $this->render('create', [
		'dimensiones' => TblOpciones::getOpciones("dimension", true),
		'origenesJudiciales' => TblOpciones::getOpciones("origen_judicial", true),
		'coberturas' => TblOpciones::getOpciones("cobertura", true),
		'origenesCapitales' => TblOpciones::getOpciones("origen_capital", true),
		'sectoresEconomicos' => ArrayHelper::map($sectoresEconomicos, "id_sector_economico", "nombre_sector_economico"),
		'sectoresComerciales' => ArrayHelper::map($sectoresComerciales, "id_sector_comercial", "nombre_sector_comercial"),
                'model' => $model,
                'tiposDocumentos' => ArrayHelper::map($tiposDocumento, "id_tipo_documento", "nombre"),
                'municipios' => ArrayHelper::map($municipios, "id_municipio", "municipioMasDepartamento"),
            ]);
        }
    }

    /**
     * Updates an existing TblClientes model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
	$tiposDocumento = TblTiposDocumentos::find()->all();
        $municipios = TblMunicipios::find()->all();
	$sectoresComerciales = \app\models\TblSectoresComerciales::find()->all();
	$sectoresEconomicos = \app\models\TblSectoresEconomicos::find()->all();
	
	$barrioSeleccionado = \app\models\TblBarrios::find()->where("id_barrio = '{$model->id_barrio_fk}'")->one();
	$municipioSeleccioando = $barrioSeleccionado->idMunicipioFk;
	$barrios = $municipioSeleccioando->tblBarrios;
	
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'id' => $model->id_cliente]);
        } else {
            return $this->render('update', [
		'municipioSeleccionado' => $municipioSeleccioando->id_municipio,
		'barrios' => ArrayHelper::map($barrios, "id_barrio", "nombre_barrio"),
		'dimensiones' => TblOpciones::getOpciones("dimension", true),
		'origenesJudiciales' => TblOpciones::getOpciones("origen_judicial", true),
		'coberturas' => TblOpciones::getOpciones("cobertura", true),
		'origenesCapitales' => TblOpciones::getOpciones("origen_capital", true),
		'sectoresEconomicos' => ArrayHelper::map($sectoresEconomicos, "id_sector_economico", "nombre_sector_economico"),
		'sectoresComerciales' => ArrayHelper::map($sectoresComerciales, "id_sector_comercial", "nombre_sector_comercial"),
                'model' => $model,
		'tiposDocumentos' => ArrayHelper::map($tiposDocumento, "id_tipo_documento", "nombre"),
                'municipios' => ArrayHelper::map($municipios, "id_municipio", "municipioMasDepartamento"),
            ]);
        }
    }

    /**
     * Deletes an existing TblClientes model.
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
     * Finds the TblClientes model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TblClientes the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TblClientes::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
