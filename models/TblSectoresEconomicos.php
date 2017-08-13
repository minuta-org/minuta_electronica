<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_sectores_economicos".
 *
 * @property integer $id_sector_economico
 * @property string $nombre_sector_economico
 *
 * @property TblClientes[] $tblClientes
 */
class TblSectoresEconomicos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_sectores_economicos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_sector_economico', 'nombre_sector_economico'], 'required'],
            [['id_sector_economico'], 'integer'],
            [['nombre_sector_economico'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_sector_economico' => 'Id Sector Economico',
            'nombre_sector_economico' => 'Nombre Sector Economico',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblClientes()
    {
        return $this->hasMany(TblClientes::className(), ['id_sector_economico_fk' => 'id_sector_economico']);
    }
}
