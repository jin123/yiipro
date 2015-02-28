<?php

class MenuController extends Controller
{
	  function actionIndex(){
	  	$Admin = new Admin();
	    $tree = $Admin->get_tree($_GET['menuid']);
	     $this->render('index',array('tree'=>$tree));
	  
	  }
    function actionAdd(){
    	 $pid = isset($_GET['parentid'])?$_GET['parentid']:0;
          if(isset($_POST['info'])){
	         
	            if(isset($_GET['id']) && !empty($_GET['id'])){
	     
	             echo Menu::model()->updateByPk($_GET['id'],$_POST['info']); 
	             return;
	            
	            }
	            else{
	         
	           echo Yii::app()->db->createCommand()->insert('v9_menu', $_POST['info']);
	               return;
	            }
	              
	      }
	      else{
	      	
            $obj = new Admin();
            $info = array();
            
	 
            if(isset($_GET['id']) && !empty($_GET['id'])){
                
              $post=Menu::model()->find('id=:id', array(':id'=>$_GET['id']));
              $info['name'] = $post->name;
              $info['id'] = $post->id;
             $info['name'] = $post->name;
             $info['parentid'] = $post->parentid;
             $info['m'] = $post->m;
             $info['c'] = $post->c;
             $info['a'] = $post->a;
             $info['data'] = $post->data;
             $info['listorder'] = $post->listorder;
             $info['display'] = $post->display;
             $info['project1'] = $post->project1;
             $info['project2'] = $post->project2;
             $info['project3'] = $post->project3;
             $info['project4'] = $post->project4;
             $info['project5'] = $post->project5;
             $pid = $info['parentid'];
            }
            
	      	$tree = $obj->design_setting_tree($pid);
	      	$this->render('add',array('tree'=>$tree,'info'=>$info));
	      }
	  
	  }
	  function actionDelete(){
	     $post=Menu::model()->findByPk($_GET['id']); // 假设有一个帖子，其 ID 为 10
         $result = $post->delete(); // 从数据表中删除此行
	      if($result){
	    
	         header("location: http://".$_SERVER['HTTP_HOST']."/demos/blog/index.php?r=Admin/Menu/index&menuid=".$_GET['menuid']);
	    
	      }
	      else{
	         echo "删除失败";
	      
	      }
	  }
	
	
	
}