<?php

/**
 * The followings are the available columns in table 'tbl_user':
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $email
 * @property string $profile
 */
class Department extends BBaseModel
{
	 public $oldpassword;
	/**
	 * Returns the static model of the specified AR class.
	 * @return static the static model class
	 */
	  public function getDbConnection() {       
        return Yii::app()->db2;  
    }
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
    
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{department}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('username, password','required'),
			array('username, password', 'length', 'max'=>128),
			array('profile', 'safe'),
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
			'id' => 'Id',
			'username' => 'Username',
			'password' => 'Password',
		);
	}


   /**
	 * 
	 * 删除数据
	 * @param unknown_type $table 表名 
	 * @param unknown_type $filed 主键名称
	 * @param unknown_type $id  id数值
	 */
	  static  public  function del($table,$filed,$id){
	
	  return Yii::app()->db->createCommand()->delete($table, $filed.'=:id', array(':id'=>$id));
	
	}

/**
	  * 
	  * 多条数据查询
	  * @param unknown_type $model  数据模型
	  * @param unknown_type $field  主键id
	  * @param unknown_type $id 数值
	  * @param unknown_type $condition  查询条件
	  * @param unknown_type $order 排序
	  * @param unknown_type $with  关联表名称 
	  * @param unknown_type $pageSize  查询每页数量
	  */
	 static public  function find_all($model,$condition,$order,$with='',$pageSize){
	
	    $model = new $model(); 
        $criteria = new CDbCriteria();
        $criteria->condition = $condition;
        $criteria->order = $order; 
        if($with!=""){  
          $criteria->with = array ( $join );
        }
        $count = $model->count( $criteria );
        $pages = new CPagination( $count );
        $pages->pageSize = $pageSize;
        $pageParams = array();
       // $pages->params = is_array( $pageParams ) ? $pageParams : array ();
        $criteria->limit = $pages->pageSize;
        $criteria->offset = $pages->currentPage * $pages->pageSize;
        $result = $model->findAll( $criteria );
        return array('datalist'=>$result,'pagebar'=>$pages,'count'=>$count);
	}
    /**
	 * 
	 * Enter 更新数据
	 * @param unknown_type $table 表名
	 * @param unknown_type $info 要更新得数据数组
	 * @param unknown_type $id   id数值
	 * @param unknown_type $field 主键名称
	 */
	 static public  function update_all($table,$info,$id,$field){
	
	return Yii::app()->db->createCommand()->update($table, $info, $field.'=:id',array(':id'=>$id));
	}
   /**
	 * 
	 *插入数据
	 * @param unknown_type $table  表名
	 * @param unknown_type $info   要更新得数据数组
	 */
	 static public  function add_insert($table,$info){
	
	   return  Yii::app()->db->createCommand()->insert($table, $info);
	
	}
 
	/**
	 * 
	 * 单条查询.
	 * @param unknown_type $table  表名
	 * @param unknown_type $field  主键id
	 * @param unknown_type $id      ID数值
	 */
	
	 static function find_one($table,$field,$id){
	
	   $row = Yii::app()->db->createCommand()->from($table)->where($field.'=:id',array(':id'=>$id))->queryRow();
	   return $row;
	
	} 
	
}
