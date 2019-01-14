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
        if(!parent::beforeSave($insert)) {
            return false;
        }

        if (UploadedFile::getInstance($this, 'image')) {
            if (!$insert) {
                @unlink(Yii::getAlias('@images') . '' . $this->getOldAttribute('image'));
            }

            $image = UploadedFile::getInstance($this, 'image');
            $imageName = md5(date("Y-m-d H:i:s"));
            $pathImage = Yii::getAlias('@images') . ''
                . '/'
                . $imageName
                . '.'
                . $image->getExtension();

            $this->image =  $imageName .  '.' . $image->getExtension();
            $image->saveAs($pathImage);
//            $image = Yii::$app->image->load->$imageName($this->po_image);
//            $image->resize('50','50', Yii\image\drivers\Image::INVERSE);
//            $image->crope('50','50');
//            $image->save($pathImage.$this->po_image);


        } else {
            $this->image = $this->getOldAttribute('image');
        }

        return true;
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