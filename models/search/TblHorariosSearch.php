<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TblHorarios;

/**
 * TblHorariosSearch represents the model behind the search form about `app\models\TblHorarios`.
 */
class TblHorariosSearch extends TblHorarios
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_horario'], 'integer'],
            [['nombre_horario', 'inicio_horario', 'finaliza_horario'], 'safe'],
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
        $query = TblHorarios::find();

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
            'id_horario' => $this->id_horario,
            'inicio_horario' => $this->inicio_horario,
            'finaliza_horario' => $this->finaliza_horario,
        ]);

        $query->andFilterWhere(['like', 'nombre_horario', $this->nombre_horario]);

        return $dataProvider;
    }
}
