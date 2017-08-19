<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_marcas_vehiculos".
 *
 * @property integer $id_marca_vehiculo
 * @property string $nombre
 *
 * @property TblEntregaDetalleVehiculo[] $tblEntregaDetalleVehiculos
 */
class TblMarcasVehiculos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_marcas_vehiculos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre'], 'required'],
            [['nombre'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_marca_vehiculo' => 'ID',
            'nombre' => 'Nombre',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblEntregaDetalleVehiculos()
    {
        return $this->hasMany(TblEntregaDetalleVehiculo::className(), ['id_marca_vehiculo_fk' => 'id_marca_vehiculo']);
    }
}
