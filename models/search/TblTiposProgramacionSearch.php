<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TblTiposProgramacion;

/**
 * TblTiposProgramacionSearch represents the model behind the search form about `app\models\TblTiposProgramacion`.
 */
class TblTiposProgramacionSearch extends TblTiposProgramacion
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_tipo_programacion', 'intervalo_tipo_programacion'], 'integer'],
            [['nombre_tipo_programacion', 'descripcion_tipo_programacion'], 'safe'],
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
        $query = TblTiposProgramacion::find();

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
            'id_tipo_programacion' => $this->id_tipo_programacion,
            'intervalo_tipo_programacion' => $this->intervalo_tipo_programacion,
        ]);

        $query->andFilterWhere(['like', 'nombre_tipo_programacion', $this->nombre_tipo_programacion])
            ->andFilterWhere(['like', 'descripcion_tipo_programacion', $this->descripcion_tipo_programacion]);

        return $dataProvider;
    }
}
