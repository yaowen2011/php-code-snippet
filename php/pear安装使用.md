windows下不通过pear安装phpunit
（主要是一直没成功 channel连不上）

链接
https://phpunit.de/manual/current/zh_cn/installation.html

简单就是
1、下载https://phar.phpunit.de/phpunit.phar（可以放到和php.exe同级目录 ） 
2、cmd  进入上目录，执行echo @php "%~dp0phpunit.phar" %* > phpunit.cmd
3、phpunit --version 查看是否安装成功

pear upgrade-all  

pear clear-cache

pear config-set auto_discover 1
pear install --force --alldeps pear.phpqatools.org/phpqatools

以上都不管用  使用peardownload来下载安装

pear list来查看

require_once 'System.php';
var_dump(class_exists('System'));
如果页面返回 bool(true) 表明安装成功。

一些常用的pear命令
安装包
　　pear install packagename

下载包，但不安装
　　pear download packagename
　　pear download-all

安装已经下载的包
　　pear install filename.tgz

列出channel里面所有的包
　　pear remote-list

列出已经安装的包
　　pear list

列出可升级的包
　　pear list-upgrades

更新包
　　pear upgrade packagename
　　pear upgrade-all

删除包
　　pear uninstall packagename