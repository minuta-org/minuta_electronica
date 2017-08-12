<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_matricula".
 *
 * @property integer $id_matricula
 * @property string $nit_matricula
 * @property string $dv_matricula
 * @property string $razon_social_matricula
 * @property string $sigla_matricula
 * @property string $primer_nombre_matricula
 * @property string $segundo_nombre_matricula
 * @property string $primer_apellido_matricula
 * @property string $segundo_apellido_matricula
 * @property string $email_matricula
 * @property string $telefono_matricula
 * @property string $direccion_matricula
 * @property integer $id_barrio_fk
 * @property string $celular_matricula
 * @property string $pagina_web
 *
 * @property TblClientes[] $tblClientes
 * @property TblBarrios $idBarrioFk
 * @property TblSupervisores[] $tblSupervisores
 */
class TblMatricula extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_matricula';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['email_matricula'], 'email'],
            [['nit_matricula'], 'unique', 'on' => 'create'],
            [['nit_matricula', 'dv_matricula', 'razon_social_matricula', 'email_matricula', 'telefono_matricula', 'direccion_matricula', 'id_barrio_fk'], 'required'],
            [['id_barrio_fk'], 'integer'],
            [['nit_matricula', 'primer_nombre_matricula', 'segundo_nombre_matricula', 'primer_apellido_matricula', 'segundo_apellido_matricula', 'telefono_matricula', 'celular_matricula'], 'string', 'max' => 30],
            [['dv_matricula'], 'string', 'max' => 1],
            [['razon_social_matricula', 'email_matricula', 'direccion_matricula'], 'string', 'max' => 80],
            [['sigla_matricula'], 'string', 'max' => 40],
            [['pagina_web'], 'string', 'max' => 100],
            [['id_barrio_fk'], 'exist', 'skipOnError' => true, 'targetClass' => TblBarrios::className(), 'targetAttribute' => ['id_barrio_fk' => 'id_barrio']],
        ];
    }

    public function beforeSave($insert) {
        if(!parent::beforeSave($insert)) {
            return false;
        }
        $this->razon_social_matricula = strtoupper($this->razon_social_matricula);
        return true;
    }
    
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_matricula' => 'Id',
            'nit_matricula' => 'Nit',
            'dv_matricula' => 'Dígito Verificación',
            'razon_social_matricula' => 'Razon Social',
            'sigla_matricula' => 'Sigla',
            'primer_nombre_matricula' => 'Primer Nombre',
            'segundo_nombre_matricula' => 'Segundo Nombre',
            'primer_apellido_matricula' => 'Primer Apellido',
            'segundo_apellido_matricula' => 'Segundo Apellido',
            'email_matricula' => 'Email',
            'telefono_matricula' => 'Teléfono',
            'direccion_matricula' => 'Dirección',
            'id_barrio_fk' => 'Barrio',
            'celular_matricula' => 'Celular',
            'pagina_web' => 'Pagina Web',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblClientes()
    {
        return $this->hasMany(TblClientes::className(), ['id_matricula_fk' => 'id_matricula']);
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
    public function getTblSupervisores()
    {
        return $this->hasMany(TblSupervisores::className(), ['id_matricula_fk' => 'id_matricula']);
    }
    
    public function getNombreCorto(){
        return "{$this->primer_nombre_matricula} {$this->primer_apellido_matricula}";
    }
    public function getBarrio(){
        return $this->idBarrioFk->nombre_barrio;
    }
}
