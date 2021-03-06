<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\behaviors\TimestampBehavior;
use common\models\queries\TagQuery;
use core\db\ActiveRecord;

/**
 * tag 表
 *
 * @property integer $id 
 * @property string $title 
 * @property string $description
 * @property string $created_at 
 * @property string $updated_at 
 * 
 */
class Tag extends ActiveRecord
{

    const CACHE_TAG_ALL = 'tags';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%tag}}';
    }


    /**
     * @inheritdoc
     * 
     * @return ActiveQuery
     */
    public static function find()
    {
        return Yii::createObject(TagQuery::class, [ get_called_class()]);
    }



    /**
     * {@inheritdoc}
     * @return string
     */
    public function formName()
    {
        return 'tag';
    }


    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return array_merge(parent::behaviors(), [
            'timestamp' => TimestampBehavior::className(),
        ]);
    }


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['title'], 'string', 'length' => [1,255]],
            [['title'], 'unique', 'when' => function($model, $attribute) {
                return $model->isAttributeChanged($attribute);
            }],
            [['description'], 'string'],
        ];
    }



    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id'          => 'ID',
            'title'       => Yii::t('all', 'Tag name'),
            'description' => Yii::t('all', 'Tag description'),
            'created_at'  => Yii::t('all', 'Created time'),
            'updated_at'  => Yii::t('all', 'Updated time'),
        ];
    }


    public static function all()
    {
        return static::find()
           -> tagCache(static::CACHE_TAG_ALL)
           -> all();
    }

    public static function hashOptions()
    {
        $all = static::all();
        return ArrayHelper::map($all, 'id', 'title');
    }

    public function invalidateCache()
    {
        static::invalidateTag([
            static::CACHE_TAG_ALL,
        ]);
    }

    public function getHtmlClass()
    {
        $integer = crc32($this->title) % 5;
        $classNames = [
            'label-danger',
            'label-warning',
            'label-info',
            'label-primary',
            'label-success',
        ];
        $class = $classNames[$integer];
        return 'tag label ' . $class;
    }


    /**
     * 获取 post_tag 表的关联
     */
    public function getPostTags()
    {
        return $this->hasMany(PostTag::className(), ['tag_id' => 'id'])->inverseOf('tag');
    }


    /**
     * 获取 post 关联
     */
    public function getPosts()
    {
        return $this->hasMany(Post::className(), ['id' => 'post_id'])
                    ->via('postTags');
    }

    
}