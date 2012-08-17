<?php
class TestAction{
	function a() {
		$w = D('Classroom');
		$data = array(
		  'name' =>  '102' ,
		  'campus' =>  'liangxiang' ,
		  'capacity' =>  100 ,
		  'facility' =>  0 ,
		  'building' =>  4 ,
		  'floor' =>  2 
		);
		$w->add($data);
		p($w->where("2=2")->findAll());
		Ajax(null, 'Test OK', 1);
	}
}
?>