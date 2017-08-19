<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_puntos_recorrido".
 *
 * @property integer $id_punto_recorrido
 * @property integer $id_puesto_fk
 * @property string $nombre_punto_recorrido
 * @property string $descripcion_punto_recorrido
 *
 * @property TblPuestos $idPuestoFk
 * @property TblRecorridosRecursos[] $tblRecorridosRecursos
 */
class TblPuntosRecorrido extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_puntos_recorrido';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_puesto_fk', 'nombre_punto_recorrido'], 'required'],
            [['id_puesto_fk'], 'integer'],
            [['descripcion_punto_recorrido'], 'string'],
            [['nombre_punto_recorrido'], 'string', 'max' => 100],
            [['id_puesto_fk'], 'exist', 'skipOnError' => true, 'targetClass' => TblPuestos::className(), 'targetAttribute' => ['id_puesto_fk' => 'id_puesto']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_punto_recorrido' => 'ID',
            'id_puesto_fk' => 'Puesto',
            'nombre_punto_recorrido' => 'Nombre',
            'descripcion_punto_recorrido' => 'Descripcion',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdPuestoFk()
    {
        return $this->hasOne(TblPuestos::className(), ['id_puesto' => 'id_puesto_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblRecorridosRecursos()
    {
        return $this->hasMany(TblRecorridosRecursos::className(), ['id_punto_recorrido_fk' => 'id_punto_recorrido']);
    }
}
