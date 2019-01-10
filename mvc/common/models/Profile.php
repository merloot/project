<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "Profile".
 *
 * @property int $p_id
 * @property int $u_id
 * @property string $p_image
 * @property string $p_date
 */
class Profile extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Profile';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['p_id', 'u_id'], 'required'],
            [['p_id', 'u_id'], 'integer'],
            [['p_date'], 'safe'],
            [['p_image'], 'string', 'max' => 100],
            [['p_id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'p_id' => 'P ID',
            'u_id' => 'U ID',
            'p_image' => 'Аватарка',
            'p_date' => 'Дата рождения',
        ];
    }
}
