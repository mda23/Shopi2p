<?
include_once('config.php');
include_once('functions.php');
?>
<html>

<head>
  <title>Adminka</title>
</head>

<body>
<?
define('LOGIN', 'admin');
define('PASS', 'ololo');
if(isset($_POST['abut']))	$_SESSION['code']=md5(md5($_POST['login'].$_POST['pass']).'shoppy');elseif(isset($_POST['eBut']))
	$_SESSION['code']='';


if(isset($_SESSION['code']) && $_SESSION['code']==md5(md5(LOGIN.PASS).'shoppy')){	if(isset($_POST['addCat']))
		addCategory($_POST['catName']);
	elseif(isset($_POST['addGood']))
		addGood($_POST['gCat'], $_POST['gName'], $_POST['gDesc'], $_POST['gPrice']);
	elseif(isset($_POST['delCat']))
		deleteCategory($_POST['catId']);
	elseif(isset($_POST['delGood']))
		deleteGood($_POST['goodId']);?>
<form name="" action="" method="post">
<input type="submit" value="Exit" name="eBut">
<hr>
Add Category:<br />
Name of Category: <input name="catName" type="text"><br />
<input type="submit" name="addCat" value="Send"><br /><hr>

Add Good:<br />
Category<input name="gCat" type="text"><br />
Name of good: <input name="gName" type="text"><br />
Description: <textarea name="gDesc" rows=5 cols=20 wrap="off"></textarea><br />
Price<input name="gPrice" type="text"><br />
<input type="submit" value="Send" name="addGood"><hr>

Delete category:<br />
<input name="catId" type="text" value=""><br />
<input type="submit" value="Send" name="delCat"><hr>

Delete good:<br />
<input name="goodId" type="text" value=""><br />
<input type="submit" value="Send" name="delGood">
<hr>
<input type="submit" value="Exit" name="eBut">
</form>
<?}else{	?>
	<form name="" action="" method="post">
     <input name="login" type="text" value=""><br />
     <input name="pass" type="passworld" value=""><br />
     <input type="submit" name="abut" value="Send">
	</form>
	<?}
?>
</body>

</html>