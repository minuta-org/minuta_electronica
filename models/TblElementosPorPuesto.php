<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_elementos_por_puesto".
 *
 * @property integer $id_epp
 * @property integer $id_elemento_fk
 * @property integer $id_puesto_fk
 * @property integer $cantidad_elemento
 * @property integer $id_estado_opt_fk
 * @property string $observacion_elemento
 *
 * @property TblElementosPuesto $idElementoFk
 * @property TblPuestos $idPuestoFk
 */
class TblElementosPorPuesto extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_elementos_por_puesto';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_elemento_fk', 'id_puesto_fk', 'id_estado_opt_fk'], 'required'],
            [['id_elemento_fk', 'id_puesto_fk', 'cantidad_elemento', 'id_estado_opt_fk'], 'integer'],
            [['observacion_elemento'], 'string'],
            [['id_elemento_fk'], 'exist', 'skipOnError' => true, 'targetClass' => TblElementosPuesto::className(), 'targetAttribute' => ['id_elemento_fk' => 'id_elemento_puesto']],
            [['id_puesto_fk'], 'exist', 'skipOnError' => true, 'targetClass' => TblPuestos::className(), 'targetAttribute' => ['id_puesto_fk' => 'id_puesto']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_epp' => 'ID',
            'id_elemento_fk' => 'Elemento',
            'id_puesto_fk' => 'Puesto',
            'cantidad_elemento' => 'Cantidad',
            'id_estado_opt_fk' => 'Estado',
            'observacion_elemento' => 'Observacion',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdElementoFk()
    {
        return $this->hasOne(TblElementosPuesto::className(), ['id_elemento_puesto' => 'id_elemento_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdPuestoFk()
    {
        return $this->hasOne(TblPuestos::className(), ['id_puesto' => 'id_puesto_fk']);
    }
}
