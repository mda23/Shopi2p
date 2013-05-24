<?
header('Content-type: text/html; charset=windows-1251');
define('HOST', 'localhost');
define('DB_LOGIN', 'root');
define('DB_PASS', '');
define('DB_NAME', 'shop');

mysql_connect(HOST, DB_LOGIN, DB_PASS);
mysql_select_db(DB_NAME);

session_start();
?>