<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_recursos_por_puesto".
 *
 * @property integer $id_rpp
 * @property integer $id_recurso_fk
 * @property integer $id_puesto_fk
 * @property string $observaciones_rpp
 *
 * @property TblPuestos $idPuestoFk
 * @property TblRecursos $idRecursoFk
 */
class TblRecursosPorPuesto extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_recursos_por_puesto';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_recurso_fk', 'id_puesto_fk'], 'required'],
            [['id_recurso_fk', 'id_puesto_fk'], 'integer'],
            [['observaciones_rpp'], 'string'],
            [['id_puesto_fk'], 'exist', 'skipOnError' => true, 'targetClass' => TblPuestos::className(), 'targetAttribute' => ['id_puesto_fk' => 'id_puesto']],
            [['id_recurso_fk'], 'exist', 'skipOnError' => true, 'targetClass' => TblRecursos::className(), 'targetAttribute' => ['id_recurso_fk' => 'id_recurso']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_rpp' => 'ID',
            'id_recurso_fk' => 'Recurso',
            'id_puesto_fk' => 'Puesto',
            'observaciones_rpp' => 'Observaciones',
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
    public function getIdRecursoFk()
    {
        return $this->hasOne(TblRecursos::className(), ['id_recurso' => 'id_recurso_fk']);
    }
}
