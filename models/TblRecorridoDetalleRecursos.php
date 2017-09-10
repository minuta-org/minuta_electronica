<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_recorrido_detalle_recursos".
 *
 * @property integer $id_rdr
 * @property integer $id_recorrido_supervisor_fk
 * @property integer $id_recurso_fk
 * @property string $observaciones
 *
 * @property TblRecorridosSupervisores $idRecorridoSupervisorFk
 * @property TblRecorridosSupervisores $idRecursoFk
 */
class TblRecorridoDetalleRecursos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_recorrido_detalle_recursos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_recorrido_supervisor_fk', 'id_recurso_fk'], 'required'],
            [['id_recorrido_supervisor_fk', 'id_recurso_fk'], 'integer'],
            [['observaciones'], 'string'],
            [['id_recorrido_supervisor_fk'], 'exist', 'skipOnError' => true, 'targetClass' => TblRecorridosSupervisores::className(), 'targetAttribute' => ['id_recorrido_supervisor_fk' => 'id_recorrido']],
            [['id_recurso_fk'], 'exist', 'skipOnError' => true, 'targetClass' => TblRecorridosSupervisores::className(), 'targetAttribute' => ['id_recurso_fk' => 'id_recorrido']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_rdr' => 'Id Rdr',
            'id_recorrido_supervisor_fk' => 'Id Recorrido Supervisor Fk',
            'id_recurso_fk' => 'Id Recurso Fk',
            'observaciones' => 'Observaciones',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdRecorridoSupervisorFk()
    {
        return $this->hasOne(TblRecorridosSupervisores::className(), ['id_recorrido' => 'id_recorrido_supervisor_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdRecursoFk()
    {
        return $this->hasOne(TblRecorridosSupervisores::className(), ['id_recorrido' => 'id_recurso_fk']);
    }
}
