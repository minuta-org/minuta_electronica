<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_turnos".
 *
 * @property integer $id_turno
 * @property string $nombre_turno
 * @property string $descripcion_turno
 * @property integer $tipo_turno
 * @property string $color
 *
 * @property TblDetalleProgSupervisor[] $tblDetalleProgSupervisors
 */
class TblTurnos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_turnos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre_turno'], 'required'],
            [['tipo_turno'], 'integer'],
            [['nombre_turno'], 'string', 'max' => 100],
            [['descripcion_turno'], 'string', 'max' => 500],
            [['color'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_turno' => 'Id Turno',
            'nombre_turno' => 'Nombre Turno',
            'descripcion_turno' => 'Descripcion Turno',
            'tipo_turno' => 'Tipo Turno',
            'color' => 'Color',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblDetalleProgSupervisors()
    {
        return $this->hasMany(TblDetalleProgSupervisor::className(), ['id_turno_fk' => 'id_turno']);
    }
}
