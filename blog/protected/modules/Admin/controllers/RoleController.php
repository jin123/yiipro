<?php

class RoleController extends Controller
{
	
	function actionIndex(){
	    $tablePrefix = Yii::app()->db->tablePrefix;	
	    $list= Admin::find_all("Admin_role",1,'roleid desc','',10);
	     $this->render('index',array('info'=>$list['datalist']));
	
	}
	function actionAdd(){
	
	
	     $tablePrefix = Yii::app()->db->tablePrefix;
	     if($_POST['info']){
	     
	      $info = array();
	         if(isset($_POST['id']) && !empty($_POST['id'])){
	         	
	         	
	         	  echo "edit";
	              echo Admin::update_all($tablePrefix."admin_role",$_POST['info'],$_POST['id'],'roleid');
	             
	         
	         }
	         else{
	         
	              
	            echo "add";
	             echo Admin::add_insert($tablePrefix."admin_role",$_POST['info']);
	         }
	     
	     }
	     else{
	         	
	         $info = array();
	         if(isset($_GET['id']) && !empty($_GET['id'])){
	            
	              $info = Admin::find_one($tablePrefix.'admin_role','roleid',$_GET['id']);
	         }
	         $this->render('role_add',array('info'=>$info));
	     
	     }
	
	}
	function actionDelete(){
	  $tablePrefix = Yii::app()->db->tablePrefix;
	    echo Admin::del($tablePrefix.'admin_role','roleid',$_GET['id']);
	
	
	}
	function actionPriv_setting(){
		//die('2121');
	      $obj = new Admin();
	      $categorys = $obj->priv_tree($_GET['roleid']);
	      $this->render('role_priv',array('categorys'=>$categorys,'show_header'=>'1'));
	
	}
	function actionRole_priv(){
        
	      $tablePrefix = Yii::app()->db->tablePrefix;
	      $roleid = $_POST['roleid'];
	      $del = Admin::del($tablePrefix.'admin_role_priv','roleid',$roleid);
	      $menuid = $_POST['menuid'];  
        // Admin::del($tablePrefix."admin_role_priv");
          if(count($menuid)==0){
        
        
               exit(json_encode(array('msg'=>'操作成功','status'=>1)));
        
        
          }
	      $insert['roleid'] = $roleid;
	      foreach($menuid as $key=>$value){
	           $menuinfo = Admin::find_one($tablePrefix.'menu','id',$value);
	           $insert['a'] = $menuinfo['a'];
	           $insert['c'] = $menuinfo['c'];
	           $insert['m'] = $menuinfo['m'];
	           $add = Admin::add_insert($tablePrefix."admin_role_priv",$insert);
	      
	      }
	     exit(json_encode(array('msg'=>'操作成功','status'=>1)));
	
	}
}