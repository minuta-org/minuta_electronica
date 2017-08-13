<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_sectores_comerciales".
 *
 * @property integer $id_sector_comercial
 * @property string $nombre_sector_comercial
 *
 * @property TblClientes[] $tblClientes
 */
class TblSectoresComerciales extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_sectores_comerciales';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre_sector_comercial'], 'required'],
            [['nombre_sector_comercial'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_sector_comercial' => 'Id Sector Comercial',
            'nombre_sector_comercial' => 'Nombre Sector Comercial',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblClientes()
    {
        return $this->hasMany(TblClientes::className(), ['id_sector_comercial_fk' => 'id_sector_comercial']);
    }
}
