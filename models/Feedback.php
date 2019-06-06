<?php

namespace artsoft\feedback\models;

use Yii;
use artsoft\models\OwnerAccess;
use artsoft\models\User;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;   
use artsoft\db\ActiveRecord;

/**
 * This is the model class for table "{{%feedback}}".
 *
 * @property int $id
 * @property string $username
 * @property string $business
 * @property string $content
 * @property int $published_at 
 * @property int $status
 * @property int $main_flag
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $created_by
 * @property integer $updated_by
 */
class Feedback extends ActiveRecord implements OwnerAccess 
{
    const STATUS_PENDING = 0;
    const STATUS_PUBLISHED = 1;
    const MAIN_ON = 1;
    const MAIN_OFF = 0;
    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%feedback}}';
    }

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        if ($this->isNewRecord && $this->className() == Feedback::className()) {
            $this->published_at = time();
        }     
    }
     public function behaviors()
    {
        return [
            TimestampBehavior::className(),
            BlameableBehavior::className(),
            ];
    }
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'business', 'content', 'status'], 'required'],
            [['content'], 'string'],
            [['status', 'main_flag'], 'integer'],
            [['username', 'business'], 'string', 'max' => 127],
            ['published_at', 'date', 'timestampAttribute' => 'published_at', 'format' => 'yyyy-MM-dd'],
            ['published_at', 'default', 'value' => time()],
            [['created_at', 'updated_at', 'created_by', 'updated_by'], 'safe'],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['updated_by' => 'id']],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
        
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('art', 'ID'),
            'username' => Yii::t('art', 'Username'),
            'business' => Yii::t('art/feedback', 'Business'),
            'content' => Yii::t('art', 'Content'),
            'published_at' => Yii::t('art', 'Published'),
            'status' => Yii::t('art', 'Status'),
            'main_flag' => Yii::t('art/feedback', 'Main On'),
            'created_at' => Yii::t('art', 'Created'),
            'updated_at' => Yii::t('art', 'Updated'),
            'created_by' => Yii::t('art', 'Created By'),
            'updated_by' => Yii::t('art', 'Updated By'),
        ];
    }
     public function getPublishedDate()
    {
        return Yii::$app->formatter->asDate(($this->isNewRecord) ? time() : $this->published_at);
    }

    public function getCreatedDate()
    {
        return Yii::$app->formatter->asDate(($this->isNewRecord) ? time() : $this->created_at);
    }

    public function getUpdatedDate()
    {
        return Yii::$app->formatter->asDate(($this->isNewRecord) ? time() : $this->updated_at);
    }

    public function getPublishedTime()
    {
        return Yii::$app->formatter->asTime(($this->isNewRecord) ? time() : $this->published_at);
    }

    public function getCreatedTime()
    {
        return Yii::$app->formatter->asTime(($this->isNewRecord) ? time() : $this->created_at);
    }

    public function getUpdatedTime()
    {
        return Yii::$app->formatter->asTime(($this->isNewRecord) ? time() : $this->updated_at);
    }

    public function getPublishedDatetime()
    {
        return "{$this->publishedDate} {$this->publishedTime}";
    }

    public function getCreatedDatetime()
    {
        return "{$this->createdDate} {$this->createdTime}";
    }

    public function getUpdatedDatetime()
    {
        return "{$this->updatedDate} {$this->updatedTime}";
    }

     public function getUpdatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'updated_by']);
    }
    
    public function getStatusText()
    {
        return $this->getStatusList()[$this->status];
    }
   /**
     * getTypeList
     * @return array
     */
    public static function getStatusList()
    {
        return [
            self::STATUS_PENDING => Yii::t('art', 'Pending'),
            self::STATUS_PUBLISHED => Yii::t('art', 'Published'),
        ];
    }
   /**
     * getStatusOptionsList
     * @return array
     */
    public static function getStatusOptionsList()
    {
        return [
            [self::STATUS_PENDING, Yii::t('art', 'Pending'), 'default'],
            [self::STATUS_PUBLISHED, Yii::t('art', 'Published'), 'primary']
        ];
    }
     public static function getMainOptionsList()
    {
        return [
            [self::MAIN_ON, Yii::t('art/feedback', 'On'), 'primary'],
            [self::MAIN_OFF, Yii::t('art/feedback', 'Off'), 'default']
        ];
    }
     /**
     *
     * @inheritdoc
     */
    public static function getCarouselOption()
    {
    return [
            'items' => 1,
            'single_item' => true,
            'navigation' => false,
            'pagination' => false,
            'transition_style' => 'fade',
            'auto_play' => '9000',           
            ];
    }

    /**
     *
     * @inheritdoc
     */
    public static function getFullAccessPermission()
    {
        return 'fullFeedbackAccess';
    }
    /**
     *
     * @inheritdoc
     */
    public static function getOwnerField()
    {
        return 'created_by';
    }
    /**
     * 
     */
    public static function getFeedbackList() {
        
    return self::find()                
                ->where(['status' => self::STATUS_PUBLISHED, 'main_flag' => self::MAIN_ON])                
                ->indexBy('id')
                ->asArray()->all();        
    
     }
}
