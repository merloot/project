<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Post;

/**
 * PostSearch represents the model behind the search form of `common\models\Post`.
 */
class PostSearch extends Post
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_post', 'id_autor', 'id_categorie', 'views', 'rating'], 'integer'],
            [['title', 'secondtitle', 'image', 'text', 'pubdate'], 'safe'],
            [['id_status'], 'boolean'],
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
        $query = Post::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination'=>[
                'pageSize'=>10,
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id_post' => $this->id_post,
            'id_autor' => $this->id_autor,
            'id_categorie' => $this->id_categorie,
            'views' => $this->views,
            'rating' => $this->rating,
            'pubdate' => $this->pubdate,
            'id_status' => $this->id_status,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'secondtitle', $this->secondtitle])
            ->andFilterWhere(['like', 'image', $this->image])
            ->andFilterWhere(['like', 'text', $this->text]);

        return $dataProvider;
    }
}
