<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_cuadrantes".
 *
 * @property integer $id_cuadrante
 * @property string $nombre_cuadrante
 *
 * @property TblZonas[] $tblZonas
 */
class TblCuadrantes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_cuadrantes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre_cuadrante'], 'required'],
            [['nombre_cuadrante'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_cuadrante' => 'Id Cuadrante',
            'nombre_cuadrante' => 'Nombre Cuadrante',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblZonas()
    {
        return $this->hasMany(TblZonas::className(), ['id_cuadrante_fk' => 'id_cuadrante']);
    }
}
