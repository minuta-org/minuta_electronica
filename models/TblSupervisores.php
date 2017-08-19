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

    public function beforeSave($insert) {
        if(!parent::beforeSave($insert)){
            return false;
        }
        
        $this->primer_nombre_supervisor = strtoupper($this->primer_nombre_supervisor);
        $this->segundo_nombre_supervisor = strtoupper($this->segundo_nombre_supervisor);
        $this->primer_apellido_supervisor = strtoupper($this->primer_apellido_supervisor);
        $this->segundo_apellido_supervisor = strtoupper($this->segundo_apellido_supervisor);
        $this->direccion_supervisor = strtoupper($this->direccion_supervisor);
        $this->email_supervisor = strtolower($this->email_supervisor);
        
        return true;
    }
    
    private function toUpper(&$string){
        $string = strtoupper($string);
    }
    
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre_completo'], 'safe', 'on' => 'search'],
            [['codigo_supervisor', 'id_tipo_documento_fk', 'documento_supervisor', 'primer_nombre_supervisor', 'primer_apellido_supervisor', 'telefono_supervisor', 'celular_supervisor', 'email_supervisor', 'direccion_supervisor', 'id_barrio_fk', 'id_matricula_fk'], 'required'],
            [['id_tipo_documento_fk', 'id_barrio_fk', 'id_matricula_fk', 'documento_supervisor'], 'integer'],
            [['codigo_supervisor'], 'string', 'max' => 10],
            [['documento_supervisor', 'celular_supervisor'], 'string', 'max' => 15],
            [['primer_nombre_supervisor', 'segundo_nombre_supervisor', 'primer_apellido_supervisor', 'segundo_apellido_supervisor', 'telefono_supervisor'], 'string', 'max' => 30],
            [['email_supervisor', 'direccion_supervisor'], 'string', 'max' => 80],
            [['id_barrio_fk'], 'exist', 'skipOnError' => true, 'targetClass' => TblBarrios::className(), 'targetAttribute' => ['id_barrio_fk' => 'id_barrio']],
            [['id_matricula_fk'], 'exist', 'skipOnError' => true, 'targetClass' => TblMatricula::className(), 'targetAttribute' => ['id_matricula_fk' => 'id_matricula']],
            [['id_tipo_documento_fk'], 'exist', 'skipOnError' => true, 'targetClass' => TblTiposDocumentos::className(), 'targetAttribute' => ['id_tipo_documento_fk' => 'id_tipo_documento']],
            [['email_supervisor'], 'email'],
            [['codigo_supervisor'], 'unique', 'on' => 'create'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_supervisor' => 'Id',
            'codigo_supervisor' => 'Codigo',
            'id_tipo_documento_fk' => 'Tipo Documento',
            'documento_supervisor' => 'Documento',
            'primer_nombre_supervisor' => 'Primer Nombre',
            'segundo_nombre_supervisor' => 'Segundo Nombre',
            'primer_apellido_supervisor' => 'Primer Apellido',
            'segundo_apellido_supervisor' => 'Segundo Apellido',
            'telefono_supervisor' => 'Telefono',
            'celular_supervisor' => 'Celular',
            'email_supervisor' => 'Email',
            'direccion_supervisor' => 'Direccion',
            'id_barrio_fk' => 'Barrio',
            'id_matricula_fk' => 'Matricula',
            'nombre_completo' => 'Nombre Completo',
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
    
    public function getTipoDocumento()
    {
        return $this->idTipoDocumentoFk->nombre;
    }
    
    public function getNombreCompleto(){
        return implode(' ', [$this->primer_nombre_supervisor, $this->segundo_nombre_supervisor, $this->primer_apellido_supervisor, $this->segundo_apellido_supervisor]);
    }
}
