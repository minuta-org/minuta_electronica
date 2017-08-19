<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_clientes".
 *
 * @property integer $id_cliente
 * @property integer $id_tipo_documento_fk
 * @property string $nit_cliente
 * @property string $dv_cliente
 * @property string $razon_social_cliente
 * @property string $sigla_cliente
 * @property string $primer_nombre_cliente
 * @property string $segundo_nombre_cliente
 * @property string $primer_apellido_cliente
 * @property string $segundo_apellido_cliente
 * @property string $email_cliente
 * @property string $telefono_cliente
 * @property string $celular_cliente
 * @property string $direccion_cliente
 * @property string $contacto_cliente
 * @property string $telefono_contacto_cliente
 * @property integer $id_barrio_fk
 * @property integer $id_sector_comercial_fk
 * @property integer $id_sector_economico_fk
 * @property integer $id_dimesion_opt_fk
 * @property integer $id_origen_judicial_opt_fk
 * @property integer $id_cobertura_opt_fk
 * @property integer $id_origen_capital_opt_fk
 * @property integer $id_matricula_fk
 * @property string $observaciones_cliente
 *
 * @property TblBarrios $idBarrioFk
 * @property TblMatricula $idMatriculaFk
 * @property TblSectoresComerciales $idSectorComercialFk
 * @property TblSectoresEconomicos $idSectorEconomicoFk
 * @property TblTiposDocumentos $idTipoDocumentoFk
 * @property TblPuestos[] $tblPuestos
 */
class TblClientes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_clientes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_tipo_documento_fk', 'nit_cliente', 'dv_cliente', 'razon_social_cliente', 'email_cliente', 'telefono_cliente', 'direccion_cliente', 'id_barrio_fk', 'id_sector_comercial_fk', 'id_sector_economico_fk', 'id_dimesion_opt_fk', 'id_origen_judicial_opt_fk', 'id_cobertura_opt_fk', 'id_origen_capital_opt_fk', 'id_matricula_fk'], 'required'],
            [['id_tipo_documento_fk', 'id_barrio_fk', 'id_sector_comercial_fk', 'id_sector_economico_fk', 'id_dimesion_opt_fk', 'id_origen_judicial_opt_fk', 'id_cobertura_opt_fk', 'id_origen_capital_opt_fk', 'id_matricula_fk'], 'integer'],
            [['observaciones_cliente'], 'string'],
            [['nit_cliente', 'sigla_cliente'], 'string', 'max' => 40],
            [['dv_cliente'], 'string', 'max' => 1],
            [['razon_social_cliente', 'email_cliente', 'direccion_cliente', 'contacto_cliente'], 'string', 'max' => 80],
            [['primer_nombre_cliente', 'segundo_nombre_cliente', 'primer_apellido_cliente', 'segundo_apellido_cliente', 'telefono_cliente', 'celular_cliente', 'telefono_contacto_cliente'], 'string', 'max' => 30],
            [['id_barrio_fk'], 'exist', 'skipOnError' => true, 'targetClass' => TblBarrios::className(), 'targetAttribute' => ['id_barrio_fk' => 'id_barrio']],
            [['id_matricula_fk'], 'exist', 'skipOnError' => true, 'targetClass' => TblMatricula::className(), 'targetAttribute' => ['id_matricula_fk' => 'id_matricula']],
            [['id_sector_comercial_fk'], 'exist', 'skipOnError' => true, 'targetClass' => TblSectoresComerciales::className(), 'targetAttribute' => ['id_sector_comercial_fk' => 'id_sector_comercial']],
            [['id_sector_economico_fk'], 'exist', 'skipOnError' => true, 'targetClass' => TblSectoresEconomicos::className(), 'targetAttribute' => ['id_sector_economico_fk' => 'id_sector_economico']],
            [['id_tipo_documento_fk'], 'exist', 'skipOnError' => true, 'targetClass' => TblTiposDocumentos::className(), 'targetAttribute' => ['id_tipo_documento_fk' => 'id_tipo_documento']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_cliente' => 'Id',
            'id_tipo_documento_fk' => 'Tipo Documento',
            'nit_cliente' => 'Nit',
            'dv_cliente' => 'Dv',
            'razon_social_cliente' => 'Razon Social',
            'sigla_cliente' => 'Sigla',
            'primer_nombre_cliente' => 'Primer Nombre',
            'segundo_nombre_cliente' => 'Segundo Nombre',
            'primer_apellido_cliente' => 'Primer Apellido',
            'segundo_apellido_cliente' => 'Segundo Apellido',
            'email_cliente' => 'Email',
            'telefono_cliente' => 'Telefono',
            'celular_cliente' => 'Celular',
            'direccion_cliente' => 'Direccion',
            'contacto_cliente' => 'Contacto',
            'telefono_contacto_cliente' => 'Telefono Contacto',
            'id_barrio_fk' => 'Barrio',
            'id_sector_comercial_fk' => 'Sector Comercial',
            'id_sector_economico_fk' => 'Sector Economico',
            'id_dimesion_opt_fk' => 'Dimesion',
            'id_origen_judicial_opt_fk' => 'Origen Judicial',
            'id_cobertura_opt_fk' => 'Cobertura',
            'id_origen_capital_opt_fk' => 'Origen Capital',
            'id_matricula_fk' => 'Matricula',
            'observaciones_cliente' => 'Observaciones',
        ];
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
    public function getIdSectorComercialFk()
    {
        return $this->hasOne(TblSectoresComerciales::className(), ['id_sector_comercial' => 'id_sector_comercial_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdSectorEconomicoFk()
    {
        return $this->hasOne(TblSectoresEconomicos::className(), ['id_sector_economico' => 'id_sector_economico_fk']);
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
    public function getTblPuestos()
    {
        return $this->hasMany(TblPuestos::className(), ['id_cliente_fk' => 'id_cliente']);
    }
}
