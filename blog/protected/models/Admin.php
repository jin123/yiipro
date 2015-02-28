<?php

class Admin extends CActiveRecord
{
	/**
	 * The followings are the available columns in table 'tbl_user':
	 * @var integer $id
	 * @var string $username
	 * @var string $password
	 * @var string $email
	 * @var string $profile
	 */

	/**
	 * Returns the static model of the specified AR class.
	 * @return CActiveRecord the static model class
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
		return '{{admin}}';
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
	        'admin_role'=>array(self::BELONGS_TO, 'Admin_role', 'roleid', 'alias'=>'admin_role', 'select'=>'roleid,rolename'),
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
		return crypt($password,$this->password)===$this->password;
	}

	/**
	 * Generates the password hash.
	 * @param string password
	 * @return string hash
	 */
	public function hashPassword($password)
	{
		return crypt($password, $this->generateSalt());
	}

	/**
	 * Generates a salt that can be used to generate a password hash.
	 *
	 * The {@link http://php.net/manual/en/function.crypt.php PHP `crypt()` built-in function}
	 * requires, for the Blowfish hash algorithm, a salt string in a specific format:
	 *  - "$2a$"
	 *  - a two digit cost parameter
	 *  - "$"
	 *  - 22 characters from the alphabet "./0-9A-Za-z".
	 *
	 * @param int cost parameter for Blowfish hash algorithm
	 * @return string the salt
	 */
	protected function generateSalt($cost=10)
	{
		if(!is_numeric($cost)||$cost<4||$cost>31){
			throw new CException(Yii::t('Cost parameter must be between 4 and 31.'));
		}
		// Get some pseudo-random data from mt_rand().
		$rand='';
		for($i=0;$i<8;++$i)
			$rand.=pack('S',mt_rand(0,0xffff));
		// Add the microtime for a little more entropy.
		$rand.=microtime();
		// Mix the bits cryptographically.
		$rand=sha1($rand,true);
		// Form the prefix that specifies hash algorithm type and cost parameter.
		$salt='$2a$'.str_pad((int)$cost,2,'0',STR_PAD_RIGHT).'$';
		// Append the random salt string in the required base64 format.
		$salt.=strtr(substr(base64_encode($rand),0,22),array('+'=>'.'));
		return $salt;
	}
	
	/**
	 * 
	 */
	
	
	 public  function get_tree($menuid){
	     $parent = $this->get_exends_menu(0,0);
	     $tr = '';
	     foreach ($parent as $key=>$value){
	           $tr.= $this->design_tree('-1',$value,$menuid);
               $first = $this->get_exends_menu($value['id'],0);
               foreach($first as $v1){
                  $tr.= $this->design_tree('0',$v1,$menuid);
                  $second = $this->get_exends_menu($v1['id'],0);
                  foreach($second as $v2){
                   $tr.= $this->design_tree('1',$v2,$menuid);
                    $three = $this->get_exends_menu($v2['id'],0);
                    foreach($three as $v3){                       
                              $tr.= $this->design_tree('2',$v3,$menuid);
                    }
                
                  }
               
               }
	     }
	     return $tr;
	     
	}
	public  function design_setting_tree($pid){
	
	     $parent = $this->get_exends_menu(0,0);
	     $options = '<option value="0">作为一级菜单</option>';
	  
	     foreach ($parent as $key=>$value){
	           $options.= $this->draw_tree('-1',$value,$pid);
               $first = $this->get_exends_menu($value['id'],0);
               foreach($first as $v1){
                  $options.= $this->draw_tree('0',$v1,$pid);
                  $second = $this->get_exends_menu($v1['id'],0);
                  foreach($second as $v2){
                   $options.= $this->draw_tree('1',$v2,$pid);
                  }
               
               }
              
	     }       
	   return  $options;
	}
	function draw_tree($rank,$val,$pid){
	  $id = $value['id'];
	  $icon =  array('&nbsp;&nbsp;└ &nbsp;&nbsp;','&nbsp;&nbsp;&nbsp;├ &nbsp;&nbsp;&nbsp;');
	  $listorder = $value['listorder'];
	  $spacer = $icon[$rank];
	  $selected = '';
	  if($pid==$val['id']){
	      $selected = 'selected="selected"';
	  
	  }
	  $options = '<option '.$selected.' value="'.$val['id'].'">'.$spacer.$val['name'].'</option>';
	  return  $options;
	}
	function design_tree($rank,$value,$menuid){
	  $id = $value['id'];
	  $icon =  array('&nbsp;&nbsp;&nbsp;└─  ','&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;└─ ','&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;├─ ');
	  $listorder = $value['listorder'];
	  if(isset($icon[$rank])){
	  
	  $spacer = $icon[$rank];
	  }
	  else{
	  
	    $spacer = 3;
	  
	  }
	  
	  $str_manage = '<a href="?r=Admin/Menu/add&parentid='.$id.'&menuid='.$menuid.'">添加</a> | <a href="?r=Admin/Menu/add&id='.$id.'&menuid='.$menuid.'">修改</a> | <a href="javascript:confirmurl(\'?r=Admin/Menu/delete&id='.$id.'&menuid='.$menuid.'\',\'确认删除\')">删除</a> ';       
	    $tr='<tr>
              <td align="center">
             <input class="input-text-c input-text" type="text" value="0" size="3" name="listorders[$id]">
             </td>
             <td align="center">'.$id.'</td>
             <td>'.$spacer.$value['name'].'</td>
             <td align="center">'.$str_manage.'</td></tr>';
	
	        return $tr;
	}
/**
	 * 按父ID查找菜单子项
	 * @param integer $parentid   父菜单ID  
	 * @param integer $with_self  是否包括他自己
	 */
	
	function get_exends_menu($parentid, $with_self){    
        return   self::admin_menu($parentid, $with_self);
	
	}
	 public static function admin_menu($parentid, $with_self = 0) {
         
         
         $tablePrefix = Yii::app()->db->tablePrefix;
	     $parentid = intval($parentid);
         $condition = '1';
         $condition.=" AND display=1";
         $condition.=" AND parentid=".$parentid;
         $result = self::find_all('Menu',$condition,'listorder ASC','',10);
         $array = array();
         foreach($result['datalist'] as $key=>$values){
         
           $array[] = $values->attributes;
         
         
         }
        
        $i = count($array);
        if($with_self==1){
           $post = self::find_one($tablePrefix.'menu','id',$parentid);
             $array[$i] = $post;
              sort($array);
        }
       
		return $array;
	}

	/**
	 * 
	 *插入数据
	 * @param unknown_type $table  表名
	 * @param unknown_type $info   要更新得数据数组
	 */
	final public static function add_insert($table,$info){
	
	   return  Yii::app()->db->createCommand()->insert($table, $info);
	
	}
	/**
	 * 
	 * Enter 更新数据
	 * @param unknown_type $table 表名
	 * @param unknown_type $info 要更新得数据数组
	 * @param unknown_type $id   id数值
	 * @param unknown_type $field 主键名称
	 */
	final public static function update_all($table,$info,$id,$field){
	
	return Yii::app()->db->createCommand()->update($table, $info, $field.'=:id',array(':id'=>$id));
	}
	
	/**
	 * 
	 * 删除数据
	 * @param unknown_type $table 表名 
	 * @param unknown_type $filed 主键名称
	 * @param unknown_type $id  id数值
	 */
	 final public static function del($table,$filed,$id){
	
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
	final public static function find_all($model,$condition,$order,$with='',$pageSize){
	
	    $model = new $model(); 
        $criteria = new CDbCriteria();
        $criteria->condition = $condition;
        $criteria->order = $order; 
        if($with!=""){  
          $criteria->with = array ( $join );
        }
        $count = $model->count( $criteria );
        $pages = new CPagination( $count );
        $pages->pageSize = 10;
        $pageParams = array();
        $pages->params = is_array( $pageParams ) ? $pageParams : array ();
        $criteria->limit = $pages->pageSize;
        $criteria->offset = $pages->currentPage * $pages->pageSize;
        
        $result = $model->findAll( $criteria );
        return array('datalist'=>$result,'pagebar'=>$pages,'count'=>$count);
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
	
	
	/**
	 * 获取菜单 头部菜单导航
	 * 
	 * @param $parentid 菜单id
	 */
	final public static function submenu($parentid = '', $big_menu = false,$index='') {
		$classname = '';
		if(empty($parentid)) {
			$menudb = new Menu();
			$c = Yii::app()->controller->id;  // controller
            $a = $index;
             $condition = '1';
            
            $a && $condition .= ' AND a = '.'"'.$a.'"';
            $c && $condition .= ' AND c = '.'"'.$c.'"';
            $criteria->condition = $condition;
            $result= Admin::find_all("Menu",$condition,'id desc','',1);
            $result  = $result[0];
           // var_dump($result);
            $model = new Menu();
            $criteria = new CDbCriteria();
            $condition = '1';
            
            $a && $condition .= ' AND a = '.'"'.$a.'"';
            $c && $condition .= ' AND c = '.'"'.$c.'"';
            $criteria->condition = $condition;
            
            $result = $model->find( $criteria );
           
			$parentid = $_GET['menuid'] = $result->id;
		}
		$array = self::admin_menu($parentid,1);
		
		$numbers = count($array);
		if($numbers==1 && !$big_menu) return '';
		$string = '';
		$pc_hash = '123456';
		foreach($array as $_value) {
			if($index==$_value['a']){
			   $string .= "<a href='javascript:;' class='on'><em>".$_value['name']."</em></a><span>|</span>";;
			
			}
			else{
			
			$string .= "<a href='?r=".$_value['m']."/".$_value['c']."/".$_value['a']."&menuid=$parentid&pc_hash=$pc_hash".'&'.$_value['data']."' $classname><em>".$_value['name']."</em></a><span>|</span>";

			}

			
		}
		$string = substr($string,0,-14);
		return $string;
	}
/**
	 * 当前位置
	 * 
	 * @param $id 菜单id
	 */
	final public static function current_pos($id) {
		$model = new Menu();
		//$r =$menudb->get_one(array('id'=>$id),'id,name,parentid');
		$r = Menu::model()->find('id=:id', array(':id'=>$id));
	
		$str = '';
		if($r->parentid) {
			$str = self::current_pos($r->parentid);
		}
		return $str.$r->name.' > ';
	}
	public function priv_tree($roleid){

	      $parent = $this->get_exends_menu(0,0);
	      
	      $tr = '';
	      foreach($parent as $value){
	      
	            $tr.=$this->design_priv_tree(0,$value,$roleid);
	           
	            $first =  $this->get_exends_menu($value['id'],0); 
	            foreach ($first as $v1){
	            
	               $tr.=$this->design_priv_tree(1,$v1,$roleid);
	             //  var_dump($tr);
	               $second =  $this->get_exends_menu($v1['id'],0); 
	               foreach ($second as $v2){
	               
	                  $tr.=$this->design_priv_tree(2,$v2,$roleid);
	                  $three =  $this->get_exends_menu($v2['id'],0); 
	                  foreach ($three as $v3){
	                  
	                         $tr.=$this->design_priv_tree(3,$v3,$roleid);
	                  
	                  }
	               }
	            }
	      
	      }
	
	    return $tr;
	}
	public function design_priv_tree($rank,$value,$roleid){
		

		 $tablePrefix = Yii::app()->db->tablePrefix;
	     $checked = '';
		 $icon = array('1'=>'&nbsp;&nbsp;└─&nbsp;','2'=>'&nbsp;&nbsp;&nbsp;├─&nbsp;','3'=>'&nbsp;&nbsp;&nbsp;│&nbsp;&nbsp;&nbsp;&nbsp;├─ &nbsp;');
         $class = '';
         $tr = '';
         if($rank!=0){
         
           $class = "child-of-node-".$value['parentid'];
         }
         $row = Admin_role_priv::model()->findByAttributes(array('roleid'=>$roleid,'c' => $value['c'],'a'=>$value['a'],'m'=>$value['m']));
         if($row){
         if($row->roleid){
	     
	        $checked = 'checked="checked"';
	     }
         }
	     $tr.= '<tr class="'.$class.'" id="node-'.$value['id'].'">
							<td style="padding-left:30px;">qwqw<input '.$checked.' type="checkbox" onclick="javascript:checknode(this);" level="'.$rank.'" value="'.$value['id'].'" name="menuid[]">&nbsp;'.$value['name'].'</td>
				</tr>';
        return $tr;
	}
}