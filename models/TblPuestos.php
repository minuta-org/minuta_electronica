<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_puestos".
 *
 * @property integer $id_puesto
 * @property string $nombre_puesto
 * @property string $direccion_puesto
 * @property string $telefono_puesto
 * @property integer $id_barrio_fk
 * @property string $contacto_puesto
 * @property string $celular_contacto_puesto
 * @property integer $id_zona_fk
 * @property integer $id_cliente_fk
 *
 * @property TblDetalleProgSupervisor[] $tblDetalleProgSupervisors
 * @property TblElementosPorPuesto[] $tblElementosPorPuestos
 * @property TblEntregaPuestos[] $tblEntregaPuestos
 * @property TblClientes $idClienteFk
 * @property TblZonas $idZonaFk
 * @property TblBarrios $idBarrioFk
 * @property TblPuntosRecorrido[] $tblPuntosRecorridos
 * @property TblRecorridosSupervisores[] $tblRecorridosSupervisores
 * @property TblRecursosPorPuesto[] $tblRecursosPorPuestos
 */
class TblPuestos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_puestos';
    }
    public function beforeSave($insert) {
        if(!parent::beforeSave($insert)) return false;
        
        $this->nombre_puesto = strtoupper($this->nombre_puesto);
        $this->direccion_puesto = strtoupper($this->direccion_puesto);
        $this->contacto_puesto = strtoupper($this->contacto_puesto);
        
        return true;
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre_puesto', 'direccion_puesto', 'telefono_puesto', 'id_barrio_fk', 'contacto_puesto', 'celular_contacto_puesto', 'id_zona_fk', 'id_cliente_fk'], 'required'],
            [['id_barrio_fk', 'id_zona_fk', 'id_cliente_fk'], 'integer'],
            [['nombre_puesto'], 'string', 'max' => 40],
            [['direccion_puesto'], 'string', 'max' => 80],
            [['telefono_puesto', 'contacto_puesto', 'celular_contacto_puesto'], 'string', 'max' => 30],
            [['id_cliente_fk'], 'exist', 'skipOnError' => true, 'targetClass' => TblClientes::className(), 'targetAttribute' => ['id_cliente_fk' => 'id_cliente']],
            [['id_zona_fk'], 'exist', 'skipOnError' => true, 'targetClass' => TblZonas::className(), 'targetAttribute' => ['id_zona_fk' => 'id_zona']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_puesto' => 'ID',
            'nombre_puesto' => 'Puesto',
            'direccion_puesto' => 'Direccion',
            'telefono_puesto' => 'Telefono',
            'id_barrio_fk' => 'Barrio',
            'contacto_puesto' => 'Contacto',
            'celular_contacto_puesto' => 'Celular Contacto',
            'id_zona_fk' => 'Zona',
            'id_cliente_fk' => 'Cliente',
            'nombreCliente' => 'Cliente',
            'nombreBarrio' => 'Barrio',
            'nombreZona' => 'Zona',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblDetalleProgSupervisors()
    {
        return $this->hasMany(TblDetalleProgSupervisor::className(), ['id_puesto' => 'id_puesto']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblElementosPorPuestos()
    {
        return $this->hasMany(TblElementosPorPuesto::className(), ['id_puesto_fk' => 'id_puesto']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblEntregaPuestos()
    {
        return $this->hasMany(TblEntregaPuestos::className(), ['id_puesto_fk' => 'id_puesto']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdClienteFk()
    {
        return $this->hasOne(TblClientes::className(), ['id_cliente' => 'id_cliente_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdZonaFk()
    {
        return $this->hasOne(TblZonas::className(), ['id_zona' => 'id_zona_fk']);
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
    public function getTblPuntosRecorridos()
    {
        return $this->hasMany(TblPuntosRecorrido::className(), ['id_puesto_fk' => 'id_puesto']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblRecorridosSupervisores()
    {
        return $this->hasMany(TblRecorridosSupervisores::className(), ['id_puesto_fk' => 'id_puesto']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblRecursosPorPuestos()
    {
        return $this->hasMany(TblRecursosPorPuesto::className(), ['id_puesto_fk' => 'id_puesto']);
    }
    
    public function getNombreZona()
    {
        return $this->idZonaFk->nombre_zona;
    }
    
    public function getNombreCliente()
    {
        return $this->idClienteFk->nombreCorto;
    }
    
    public function getNombreBarrio(){
        return $this->idBarrioFk->nombre_barrio;
    }
}
