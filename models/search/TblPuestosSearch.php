<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TblPuestos;

/**
 * TblPuestosSearch represents the model behind the search form about `app\models\TblPuestos`.
 */
class TblPuestosSearch extends TblPuestos
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_puesto', 'id_barrio_fk', 'id_zona_fk', 'id_cliente_fk'], 'integer'],
            [['nombre_puesto', 'direccion_puesto', 'telefono_puesto', 'contacto_puesto', 'celular_contacto_puesto'], 'safe'],
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
        $query = TblPuestos::find();

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
            'id_puesto' => $this->id_puesto,
            'id_barrio_fk' => $this->id_barrio_fk,
            'id_zona_fk' => $this->id_zona_fk,
            'id_cliente_fk' => $this->id_cliente_fk,
        ]);

        $query->andFilterWhere(['like', 'nombre_puesto', $this->nombre_puesto])
            ->andFilterWhere(['like', 'direccion_puesto', $this->direccion_puesto])
            ->andFilterWhere(['like', 'telefono_puesto', $this->telefono_puesto])
            ->andFilterWhere(['like', 'contacto_puesto', $this->contacto_puesto])
            ->andFilterWhere(['like', 'celular_contacto_puesto', $this->celular_contacto_puesto])
            ->orderBy(['id_puesto' => SORT_DESC]);

        return $dataProvider;
    }
}
