<?php
include './Init.php';

//数据库文件为sql.php, 导入到mysql中即可
//先看把注释看完, 在一个一个去掉注释试试就会用了.

//$db->table('user')->findAll();	//查询user表中所有记录

//$db->table('user')->cache()->findAll(); //查询user表中所有记录,并进行缓存
$db->table('user');

$data = array(
	'name'	=> 'xiaokai',
	'pwd'	=> '123456',
);

//$db->add($data);	//插入记录

//$db->update(array('name' => 'kaixiao'), 'id = 5');	//修改id为5的记录name字段为kaixiao

//$db->delete('id = 4');//删除id为4的记录

/*
添加, 修改, 删除, 都比较简单, 我们重点来研究查询
使用连贯操作进行查询时, 主要有这几个方法提供调用
table() 设置表名称, 这个表名称只要设置一次在后面的操作中就不需要进行设置了, 除非你要操作另外一个表
field() 设置查询字段
where() 设置查询条件
order() 设置排序方法
join()  设置关联查询
cache()	缓存当前查询
还有limit(), group(), having()等3个方法
这里调用的顺序没有讲究
比如$db->order('id DESC')->where('id = 1') 与 $db->where('id = 1')->order('id DESC')效果是完全相同的
但是必须注意, 在调用上面的任何方法后需要调用find()或则findAll()方法进行数据返回, 注意:使用连贯操作时, findAll或则find必须放大整个操作连最后
比如这样 $db->order('id DESC')->where('id = 1')->findAll();
当然你也可以直接调用$db->findAll();方法, 但是这样就需要给findAll()方法传入参数
findAll($where = NULL, $field = '*', $table = '', $all = TRUE)
findAll(查询条件, 查询字段, 表名, 是否返回所有记录)
好了说了这么多, 我们来试试吧
*/

//$db->field('name')->where('id = 4')->order('id DESC')->findAll();
//相当于: SELECT name FROM user WHERE id = 4 ORDER BY id DESC
//这里没有调用table方法, 因为上面已经调用过了


//$rows = $db->join('news on `user`.id = `news`.uid')->findAll();
//相当于执行 SELECT * FROM user LEFT JOIN news ON `user`.id = `news`.uid;
