<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TblRecursos;

/**
 * TblRecursosSearch represents the model behind the search form about `app\models\TblRecursos`.
 */
class TblRecursosSearch extends TblRecursos
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_recurso', 'id_tipo_documento_fk', 'id_barrio_fk', 'estado_recurso'], 'integer'],
            [['codigo_recurso', 'documento_recurso', 'primer_nombre_recurso', 'segundo_nombre_recurso', 'primer_apellido_recurso', 'segundo_apellido_recurso', 'email_recurso', 'direccion_recurso', 'telefono_recurso', 'celular_recurso'], 'safe'],
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
        $query = TblRecursos::find();

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
            'id_recurso' => $this->id_recurso,
            'id_tipo_documento_fk' => $this->id_tipo_documento_fk,
            'id_barrio_fk' => $this->id_barrio_fk,
            'estado_recurso' => $this->estado_recurso,
        ]);

        $query->andFilterWhere(['like', 'codigo_recurso', $this->codigo_recurso])
            ->andFilterWhere(['like', 'documento_recurso', $this->documento_recurso])
            ->andFilterWhere(['like', 'primer_nombre_recurso', $this->primer_nombre_recurso])
            ->andFilterWhere(['like', 'segundo_nombre_recurso', $this->segundo_nombre_recurso])
            ->andFilterWhere(['like', 'primer_apellido_recurso', $this->primer_apellido_recurso])
            ->andFilterWhere(['like', 'segundo_apellido_recurso', $this->segundo_apellido_recurso])
            ->andFilterWhere(['like', 'email_recurso', $this->email_recurso])
            ->andFilterWhere(['like', 'direccion_recurso', $this->direccion_recurso])
            ->andFilterWhere(['like', 'telefono_recurso', $this->telefono_recurso])
            ->andFilterWhere(['like', 'celular_recurso', $this->celular_recurso]);

        return $dataProvider;
    }
}
