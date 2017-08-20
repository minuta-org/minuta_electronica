<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TblSupervisores;

/**
 * TblSupervisoresSearch represents the model behind the search form about `app\models\TblSupervisores`.
 */
class TblSupervisoresSearch extends TblSupervisores
{
    public $nombreCompleto;
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_supervisor', 'id_tipo_documento_fk', 'id_barrio_fk', 'id_matricula_fk'], 'integer'],
            [['nombreCompleto', 'codigo_supervisor', 'documento_supervisor', 'primer_nombre_supervisor', 'segundo_nombre_supervisor', 'primer_apellido_supervisor', 'segundo_apellido_supervisor', 'telefono_supervisor', 'celular_supervisor', 'email_supervisor', 'direccion_supervisor'], 'safe'],
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
        $query = TblSupervisores::find();

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
            'id_supervisor' => $this->id_supervisor,
            'codigo_supervisor' => $this->codigo_supervisor,
            'id_tipo_documento_fk' => $this->id_tipo_documento_fk,
            'id_barrio_fk' => $this->id_barrio_fk,
            'id_matricula_fk' => $this->id_matricula_fk,
        ]);
        
        $query->andFilterWhere(['like', 'codigo_supervisor', $this->codigo_supervisor])            
            ->andFilterWhere(['like', 'documento_supervisor', $this->documento_supervisor])
            ->andFilterWhere(['like', 'primer_nombre_supervisor', $this->primer_nombre_supervisor])
            ->andFilterWhere(['like', 'segundo_nombre_supervisor', $this->segundo_nombre_supervisor])
            ->andFilterWhere(['like', 'primer_apellido_supervisor', $this->primer_apellido_supervisor])
            ->andFilterWhere(['like', 'segundo_apellido_supervisor', $this->segundo_apellido_supervisor])
            ->andFilterWhere(['like', 'telefono_supervisor', $this->telefono_supervisor])
            ->andFilterWhere(['like', 'celular_supervisor', $this->celular_supervisor])
            ->andFilterWhere(['like', 'email_supervisor', $this->email_supervisor])
            ->andFilterWhere(['like', 'direccion_supervisor', $this->direccion_supervisor]);
        $query->orderBy(['id_supervisor' => SORT_DESC]);
        
        # ToDo: Corregir filtros.
        if(count($_POST) > 0){
            $nombreCompleto = $_POST['TblSupervisoresSearch']['nombreCompleto'];
            $query->andFilterWhere(['like', "CONCAT_WS(' ', primer_nombre_supervisor, segundo_nombre_supervisor, primer_apellido_supervisor, segundo_apellido_supervisor)", $nombreCompleto]);
        }
        return $dataProvider;
    }
}
