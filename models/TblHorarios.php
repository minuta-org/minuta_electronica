<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_horarios".
 *
 * @property integer $id_horario
 * @property string $nombre_horario
 * @property string $inicio_horario
 * @property string $finaliza_horario
 *
 * @property TblProgramacionSupervisores[] $tblProgramacionSupervisores
 */
class TblHorarios extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_horarios';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre_horario', 'inicio_horario', 'finaliza_horario'], 'required'],
            [['inicio_horario', 'finaliza_horario'], 'safe'],
            [['nombre_horario'], 'string', 'max' => 300],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_horario' => 'Id Horario',
            'nombre_horario' => 'Nombre Horario',
            'inicio_horario' => 'Inicio Horario',
            'finaliza_horario' => 'Finaliza Horario',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblProgramacionSupervisores()
    {
        return $this->hasMany(TblProgramacionSupervisores::className(), ['id_horario_fk' => 'id_horario']);
    }
    
    public function getNombreHorario()
    {
        return "{$this->nombre_horario} {$this->inicio_horario} - $this->finaliza_horario";
    }
}
