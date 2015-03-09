<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Yii Blog Demo',

	// preloading 'log' component
	'preload'=>array('log'),
    'modules'=>array(
        'Admin',
        'Shake',
        'gii'=>array(
            'class'=>'system.gii.GiiModule',
            'password'=>'123456',
            // 'ipFilters'=>array(...IP �б�...),
            // 'newFileMode'=>0666,
            // 'newDirMode'=>0777,
        ),
    ),
	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
	),

	'defaultController'=>'post',

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
		// uncomment the following to use a MySQL database
		'authManager'=>array(

		'class'=>'CDbAuthManager',//认证类名称

		'defaultRoles'=>array('guest'),//默认角色

		'itemTable' => 'tbl_authitem',//认证项表名称

		'itemChildTable' => 'tbl_authitemchild',//认证项父子关系

		'assignmentTable' => 'tbl_authassignment',//认证项赋权关系

		),
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=blog',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => '',
			'charset' => 'utf8',
			'tablePrefix' => 'tbl_',
		),
		  'db2'=>array(
    'class' => 'CDbConnection',
    'connectionString' => 'mysql:host=127.0.0.1;dbname=syh',
    'emulatePrepare' => true,
	'tablePrefix' => '',
    'username' => 'root',
    'password' => '',
    'charset' => 'utf8',
    'enableParamLogging'  => true
),
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
		'urlManager'=>array(
			'urlFormat'=>'get',
			'rules'=>array(
				'post/<id:\d+>/<title:.*?>'=>'post/view',
				'posts/<tag:.*?>'=>'post/index',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>require(dirname(__FILE__).'/params.php'),
);