<?php

namespace app\models;

use Yii;
use yii\helpers\Html;

/**
 * This is the model class for table "tbl_programacion_supervisores".
 *
 * @property integer $id_programacion_supervisor
 * @property integer $id_supervisor_fk
 * @property integer $id_horario_fk
 * @property string $fecha_inicio_programacion_supervisor
 * @property string $fecha_fin_programacion_supervisor
 * @property integer $id_tipo_programacion_fk
 *
 * @property TblDetalleProgSupervisor[] $tblDetalleProgSupervisors
 * @property TblHorarios $idHorarioFk
 * @property TblSupervisores $idSupervisorFk
 * @property TblTiposProgramacion $idTipoProgramacionFk
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
            [['id_supervisor_fk', 'id_horario_fk', 'fecha_inicio_programacion_supervisor', 'fecha_fin_programacion_supervisor', 'id_tipo_programacion_fk'], 'required'],
            [['id_supervisor_fk', 'id_horario_fk', 'id_tipo_programacion_fk'], 'integer'],
            [['fecha_inicio_programacion_supervisor', 'fecha_fin_programacion_supervisor'], 'safe'],
            [['id_horario_fk'], 'exist', 'skipOnError' => true, 'targetClass' => TblHorarios::className(), 'targetAttribute' => ['id_horario_fk' => 'id_horario']],
            [['id_supervisor_fk'], 'exist', 'skipOnError' => true, 'targetClass' => TblSupervisores::className(), 'targetAttribute' => ['id_supervisor_fk' => 'id_supervisor']],
            [['id_tipo_programacion_fk'], 'exist', 'skipOnError' => true, 'targetClass' => TblTiposProgramacion::className(), 'targetAttribute' => ['id_tipo_programacion_fk' => 'id_tipo_programacion']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_programacion_supervisor' => 'Id',
            'id_supervisor_fk' => 'Supervisor',
            'id_horario_fk' => 'Horario',
            'fecha_inicio_programacion_supervisor' => 'Fecha Inicio',
            'fecha_fin_programacion_supervisor' => 'Fecha Final',
            'id_tipo_programacion_fk' => 'Tipo',
            'nombreSupervisor' => "Supervisor",
            'nombreHorario' => "Horario",
            'nombreTipo' => "Tipo",
            'diasProgramados' => "Dias Programados"
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
    public function getIdTipoProgramacionFk()
    {
        return $this->hasOne(TblTiposProgramacion::className(), ['id_tipo_programacion' => 'id_tipo_programacion_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblRecorridosSupervisores()
    {
        return $this->hasMany(TblRecorridosSupervisores::className(), ['id_programacion_fk' => 'id_programacion_supervisor']);
    }
    
    public function getNombreSupervisor()
    {
        return $this->idSupervisorFk->nombreCompleto;
    }
    
    public function getNombreTipo()
    {
        return $this->idTipoProgramacionFk->nombre_tipo_programacion;
    }
    
    public function getNombreHorario()
    {
        return $this->idHorarioFk->nombreHorario;
    }

    public function getDiasProgramados(){
        $totalProgramaciones = TblDetalleProgSupervisor::find()
            ->where("id_programacion_supervisor_fk = '{$this->id_programacion_supervisor}'")
            ->andWhere("id_puesto IS NOT NULL")
            ->groupBy("dia_dps")
            ->count();
        $novedades = TblDetalleProgSupervisor::find()
            ->where("id_programacion_supervisor_fk = '{$this->id_programacion_supervisor}'")
            ->andWhere("id_turno_fk IS NOT NULL")
            ->groupBy("dia_dps")
            ->count();
        $fechaInicial = new \DateTime($this->fecha_inicio_programacion_supervisor);
        $fechaFinal = new \DateTime($this->fecha_fin_programacion_supervisor);
        $diff = $fechaFinal->diff($fechaInicial);
        $dias = intval($diff->format("%a")) - $novedades + 1;


        if($totalProgramaciones == 0) $clase = "danger";
        else if($totalProgramaciones == $dias) $clase = "success";
        else if($totalProgramaciones < $dias && $totalProgramaciones >= ($dias / 2)) $clase = "warning";
        else $clase = "default";
        return Html::tag("span", $totalProgramaciones . " / " . $dias, ["class" => "label label-{$clase} huge"]);
    }
}
