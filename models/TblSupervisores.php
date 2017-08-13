<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_supervisores".
 *
 * @property integer $id_supervisor
 * @property string $codigo_supervisor
 * @property integer $id_tipo_documento_fk
 * @property string $documento_supervisor
 * @property string $primer_nombre_supervisor
 * @property string $segundo_nombre_supervisor
 * @property string $primer_apellido_supervisor
 * @property string $segundo_apellido_supervisor
 * @property string $telefono_supervisor
 * @property string $celular_supervisor
 * @property string $email_supervisor
 * @property string $direccion_supervisor
 * @property integer $id_barrio_fk
 * @property integer $id_matricula_fk
 *
 * @property TblProgramacionSupervisores[] $tblProgramacionSupervisores
 * @property TblBarrios $idBarrioFk
 * @property TblMatricula $idMatriculaFk
 * @property TblTiposDocumentos $idTipoDocumentoFk
 */
class TblSupervisores extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_supervisores';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['codigo_supervisor', 'id_tipo_documento_fk', 'documento_supervisor', 'primer_nombre_supervisor', 'primer_apellido_supervisor', 'telefono_supervisor', 'celular_supervisor', 'email_supervisor', 'direccion_supervisor', 'id_barrio_fk', 'id_matricula_fk'], 'required'],
            [['id_tipo_documento_fk', 'id_barrio_fk', 'id_matricula_fk'], 'integer'],
            [['codigo_supervisor'], 'string', 'max' => 40],
            [['documento_supervisor', 'celular_supervisor'], 'string', 'max' => 15],
            [['primer_nombre_supervisor', 'segundo_nombre_supervisor', 'primer_apellido_supervisor', 'segundo_apellido_supervisor', 'telefono_supervisor'], 'string', 'max' => 30],
            [['email_supervisor', 'direccion_supervisor'], 'string', 'max' => 80],
            [['id_barrio_fk'], 'exist', 'skipOnError' => true, 'targetClass' => TblBarrios::className(), 'targetAttribute' => ['id_barrio_fk' => 'id_barrio']],
            [['id_matricula_fk'], 'exist', 'skipOnError' => true, 'targetClass' => TblMatricula::className(), 'targetAttribute' => ['id_matricula_fk' => 'id_matricula']],
            [['id_tipo_documento_fk'], 'exist', 'skipOnError' => true, 'targetClass' => TblTiposDocumentos::className(), 'targetAttribute' => ['id_tipo_documento_fk' => 'id_tipo_documento']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_supervisor' => 'Id Supervisor',
            'codigo_supervisor' => 'Codigo Supervisor',
            'id_tipo_documento_fk' => 'Id Tipo Documento Fk',
            'documento_supervisor' => 'Documento Supervisor',
            'primer_nombre_supervisor' => 'Primer Nombre Supervisor',
            'segundo_nombre_supervisor' => 'Segundo Nombre Supervisor',
            'primer_apellido_supervisor' => 'Primer Apellido Supervisor',
            'segundo_apellido_supervisor' => 'Segundo Apellido Supervisor',
            'telefono_supervisor' => 'Telefono Supervisor',
            'celular_supervisor' => 'Celular Supervisor',
            'email_supervisor' => 'Email Supervisor',
            'direccion_supervisor' => 'Direccion Supervisor',
            'id_barrio_fk' => 'Id Barrio Fk',
            'id_matricula_fk' => 'Id Matricula Fk',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblProgramacionSupervisores()
    {
        return $this->hasMany(TblProgramacionSupervisores::className(), ['id_supervisor_fk' => 'id_supervisor']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdBarrioFk()
    {
        return $this->hasOne(TblBarrios::className(), ['id_barrio' => 'id_barrio_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdMatriculaFk()
    {
        return $this->hasOne(TblMatricula::className(), ['id_matricula' => 'id_matricula_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdTipoDocumentoFk()
    {
        return $this->hasOne(TblTiposDocumentos::className(), ['id_tipo_documento' => 'id_tipo_documento_fk']);
    }
}
