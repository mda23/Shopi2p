<?
include_once('config.php');
include_once('functions.php');
$qs=explode(',', $HTTP_SERVER_VARS['QUERY_STRING']);
?>
<html>

<head>
  <title></title>
</head>

<body>
<form action="index.php" method="get">
<br><input type="text" name="good" size="60" value="">
<input type="submit" value="Search">
<input type="reset" name="reset" value="Clear">
</form>
<br /><br /><br /><br />
<table align=center border=1><tr><td><?=showCategory();?></td><td>
<?
	$sch=$_GET['good'];
	//echo($sch);
	if ($sch!='')
		search($sch);
	elseif(intval($qs[0])>0)
		showGood($qs[0]);
	elseif($qs[0]=='buy'){
		addToBask($qs[1], 1);
		showGood($qs[1]);
	}elseif($qs[0]=='del'){
		deleteFromBasked($qs[1]);
		showGood($qs[1]);
	}else
		showGoods($qs[1]);

?>
</td><td><?=showBask();?></td></tr></table>
<br><center>*demo</center>
</body>

</html>