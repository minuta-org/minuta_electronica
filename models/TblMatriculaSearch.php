<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TblMatricula;

/**
 * TblMatriculaSearch represents the model behind the search form about `app\models\TblMatricula`.
 */
class TblMatriculaSearch extends TblMatricula
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_matricula', 'id_barrio_fk'], 'integer'],
            [['nit_matricula', 'dv_matricula', 'razon_social_matricula', 'sigla_matricula', 'primer_nombre_matricula', 'segundo_nombre_matricula', 'primer_apellido_matricula', 'segundo_apellido_matricula', 'email_matricula', 'telefono_matricula', 'direccion_matricula', 'celular_matricula', 'pagina_web'], 'safe'],
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
        $query = TblMatricula::find();

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
            'id_matricula' => $this->id_matricula,
            'id_barrio_fk' => $this->id_barrio_fk,
        ]);

        $query->andFilterWhere(['like', 'nit_matricula', $this->nit_matricula])
            ->andFilterWhere(['like', 'dv_matricula', $this->dv_matricula])
            ->andFilterWhere(['like', 'razon_social_matricula', $this->razon_social_matricula])
            ->andFilterWhere(['like', 'sigla_matricula', $this->sigla_matricula])
            ->andFilterWhere(['like', 'primer_nombre_matricula', $this->primer_nombre_matricula])
            ->andFilterWhere(['like', 'segundo_nombre_matricula', $this->segundo_nombre_matricula])
            ->andFilterWhere(['like', 'primer_apellido_matricula', $this->primer_apellido_matricula])
            ->andFilterWhere(['like', 'segundo_apellido_matricula', $this->segundo_apellido_matricula])
            ->andFilterWhere(['like', 'email_matricula', $this->email_matricula])
            ->andFilterWhere(['like', 'telefono_matricula', $this->telefono_matricula])
            ->andFilterWhere(['like', 'direccion_matricula', $this->direccion_matricula])
            ->andFilterWhere(['like', 'celular_matricula', $this->celular_matricula])
            ->andFilterWhere(['like', 'pagina_web', $this->pagina_web]);

        return $dataProvider;
    }
}
