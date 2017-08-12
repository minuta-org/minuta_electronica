<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TblBarrios;

/**
 * TblBarriosSearch represents the model behind the search form about `app\models\TblBarrios`.
 */
class TblBarriosSearch extends TblBarrios
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_barrio', 'id_municipio_fk'], 'integer'],
            [['nombre_barrio', 'codigo_barrio'], 'safe'],
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
        $query = TblBarrios::find();

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
            'id_barrio' => $this->id_barrio,
            'id_municipio_fk' => $this->id_municipio_fk,
        ]);

        $query->andFilterWhere(['like', 'nombre_barrio', $this->nombre_barrio])
            ->andFilterWhere(['like', 'codigo_barrio', $this->codigo_barrio]);

        return $dataProvider;
    }
}
