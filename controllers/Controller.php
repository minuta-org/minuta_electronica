<?php


namespace app\controllers;

use Yii;

abstract class Controller extends \yii\web\Controller{
    private $excepcionesSesion = [
        'site/login',
        'site/logout',
    ];
    
    /**
     * Utilizamos esta función para poder ejecutar lógica antes de que se
     * llame la  acción del controlador.
     */
    public function beforeAction($action) {
        Yii::$app->session->open();
        if(!in_array($this->getRoute(), $this->excepcionesSesion) && Yii::$app->user->getIsGuest()){
            return Yii::$app->response->redirect(['site/login']);
        }
        return parent::beforeAction($action);
    }
    
    public function run($route, $params = array()) {        
        parent::run($route, $params);
    }
    
    protected function json($array)
    {
        header("Content-type:application/json");
        echo json_encode($array);
        exit();
    }
}