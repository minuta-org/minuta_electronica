<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_opciones_valores".
 *
 * @property integer $id_opcion
 * @property integer $id_tipo_opcion
 * @property string $nombre
 * @property string $valor
 *
 * @property TblOpciones $idTipoOpcion
 */
class TblOpcionesValores extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_opciones_valores';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_tipo_opcion'], 'required'],
            [['id_tipo_opcion'], 'integer'],
            [['nombre'], 'string', 'max' => 50],
            [['valor'], 'string', 'max' => 500],
            [['id_tipo_opcion'], 'exist', 'skipOnError' => true, 'targetClass' => TblOpciones::className(), 'targetAttribute' => ['id_tipo_opcion' => 'id_opcion']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_opcion' => 'Id Opcion',
            'id_tipo_opcion' => 'Id Tipo Opcion',
            'nombre' => 'Nombre',
            'valor' => 'Valor',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdTipoOpcion()
    {
        return $this->hasOne(TblOpciones::className(), ['id_opcion' => 'id_tipo_opcion']);
    }
}
