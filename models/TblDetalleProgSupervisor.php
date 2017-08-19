<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_detalle_prog_supervisor".
 *
 * @property integer $id_dps
 * @property integer $id_programacion_supervisor_fk
 * @property integer $id_puesto
 *
 * @property TblProgramacionSupervisores $idProgramacionSupervisorFk
 * @property TblPuestos $idPuesto
 */
class TblDetalleProgSupervisor extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_detalle_prog_supervisor';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_programacion_supervisor_fk', 'id_puesto'], 'required'],
            [['id_programacion_supervisor_fk', 'id_puesto'], 'integer'],
            [['id_programacion_supervisor_fk'], 'exist', 'skipOnError' => true, 'targetClass' => TblProgramacionSupervisores::className(), 'targetAttribute' => ['id_programacion_supervisor_fk' => 'id_programacion_supervisor']],
            [['id_puesto'], 'exist', 'skipOnError' => true, 'targetClass' => TblPuestos::className(), 'targetAttribute' => ['id_puesto' => 'id_puesto']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_dps' => 'ID',
            'id_programacion_supervisor_fk' => 'Supervisor',
            'id_puesto' => 'Puesto',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdProgramacionSupervisorFk()
    {
        return $this->hasOne(TblProgramacionSupervisores::className(), ['id_programacion_supervisor' => 'id_programacion_supervisor_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdPuesto()
    {
        return $this->hasOne(TblPuestos::className(), ['id_puesto' => 'id_puesto']);
    }
}
