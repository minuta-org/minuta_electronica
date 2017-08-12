<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_barrios".
 *
 * @property integer $id_barrio
 * @property string $nombre_barrio
 * @property integer $id_municipio_fk
 * @property string $codigo_barrio
 *
 * @property TblMunicipios $idMunicipioFk
 * @property TblClientes[] $tblClientes
 * @property TblMatricula[] $tblMatriculas
 * @property TblSupervisores[] $tblSupervisores
 */
class TblBarrios extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_barrios';
    }
    
    public function beforeSave($insert) {
        if(!parent::beforeSave($insert)){
            return false;
        }
        $this->nombre_barrio = strtoupper($this->nombre_barrio);
        return true;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre_barrio', 'id_municipio_fk', 'codigo_barrio'], 'required'],
            [['codigo_barrio'], 'unique', 'on' => 'create'],
            [['id_municipio_fk'], 'integer'],
            [['nombre_barrio'], 'string', 'max' => 100],
            [['codigo_barrio'], 'string', 'max' => 20],
            [['id_municipio_fk'], 'exist', 'skipOnError' => true, 'targetClass' => TblMunicipios::className(), 'targetAttribute' => ['id_municipio_fk' => 'id_municipio']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_barrio' => 'Id',
            'nombre_barrio' => 'Nombre',
            'id_municipio_fk' => 'Municipio',
            'codigo_barrio' => 'Codigo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdMunicipioFk()
    {
        return $this->hasOne(TblMunicipios::className(), ['id_municipio' => 'id_municipio_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblClientes()
    {
        return $this->hasMany(TblClientes::className(), ['id_barrio_fk' => 'id_barrio']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblMatriculas()
    {
        return $this->hasMany(TblMatricula::className(), ['id_barrio_fk' => 'id_barrio']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblSupervisores()
    {
        return $this->hasMany(TblSupervisores::className(), ['id_barrio_fk' => 'id_barrio']);
    }
    
    public function getNombreMunicipio(){
        return $this->idMunicipioFk->nombre_municipio;
    }
    
    public function getBarrioMunicipio(){
        return $this->nombre_barrio . " - " . $this->idMunicipioFk->nombre_municipio;
    }
    
}