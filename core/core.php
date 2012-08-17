<?php
include_once('/../common/functions.php');
class App {
	protected $_controller, $_action, $_params;
	static $_instance;
	
	//单例模式
	public static function Run() {
		if(!(self::$_instance instanceof self)) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}
	
	private function __construct() {
		//先获取php系统提供的URl请求串
		$request = substr($_SERVER['REQUEST_URI'], strlen($_SERVER['SCRIPT_NAME']), strlen($_SERVER['REQUEST_URI']) - 1);
		//接着分割URL字符串，其实就是所谓的URL解析
		$splits = explode('/', trim($request,'/'));
		// URL解析后的的字符串数组，分别提取出各个部分
		$this->_controller = !empty($splits[0])?$splits[0]:'index';
		//提取action的名字，如果URL格式不对这里提取的名字是index
		if(!($len = strpos($splits[1], "?")))
			$len = strlen($splits[1]);
		$actionStr = substr($splits[1], 0, $len);
		$this->_action = !empty($actionStr)?$actionStr:'index';
		//指派具体函数
		$controllerFile = "/../lib/Action/{$this->_controller}Action.class.php";
		if(!file_exists($controllerFile)) {
			require_once($controllerFile);
			$controller = "{$this->_controller}Action";
			$action = $this->_action;
			$app = new $controller();
			$app::$action();
		}
		else {
			echo "Error";
		}
		
		//
	}
}
?>