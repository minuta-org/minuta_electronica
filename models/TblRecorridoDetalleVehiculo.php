<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_recorrido_detalle_vehiculo".
 *
 * @property integer $id_edv
 * @property integer $id_recorrido_supervisor_fk
 * @property integer $id_marca_vehiculo_fk
 * @property integer $id_tipo_vehiculo_fk
 * @property string $placa_vehiculo
 * @property string $observaciones
 *
 * @property TblMarcasVehiculos $idMarcaVehiculoFk
 * @property TblTiposVehiculos $idTipoVehiculoFk
 * @property TblRecorridosSupervisores $idRecorridoSupervisorFk
 */
class TblRecorridoDetalleVehiculo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_recorrido_detalle_vehiculo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_recorrido_supervisor_fk', 'id_marca_vehiculo_fk', 'id_tipo_vehiculo_fk'], 'required'],
            [['id_recorrido_supervisor_fk', 'id_marca_vehiculo_fk', 'id_tipo_vehiculo_fk'], 'integer'],
            [['observaciones'], 'string'],
            [['placa_vehiculo'], 'string', 'max' => 6],
            [['id_marca_vehiculo_fk'], 'exist', 'skipOnError' => true, 'targetClass' => TblMarcasVehiculos::className(), 'targetAttribute' => ['id_marca_vehiculo_fk' => 'id_marca_vehiculo']],
            [['id_tipo_vehiculo_fk'], 'exist', 'skipOnError' => true, 'targetClass' => TblTiposVehiculos::className(), 'targetAttribute' => ['id_tipo_vehiculo_fk' => 'id_tipo_vehiculo']],
            [['id_recorrido_supervisor_fk'], 'exist', 'skipOnError' => true, 'targetClass' => TblRecorridosSupervisores::className(), 'targetAttribute' => ['id_recorrido_supervisor_fk' => 'id_recorrido']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_edv' => 'Id Edv',
            'id_recorrido_supervisor_fk' => 'Id Recorrido Supervisor Fk',
            'id_marca_vehiculo_fk' => 'Id Marca Vehiculo Fk',
            'id_tipo_vehiculo_fk' => 'Id Tipo Vehiculo Fk',
            'placa_vehiculo' => 'Placa Vehiculo',
            'observaciones' => 'Observaciones',
        ];
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdRecorridoSupervisorFk()
    {
        return $this->hasOne(TblRecorridosSupervisores::className(), ['id_recorrido' => 'id_recorrido_supervisor_fk']);
    }
}
