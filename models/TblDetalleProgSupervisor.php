<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_detalle_prog_supervisor".
 *
 * @property integer $id_dps
 * @property integer $id_programacion_supervisor_fk
 * @property integer $id_puesto
 * @property integer $dia_dps
 *
 * @property TblProgramacionSupervisores $idProgramacionSupervisorFk
 * @property TblPuestos $idPuesto
 */
class TblDetalleProgSupervisor extends \yii\db\ActiveRecord
{
    const ESTADO_VISITADO = 1;
    const ESTADO_NO_VISITADO = 0;

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
            [['id_programacion_supervisor_fk', 'id_puesto', 'dia_dps'], 'integer'],
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
            'id_dps' => 'Id Dps',
            'id_programacion_supervisor_fk' => 'Id Programacion Supervisor Fk',
            'id_puesto' => 'Id Puesto',
            'dia_dps' => 'Dia Dps',
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

    public function getEtiquetaEstado()
    {
        if($this->estado == self::ESTADO_VISITADO){
            return \yii\helpers\Html::tag('span', 'Visitado', ['class' => 'label label-success']);
        } else if($this->estado == self::ESTADO_NO_VISITADO){
            return \yii\helpers\Html::tag('span', 'Sin visitar', ['class' => 'label label-danger']);
        }
    }
}
