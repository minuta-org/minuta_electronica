<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_entrega_detalle_elementos".
 *
 * @property integer $id_ede
 * @property integer $id_elemento_fk
 * @property integer $id_entrega_puesto_fk
 * @property string $observacion
 *
 * @property TblElementosPuesto $idElementoFk
 * @property TblEntregaPuestos $idEntregaPuestoFk
 */
class TblEntregaDetalleElementos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_entrega_detalle_elementos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_elemento_fk', 'id_entrega_puesto_fk'], 'required'],
            [['id_elemento_fk', 'id_entrega_puesto_fk'], 'integer'],
            [['observacion'], 'string'],
            [['id_elemento_fk'], 'exist', 'skipOnError' => true, 'targetClass' => TblElementosPuesto::className(), 'targetAttribute' => ['id_elemento_fk' => 'id_elemento_puesto']],
            [['id_entrega_puesto_fk'], 'exist', 'skipOnError' => true, 'targetClass' => TblEntregaPuestos::className(), 'targetAttribute' => ['id_entrega_puesto_fk' => 'id_entrega_puesto']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_ede' => 'Id',
            'id_elemento_fk' => 'Id Elemento',
            'id_entrega_puesto_fk' => 'Entrega',
            'observacion' => 'Observacion',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdElementoFk()
    {
        return $this->hasOne(TblElementosPuesto::className(), ['id_elemento_puesto' => 'id_elemento_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdEntregaPuestoFk()
    {
        return $this->hasOne(TblEntregaPuestos::className(), ['id_entrega_puesto' => 'id_entrega_puesto_fk']);
    }
}
