<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_programacion_supervisores".
 *
 * @property integer $id_programacion_supervisor
 * @property integer $id_supervisor_fk
 * @property integer $id_horario_fk
 * @property string $fecha_inicio_programacion_supervisor
 * @property string $fecha_fin_programacion_supervisor
 *
 * @property TblDetalleProgSupervisor[] $tblDetalleProgSupervisors
 * @property TblHorarios $idHorarioFk
 * @property TblSupervisores $idSupervisorFk
 * @property TblRecorridosSupervisores[] $tblRecorridosSupervisores
 */
class TblProgramacionSupervisores extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_programacion_supervisores';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_supervisor_fk', 'id_horario_fk', 'fecha_inicio_programacion_supervisor', 'fecha_fin_programacion_supervisor'], 'required'],
            [['id_supervisor_fk', 'id_horario_fk'], 'integer'],
            [['fecha_inicio_programacion_supervisor', 'fecha_fin_programacion_supervisor'], 'safe'],
            [['id_horario_fk'], 'exist', 'skipOnError' => true, 'targetClass' => TblHorarios::className(), 'targetAttribute' => ['id_horario_fk' => 'id_horario']],
            [['id_supervisor_fk'], 'exist', 'skipOnError' => true, 'targetClass' => TblSupervisores::className(), 'targetAttribute' => ['id_supervisor_fk' => 'id_supervisor']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_programacion_supervisor' => 'ID',
            'id_supervisor_fk' => 'Supervisor',
            'id_horario_fk' => 'Horario',
            'fecha_inicio_programacion_supervisor' => 'Inicio',
            'fecha_fin_programacion_supervisor' => 'Fin',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblDetalleProgSupervisors()
    {
        return $this->hasMany(TblDetalleProgSupervisor::className(), ['id_programacion_supervisor_fk' => 'id_programacion_supervisor']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdHorarioFk()
    {
        return $this->hasOne(TblHorarios::className(), ['id_horario' => 'id_horario_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdSupervisorFk()
    {
        return $this->hasOne(TblSupervisores::className(), ['id_supervisor' => 'id_supervisor_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblRecorridosSupervisores()
    {
        return $this->hasMany(TblRecorridosSupervisores::className(), ['id_programacion_fk' => 'id_programacion_supervisor']);
    }
}
