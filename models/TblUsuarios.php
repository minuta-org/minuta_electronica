<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_usuarios".
 *
 * @property integer $id_usuario
 * @property string $username
 * @property string $password
 * @property string $authkey
 * @property string $nombre_usuario
 * @property string $apellido_usuario
 * @property integer $rol_usuario
 * @property string $fecha_creacion
 * @property string $fecha_modificacion
 * @property integer $estado
 *
 * @property TblRoles $rolUsuario
 */
class TblUsuarios extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_usuarios';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['rol_usuario', 'estado'], 'integer'],
            [['fecha_creacion', 'fecha_modificacion'], 'safe'],
            [['username', 'password', 'nombre_usuario', 'apellido_usuario'], 'string', 'max' => 255],
            [['authkey'], 'string', 'max' => 50],
            [['rol_usuario'], 'exist', 'skipOnError' => true, 'targetClass' => TblRoles::className(), 'targetAttribute' => ['rol_usuario' => 'id_rol']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_usuario' => 'Id Usuario',
            'username' => 'Username',
            'password' => 'Password',
            'authkey' => 'Authkey',
            'nombre_usuario' => 'Nombre Usuario',
            'apellido_usuario' => 'Apellido Usuario',
            'rol_usuario' => 'Rol Usuario',
            'fecha_creacion' => 'Fecha Creacion',
            'fecha_modificacion' => 'Fecha Modificacion',
            'estado' => 'Estado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRolUsuario()
    {
        return $this->hasOne(TblRoles::className(), ['id_rol' => 'rol_usuario']);
    }

    public function getAuthKey() {
        return $this->authkey;
    }

    public function getId() {
        return $this->id_usuario;
    }

    public function validateAuthKey($authKey) {
        return $this->authkey == $authKey;
    }

    public static function findIdentity($id) {
        return self::findOne($id);
    }
    
    public static function findByUsername($username)
    {
        return self::findOne(['username' => $username]);
    }
    
    
    public function validatePassword($password)
    {
        return $this->password == $password;
    }

    /**
     * @todo Definir este método...
     * @param type $token
     * @param type $type
     */
    public static function findIdentityByAccessToken($token, $type = null) {
        
    }
    
    public function getNombreCompleto()
    {
        return $this->nombre_usuario . " " . $this->apellido_usuario;                
    }

}
