<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TblProgramacionSupervisores;

/**
 * TblProgramacionSupervisoresSearch represents the model behind the search form about `app\models\TblProgramacionSupervisores`.
 */
class TblProgramacionSupervisoresSearch extends TblProgramacionSupervisores
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_programacion_supervisor', 'id_supervisor_fk', 'id_horario_fk', 'id_tipo_programacion_fk'], 'integer'],
            [['fecha_inicio_programacion_supervisor', 'fecha_fin_programacion_supervisor'], 'safe'],
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
        $query = TblProgramacionSupervisores::find();

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
            'id_programacion_supervisor' => $this->id_programacion_supervisor,
            'id_supervisor_fk' => $this->id_supervisor_fk,
            'id_horario_fk' => $this->id_horario_fk,
            'fecha_inicio_programacion_supervisor' => $this->fecha_inicio_programacion_supervisor,
            'fecha_fin_programacion_supervisor' => $this->fecha_fin_programacion_supervisor,
            'id_tipo_programacion_fk' => $this->id_tipo_programacion_fk,
        ]);

	$query->orderBy(['id_programacion_supervisor' => SORT_DESC]);
        return $dataProvider;
    }
}
