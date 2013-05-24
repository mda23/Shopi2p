<?php
include_once('config.php');

function showCategory()
{
	$c=mysql_query('select * from category');
	echo '<a href=?>All categories</a></br>';
	while($c2=mysql_fetch_row($c))
		echo '<a href=?cat,',$c2[0],'>',$c2[1],'</a></br>';
}

function showGoods($cat)
{
	if(!$cat || $cat==0)$where = 'true';
	else $where = 'id_cat='.intval($cat);
	$a=mysql_query('select * from goods where '.$where.' order by id desc');
	echo '<table border=0>';
	while($good=mysql_fetch_row($a))
		echo '<tr><td colspan=2><hr></td></tr><tr><td width=300><a href=?',$good[0],'>',$good[2],'</a></td><td align=right>Id of good: ',$good[0],'</td></tr><tr><td>',$good[3],'</td><td align=right>',showBuyButton($good[0]),'<br>Price:',$good[4],' UAH</td></tr><tr><td colspan=3><hr></td></tr>';
	echo '</table>';
}

function showGood($id)
{
	$good=mysql_fetch_row(mysql_query('select * from goods where id='.intval($id)));
	echo '<table border=0>
	<tr><td colspan=2><hr></td></tr><tr><td width=300><a href=?',$good[0],'>',$good[2],'</a></td><td align=right>Id of good: ',$good[0],'</td></tr>
	<tr><td colspan=3><img src=img/big_',$good[0],'.jpg></td></tr>
	<tr><td>',$good[3],'</td><td align=right>',showBuyButton($good[0]),'<br>Price:',$good[4],' UAH</td></tr>
	<tr><td colspan=3><hr></td></tr></table>';
}
function search($sea)
{
	$d=mysql_query('select * from goods');
	echo '<table border=0>';
	while($good=mysql_fetch_row($d))
	if(substr_count(strtoupper($good[2]),strtoupper($sea))!=0)
	{
	echo '<tr><td colspan=2><hr></td></tr><tr><td width=300><a href=?',$good[0],'>',$good[2],'</a></td><td align=right>Id of good: ',$good[0],'</td></tr><tr><td>',$good[3],'</td><td 				align=right>',showBuyButton($good[0]),'<br>Price:',$good[4],' UAH</td></tr><tr><td colspan=3><hr></td></tr>';
	}
	echo '</table>';	


}

function addToBask($id, $count)
{
	$gid=explode(',', $_SESSION['goods_id']);
	$gc=explode(',', $_SESSION['goods_count']);
    $nid=posInArray($id, $gid);

    if($nid==-1)
    {
    $n=count($gid);
    if($gid[$n-1]=='' && $n>0)$n--;
    	$gid[$n]=$id;
    	$gc[$n]=$count;
    }
 	else
 		$gc[$nid]+=$count;

   $_SESSION['goods_id']=join(',', $gid);
   $_SESSION['goods_count']=join(',', $gc);
}

function deleteFromBasked($id)
{
	$gid=explode(',', $_SESSION['goods_id']);
	$gc=explode(',', $_SESSION['goods_count']);
	$n=posInArray($id, $gid);
 	unset($gid[$n]);
 	unset($gid[$n]);
 	$_SESSION['goods_id']=join(',', $gid);
	$_SESSION['goods_count']=join(',', $gc);
}

function posInArray($a, $b)
{
	if(!in_array($a, $b))return -1;
	for($i=0;$i<count($b);$i++)
		if($a==$b[$i])
			return $i;
	return -1;
}

function showBuyButton($id)
{
	echo '<a href=?buy,',$id,'><img src=img/bask.png></a>';
}

function showBask()
{
	$gid=explode(',', $_SESSION['goods_id']);
	$gc=explode(',', $_SESSION['goods_count']);
	if($_SESSION['goods_id']!='' && intval($_SESSION['goods_id'])>0){
		$list=mysql_query('select id, name, price from goods where id in ('.addslashes($_SESSION['goods_id']).')');
		if(mysql_num_rows($list)==0)echo 'No goods in the basket.';
		$sum=0;
		while($gBask=mysql_fetch_row($list))
		{
			$cnt=abs(intval($gc[posInArray($gBask[0], $gid)]));
			echo '<a href=?del,',$gBask[0],'><img src=img/del_bask.png></a><a href=?',$gBask[0],'>',$gBask[1],'</a> - ',$cnt,' it. - ',$gBask[2],' UAH<hr>';
			$sum+=$gBask[2]*$cnt;
		}
		echo 'Total sum of goods:',$sum,' UAH';
	}else echo 'No goods in the basket.';
}

function addCategory($name)
{
	mysql_query('insert into `category` (`name`) values ("'.addslashes($name).'")');
}

function addGood($cat, $name, $desc, $price)
{
//echo 'insert into `goods` (`id_cat`, `name`, `description`, `price`) values ( '.intval($cat).', '.addslashes($name).', '.addslashes($desc).', '.intval($price).')';
	mysql_query('insert into `goods` (`id_cat`, `name`, `description`, `price`) values ( '.intval($cat).', "'.addslashes($name).'", "'.addslashes($desc).'", '.intval($price).')');
}

function deleteCategory($id)
{
	mysql_query('delete from category where id='.intval($id));

}

function deleteGood($id)
{
echo'dfgere';
	mysql_query('delete from goods where id='.intval($id));
}
?>