<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TblSectoresComerciales;

/**
 * TblSectoresComercialesSearch represents the model behind the search form about `app\models\TblSectoresComerciales`.
 */
class TblSectoresComercialesSearch extends TblSectoresComerciales
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_sector_comercial'], 'integer'],
            [['nombre_sector_comercial'], 'safe'],
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
        $query = TblSectoresComerciales::find();

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
            'id_sector_comercial' => $this->id_sector_comercial,
        ]);

        $query->andFilterWhere(['like', 'nombre_sector_comercial', $this->nombre_sector_comercial]);

        return $dataProvider;
    }
}
