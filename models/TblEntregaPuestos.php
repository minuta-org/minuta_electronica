<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_entrega_puestos".
 *
 * @property integer $id_entrega_puesto
 * @property integer $id_puesto_fk
 * @property integer $id_recurso_entrega_fk
 * @property integer $id_recurso_recibe_fk
 * @property string $url_firma_entrega
 * @property string $url_firma_recibe
 * @property string $fecha_entrega_puesto
 * @property string $hora_entrega_puesto
 * @property string $observaciones
 * @property double $logitud_mapa_entrega
 * @property double $latitud_mapa_entrega
 *
 * @property TblEntregaDetalleElementos[] $tblEntregaDetalleElementos
 * @property TblEntregaDetalleTareas[] $tblEntregaDetalleTareas
 * @property TblEntregaDetalleVehiculo[] $tblEntregaDetalleVehiculos
 * @property TblPuestos $idPuestoFk
 */
class TblEntregaPuestos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_entrega_puestos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_puesto_fk', 'id_recurso_entrega_fk', 'id_recurso_recibe_fk', 'fecha_entrega_puesto', 'hora_entrega_puesto', 'observaciones'], 'required'],
            [['id_puesto_fk', 'id_recurso_entrega_fk', 'id_recurso_recibe_fk'], 'integer'],
            [['url_firma_entrega', 'url_firma_recibe', 'observaciones'], 'string'],
            [['fecha_entrega_puesto', 'hora_entrega_puesto'], 'safe'],
            [['logitud_mapa_entrega', 'latitud_mapa_entrega'], 'number'],
            [['id_puesto_fk'], 'exist', 'skipOnError' => true, 'targetClass' => TblPuestos::className(), 'targetAttribute' => ['id_puesto_fk' => 'id_puesto']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_entrega_puesto' => 'ID',
            'id_puesto_fk' => 'Puesto',
            'id_recurso_entrega_fk' => 'Recurso',
            'id_recurso_recibe_fk' => 'Recibe',
            'url_firma_entrega' => 'Firma Entrega',
            'url_firma_recibe' => 'Firma Recibe',
            'fecha_entrega_puesto' => 'Fecha Entrega',
            'hora_entrega_puesto' => 'Hora Entrega',
            'observaciones' => 'Observaciones',
            'logitud_mapa_entrega' => 'Logitud',
            'latitud_mapa_entrega' => 'Latitud',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblEntregaDetalleElementos()
    {
        return $this->hasMany(TblEntregaDetalleElementos::className(), ['id_entrega_puesto_fk' => 'id_entrega_puesto']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblEntregaDetalleTareas()
    {
        return $this->hasMany(TblEntregaDetalleTareas::className(), ['id_entrega_puesto' => 'id_entrega_puesto']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblEntregaDetalleVehiculos()
    {
        return $this->hasMany(TblEntregaDetalleVehiculo::className(), ['id_entrega_puesto_fk' => 'id_entrega_puesto']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdPuestoFk()
    {
        return $this->hasOne(TblPuestos::className(), ['id_puesto' => 'id_puesto_fk']);
    }
}
