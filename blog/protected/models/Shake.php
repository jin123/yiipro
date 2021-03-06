<?php

/**
 * The followings are the available columns in table 'tbl_user':
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $email
 * @property string $profile
 */
class Shake extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return static the static model class
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
		return '{{user}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('username, password, email', 'required'),
			array('username, password, email', 'length', 'max'=>128),
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
			'posts' => array(self::HAS_MANY, 'Post', 'author_id'),
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
			'email' => 'Email',
			'profile' => 'Profile',
		);
	}

	/**
	 * Checks if the given password is correct.
	 * @param string the password to be validated
	 * @return boolean whether the password is valid
	 */
	public function validatePassword($password)
	{
		return CPasswordHelper::verifyPassword($password,$this->password);
	}

	/**
	 * Generates the password hash.
	 * @param string password
	 * @return string hash
	 */
	public function hashPassword($password)
	{
		return CPasswordHelper::hashPassword($password);
	}
	 public function addStrength($strength, $shakeid, $wechater)
    {
	
        $map['shakeid'] = $shakeid;
        $map['wechater'] = $wechater;
		$where_dur['shakeid']=$shakeid;
		$list_dur=M('Shake')->where($where_dur)->find();
		$duration=$list_dur['duration'];
        // $map['start_time'] = $start_time;
        if ($id = M('ShakeParter')->where($map)->getField('id')) {
            unset($map);
            $map['id'] = $id;
			$list_strength=M('ShakeParter')->order('strength desc')->find();
			$strengthlog=$list_strength['strength'];
			if($strengthlog>=$duration){
				return false;
			}else{
				if (M('ShakeParter')->where($map)->setInc('strength', $strength)) {
					return true;
				} else {
					return false;
				}
			}
        } else {
			$list_strength=M('ShakeParter')->order('strength desc')->find();
			$strengthlog=$list_strength['strength'];
			if($strengthlog>=$duration){
				return false;
			}else{
				$data = $map;
				$data['strength'] = $strength;
				if (M('ShakeParter')->add($data)) {
					return true;
				} else {
					return false;
				}
			}
        }
    }
	
}
