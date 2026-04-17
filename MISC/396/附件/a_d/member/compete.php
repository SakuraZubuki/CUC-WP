<?php
require_once("global.php");
echo 'test';
echo $id;
$linkdb=array(
			"广告位列表"=>"?job=list",
			"我购买的广告"=>"?job=mylist"
			);

if(!$lfjid)
{
	showerr("请先登录");
}

if($job=='buy')
{
	$rsdb = $db->get_one(" SELECT * FROM `{$pre}ad_compete_place` WHERE id='$id' ");
	$_s2=$db->get_one("SELECT COUNT(*) AS Num FROM `{$pre}ad_compete_user` WHERE id='$id' AND endtime>$timestamp");
	if($_s2[Num]>=$rsdb[adnum]){
		showerr("很抱歉,本广告位目前已没位置了");
	}
	$lfjdb[money]=intval(get_money($lfjdb[uid]));

	if(!$rsdb){
		showerr("广告位不存在");
	}
	if($step){
		if($postdb[price]<$rsdb[price]){
			showerr("你出价不能低于系统规定的最低价:$rsdb[price]");
		}elseif($postdb[price]>$lfjdb[money]){
			showerr("你出价不能大于你自身的积分");
		}elseif($rsdb[wordnum]&&strlen($postdb[adword])>$rsdb[wordnum]){
			showerr("你的广告文字内容字数不能大于{$rsdb[wordnum]}个");
		}elseif($postdb[adword]===''){
			showerr("广告文字内容不能为空");
		}
		if(!strstr($postdb[adlink],'http://')){
			$postdb[adlink]="http://$postdb[adlink]";
		}
		$postdb[adlink]=filtrate($postdb[adlink]);
		$postdb[adword]=filtrate($postdb[adword]);
		$postdb[endtime]=$timestamp+$rsdb[day]*3600*24;
		$db->query("INSERT INTO `{$pre}ad_compete_user` ( `uid` , `username` , `begintime` , `endtime` , `money` , `id`, `adlink`, `adword`) VALUES ('$lfjdb[uid]','$lfjdb[username]','$timestamp','$postdb[endtime]','$postdb[price]','$id','$postdb[adlink]','$postdb[adword]')");
		add_user($lfjuid,-$postdb[price],'购买竞价广告扣分');	//扣除积分
		refreshto("?job=list","恭喜你,广告提交成功",1);
	}
}
elseif($job=='list')
{
	$lfjdb[money]=get_money($lfjdb[uid]);
	$query = $db->query("SELECT AD.* FROM `{$pre}ad_compete_place` AD ORDER BY AD.id DESC");
	while($rs = $db->fetch_array($query)){
		$_s2=$db->get_one("SELECT COUNT(*) AS Num FROM `{$pre}ad_compete_user` WHERE id='$rs[id]' AND endtime>$timestamp");
		$rs[AdNum]=$rs[adnum]-$_s2[Num];
		$rs[isclose]=$rs[isclose]?'关闭':'开放';
		$listdb[]=$rs;
	}
}
elseif($job=='sell_list')
{
	$rows=30;
	if(!$page){
		$page=1;
	}
	$min=($page-1)*$rows;
	$showpage=getpage("`{$pre}ad_compete_user`","WHERE id='$id'","?job=$job&id=$id","$rows");
	$query = $db->query("SELECT * FROM `{$pre}ad_compete_user` WHERE id='$id' ORDER BY ad_id DESC LIMIT $min,$rows");
	while($rs = $db->fetch_array($query)){
		if($rs[endtime]>$timestamp){
			$rs[state]='投放中';
		}else{
			$rs[state]='已过期';
		}
		$rs[begintime]=date("Y-m-d H:i",$rs[begintime]);
		$rs[endtime]=date("Y-m-d H:i",$rs[endtime]);
		$listdb[]=$rs;
	}
}
elseif($job=='mylist')
{
	$query = $db->query("SELECT AD.name,B.* FROM `{$pre}ad_compete_place` AD LEFT JOIN `{$pre}ad_compete_user` B ON AD.id=B.id WHERE B.uid='$lfjuid' ORDER BY B.ad_id DESC");
	while($rs = $db->fetch_array($query)){
		$rs[begintime]=date("Y-m-d H:i",$rs[begintime]);
		$rs[endtime]=date("Y-m-d H:i",$rs[endtime]);
		$listdb[]=$rs;
	}
}
elseif($action=='del')
{
	$db->query("DELETE FROM `{$pre}ad_compete_user` WHERE uid='$lfjuid' AND ad_id='$ad_id'");
	refreshto("$FROMURL","删除成功",1);
}
elseif($job=='edit')
{
	$rsdb = $db->get_one("SELECT AD.name,AD.wordnum,B.* FROM `{$pre}ad_compete_place` AD LEFT JOIN `{$pre}ad_compete_user` B ON AD.id=B.id WHERE B.uid='$lfjuid' AND ad_id='$ad_id'");

	if($step==2){
		if($rsdb[wordnum]&&strlen($postdb[adword])>$rsdb[wordnum]){
			showerr("你的广告文字内容字数不能大于{$rsdb[wordnum]}个");
		}elseif($postdb[adword]===''){
			showerr("广告文字内容不能为空");
		}
		if(!strstr($postdb[adlink],'http://')){
			$postdb[adlink]="http://$postdb[adlink]";
		}
		$postdb[adlink]=filtrate($postdb[adlink]);
		$postdb[adword]=filtrate($postdb[adword]);
		$db->query("UPDATE `{$pre}ad_compete_user` SET adword='$postdb[adword]',adlink='$postdb[adlink]' WHERE  uid='$lfjuid' AND ad_id='$ad_id'");
		refreshto("?job=mylist","修改成功",1);
	}

	$rsdb[begintime]=date("Y-m-d H:i",$rsdb[begintime]);
	$rsdb[endtime]=date("Y-m-d H:i",$rsdb[endtime]);
}

require(ROOT_PATH."member/head.php");
require(dirname(__FILE__)."/template/compete/list.htm");
require(ROOT_PATH."member/foot.php");
?>