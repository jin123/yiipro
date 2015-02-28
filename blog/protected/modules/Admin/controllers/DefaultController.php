<?php

class DefaultController extends Controller
{
	public function actionIndex()
	{
	
		$this->render('index');
	}
	public function  actionPublic_menu_left(){
	
	    $menuid = intval($_GET['menuid']);
		$datas = Admin::admin_menu($menuid);
		if (isset($_GET['parentid']) && $parentid = intval($_GET['parentid']) ? intval($_GET['parentid']) : 10) {
			foreach($datas as $_value) {
	        	if($parentid==$_value['id']) {
	        		echo '<li id="_M'.$_value['id'].'" class="on top_menu"><a href="javascript:_M('.$_value['id'].',\'?m='.$_value['m'].'&c='.$_value['c'].'&a='.$_value['a'].'\')" hidefocus="true" style="outline:none;">'.L($_value['name']).'</a></li>';
	        		
	        	} else {
	        		echo '<li id="_M'.$_value['id'].'" class="top_menu"><a href="javascript:_M('.$_value['id'].',\'?m='.$_value['m'].'&c='.$_value['c'].'&a='.$_value['a'].'\')"  hidefocus="true" style="outline:none;">'.L($_value['name']).'</a></li>';
	        	}      	
	        }
		} else {
			$this->render('left',array('datas'=>$datas));
		}
	
	}
 public function actionPublic_main() {
   		$this->render('main');
	}
public function actionPublic_current_pos() {
		echo Admin::current_pos($_GET['menuid']);
		exit;
	}
    public function actionDownload(){
    
    
       echo "应用下载页面，正在努力开发中";
    
    }
}