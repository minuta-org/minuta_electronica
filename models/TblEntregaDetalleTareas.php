<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_entrega_detalle_vehiculo".
 *
 * @property integer $id_edv
 * @property integer $id_entrega_puesto_fk
 * @property integer $id_marca_vehiculo_fk
 * @property integer $id_tipo_vehiculo_fk
 * @property string $placa_vehiculo
 * @property string $observaciones
 *
 * @property TblEntregaPuestos $idEntregaPuestoFk
 * @property TblMarcasVehiculos $idMarcaVehiculoFk
 * @property TblTiposVehiculos $idTipoVehiculoFk
 */
class TblEntregaDetalleTareas extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_entrega_detalle_vehiculo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_entrega_puesto_fk', 'id_marca_vehiculo_fk', 'id_tipo_vehiculo_fk'], 'required'],
            [['id_entrega_puesto_fk', 'id_marca_vehiculo_fk', 'id_tipo_vehiculo_fk'], 'integer'],
            [['observaciones'], 'string'],
            [['placa_vehiculo'], 'string', 'max' => 6],
            [['id_entrega_puesto_fk'], 'exist', 'skipOnError' => true, 'targetClass' => TblEntregaPuestos::className(), 'targetAttribute' => ['id_entrega_puesto_fk' => 'id_entrega_puesto']],
            [['id_marca_vehiculo_fk'], 'exist', 'skipOnError' => true, 'targetClass' => TblMarcasVehiculos::className(), 'targetAttribute' => ['id_marca_vehiculo_fk' => 'id_marca_vehiculo']],
            [['id_tipo_vehiculo_fk'], 'exist', 'skipOnError' => true, 'targetClass' => TblTiposVehiculos::className(), 'targetAttribute' => ['id_tipo_vehiculo_fk' => 'id_tipo_vehiculo']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_edv' => 'ID',
            'id_entrega_puesto_fk' => 'Entrega',
            'id_marca_vehiculo_fk' => 'Marca',
            'id_tipo_vehiculo_fk' => 'Tipo Vehiculo',
            'placa_vehiculo' => 'Placa',
            'observaciones' => 'Observaciones',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdEntregaPuestoFk()
    {
        return $this->hasOne(TblEntregaPuestos::className(), ['id_entrega_puesto' => 'id_entrega_puesto_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdMarcaVehiculoFk()
    {
        return $this->hasOne(TblMarcasVehiculos::className(), ['id_marca_vehiculo' => 'id_marca_vehiculo_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdTipoVehiculoFk()
    {
        return $this->hasOne(TblTiposVehiculos::className(), ['id_tipo_vehiculo' => 'id_tipo_vehiculo_fk']);
    }
}
