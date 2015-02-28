<?php

class SiteController extends Controller
{
	public $layout='column1';

	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
	    if($error=Yii::app()->errorHandler->error)
	    {
	    	if(Yii::app()->request->isAjaxRequest)
	    		echo $error['message'];
	    	else
	        	$this->render('error', $error);
	    }
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$headers="From: {$model->email}\r\nReply-To: {$model->email}";
				mail(Yii::app()->params['adminEmail'],$model->subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		if (!defined('CRYPT_BLOWFISH')||!CRYPT_BLOWFISH)
			throw new CHttpException(500,"This application requires that PHP was compiled with Blowfish support for crypt().");

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
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
public function actionIndex()
	{
			$private_key = file_get_contents("./Public/ssl/private_key.pem");
	     
	     $public_key = file_get_contents("./Public/ssl/rsa_public_key.pem");
	     $pi_key =  openssl_pkey_get_private($private_key);//这个函数可用来判断私钥是否是可用的，可用返回资源id Resource id  
		 $pu_key = openssl_pkey_get_public($public_key);//这个函数可用来判断公钥是否是可用的  
		 print_r($pi_key);echo "\n";  
		 print_r($pu_key);echo "\n";
		 $data = "aassssasssddd";//原始数据  
			$encrypted = "";   
			$decrypted = "";   
			echo "<pre>";
			echo "source data:",$data,"\n";  
			  
			echo "private key encrypt:\n";  
			  
			openssl_private_encrypt($data,$encrypted,$pi_key);//私钥加密  
			$encrypted = base64_encode($encrypted);//加密后的内容通常含有特殊字符，需要编码转换下，在网络间通过url传输时要注意base64编码是否是url安全的  
			echo $encrypted,"\n";  
			  
			echo "public key decrypt:\n";  
			  
			openssl_public_decrypt(base64_decode($encrypted),$decrypted,$pu_key);//私钥加密的内容通过公钥可用解密出来  
			echo $decrypted,"\n";  
			  
			echo "---------------------------------------\n";  
			echo "public key encrypt:\n";  
			  
			openssl_public_encrypt($data,$encrypted,$pu_key);//公钥加密  
			$encrypted = base64_encode($encrypted);  
			echo $encrypted,"\n";  
			  
			echo "private key decrypt:\n";  
			openssl_private_decrypt(base64_decode($encrypted),$decrypted,$pi_key);//私钥解密  
			echo $decrypted,"\n";  
		die;
	}
}
