<?php
//通过像这样使用组合和委托，可以在运行时轻松地合并对象。
//看书其实就是把纵向的知识点  横向组织到自己
//检验有没有掌握的唯一方法  做个出来
//外观模式
//总之 如果你想获得简洁的客户端代码，或者想把系统中的修改对客户端代码隐藏，或许可以使用外观模式
// $facacde = new ProductFacade( 'test.txt' );
// $facade->getProduct( 234 );
abstract class Question
{
	protected $prompt;//敏捷的  提示
	protected $marker;//委托的处理类
	
	public function __construct($prompt, Marker $marker) {
		$this->prompt = $prompt;
		$this->marker = $marker;
	}
	
	public function mark($resoponse) {
		//委托
		return $this->marker->mark($resoponse);
	}
}
