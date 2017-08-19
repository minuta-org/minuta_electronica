<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_elementos_puesto".
 *
 * @property integer $id_elemento_puesto
 * @property string $nombre_elemento_puesto
 * @property string $descripcion_elemento_puesto
 *
 * @property TblElementosPorPuesto[] $tblElementosPorPuestos
 * @property TblEntregaDetalleElementos[] $tblEntregaDetalleElementos
 */
class TblElementosPuesto extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_elementos_puesto';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre_elemento_puesto'], 'required'],
            [['descripcion_elemento_puesto'], 'string'],
            [['nombre_elemento_puesto'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_elemento_puesto' => 'ID',
            'nombre_elemento_puesto' => 'Nombre',
            'descripcion_elemento_puesto' => 'Descripcion',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblElementosPorPuestos()
    {
        return $this->hasMany(TblElementosPorPuesto::className(), ['id_elemento_fk' => 'id_elemento_puesto']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblEntregaDetalleElementos()
    {
        return $this->hasMany(TblEntregaDetalleElementos::className(), ['id_elemento_fk' => 'id_elemento_puesto']);
    }
}
