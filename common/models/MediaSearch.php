<?php
/**
 * @Author: cnzhihua
 * @Date: 2018-05-09 23:44
 * @Github: https://github.com/Hzhihua
 */

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * MediaSearch represents the model behind the search form of `common\models\Media`.
 */
class MediaSearch extends Media
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'size', 'created_at'], 'integer'],
            [['picture_url', 'new_name', 'origin_name', 'new_directory', 'extension', 'type', 'file_key'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Media::find();

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
            'id' => $this->id,
            'size' => $this->size,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'picture_url', $this->picture_url])
            ->andFilterWhere(['like', 'new_name', $this->new_name])
            ->andFilterWhere(['like', 'origin_name', $this->origin_name])
            ->andFilterWhere(['like', 'new_directory', $this->new_directory])
            ->andFilterWhere(['like', 'extension', $this->extension])
            ->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'file_key', $this->file_key]);

        return $dataProvider;
    }
}
