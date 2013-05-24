<?php
include_once('config.php');

$link = mysql_connect("localhost", "root", "") 

or die("Не соединилось!!!");

print "Соединение успешно";

mysql_select_db("shop") or die("Не найдена БД");

/* Выполнение SQL запроса */ 
if(isset($_POST['submit'])){

$query = "SELECT * FROM goods";

$result = mysql_query($query) or die("Запрос ошибочный");

/* Печать результатов в HTML */

print "<table>\n";

while ($line = mysql_fetch_array($result, MYSQL_NUM))
{
for ($i=1;$i<=3;$i++) 
{
if (substr_count(strtoupper($line[i]),strtoupper($_POST['good']))!=0) {

print "\t<tr>\n";

echo '$line[$i]';}

}

} 


print "</table>\n";

/* Освобождение памяти, занятой результатом запроса */

mysql_free_result($result);

/* Закрытие соединения */

mysql_close($link);
}

?>