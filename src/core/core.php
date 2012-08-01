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
		$actionStr = substr($splits[1], 0, strpos($splits[1], "?"));
		$this->_action = !empty($actionStr)?$actionStr:'index';
		//提取传递过来的参数，以键值对的形式存在，所以要分别提取并放入数组中
		$kvStr = substr($splits[1], strpos($splits[1], "?") + 1, strlen($splits[1]) - 1);
		//提取键值对
		$kvStr = explode('&', $kvStr);
		if(!empty($kvStr)) {
			//构造两个数组，一个用于放键串，另一个用放值。
			$keys = $values = array();
			/*遍历URL解析后的字符串数组，从第二位开始（索引第一位是控制器名，第二位是action名其余的应该是参数对）*/
			for($i = 0; $i < count($kvStr); ++$i) {
				$temp = explode('=', $kvStr[$i]);
				$keys[] = $temp[0];
				$values[] = $temp[1];
			}
			//合并键值对数组为一个数组，php中的数组兼有其他语言hashtable的功能。
			$this->_params = array_combine($keys, $values);
		}
		//指派具体函数
		$controllerFile = "/../lib/{$this->_controller}Action.class.php";
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