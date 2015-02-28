<?php

class PublicController extends Controller
{
	
	
	
	public function actionDologin(){
	
	$model=new LoginForm;

		// if it is ajax validation request
	if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			///var_dump($model->validate() && $model->login());die;
			if($model->validate() && $model->login()){
				exit(json_encode(array('state'=>'success','referer'=>'/index.php/?r=Admin/Default/index','info'=>'success')));
			}
				else{
				
				exit(json_encode(array('state'=>'fail','info'=>'login error')));
				
				}
		}
		
	
	}
/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		if (!defined('CRYPT_BLOWFISH')||!CRYPT_BLOWFISH)
			throw new CHttpException(500,"This application requires that PHP was compiled with Blowfish support for crypt().");

		
		// display the login form
		$this->render('login',array('model'=>$model));
	}
}