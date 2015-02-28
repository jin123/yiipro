<?php

class AdminController extends Controller
{
	
	  public function actionIndex(){
	       $tablePrefix = Yii::app()->db->tablePrefix;	
	       $list = $this->getlist();
	       $get = array();
	       foreach($list['datalist'] as $key=>$value){
	           $info = Admin::find_one($tablePrefix.'admin_role','roleid',$value->roleid);
	           $get[$key] = $value->attributes;
	           $get[$key]['roleid'] = $info['roleid'];
	           $get[$key]['rolename'] = $info['rolename'];
	       }
	       $this->render( 'index', array ( 'datalist' => $get , 'pagebar' => $list['pagebar'],'count'=>$list['count'] ) );
           
	  
	  }
 public function getlist(){ 
           $list= Admin::find_all('Admin',1,'userid desc','',10);
           return $list;
   
     }
    public function actionAdd(){
      
    	if($_POST['info']){  
    		 unset($_POST['info']['pwdconfirm']);
    		
    		 $_POST['info']['password'] = md5($_POST['info']['password']);
    	    if(isset($_POST['userid']) && !empty($_POST['userid'])){  
    	    	echo  "update"; 
    	    echo Admin::update_all($tablePrefix.'admin',$_POST['info'],$_POST['userid'],'userid');
    	    
    	    }
    	    else{
    	      echo  "add";
    	     
    	      echo Admin::add_insert($tablePrefix.'admin',$_POST['info']);
    	    
    	    }
    	    return;
    	
    	}
    	$list= array();
    	
    	$id = $_GET['userid'];
    	if(isset($id) && !empty($id)){
    	$object = Admin::model()->find("userid=:userid",array(":userid"=>$id));
    	$list= $object->attributes;
    	}
    	$role = Admin_role::model()->findAll();
	    $this->render( 'add',array('info'=>$list,'role'=>$role));
	  }
	  public function actionDelete(){
	  
	     echo Admin::model()->delete(array('id'=>$_GET['id']));
	  
	  }
}