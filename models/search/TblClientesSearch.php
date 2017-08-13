<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TblClientes;

/**
 * TblClientesSearch represents the model behind the search form about `app\models\TblClientes`.
 */
class TblClientesSearch extends TblClientes
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_cliente', 'id_tipo_documento_fk', 'id_barrio_fk', 'id_sector_comercial_fk', 'id_sector_economico_fk', 'id_dimesion_opt_fk', 'id_origen_judicial_opt_fk', 'id_cobertura_opt_fk', 'id_origen_capital_opt_fk', 'id_matricula_fk'], 'integer'],
            [['nit_cliente', 'dv_cliente', 'razon_social_cliente', 'sigla_cliente', 'primer_nombre_cliente', 'segundo_nombre_cliente', 'primer_apellido_cliente', 'segundo_apellido_cliente', 'email_cliente', 'telefono_cliente', 'celular_cliente', 'direccion_cliente', 'contacto_cliente', 'telefono_contacto_cliente', 'observaciones_cliente'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = TblClientes::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id_cliente' => $this->id_cliente,
            'id_tipo_documento_fk' => $this->id_tipo_documento_fk,
            'id_barrio_fk' => $this->id_barrio_fk,
            'id_sector_comercial_fk' => $this->id_sector_comercial_fk,
            'id_sector_economico_fk' => $this->id_sector_economico_fk,
            'id_dimesion_opt_fk' => $this->id_dimesion_opt_fk,
            'id_origen_judicial_opt_fk' => $this->id_origen_judicial_opt_fk,
            'id_cobertura_opt_fk' => $this->id_cobertura_opt_fk,
            'id_origen_capital_opt_fk' => $this->id_origen_capital_opt_fk,
            'id_matricula_fk' => $this->id_matricula_fk,
        ]);

        $query->andFilterWhere(['like', 'nit_cliente', $this->nit_cliente])
            ->andFilterWhere(['like', 'dv_cliente', $this->dv_cliente])
            ->andFilterWhere(['like', 'razon_social_cliente', $this->razon_social_cliente])
            ->andFilterWhere(['like', 'sigla_cliente', $this->sigla_cliente])
            ->andFilterWhere(['like', 'primer_nombre_cliente', $this->primer_nombre_cliente])
            ->andFilterWhere(['like', 'segundo_nombre_cliente', $this->segundo_nombre_cliente])
            ->andFilterWhere(['like', 'primer_apellido_cliente', $this->primer_apellido_cliente])
            ->andFilterWhere(['like', 'segundo_apellido_cliente', $this->segundo_apellido_cliente])
            ->andFilterWhere(['like', 'email_cliente', $this->email_cliente])
            ->andFilterWhere(['like', 'telefono_cliente', $this->telefono_cliente])
            ->andFilterWhere(['like', 'celular_cliente', $this->celular_cliente])
            ->andFilterWhere(['like', 'direccion_cliente', $this->direccion_cliente])
            ->andFilterWhere(['like', 'contacto_cliente', $this->contacto_cliente])
            ->andFilterWhere(['like', 'telefono_contacto_cliente', $this->telefono_contacto_cliente])
            ->andFilterWhere(['like', 'observaciones_cliente', $this->observaciones_cliente]);

        return $dataProvider;
    }
}
