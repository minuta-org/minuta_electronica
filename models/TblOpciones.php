<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_opciones".
 *
 * @property integer $id_opcion
 * @property string $nombre_opcion
 * @property string $descripcion
 *
 * @property TblOpcionesValores[] $tblOpcionesValores
 */
class TblOpciones extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_opciones';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre_opcion'], 'string', 'max' => 50],
            [['descripcion'], 'string', 'max' => 500],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_opcion' => 'Id Opcion',
            'nombre_opcion' => 'Nombre Opcion',
            'descripcion' => 'Descripcion',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblOpcionesValores()
    {
        return $this->hasMany(TblOpcionesValores::className(), ['id_tipo_opcion' => 'id_opcion']);
    }
    
    public static function getOpciones($nombre = "", $comoArray = false)
    {
	$opcion = self::find()->where("nombre_opcion = '{$nombre}'")->one();
	if(!$comoArray && $opcion){
	    return $opcion->tblOpcionesValores;
	} else if($comoArray && $opcion){
	    $opciones = [];
	    $arOps = $opcion->tblOpcionesValores;
	    foreach ($arOps AS $arOp) $opciones[$arOp->id_opcion] = $arOp->nombre;
	    return $opciones;
	}
	return [];
    }
    
    public static function getOpcionValor($codigo, $valor = false){
	$opcion = TblOpcionesValores::find()->where("id_opcion = '{$codigo}'")->one();
	if($opcion){
	    return $valor? $opcion->valor : $opcion->nombre;
	}
	return null;
    }
}
