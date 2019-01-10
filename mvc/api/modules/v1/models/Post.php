<?php

namespace api\modules\v1\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\UploadedFile;



/**
 * This is the model class for table "Post".
 *
 * @property int $id_post
 * @property int $id_autor
 * @property int $id_categorie
 * @property string $title
 * @property string $secondtitle
 * @property string $image
 * @property string $text
 * @property int $views
 * @property int $rating
 * @property string $pubdate
 * @property bool $id_status
 */
class Post extends ActiveRecord
{
    public $file;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Post';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_categorie', 'title', 'secondtitle'], 'required'],
            [['id_autor', 'id_categorie', 'views', 'rating'], 'integer'],
            [['text'], 'string'],
            [['pubdate'], 'safe'],
            [['id_status'], 'boolean'],
            [['title', 'secondtitle'], 'string', 'max' => 150],
            [['image'], 'string', 'max' => 255],
            [['file'],'image'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_post' => 'Id поста',
            'id_autor' => 'Id автора',
            'id_categorie' => 'Id категории',
            'title' => 'Заголовок',
            'secondtitle' => 'Описание',
            'image' => 'Картинка',
            'text' => 'Текст',
            'views' => 'Просмотры',
            'rating' => 'Рейтинг',
            'pubdate' => 'Дата публикации',
            'id_status' => 'Cтатус проверки',
        ];
    }

//    public function behaviors()
//    {
//        return
//            [
//                'timestampBehavior'=>[
//                'class'=>TimestampBehavior::className(),
//                'createdAtAttribute'=>'pubdate',
//                    'updatedAtAttribute'=>'pubdate',
//                'value'=>new Expression('NOW ()'),
//            ],
//        ];
//    }
    public function getAuthor()
    {
        return $this->hasOne(User::className(),['id'=>'id_autor']);
    }

    public function beforeSave($insert)
    {
        if ($file = UploadedFile::getInstance($this,'file'))
        {
            $dir = Yii::getAlias('@images').'/post/';
            if (file_exists($dir.$this->image))
            {
                unlink($dir.$this->image);
            }
            if (file_exists($dir.'50x50/'. $this->image))
            {
                unlink($dir.'50x50'.$this->image);
            }
            if (file_exists($dir.'800x/'. $this->image))
            {
                unlink($dir.'800x'.$this->image);
            }
            $this->image = strtotime('now').'_'.Yii::$app->getSecurity()->generateRandomString(6) . '.' . $file->extension;
            $file->saveAs($dir.$this->image);
            $imag = Yii::$app->image->load($dir.$this->image);
            $imag->background('#fff',0);
            $imag->resize('50','50', Yii\image\drivers\Image::INVERSE);
            $imag->crop('50','50');
            $imag->save($dir.'50x50/'.$this->image,90);
            $imag = Yii::$app->image->load($dir.$this->image);
            $imag->background('#fff',0);
            $imag->resize('800',null, Yii\image\drivers\Image::INVERSE);
            $imag->save($dir.'800x/'.$this->image,90);
        }
        return parent::beforeSave($insert);
    }
//    public function beforeSave($insert)
//    {
//        if(parent::beforeSave($insert))
//        {
//            if($this->isNewRecord)
//            {
//
//                if (!empty($this->id_auth)) {
//                    $this->id_auth=Yii::$app->user->id;
//                }
//
//            }
//
//            return parent::beforeSave($insert);
//        }
//
//    }
}