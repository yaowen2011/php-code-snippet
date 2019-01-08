<?php
//通过像这样使用组合和委托，可以在运行时轻松地合并对象。
//看书其实就是把纵向的知识点  横向组织到自己
//检验有没有掌握的唯一方法  做个出来
abstract class Tile 
{
    abstract function getWealthFactor();
}

class Plains extends Tile
{
    private $wealthfactor = 2;
    
    public function getWealthFactor() 
    {
    	echo "Plains called ...........\n";
        return $this->wealthfactor;
    }
}

//装饰模式的核心类
//装饰基类  继承抽象类
//tips::组合和继承通常都是同时使用的
//实现  __call 来捕捉装饰类中不存在的方法
abstract class TileDecorator extends Tile
{
    protected $tile;
    
    function __construct( Tile $tile)
    {
        $this->tile = $tile;
    }
}
class DiamondDecorator extends TileDecorator {
    function getWealthFactor() {
    	echo "DiamonDecorator called........\n";
        return $this->tile->getWealthFactor() + 2; //关键点   保留了构造方法传进来的对象引用   tile 
    }
}

class PollutionDecorator extends TileDecorator {
    function getWealthFactor() {
    	echo "PollutionDecorator called ...........\n";
        return $this->tile->getWealthFactor() - 4; //关键点   保留了构造方法传进来的对象引用   tile 
    }
}

$texPlain = new DiamondDecorator(new PollutionDecorator( new Plains()));
$wealth = $texPlain->getWealthFactor();
echo $wealth;
//装饰模式 合并对象
// $processs = new AuthenticateRequest(new StructureRequest(
// 		                           new LogRequest(
// 		                           new MainProcess())));
// $process->process( new RequestHelper() );

