<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_municipios".
 *
 * @property integer $id_municipio
 * @property string $codigo_municipio
 * @property string $nombre_municipio
 * @property integer $id_departamento_fk
 *
 * @property TblBarrios[] $tblBarrios
 * @property TblDepartamentos $idDepartamentoFk
 */
class TblMunicipios extends \yii\db\ActiveRecord
{
    const ESTADO_ACTIVO = 1;
    const ESTADO_INACTIVO = 0;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_municipios';
    }

    public function beforeSave($insert) {
        if(!parent::beforeSave($insert)){
            return false;
        }
        $this->nombre_municipio = strtoupper($this->nombre_municipio);
        return true;
    }
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['codigo_municipio'], 'unique', 'on' => 'create'],
            [['codigo_municipio', 'nombre_municipio', 'id_departamento_fk'], 'required'],
            [['id_departamento_fk'], 'integer'],
            [['codigo_municipio'], 'string', 'max' => 20 ],
            [['nombre_municipio'], 'string', 'max' => 100],
            [['id_departamento_fk'], 'exist', 'skipOnError' => true, 'targetClass' => TblDepartamentos::className(), 'targetAttribute' => ['id_departamento_fk' => 'id_departamento']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_municipio' => 'ID',
            'codigo_municipio' => 'Codigo',
            'nombre_municipio' => 'Municipio',
            'id_departamento_fk' => 'Departamento',
            'nombreDepartamento' => 'Departamento',
            'etiquetaEstado' => 'Estado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblBarrios()
    {
        return $this->hasMany(TblBarrios::className(), ['id_municipio_fk' => 'id_municipio']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdDepartamentoFk()
    {
        return $this->hasOne(TblDepartamentos::className(), ['id_departamento' => 'id_departamento_fk']);
    }
    
    public function getNombreDepartamento(){
        return $this->idDepartamentoFk->nombre_departamento;
    }
    
    public function getMunicipioMasDepartamento(){
        return  $this->nombre_municipio . " - " . $this->idDepartamentoFk->nombre_departamento;
    }
    
    public function getEtiquetaEstado(){
        if($this->estado == self::ESTADO_ACTIVO){
            return \yii\helpers\Html::tag('span', 'ACTIVO', ['class' => 'label label-success']);
        } else {
            return \yii\helpers\Html::tag('span', 'INACTIVO', ['class' => 'label label-default']);
        }
    }
}