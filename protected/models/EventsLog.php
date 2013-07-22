<?php

/**
 * This is the model class for table "events_log".
 *
 * The followings are the available columns in table 'events_log':
 * @property string $id
 * @property integer $event
 * @property string $event_time
 * @property string $user
 * @property string $id_aux
 * @property string $s_comment
 * @property integer $eve_group
 * @property string $ip
 */
class EventsLog extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return EventsLog the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'events_log';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('event_time', 'required'),
			array('event, eve_group', 'numerical', 'integerOnly'=>true),
			array('user, id_aux', 'length', 'max'=>10),
			array('s_comment', 'length', 'max'=>255),
			array('ip', 'length', 'max'=>15),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, event, event_time, user, id_aux, s_comment, eve_group, ip', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'event' => 'Event',
			'event_time' => 'Event Time',
			'user' => 'User',
			'id_aux' => 'Id Aux',
			's_comment' => 'Comment',
			'eve_group' => 'Event Group',
			'ip' => 'Ip',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('event',$this->event);
		$criteria->compare('event_time',$this->event_time,true);
		$criteria->compare('user',$this->user,true);
		$criteria->compare('id_aux',$this->id_aux,true);
		$criteria->compare('s_comment',$this->s_comment,true);
		$criteria->compare('eve_group',$this->eve_group);
		$criteria->compare('ip',$this->ip,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function beforeSave()
	{
		
		if (parent::beforeSave())
		{
			$this->event_time = date('Y-m-d', strtotime($this->event_time));
						
			return true;
		}
	}

	protected function afterFind()
	{
		$date = date('Y-m-d', strtotime($this->event_time));
		$this->event_time = $date;

		parent::afterFind();
	}

}