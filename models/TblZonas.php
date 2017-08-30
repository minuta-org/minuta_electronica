<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_zonas".
 *
 * @property integer $id_zona
 * @property string $nombre_zona
 *
 * @property TblPuestos[] $tblPuestos
 */
class TblZonas extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_zonas';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre_zona'], 'required'],
            [['nombre_zona'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_zona' => 'ID',
            'nombre_zona' => 'Nombre',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblPuestos()
    {
        return $this->hasMany(TblPuestos::className(), ['id_zona_fk' => 'id_zona']);
    }
	
	/**
     * @return \yii\db\ActiveQuery
     */
    public function getIdCuadranteFk()
    {
        return $this->hasOne(TblCuadrantes::className(), ['id_cuadrante' => 'id_cuadrante_fk']);
    }
}
