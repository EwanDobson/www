<?php

/**
 * This is the model class for table "tbl_project".
 *
 * The followings are the available columns in table 'tbl_project':
 * @property integer $projectId
 * @property string $start
 * @property string $end
 * @property string $title
 * @property string $description
 * @property string $modified
 * @property string $status
 */
class TblProject extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_project';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, status, description', 'required'),
			array('title', 'length', 'max'=>128),
			//array('description', 'length', 'max'=>256),
			array('status', 'length', 'max'=>64),
			array('start, end', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('projectId, start, end, title, description, modified, status', 'safe', 'on'=>'search'),
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
			'projectId' => 'Project',
			'start' => 'Start',
			'end' => 'End',
			'title' => 'Title',
			'description' => 'Description',
			'modified' => 'Modified',
			'status' => 'Status',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('projectId',$this->projectId);
		$criteria->compare('start',$this->start,true);
		$criteria->compare('end',$this->end,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('modified',$this->modified,true);
		$criteria->compare('status',$this->status,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TblProject the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
