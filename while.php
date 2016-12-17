<?php
/**
 * while的一些用到过的用法
 */

/**
 * 命令行时钟
 */
function showTime() {
 	while(true) {
 		sleep(1);
 		echo date('Y-m-d H:i:s', time()) . PHP_EOL;
 	}
 }
 //showTime();
 
 /**
  * 确保显示环境也是用utf-8编码
  * 字符串一维转二维
  */
function str2arr() {
 	$str = "123abc世界";
 	$start = 0;
 	$strlen = mb_strlen($str, 'utf-8');//
 	
 	$arr = array();
 	$len = 1;
 	while ($strlen) {
 		$arr[] = mb_substr($str, $start, $len, 'utf-8');
 		$str = mb_substr($str, $len, $strlen);
 		$strlen = mb_strlen($str, 'utf-8');
 	}
 	
 	//var_dump($arr);
 	return $arr;
 }
 //var_dump(str2arr());
 
 /**
  * 队列处理
  * 
  */
 function dealQueue() {
 	//构造队列
 	//类似逻辑 将一些日志写入到消息队列  然后异步到mysql 降低mysql io压力
 	$fh = fopen('./test.temp', 'w+') or die('不能打开文件');
 	for ($i=0; $i<=10; $i++) {
 		fputs($fh, "world" . PHP_EOL);
 	}
 	//处理队列
 	rewind($fh);
 	while(($line=fgets($fh)) !== false) {
 		//处理一些逻辑
 		echo 'Hello ' . $line . PHP_EOL;
 	}
 	
 	fclose($fh);
 }
 //dealQueue();
 
 /**
  * 子进程管理器
  */
function manageProcess() {
	
} 
 
 /**
  * 读取tcp数据流
  */
function readStream() {
	$url = 'cn.bing.com';
	$port = 80;
	$host_ip = gethostbyname($url);
	$http_header .= "GET / HTTP/1.1\r\n";
	$http_header .= "Host:{$url}\r\n";
	$http_header .= "Connection:Close\r\n";
	$http_header .= "\r\n";
	
	$http_request = $http_header;
	$sock_http = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
	socket_connect($sock_http, $host_ip, $port);
	socket_write($sock_http, $http_request, strlen($http_request));
	
	$response = '';
	while($read = socket_read($sock_http, 1024)) {
		$response .= $read;
	}
	
	socket_close($sock_http);
	return $response;
}
// echo readStream();

 /**
  * 状态机
  * 写一些 server类的会用到
  */
define('STATUS_INIT', 0);
define('STATUS_START', 1);
define('STATUS_DEAL', 2);
define('STATUS_END', 3);
function stateMachine() {
	
	$event_done = false;
	$status = STATUS_INIT;//init 
	while ( ! $event_done) {
		switch ($status){
			case STATUS_INIT:
				//处理一些逻辑
				echo 'init...' . PHP_EOL;
				//状态切换到1
				$status = STATUS_START;
				break;
			case STATUS_START:
				//处理一些逻辑
				echo 'start....' . PHP_EOL;
				//状态切换到2
				$status = STATUS_DEAL;
				break;	
			case STATUS_DEAL:
				//处理一些逻辑
				echo 'dealing....' . PHP_EOL;
				//状态切换到2
				$status = STATUS_END;
				break;
			case STATUS_END:
				//处理一些逻辑
				echo 'done....' . PHP_EOL;
				//状态切换到2
				//$status = STATUS_START;
				$event_done = true;
				break;
			default:
				break;
		}
	}
}
// stateMachine();