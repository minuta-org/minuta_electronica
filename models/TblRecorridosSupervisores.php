<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_recorridos_supervisores".
 *
 * @property integer $id_recorrido
 * @property integer $id_programacion_fk
 * @property integer $id_puesto_fk
 * @property string $observacion_recorrido_supervisor
 * @property string $url_foto_recorrido_supervisor
 * @property string $fecha_recorrido_supervisor
 * @property string $hora_recorrido_supervisor
 * @property double $longitud_recorrido_supervisor
 * @property double $latitud_recorrido_supervisor
 *
 * @property TblProgramacionSupervisores $idProgramacionFk
 * @property TblPuestos $idPuestoFk
 */
class TblRecorridosSupervisores extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_recorridos_supervisores';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_programacion_fk', 'id_puesto_fk', 'observacion_recorrido_supervisor', 'fecha_recorrido_supervisor', 'hora_recorrido_supervisor'], 'required'],
            [['id_programacion_fk', 'id_puesto_fk'], 'integer'],
            [['observacion_recorrido_supervisor', 'url_foto_recorrido_supervisor'], 'string'],
            [['fecha_recorrido_supervisor', 'hora_recorrido_supervisor'], 'safe'],
            [['longitud_recorrido_supervisor', 'latitud_recorrido_supervisor'], 'number'],
            [['id_programacion_fk'], 'exist', 'skipOnError' => true, 'targetClass' => TblProgramacionSupervisores::className(), 'targetAttribute' => ['id_programacion_fk' => 'id_programacion_supervisor']],
            [['id_puesto_fk'], 'exist', 'skipOnError' => true, 'targetClass' => TblPuestos::className(), 'targetAttribute' => ['id_puesto_fk' => 'id_puesto']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_recorrido' => 'ID',
            'id_programacion_fk' => 'Programacion',
            'id_puesto_fk' => 'Puesto',
            'observacion_recorrido_supervisor' => 'Observacion',
            'url_foto_recorrido_supervisor' => 'Foto',
            'fecha_recorrido_supervisor' => 'Fecha',
            'hora_recorrido_supervisor' => 'Hora',
            'longitud_recorrido_supervisor' => 'Longitud',
            'latitud_recorrido_supervisor' => 'Latitud',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdProgramacionFk()
    {
        return $this->hasOne(TblProgramacionSupervisores::className(), ['id_programacion_supervisor' => 'id_programacion_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdPuestoFk()
    {
        return $this->hasOne(TblPuestos::className(), ['id_puesto' => 'id_puesto_fk']);
    }
}
