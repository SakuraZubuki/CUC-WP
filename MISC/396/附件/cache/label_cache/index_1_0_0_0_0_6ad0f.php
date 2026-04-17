<?php
$haveCache=1;
$label['head_guides']=stripslashes('      <div class=\"ico_guide bbs\"><a href=\"http://192.168.176.156/v7/bbs/\" target=\'_blank\'>社区</a></div>
	  <div class=\"ico_guide post\"><a href=\"http://192.168.176.156/v7/do/post.php\">投稿</a></div>
	  <div class=\"ico_guide sell\"><a href=\"http://192.168.176.156/v7/do/buymoneycard.php?paytype=yeepay\">充值</a></div>
	  <div class=\"ico_guide jf\"><a href=\"http://192.168.176.156/v7/do/jf.php\">积分</a></div>
	  <div class=\"ico_guide user\"><a href=\"http://192.168.176.156/v7/do/list_form.php?mid=2\">招聘</a></div>
	  <div class=\"ico_guide search\"><a href=\"http://192.168.176.156/v7/do/search.php\">搜索</a></div>
	  <div class=\"ico_guide book\"><a href=\"http://192.168.176.156/v7/do/guestbook.php\">留言</a></div>
	  <div class=\"ico_guide digg\"><a href=\"http://192.168.176.156/v7/do/listsp.php?fid=1\">专题</a></div>');
$label['head_search']=stripslashes('<a href=\"http://192.168.176.156/v7/do/search.php?keyword=齐博CMS\" class=\"b\">齐博CMS</a> 
        <a href=\"http://192.168.176.156/v7/do/search.php?keyword=注册域名\" target=\"_blank\">注册域名</a> 
        <a href=\"http://192.168.176.156/v7/do/search.php?keyword=CEO\" target=\"_blank\">CEO</a> 
        <a href=\"http://192.168.176.156/v7/do/search.php?keyword=源码下载\" target=\"_blank\">源码下载</a> 
        <a href=\"http://192.168.176.156/v7/do/search.php?keyword=IT资讯\" target=\"_blank\">IT资讯</a> 
        <a href=\"http://192.168.176.156/v7/do/search.php?keyword=主机空间\" target=\"_blank\">主机空间</a> 
        <a href=\"http://192.168.176.156/v7/do/search.php?keyword=建站手册\" class=\"b\" target=\"_blank\">建站手册</a> 
        <a href=\"http://192.168.176.156/v7/do/search.php?keyword=论坛程序\" target=\"_blank\">论坛程序</a> 
        <a href=\"http://192.168.176.156/v7/do/search.php?keyword=健康咨询\" class=\"b\" target=\"_blank\">健康咨询</a>');
$label['index_ad1']=stripslashes('<a href=\'http://www.chinaccnet.com/hyperv.php\' target=_blank><img src=\'http://192.168.176.156/v7/upload_files/label/1_20101109141123_k355a.jpg\'  width=\'740\'  height=\'70\' border=\'0\' /></a>');
$label['index_ad2']=stripslashes('<a href=\'http://www.yeepay.com/\' target=_blank><img src=\'http://192.168.176.156/v7/upload_files/label/1_20101109141150_bnrt2.jpg\'  width=\'240\'  height=\'70\' border=\'0\' /></a>');
$label['index_rollpic']=stripslashes('

<script type=\'text/javascript\'>
var widths=266;
var heights=236;
var counts=2;

				img1=new Image ();img1.src=\'http://192.168.176.156/v7/upload_files/label/1_20101109141150_sfgyo.jpg\';
				url1=new Image ();url1.src=\'http://www.sudu.cn/\';
				
				img2=new Image ();img2.src=\'http://192.168.176.156/v7/upload_files/label/1_20101109141154_f28xx.jpg\';
				url2=new Image ();url2.src=\'http://www.chinaccnet.com/\';
				
var nn=1;
var key=0;
function change_img()
{if(key==0){key=1;}
else if(document.all)
{document.getElementById(\"pic\").filters[0].Apply();document.getElementById(\"pic\").filters[0].Play(duration=2);}
eval(\'document.getElementById(\"pic\").src=img\'+nn+\'.src\');
eval(\'document.getElementById(\"url\").href=url\'+nn+\'.src\');
eval(\'document.getElementById(\"url\").target=\"blank\"\');
for (var i=1;i<=counts;i++){document.getElementById(\"xxjdjj\"+i).className=\'axx\';}
document.getElementById(\"xxjdjj\"+nn).className=\'bxx\';
nn++;if(nn>counts){nn=1;}
tt=setTimeout(\'change_img()\',4000);}
function changeimg(n){nn=n;window.clearInterval(tt);change_img();}
document.write(\'<style>\');
document.write(\'.axx{padding:1px 7px;border-left:#cccccc 1px solid;}\');
document.write(\'a.axx:link,a.axx:visited{text-decoration:none;color:#fff;line-height:12px;font:9px sans-serif;background-color:#666;}\');
document.write(\'a.axx:active,a.axx:hover{text-decoration:none;color:#fff;line-height:12px;font:9px sans-serif;background-color:#999;}\');
document.write(\'.bxx{padding:1px 7px;border-left:#cccccc 1px solid;}\');
document.write(\'a.bxx:link,a.bxx:visited{text-decoration:none;color:#fff;line-height:12px;font:9px sans-serif;background-color:#D34600;}\');
document.write(\'a.bxx:active,a.bxx:hover{text-decoration:none;color:#fff;line-height:12px;font:9px sans-serif;background-color:#D34600;}\');
document.write(\'</style>\');
document.write(\'<div style=\"width:\'+widths+\'px;height:\'+heights+\'px;overflow:hidden;text-overflow:clip;\">\');
document.write(\'<div><a id=\"url\"><img id=\"pic\" style=\"border:0px;filter:progid:dximagetransform.microsoft.wipe(gradientsize=1.0,wipestyle=4, motion=forward)\" width=\'+widths+\' height=\'+heights+\' /></a></div>\');
document.write(\'<div style=\"filter:alpha(style=1,opacity=10,finishOpacity=80);background: #888888;width:100%-2px;text-align:right;top:-12px;position:relative;margin:1px;height:12px;padding:0px;margin:0px;border:0px;\">\');
for(var i=1;i<counts+1;i++){document.write(\'<a href=\"javascript:changeimg(\'+i+\');\" id=\"xxjdjj\'+i+\'\" class=\"axx\" target=\"_self\">\'+i+\'</a>\');}
document.write(\'</div></div>\');
change_img();
</script>
	
	');
$label['index_t1']=stripslashes('<div class=\"lista1\"> <span class=\"t\"><a href=\"http://192.168.176.156/v7/html/31/668.htm\" target=\"_blank\">fdsa223333</a></span> 
                <span class=\"d\">[08-26]</span> <span class=\"c\">　fsdfasd<a href=\"http://192.168.176.156/v7/html/31/668.htm\" target=\"_blank\">[详情]</a></span> 
              </div><div class=\"lista2\"> <span class=\"t\"><a href=\"http://192.168.176.156/v7/html/31/667.htm\" target=\"_blank\">fdsa2</a></span> 
                <span class=\"d\">[08-26]</span> <span class=\"c\">　fsdfasd<a href=\"http://192.168.176.156/v7/html/31/667.htm\" target=\"_blank\">[详情]</a></span> 
              </div><div class=\"lista3\"> <span class=\"t\"><a href=\"http://192.168.176.156/v7/html/31/666.htm\" target=\"_blank\">fdsa</a></span> 
                <span class=\"d\">[08-26]</span> <span class=\"c\">　fsdfasd<a href=\"http://192.168.176.156/v7/html/31/666.htm\" target=\"_blank\">[详情]</a></span> 
              </div><div class=\"lista4\"> <span class=\"t\"><a href=\"http://192.168.176.156/v7/html/3/663.htm\" target=\"_blank\">&#39;</a></span> 
                <span class=\"d\">[11-12]</span> <span class=\"c\">　中电云集（www.chinaccnet.com）是一家拥有中华人民共和国增值电信业务经营许可证，获准经营因特网数据中心业务（IDC）、因特网接入服务..<a href=\"http://192.168.176.156/v7/html/3/663.htm\" target=\"_blank\">[详情]</a></span> 
              </div><div class=\"lista5\"> <span class=\"t\"><a href=\"http://192.168.176.156/v7/html/3/664.htm\" target=\"_blank\">官方更名为“齐博CMS”，请大家注意</a></span> 
                <span class=\"d\">[12-09]</span> <span class=\"c\">　一切是为了发展需要<a href=\"http://192.168.176.156/v7/html/3/664.htm\" target=\"_blank\">[详情]</a></span> 
              </div><div class=\"lista6\"> <span class=\"t\"><a href=\"http://192.168.176.156/v7/html/39/604.htm\" target=\"_blank\">V7欢迎大家拍砖，忠言虽逆耳，但利于行，良药虽苦口，但</a></span> 
                <span class=\"d\">[04-20]</span> <span class=\"c\">　欢迎大家对现在的V7版，进行功能上不足的建议，与细节做得不到位而提出批评。我们很乐于倾听各方面不同的声音。

只有大家勇于把问题..<a href=\"http://192.168.176.156/v7/html/39/604.htm\" target=\"_blank\">[详情]</a></span> 
              </div>');
$label['index_hot1']=stripslashes('<div class=\"listb1\"><a href=\"http://192.168.176.156/v7/html/31/668.htm\" target=\"_blank\">fdsa223333</a></div><div class=\"listb2\"><a href=\"http://192.168.176.156/v7/html/31/667.htm\" target=\"_blank\">fdsa2</a></div><div class=\"listb3\"><a href=\"http://192.168.176.156/v7/html/31/666.htm\" target=\"_blank\">fdsa</a></div><div class=\"listb4\"><a href=\"http://192.168.176.156/v7/html/3/663.htm\" target=\"_blank\">&#39;</a></div><div class=\"listb5\"><a href=\"http://192.168.176.156/v7/html/3/664.htm\" target=\"_blank\">官方更名为“齐博CMS”，请大家注意</a></div><div class=\"listb6\"><a href=\"http://192.168.176.156/v7/html/39/604.htm\" target=\"_blank\">V7欢迎大家拍砖，忠言虽逆耳，但利</a></div><div class=\"listb7\"><a href=\"http://192.168.176.156/v7/html/39/603.htm\" target=\"_blank\">齐博V7版文章静态功能,已取得飞跃性</a></div><div class=\"listb8\"><a href=\"http://192.168.176.156/v7/html/3/599.htm\" target=\"_blank\">齐博风格舞台，有梦想你就来齐博CMS</a></div>');
$label['index_5t2']=stripslashes('	<span id=\"Span1\" onmouseover=\"ShowTab(1,1,6)\">文章</span>
            <span id=\"Span2\" onmouseover=\"ShowTab(2,1,6)\">图片</span>
            <span id=\"Span3\" onmouseover=\"ShowTab(3,1,6)\">影视</span>
            <span id=\"Span4\" onmouseover=\"ShowTab(4,1,6)\">商场</span>
            <span id=\"Span5\" onmouseover=\"ShowTab(5,1,6)\">flash</span>');
$label['index_t2']=stripslashes('<div class=\"listpic\">
        	
        <div class=\"img\"><a href=\"http://192.168.176.156/v7/html/3/593.htm\" target=\"_blank\"><img src=\"http://i3.sinaimg.cn/home/deco/2009/0330/con_logo_tech_news.gif\" onerror=\"this.src=\'http://192.168.176.156/v7/images/default/nopic.jpg\'\" width=\"120\" height=\"90\"/></a></div>
            
        <div class=\"t\"><a href=\"http://192.168.176.156/v7/html/3/593.htm\" target=\"_blank\">更名为齐博CMS,深受各大媒体关</a></div>
        </div><div class=\"listpic\">
        	
        <div class=\"img\"><a href=\"http://192.168.176.156/v7/html/4/583.htm\" target=\"_blank\"><img src=\"http://down.qibosoft.com/other/testv6/upload_files/article/4/1_20090419160422_PjOh8_jpg.gif\" onerror=\"this.src=\'http://192.168.176.156/v7/images/default/nopic.jpg\'\" width=\"120\" height=\"90\"/></a></div>
            
        <div class=\"t\"><a href=\"http://192.168.176.156/v7/html/4/583.htm\" target=\"_blank\">产品经理的前世今生（职业规划）</a></div>
        </div><div class=\"listpic\">
        	
        <div class=\"img\"><a href=\"http://192.168.176.156/v7/html/39/578.htm\" target=\"_blank\"><img src=\"http://down.qibosoft.com/other/testv6/upload_files/article/39/1_20090419150430_a2XoC.jpg\" onerror=\"this.src=\'http://192.168.176.156/v7/images/default/nopic.jpg\'\" width=\"120\" height=\"90\"/></a></div>
            
        <div class=\"t\"><a href=\"http://192.168.176.156/v7/html/39/578.htm\" target=\"_blank\">戴志康：和我一样创业的年轻人</a></div>
        </div><div class=\"listpic\">
        	
        <div class=\"img\"><a href=\"http://192.168.176.156/v7/html/34/560.htm\" target=\"_blank\"><img src=\"http://down.qibosoft.com/other/testv6/upload_files/article/34/1_20090420110424_5lRC8.jpg\" onerror=\"this.src=\'http://192.168.176.156/v7/images/default/nopic.jpg\'\" width=\"120\" height=\"90\"/></a></div>
            
        <div class=\"t\"><a href=\"http://192.168.176.156/v7/html/34/560.htm\" target=\"_blank\">chinaz主机网商品快照功能 让您</a></div>
        </div><div class=\"listpic\">
        	
        <div class=\"img\"><a href=\"http://192.168.176.156/v7/html/34/559.htm\" target=\"_blank\"><img src=\"http://down.qibosoft.com/other/testv6/upload_files/article/34/1_20090418210444_jnTex.jpg\" onerror=\"this.src=\'http://192.168.176.156/v7/images/default/nopic.jpg\'\" width=\"120\" height=\"90\"/></a></div>
            
        <div class=\"t\"><a href=\"http://192.168.176.156/v7/html/34/559.htm\" target=\"_blank\">中国移动抢跑3G 上网本迎来“白</a></div>
        </div><div class=\"listpic\">
        	
        <div class=\"img\"><a href=\"http://192.168.176.156/v7/html/33/556.htm\" target=\"_blank\"><img src=\"http://down.qibosoft.com/other/testv6/upload_files/article/33/1_20090418200441_Zm9oq.jpg\" onerror=\"this.src=\'http://192.168.176.156/v7/images/default/nopic.jpg\'\" width=\"120\" height=\"90\"/></a></div>
            
        <div class=\"t\"><a href=\"http://192.168.176.156/v7/html/33/556.htm\" target=\"_blank\">熊晓鸽：怎样拿到他的钱？</a></div>
        </div>');
$label['index_t22']=stripslashes('<br><br>这是演示内容,请自由添加其它内容<br><br><br><br>');
$label['index_t23']=stripslashes('<br><br>2 这是演示内容,请自由添加其它内容<br><br><br><br>');
$label['index_t24']=stripslashes('<br><br>33这是演示内容,请自由添加其它内容<br><br><br><br>');
$label['index_t25']=stripslashes('<br><br>44这是演示内容,请自由添加其它内容<br><br><br><br>');
$label['index_j1']=stripslashes('<div class=\"list1\">
                    	<span class=\"t\"><a href=\"http://192.168.176.156/v7/html/31/668.htm\" target=\"_blank\">fdsa223333</a></span>
                        <span class=\"c\">&nbsp;&nbsp;&nbsp;&nbsp;fsdfasd.</span>
                    </div><div class=\"list2\">
                    	<span class=\"t\"><a href=\"http://192.168.176.156/v7/html/31/667.htm\" target=\"_blank\">fdsa2</a></span>
                        <span class=\"c\">&nbsp;&nbsp;&nbsp;&nbsp;fsdfasd.</span>
                    </div><div class=\"list3\">
                    	<span class=\"t\"><a href=\"http://192.168.176.156/v7/html/31/666.htm\" target=\"_blank\">fdsa</a></span>
                        <span class=\"c\">&nbsp;&nbsp;&nbsp;&nbsp;fsdfasd.</span>
                    </div><div class=\"list4\">
                    	<span class=\"t\"><a href=\"http://192.168.176.156/v7/html/3/663.htm\" target=\"_blank\">&#39;</a></span>
                        <span class=\"c\">&nbsp;&nbsp;&nbsp;&nbsp;中电云集（www.chinaccnet.com）是一家拥有中华人民共和国增值电信业务经营许可证，获准经营因特...</span>
                    </div><div class=\"list5\">
                    	<span class=\"t\"><a href=\"http://192.168.176.156/v7/html/3/664.htm\" target=\"_blank\">官方更名为“齐博CMS”，请大家注意</a></span>
                        <span class=\"c\">&nbsp;&nbsp;&nbsp;&nbsp;一切是为了发展需要.</span>
                    </div><div class=\"list6\">
                    	<span class=\"t\"><a href=\"http://192.168.176.156/v7/html/39/604.htm\" target=\"_blank\">V7欢迎大家拍砖，忠言虽逆耳，但利于行，</a></span>
                        <span class=\"c\">&nbsp;&nbsp;&nbsp;&nbsp;欢迎大家对现在的V7版，进行功能上不足的建议，与细节做得不到位而提出批评。我们很乐于倾听各方...</span>
                    </div><div class=\"list7\">
                    	<span class=\"t\"><a href=\"http://192.168.176.156/v7/html/39/603.htm\" target=\"_blank\">齐博V7版文章静态功能,已取得飞跃性突破,</a></span>
                        <span class=\"c\">&nbsp;&nbsp;&nbsp;&nbsp;齐博V7版文章静态功能,在今天,已取得飞跃性突破,定时全站静态+无人监守静态
定时全站静态指的是,...</span>
                    </div>');
$label['index_j2']=stripslashes('<div class=\"list\"> <span class=\"t\"><em>admin</em> 于 11-09 
                      00:54 对 <a href=\"#\" target=\"_blank\">电子商务成功运作四大要素，不要都去做马云</a></span> 
                      <span class=\"a\">发表如下评论</span> <span class=\"c\">想要在电子商务方面成功,实战很重要!...</span> 
                    </div><div class=\"list\"> <span class=\"t\"><em>admin</em> 于 11-09 
                      00:54 对 <a href=\"#\" target=\"_blank\">新手站长必须知道的50个问题，让你顺利成为草根站长</a></span> 
                      <span class=\"a\">发表如下评论</span> <span class=\"c\">受教非浅.大家都要过来看看,不看会后悔的呀...</span> 
                    </div><div class=\"list\"> <span class=\"t\"><em>admin</em> 于 11-09 
                      00:54 对 <a href=\"#\" target=\"_blank\">V7欢迎大家拍砖，忠言虽逆耳，但利于行，良药虽苦口，但利于病</a></span> 
                      <span class=\"a\">发表如下评论</span> <span class=\"c\">好东西大家要一起分离的哦...</span> 
                    </div>');
$label['index_down']=stripslashes('<div class=\"listc1\"><a href=\"http://192.168.176.156/v7/html/31/668.htm\" target=\"_blank\">fdsa223333</a><span>0次</span></div><div class=\"listc2\"><a href=\"http://192.168.176.156/v7/html/31/667.htm\" target=\"_blank\">fdsa2</a><span>0次</span></div><div class=\"listc3\"><a href=\"http://192.168.176.156/v7/html/31/666.htm\" target=\"_blank\">fdsa</a><span>0次</span></div><div class=\"listc4\"><a href=\"http://192.168.176.156/v7/html/3/663.htm\" target=\"_blank\">&#39;</a><span>7次</span></div><div class=\"listc5\"><a href=\"http://192.168.176.156/v7/html/3/664.htm\" target=\"_blank\">官方更名为“齐博CMS”，请</a><span>2次</span></div><div class=\"listc6\"><a href=\"http://192.168.176.156/v7/html/39/604.htm\" target=\"_blank\">V7欢迎大家拍砖，忠言虽逆</a><span>21次</span></div><div class=\"listc7\"><a href=\"http://192.168.176.156/v7/html/39/603.htm\" target=\"_blank\">齐博V7版文章静态功能,已取</a><span>4次</span></div><div class=\"listc8\"><a href=\"http://192.168.176.156/v7/html/3/599.htm\" target=\"_blank\">齐博风格舞台，有梦想你就</a><span>31次</span></div><div class=\"listc9\"><a href=\"http://192.168.176.156/v7/html/3/598.htm\" target=\"_blank\">应大家要求,V7现增加ckedit</a><span>4次</span></div><div class=\"listc10\"><a href=\"http://192.168.176.156/v7/html/3/595.htm\" target=\"_blank\">V7现已增加定时任务功能 ,</a><span>4次</span></div>');
$label['index_bfj3']=stripslashes('<span id=\"Span11\" onmouseover=\"ShowTab(11,11,15)\">服装</span>
                    <span id=\"Span12\" onmouseover=\"ShowTab(12,11,15)\">数码</span>
                    <span id=\"Span13\" onmouseover=\"ShowTab(13,11,15)\">食品</span>
                    <span id=\"Span14\" onmouseover=\"ShowTab(14,11,15)\">美容</span>');
$label['index_j3']=stripslashes('	<div class=\"listpic\">
                    
              <div class=\"img\"><a href=\"http://192.168.176.156/v7/html/16/636.htm\" target=\"_blank\"><img src=\"http://img03.taobaocdn.com/bao/uploaded/i7/T15QFHXnFOXXcFBFs2_042705.jpg_310x310.jpg\" onerror=\"this.src=\'http://192.168.176.156/v7/images/default/nopic.jpg\'\" width=\"120\" height=\"90\"/></a></div>
                    
              <div class=\"t\"><a href=\"http://192.168.176.156/v7/html/16/636.htm\" target=\"_blank\">掌上电脑 旋屏手机 触屏 +J</a></div>
                    <div class=\"p\"><strike>市场价:￥3999</strike></div>
                    <div class=\"p\"><em>现售价:￥2888</em></div>
                </div>	<div class=\"listpic\">
                    
              <div class=\"img\"><a href=\"http://192.168.176.156/v7/html/16/635.htm\" target=\"_blank\"><img src=\"http://img02.taobaocdn.com/bao/uploaded/i2/T1V_VIXiJeXXXpNbzb_122917.jpg_310x310.jpg\" onerror=\"this.src=\'http://192.168.176.156/v7/images/default/nopic.jpg\'\" width=\"120\" height=\"90\"/></a></div>
                    
              <div class=\"t\"><a href=\"http://192.168.176.156/v7/html/16/635.htm\" target=\"_blank\">高贵LG KG90/KG800 巧克力</a></div>
                    <div class=\"p\"><strike>市场价:￥4444</strike></div>
                    <div class=\"p\"><em>现售价:￥3999</em></div>
                </div>	<div class=\"listpic\">
                    
              <div class=\"img\"><a href=\"http://192.168.176.156/v7/html/16/634.htm\" target=\"_blank\"><img src=\"http://img06.taobaocdn.com/bao/uploaded/i6/T1W2NuXallXXaaewYa_120947.jpg_310x310.jpg\" onerror=\"this.src=\'http://192.168.176.156/v7/images/default/nopic.jpg\'\" width=\"120\" height=\"90\"/></a></div>
                    
              <div class=\"t\"><a href=\"http://192.168.176.156/v7/html/16/634.htm\" target=\"_blank\">才990克 军工 原装正品松下</a></div>
                    <div class=\"p\"><strike>市场价:￥3999</strike></div>
                    <div class=\"p\"><em>现售价:￥2999</em></div>
                </div>	<div class=\"listpic\">
                    
              <div class=\"img\"><a href=\"http://192.168.176.156/v7/html/16/633.htm\" target=\"_blank\"><img src=\"http://img03.taobaocdn.com/bao/uploaded/i3/T1j3xAXeNBXXa35wg3_050109.jpg_310x310.jpg\" onerror=\"this.src=\'http://192.168.176.156/v7/images/default/nopic.jpg\'\" width=\"120\" height=\"90\"/></a></div>
                    
              <div class=\"t\"><a href=\"http://192.168.176.156/v7/html/16/633.htm\" target=\"_blank\">宏基/acer AO532h 超薄10寸</a></div>
                    <div class=\"p\"><strike>市场价:￥2999</strike></div>
                    <div class=\"p\"><em>现售价:￥1999</em></div>
                </div>	<div class=\"listpic\">
                    
              <div class=\"img\"><a href=\"http://192.168.176.156/v7/html/16/632.htm\" target=\"_blank\"><img src=\"http://img03.taobaocdn.com/imgextra/i7/T1VwlwXaFFXXbSH0E8_100145.jpg_310x310.jpg\" onerror=\"this.src=\'http://192.168.176.156/v7/images/default/nopic.jpg\'\" width=\"120\" height=\"90\"/></a></div>
                    
              <div class=\"t\"><a href=\"http://192.168.176.156/v7/html/16/632.htm\" target=\"_blank\">三星 N148-DP03 全新套餐 </a></div>
                    <div class=\"p\"><strike>市场价:￥3000</strike></div>
                    <div class=\"p\"><em>现售价:￥2000</em></div>
                </div>');
$label['index_j32']=stripslashes('dd<br><br>这是演示内容,请自由添加其它内容<br><br><br><br>dd');
$label['index_j33']=stripslashes('<br><br>这是演示内容,请自由添加其它内容<br><br><br><br>');
$label['index_j34']=stripslashes('d<br><br>这是演示内容,请自由添加其它内容<br><br><br><br>');
$label['index_ad3']=stripslashes('<a href=\'http://www.sudu.cn\' target=_blank><img src=\'http://192.168.176.156/v7/upload_files/label/1_20101027171006_q2b2q.gif\'  width=\'220\'  height=\'50\' border=\'0\' /></a>');
$label['index_ad4']=stripslashes('<a href=\'http://www.eydns.com/\' target=_blank><img src=\'http://192.168.176.156/v7/upload_files/label/1_20101027171018_bzfar.gif\'  width=\'220\'  height=\'50\' border=\'0\' /></a>');
$label['index_ad5']=stripslashes('<a href=\'http://www.chinaccnet.com/\' target=_blank><img src=\'http://192.168.176.156/v7/upload_files/label/1_20101027171021_fndoi.gif\'  width=\'220\'  height=\'50\' border=\'0\' /></a>');
$label['index_ad7']=stripslashes('<a href=\'http://u.admin5.com\' target=_blank><img src=\'http://192.168.176.156/v7/upload_files/label/1_20101109141121_uu6ot.gif\'  width=\'990\'  height=\'70\' border=\'0\' /></a>');
$label['index_cc1']=stripslashes('<span>IT业界</span><a href=\"#\">更多&gt;&gt;</a>');
$label['index_c1']=stripslashes('<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
                          <tr>
                            
                    <td class=\"img\"><a href=\"http://192.168.176.156/v7/html/3/593.htm\" target=\"_blank\"><img src=\"http://i3.sinaimg.cn/home/deco/2009/0330/con_logo_tech_news.gif\" onerror=\"this.src=\'http://192.168.176.156/v7/images/default/nopic.jpg\'\" width=\"80\" height=\"60\"/></a></td>
                            <td>
                                
                      <div class=\"t\"><a href=\"http://192.168.176.156/v7/html/3/593.htm\" target=\"_blank\">更名为齐博CMS,深受各大媒体关注!!</a></div>
                                
                      <div class=\"m\">　　一路有你,感谢广大网友一如继往的支持!
同时,也深受广大媒体的关注:
..<a href=\"http://192.168.176.156/v7/html/3/593.htm\" target=\"_blank\">[详细]</a></div>
                            </td>
                          </tr>
                        </table>
                        
                 <div class=\"list\"><a href=\"http://192.168.176.156/v7/html/31/668.htm\" target=\"_blank\">fdsa223333</a><span>[08/26]</span></div>  <div class=\"list\"><a href=\"http://192.168.176.156/v7/html/31/667.htm\" target=\"_blank\">fdsa2</a><span>[08/26]</span></div>  <div class=\"list\"><a href=\"http://192.168.176.156/v7/html/31/666.htm\" target=\"_blank\">fdsa</a><span>[08/26]</span></div>  <div class=\"list\"><a href=\"http://192.168.176.156/v7/html/3/663.htm\" target=\"_blank\">&#39;</a><span>[11/12]</span></div>  <div class=\"list\"><a href=\"http://192.168.176.156/v7/html/3/664.htm\" target=\"_blank\">官方更名为“齐博CMS”，请大家注意</a><span>[12/09]</span></div>');
$label['index_cc2']=stripslashes('<span>社会民生</span><a href=\"#\">更多&gt;&gt;</a>');
$label['index_c2']=stripslashes('<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
                          <tr>                            
                    <td class=\"img\"><a href=\"http://192.168.176.156/v7/html/32/550.htm\" target=\"_blank\"><img src=\"http://down.qibosoft.com/other/testv6/upload_files/article/32/1_20090418180444_f8mDG_jpg.gif\" onerror=\"this.src=\'http://192.168.176.156/v7/images/default/nopic.jpg\'\" width=\"80\" height=\"60\"/></a></td>
                            <td>
                                
                      <div class=\"t\"><a href=\"http://192.168.176.156/v7/html/32/550.htm\" target=\"_blank\">chinaz倾力打造IDC交易平台主机网正式上..</a></div>
                                
                      <div class=\"m\">　　2009年3月23日，中国站长站旗下专业IDC交易平台，主机网（CNIDC.com）正..<a href=\"http://192.168.176.156/v7/html/32/550.htm\" target=\"_blank\">[详细]</a></div>
                            </td>
                          </tr>
                        </table>
                        
                <div class=\"list\"><a href=\"http://192.168.176.156/v7/html/31/545.htm\" target=\"_blank\">V7将保留V6原来的所有功能</a><span>[04/18]</span></div>  <div class=\"list\"><a href=\"http://192.168.176.156/v7/html/32/546.htm\" target=\"_blank\">qibosoft与Phpwind强势整合 打造黄金</a><span>[04/18]</span></div>  <div class=\"list\"><a href=\"http://192.168.176.156/v7/html/32/547.htm\" target=\"_blank\">v7考试系统进一步加强,已实现前台查看</a><span>[04/18]</span></div>  <div class=\"list\"><a href=\"http://192.168.176.156/v7/html/32/548.htm\" target=\"_blank\">v7考试系统已支持随机出题与考试时间</a><span>[04/18]</span></div>  <div class=\"list\"><a href=\"http://192.168.176.156/v7/html/32/549.htm\" target=\"_blank\">透露一下V7的进展,已增强会员积分消费</a><span>[04/18]</span></div>');
$label['index_member']=stripslashes('<div class=\"listuser\">
                	
                <div class=\"img\"><a href=\"http://192.168.176.156/v7/member/homepage.php?uid=1\" target=\"_blank\"><img src=\"http://192.168.176.156/v7/upload_files/icon/1.jpg\" onerror=\"this.src=\'http://192.168.176.156/v7/images/default/nobody.gif\'\" width=\"50\" height=\"50\"/></a></div>
                	
                <div class=\"name\"><a href=\"http://192.168.176.156/v7/member/homepage.php?uid=1\" target=\"_blank\">admin</a></div>
                </div><div class=\"listuser\">
                	
                <div class=\"img\"><a href=\"http://192.168.176.156/v7/member/homepage.php?uid=2\" target=\"_blank\"><img src=\"\" onerror=\"this.src=\'http://192.168.176.156/v7/images/default/nobody.gif\'\" width=\"50\" height=\"50\"/></a></div>
                	
                <div class=\"name\"><a href=\"http://192.168.176.156/v7/member/homepage.php?uid=2\" target=\"_blank\">test</a></div>
                </div>');
$label['index_pk']=stripslashes('<SCRIPT src=\'http://192.168.176.156/v7/vote/vote.php?job=js&cid=10\'></SCRIPT>');
$label['index_ad8']=stripslashes('<a href=\'http://www.chinaccnet.com/\' target=_blank><img src=\'http://192.168.176.156/v7/upload_files/label/1_20101109141128_eq3o1.jpg\'  width=\'270\'  height=\'60\' border=\'0\' /></a>');
$label['index_vote2']=stripslashes('<SCRIPT src=\'http://192.168.176.156/v7/vote/vote.php?job=js&cid=12\'></SCRIPT>');
$label['index_digg']=stripslashes('<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" class=\"listConcern\">
                  <tr>
                    <td class=\"L\"><div class=\"n\" id=\"DiggNum_668\">0</div><div class=\"d\"><a href=\"http://192.168.176.156/v7/do/job.php?job=digg&type=vote&id=668\" target=\"DiggIframe_668\">顶一下</a></div></td>
                    <td class=\"R\"><a href=\"http://192.168.176.156/v7/html/31/668.htm\" class=\"a1\" target=\"_blank\">fdsa223333</a></td>
                  </tr>
                </table>
<div style=\"display:none;\"><iframe src=\"about:blank\" width=0 height=0 name=\"DiggIframe_668\" id=\"DiggIframe_668\"></iframe></div><table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" class=\"listConcern\">
                  <tr>
                    <td class=\"L\"><div class=\"n\" id=\"DiggNum_667\">0</div><div class=\"d\"><a href=\"http://192.168.176.156/v7/do/job.php?job=digg&type=vote&id=667\" target=\"DiggIframe_667\">顶一下</a></div></td>
                    <td class=\"R\"><a href=\"http://192.168.176.156/v7/html/31/667.htm\" class=\"a2\" target=\"_blank\">fdsa2</a></td>
                  </tr>
                </table>
<div style=\"display:none;\"><iframe src=\"about:blank\" width=0 height=0 name=\"DiggIframe_667\" id=\"DiggIframe_667\"></iframe></div><table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" class=\"listConcern\">
                  <tr>
                    <td class=\"L\"><div class=\"n\" id=\"DiggNum_666\">0</div><div class=\"d\"><a href=\"http://192.168.176.156/v7/do/job.php?job=digg&type=vote&id=666\" target=\"DiggIframe_666\">顶一下</a></div></td>
                    <td class=\"R\"><a href=\"http://192.168.176.156/v7/html/31/666.htm\" class=\"a3\" target=\"_blank\">fdsa</a></td>
                  </tr>
                </table>
<div style=\"display:none;\"><iframe src=\"about:blank\" width=0 height=0 name=\"DiggIframe_666\" id=\"DiggIframe_666\"></iframe></div><table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" class=\"listConcern\">
                  <tr>
                    <td class=\"L\"><div class=\"n\" id=\"DiggNum_663\">0</div><div class=\"d\"><a href=\"http://192.168.176.156/v7/do/job.php?job=digg&type=vote&id=663\" target=\"DiggIframe_663\">顶一下</a></div></td>
                    <td class=\"R\"><a href=\"http://192.168.176.156/v7/html/3/663.htm\" class=\"a4\" target=\"_blank\">&#39;</a></td>
                  </tr>
                </table>
<div style=\"display:none;\"><iframe src=\"about:blank\" width=0 height=0 name=\"DiggIframe_663\" id=\"DiggIframe_663\"></iframe></div>');
$label['index_trrr1']=stripslashes('<span id=\"Span6\" onmouseover=\"ShowTab(6,6,11)\">文章</span>
            <span id=\"Span7\" onmouseover=\"ShowTab(7,6,11)\">图片</span>
            <span id=\"Span8\" onmouseover=\"ShowTab(8,6,11)\">影视</span>
            <span id=\"Span9\" onmouseover=\"ShowTab(9,6,11)\">商场</span>
            <span id=\"Span10\" onmouseover=\"ShowTab(10,6,11)\">flash</span>');
$label['index_tr1']=stripslashes('<div class=\"listzt\">
        	<div class=\"img\"><a target=\"_blank\" href=\"http://192.168.176.156/v7/do/showsp.php?fid=1&id=24\"><img src=\"http://down.qibosoft.com/other/testv6/upload_files/special/1_20090419140403_B36H1.jpg\" onerror=\"this.src=\'http://192.168.176.156/v7/images/default/nopic.jpg\'\" width=\"120\" height=\"160\"/></a></div>
            <div class=\"t\"><a target=\"_blank\" href=\"http://192.168.176.156/v7/do/showsp.php?fid=1&id=24\">成长中和成功的中国CEO</a></div>
        </div><div class=\"listzt\">
        	<div class=\"img\"><a target=\"_blank\" href=\"http://192.168.176.156/v7/do/showsp.php?fid=1&id=19\"><img src=\"http://down.qibosoft.com/other/testv6/upload_files/special/1_20101119091108_agkc8.jpg\" onerror=\"this.src=\'http://192.168.176.156/v7/images/default/nopic.jpg\'\" width=\"120\" height=\"160\"/></a></div>
            <div class=\"t\"><a target=\"_blank\" href=\"http://192.168.176.156/v7/do/showsp.php?fid=1&id=19\">希金斯赌球丑闻后首露面</a></div>
        </div><div class=\"listzt\">
        	<div class=\"img\"><a target=\"_blank\" href=\"http://192.168.176.156/v7/do/showsp.php?fid=1&id=23\"><img src=\"http://down.qibosoft.com/other/testv6/upload_files/special/1_20090419140451_9nuT0.jpg\" onerror=\"this.src=\'http://192.168.176.156/v7/images/default/nopic.jpg\'\" width=\"120\" height=\"160\"/></a></div>
            <div class=\"t\"><a target=\"_blank\" href=\"http://192.168.176.156/v7/do/showsp.php?fid=1&id=23\">中国互联网观点参考</a></div>
        </div><div class=\"listzt\">
        	<div class=\"img\"><a target=\"_blank\" href=\"http://192.168.176.156/v7/do/showsp.php?fid=1&id=22\"><img src=\"http://down.qibosoft.com/other/testv6/upload_files/special/1_20101119161104_fdxqf.jpg\" onerror=\"this.src=\'http://192.168.176.156/v7/images/default/nopic.jpg\'\" width=\"120\" height=\"160\"/></a></div>
            <div class=\"t\"><a target=\"_blank\" href=\"http://192.168.176.156/v7/do/showsp.php?fid=1&id=22\">奥迪A3限量版上市 四款同级进</a></div>
        </div><div class=\"listzt\">
        	<div class=\"img\"><a target=\"_blank\" href=\"http://192.168.176.156/v7/do/showsp.php?fid=1&id=21\"><img src=\"http://down.qibosoft.com/other/testv6/upload_files/special/1_20101122151126_wvvvp.jpg\" onerror=\"this.src=\'http://192.168.176.156/v7/images/default/nopic.jpg\'\" width=\"120\" height=\"160\"/></a></div>
            <div class=\"t\"><a target=\"_blank\" href=\"http://192.168.176.156/v7/do/showsp.php?fid=1&id=21\">聚焦美国汇率改革促进公平贸</a></div>
        </div><div class=\"listzt\">
        	<div class=\"img\"><a target=\"_blank\" href=\"http://192.168.176.156/v7/do/showsp.php?fid=1&id=20\"><img src=\"http://down.qibosoft.com/other/testv6/upload_files/special/1_20101122161134_u6aeu.jpg\" onerror=\"this.src=\'http://192.168.176.156/v7/images/default/nopic.jpg\'\" width=\"120\" height=\"160\"/></a></div>
            <div class=\"t\"><a target=\"_blank\" href=\"http://192.168.176.156/v7/do/showsp.php?fid=1&id=20\">英国首相卡梅伦2010年访华</a></div>
        </div>');
$label['index_tr12']=stripslashes('1<br><br>这是演示内容,请自由添加其它内容<br><br><br><br>');
$label['index_tr13']=stripslashes('2<br><br>这是演示内容,请自由添加其它内容<br><br><br><br>2');
$label['index_tr14']=stripslashes('3<br><br>这是演示内容,请自由添加其它内容<br><br><br><br>3');
$label['index_tr15']=stripslashes('4<br><br>这是演示内容,请自由添加其它内容<br><br><br><br>6');
$label['bodyad']=stripslashes('<a href=\'http://www.phpwind.net/read-htm-tid-761520.html\' target=_blank><img src=\'http://down.qibosoft.com/other/testv6/upload_files/label/1_20090420140457_NOGYw.jpg\'  width=\'990\'  height=\'80\' border=\'0\' /></a>');
$label['Title1']=stripslashes('web新闻');
$label['Title2']=stripslashes('求职招聘');
$label['Title3']=stripslashes('软件下载');
$label['Title4']=stripslashes('社会新闻');
$label['Title5']=stripslashes('文章评论');
$label['Title6']=stripslashes('优秀会员');
$label['Title01']=stripslashes('热门文章');
$label['Title02']=stripslashes('最受关注');
$label['Title_jinjaad']=stripslashes('投票调查');
$label['jinjaad']=stripslashes('<SCRIPT src=\'http://192.168.176.156/v7/do/vote.php?job=js&cid=6\'></SCRIPT>');
$label['bjsptitle']=stripslashes('推荐专题');
$label['Title04']=stripslashes('访客留言');
$label['bb1']=stripslashes('<table width=\"100%\" border=\"0\" cellspacing=\"1\" cellpadding=\"3\" bgcolor=\"#ffffff\">
        <tr align=\"center\" bgcolor=\"#EBEBEB\"> 
          <td width=\"36%\">求职岗位</td>
          <td width=\"13%\">学历</td>
          <td width=\"14%\">性别</td>
          <td width=\"13%\">工作年限</td>
          <td width=\"13%\">年龄</td>
          <td width=\"11%\">详情</td>
        </tr> 
</table>');
$label['b02']=stripslashes('<table width=\"100%\" border=\"0\" cellspacing=\"1\" cellpadding=\"3\" bgcolor=\"#ffffff\">
        <tr align=\"center\" bgcolor=\"#EBEBEB\"> 
          <td width=\"36%\">招聘职位</td>
          <td width=\"13%\">学历要求</td>
          <td width=\"14%\">性别要求</td>
          <td width=\"13%\">经验要求</td>
          <td width=\"13%\">月薪待遇</td>
          <td width=\"11%\">详情</td>
        </tr> 
      </table>');
$label['Title05']=stripslashes('商城购物');
$label['bodyad2']=stripslashes('<img src=\'http://192.168.176.156/v7/upload_files/\'    border=\'0\' />');
$label['Title4d']=stripslashes('搜索引擎之PK战');
$label['c2d']=stripslashes('<SCRIPT src=\'http://192.168.176.156/v7/do/vote.php?job=js&cid=10\'></SCRIPT>');
$label['Title5d']=stripslashes('2008年中国站长八大热门');
$label['b2d']=stripslashes('<SCRIPT src=\'http://192.168.176.156/v7/do/vote.php?job=js&cid=11\'></SCRIPT>');
$label['Title04d']=stripslashes('推荐图文');
$label['c2de']=stripslashes('<a href=\'http://www.371.com/\' target=_blank><img src=\'http://down.qibosoft.com/other/testv6/upload_files/label/1_20090420130440_bWzOZ.jpg\'  width=\'242\'  height=\'98\' border=\'0\' /></a>');
$label['bodyad33']=stripslashes('<a href=\'http://www.yeepay.com/\' target=_blank><img src=\'http://down.qibosoft.com/other/testv6/upload_files/label/1_20090418150428_gPa47.jpg\'  width=\'243\'  height=\'90\' border=\'0\' /></a>');
$label['showinfo']=stripslashes('<SCRIPT LANGUAGE=\"JavaScript\">
<!--
document.write(\'<span id=\"num_info\"><img alt=\"内容加载中,请稍候...\" src=\"http://192.168.176.156/v7/images/default/ico_loading3.gif\"></span>\');
document.write(\'<div style=\"display:none;\"><iframe src=\"http://192.168.176.156/v7/do/job.php?job=getinfo&iframeID=num_info\" width=0 height=0></iframe></div>\');
//-->
</SCRIPT>');
$label['index_tr01']=stripslashes('<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
          <tr>
            <td class=\"choose\"><a href=\"#\" class=\"nbor\">文章</a></td>
            <td><a href=\"#\" class=\"nbor\">图片</a></td>
            <td><a href=\"#\">影视</a></td>
            <td><a href=\"#\">商场</a></td>
            <td><a href=\"#\">flash</a></td>
          </tr>
        </table> ');
?>