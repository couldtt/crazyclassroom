<?php
// 浏览器友好的变量输出
function dump($var, $echo=true, $label=null, $strict=true) {
    $label = ($label === null) ? '' : rtrim($label) . ' ';
    if (!$strict) {
        if (ini_get('html_errors')) {
            $output = print_r($var, true);
            $output = "<pre>" . $label . htmlspecialchars($output, ENT_QUOTES) . "</pre>";
        } else {
            $output = $label . print_r($var, true);
        }
    } else {
        ob_start();
        var_dump($var);
        $output = ob_get_clean();
        if (!extension_loaded('xdebug')) {
            $output = preg_replace("/\]\=\>\n(\s+)/m", "] => ", $output);
            $output = '<pre>' . $label . htmlspecialchars($output, ENT_QUOTES) . '</pre>';
        }
    }
    if ($echo) {
        echo($output);
        return null;
    }else
        return $output;
}
//dump + exit
function p($s = "Arrive here!") {
	dump($s);
	exit;
}
protected function ajaxReturn($data,$info='',$status=1,$type='') {
	$result  =  array();
	$result['status']  =  $status;
	$result['info'] =  $info;
	$result['data'] = $data;
	//扩展ajax返回数据, 在Action中定义function ajaxAssign(&$result){} 方法 扩展ajax返回数据。
	if(method_exists($this,"ajaxAssign")) 
		$this->ajaxAssign($result);
	if(empty($type)) $type  =   C('DEFAULT_AJAX_RETURN');
	if(strtoupper($type)=='JSON') {
		// 返回JSON数据格式到客户端 包含状态信息
		header("Content-Type:text/html; charset=utf-8");
		exit(json_encode($result));
	}elseif(strtoupper($type)=='XML'){
		// 返回xml格式数据
		header("Content-Type:text/xml; charset=utf-8");
		exit(xml_encode($result));
	}elseif(strtoupper($type)=='EVAL'){
		// 返回可执行的js脚本
		header("Content-Type:text/html; charset=utf-8");
		exit($data);
	}else{
	}
}
?>