<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TblZonas;

/**
 * TblZonasSearch represents the model behind the search form about `app\models\TblZonas`.
 */
class TblZonasSearch extends TblZonas
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_zona', 'id_cuadrante_fk'], 'integer'],
            [['nombre_zona'], 'safe'],
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
        $query = TblZonas::find();

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
            'id_zona' => $this->id_zona,
            'id_cuadrante_fk' => $this->id_cuadrante_fk,
        ]);

        $query->andFilterWhere(['like', 'nombre_zona', $this->nombre_zona]);

        return $dataProvider;
    }
}
