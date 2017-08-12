<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TblMunicipios;

/**
 * TblMunicipiosSearch represents the model behind the search form about `app\models\TblMunicipios`.
 */
class TblMunicipiosSearch extends TblMunicipios
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_municipio', 'id_departamento_fk'], 'integer'],
            [['codigo_municipio', 'nombre_municipio'], 'safe'],
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
        $query = TblMunicipios::find();

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
            'id_municipio' => $this->id_municipio,
            'id_departamento_fk' => $this->id_departamento_fk,
        ]);

        $query->andFilterWhere(['like', 'codigo_municipio', $this->codigo_municipio])
            ->andFilterWhere(['like', 'nombre_municipio', $this->nombre_municipio]);

        return $dataProvider;
    }
}
