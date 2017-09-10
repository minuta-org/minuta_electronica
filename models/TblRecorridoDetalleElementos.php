<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_recorrido_detalle_elementos".
 *
 * @property integer $id_ede
 * @property integer $id_elemento_fk
 * @property integer $id_recorrido_supervisor_fk
 * @property string $observacion
 *
 * @property TblElementosPuesto $idElementoFk
 * @property TblRecorridosSupervisores $idRecorridoSupervisorFk
 */
class TblRecorridoDetalleElementos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_recorrido_detalle_elementos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_elemento_fk', 'id_recorrido_supervisor_fk'], 'required'],
            [['id_elemento_fk', 'id_recorrido_supervisor_fk'], 'integer'],
            [['observacion'], 'string'],
            [['id_elemento_fk'], 'exist', 'skipOnError' => true, 'targetClass' => TblElementosPuesto::className(), 'targetAttribute' => ['id_elemento_fk' => 'id_elemento_puesto']],
            [['id_recorrido_supervisor_fk'], 'exist', 'skipOnError' => true, 'targetClass' => TblRecorridosSupervisores::className(), 'targetAttribute' => ['id_recorrido_supervisor_fk' => 'id_recorrido']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_ede' => 'Id Ede',
            'id_elemento_fk' => 'Id Elemento Fk',
            'id_recorrido_supervisor_fk' => 'Id Recorrido Supervisor Fk',
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
    public function getIdRecorridoSupervisorFk()
    {
        return $this->hasOne(TblRecorridosSupervisores::className(), ['id_recorrido' => 'id_recorrido_supervisor_fk']);
    }
}
