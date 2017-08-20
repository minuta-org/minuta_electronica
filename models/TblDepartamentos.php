<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_departamentos".
 *
 * @property integer $id_departamento
 * @property string $codigo_departamento
 * @property string $nombre_departamento
 *
 * @property TblMunicipios[] $tblMunicipios
 */
class TblDepartamentos extends \yii\db\ActiveRecord
{
    
    const ESTADO_ACTIVO = 1;
    const ESTADO_INACTIVO = 0;
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_departamentos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['codigo_departamento'], 'unique', 'on' => 'create'],
            [['codigo_departamento', 'nombre_departamento'], 'required'],
            [['codigo_departamento'], 'string', 'max' => 20],
            [['nombre_departamento'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_departamento' => 'Id Departamento',
            'codigo_departamento' => 'Codigo Departamento',
            'nombre_departamento' => 'Nombre Departamento',
            'etiquetaEstado' => 'Estado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblMunicipios()
    {
        return $this->hasMany(TblMunicipios::className(), ['id_departamento_fk' => 'id_departamento']);
    }
    
    public function getEtiquetaEstado()
    {
        if($this->estado == self::ESTADO_ACTIVO){
            return \yii\helpers\Html::tag('span', 'ACTIVO', ['class' => 'label label-success']);
        } else {
            return \yii\helpers\Html::tag('span', 'INACTIVO', ['class' => 'label label-default']);
        }
    }
}
