<?php
!function_exists('html') && exit('ERR');
if(!$lfjid){
	showerr('请先登录！');
}

if($step==2)
{
	$ckfile = ROOT_PATH.'cache/regsendmail.txt';
	if( (time()-@filemtime($ckfile) )<60 ){
		showerr("邮件发送正在排队中，请稍候再偿试发送！");
	}
	
	if(!ereg("^[-a-zA-Z0-9_\.]+\@([0-9A-Za-z][0-9A-Za-z-]+\.)+[A-Za-z]{2,5}$",$email)) {
		showerr("邮箱不符合规则"); 
	}elseif(!$content){
		showerr("内容不能为空"); 
	}elseif(strlen($content)>3000){
		showerr("内容不能大于3000个字符"); 
	}
	$Title="来自“{$webdb[webname]}”的邮件,你朋友“{$myname}”给你推荐了一篇精彩文章!!";
	
	if(!check_imgnum($yzimg)){
		showerr("验证码不符合");
	}
	
	$rs[email]=$email;
	$Content=filtrate($content);
	$Content=str_replace("\n","<br>",$Content);
	write_file($ckfile,$email);
	if( send_mail($rs[email], $Title, $Content,0) ){
		@unlink($ckfile);
		refreshto("./","恭喜你，邮件成功发出!",5);
	}else{
		@unlink($ckfile);
		showerr("邮件发送失败，可能你邮箱地址有误,或者是服务器发送邮件功能有问题！！");
	}
}

$erp=get_id_table($id);
$rsdb=$db->get_one("SELECT * FROM {$pre}article$erp WHERE aid='$id'");
if(!$id){
	showerr("数据不存在");
}
require(ROOT_PATH."inc/head.php");
require(html("recommend"));
require(ROOT_PATH."inc/foot.php");
?>