<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_tipos_documentos".
 *
 * @property integer $id_tipo_documento
 * @property string $nombre
 *
 * @property TblClientes[] $tblClientes
 * @property TblRecursos[] $tblRecursos
 * @property TblSupervisores[] $tblSupervisores
 */
class TblTiposDocumentos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_tipos_documentos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre'], 'required'],
            [['nombre', 'concepto'], 'string', 'max' => 80],
        ];
    }
    
    public function beforeSave($insert) {
        if(!parent::beforeSave($insert)) return false;
        $this->nombre = mb_strtoupper($this->nombre);
        $this->concepto = mb_strtoupper($this->concepto);
        return true;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_tipo_documento' => 'Id',
            'nombre' => 'Tipo Documento',
            'concepto' => 'Concepto',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblClientes()
    {
        return $this->hasMany(TblClientes::className(), ['id_tipo_documento_fk' => 'id_tipo_documento']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblRecursos()
    {
        return $this->hasMany(TblRecursos::className(), ['id_tipo_documento_fk' => 'id_tipo_documento']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblSupervisores()
    {
        return $this->hasMany(TblSupervisores::className(), ['id_tipo_documento_fk' => 'id_tipo_documento']);
    }
}
