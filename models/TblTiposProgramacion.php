<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_tipos_programacion".
 *
 * @property integer $id_tipo_programacion
 * @property string $nombre_tipo_programacion
 * @property string $descripcion_tipo_programacion
 * @property integer $intervalo_tipo_programacion
 *
 * @property TblProgramacionSupervisores[] $tblProgramacionSupervisores
 */
class TblTiposProgramacion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_tipos_programacion';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre_tipo_programacion'], 'required'],
            [['intervalo_tipo_programacion'], 'integer'],
            [['nombre_tipo_programacion'], 'string', 'max' => 100],
            [['descripcion_tipo_programacion'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_tipo_programacion' => 'Id Tipo Programacion',
            'nombre_tipo_programacion' => 'Nombre Tipo Programacion',
            'descripcion_tipo_programacion' => 'Descripcion Tipo Programacion',
            'intervalo_tipo_programacion' => 'Intervalo Tipo Programacion',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblProgramacionSupervisores()
    {
        return $this->hasMany(TblProgramacionSupervisores::className(), ['id_tipo_programacion_fk' => 'id_tipo_programacion']);
    }
}
