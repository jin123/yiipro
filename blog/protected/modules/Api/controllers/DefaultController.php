<?php

class DefaultController extends Controller
{

	public function filters(){

        return array(
            'accessControl', // perform access control for CRUD operations
            array(
                'RestfullYii.filters.ERestFilter + 
                REST.GET, REST.PUT, REST.POST, REST.DELETE, REST.OPTIONS'
            ),
        );
   }
	public function actionIndex()
	{
		$this->render('index');
	}
}