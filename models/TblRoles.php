<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_roles".
 *
 * @property integer $id_rol
 * @property string $nombre_rol
 * @property string $descripcion_rol
 *
 * @property TblUsuarios[] $tblUsuarios
 */
class TblRoles extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_roles';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre_rol'], 'string', 'max' => 255],
            [['descripcion_rol'], 'string', 'max' => 500],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_rol' => 'Id Rol',
            'nombre_rol' => 'Nombre Rol',
            'descripcion_rol' => 'Descripcion Rol',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblUsuarios()
    {
        return $this->hasMany(TblUsuarios::className(), ['rol_usuario' => 'id_rol']);
    }
}
