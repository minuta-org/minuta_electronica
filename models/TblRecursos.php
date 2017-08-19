<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_recursos".
 *
 * @property integer $id_recurso
 * @property integer $id_tipo_documento_fk
 * @property string $documento_recurso
 * @property string $primer_nombre_recurso
 * @property string $segundo_nombre_recurso
 * @property string $primer_apellido_recurso
 * @property string $segundo_apellido_recurso
 * @property string $email_recurso
 * @property string $direccion_recurso
 * @property string $telefono_recurso
 * @property string $celular_recurso
 * @property integer $id_barrio_fk
 * @property integer $estado_recurso
 *
 * @property TblRecorridosRecursos[] $tblRecorridosRecursos
 * @property TblTiposDocumentos $idTipoDocumentoFk
 * @property TblRecursosPorPuesto[] $tblRecursosPorPuestos
 */
class TblRecursos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_recursos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_tipo_documento_fk', 'documento_recurso', 'primer_nombre_recurso', 'primer_apellido_recurso', 'email_recurso', 'direccion_recurso', 'telefono_recurso', 'id_barrio_fk'], 'required'],
            [['id_tipo_documento_fk', 'id_barrio_fk', 'estado_recurso'], 'integer'],
            [['documento_recurso', 'telefono_recurso', 'celular_recurso'], 'string', 'max' => 15],
            [['primer_nombre_recurso', 'segundo_nombre_recurso', 'primer_apellido_recurso', 'segundo_apellido_recurso'], 'string', 'max' => 30],
            [['email_recurso', 'direccion_recurso'], 'string', 'max' => 80],
            [['id_tipo_documento_fk'], 'exist', 'skipOnError' => true, 'targetClass' => TblTiposDocumentos::className(), 'targetAttribute' => ['id_tipo_documento_fk' => 'id_tipo_documento']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_recurso' => 'Id',
            'id_tipo_documento_fk' => 'Tipo Documento',
            'documento_recurso' => 'Documento Recurso',
            'primer_nombre_recurso' => 'Primer Nombre',
            'segundo_nombre_recurso' => 'Segundo Nombre',
            'primer_apellido_recurso' => 'Primer Apellido',
            'segundo_apellido_recurso' => 'Segundo Apellido',
            'email_recurso' => 'Email',
            'direccion_recurso' => 'Direccion',
            'telefono_recurso' => 'Telefono',
            'celular_recurso' => 'Celular',
            'id_barrio_fk' => 'Barrio',
            'estado_recurso' => 'Estado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblRecorridosRecursos()
    {
        return $this->hasMany(TblRecorridosRecursos::className(), ['id_recurso_fk' => 'id_recurso']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdTipoDocumentoFk()
    {
        return $this->hasOne(TblTiposDocumentos::className(), ['id_tipo_documento' => 'id_tipo_documento_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblRecursosPorPuestos()
    {
        return $this->hasMany(TblRecursosPorPuesto::className(), ['id_recurso_fk' => 'id_recurso']);
    }
}
