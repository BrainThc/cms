<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<meta property="qc:admins" content="07303643462122363757" />
<meta name="robots" content="index, follow" />
<meta name="keywords" content="<?php echo ($seo_keywords); ?>" />
<meta name="description" content="<?php echo ($seo_description); ?>" />
<meta name="Copyright" content="ieconn.com 一贯科技" />
<meta name="author" content="<?php echo ($site_name); ?>">
<meta name="generator" content="ieconn.com 佛山建站" />
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE9" />
<title><?php echo ($seo_title); ?>-<?php echo ($site_name); ?></title>
<link href="__ROOT__/favicon.ico" type="image/x-icon" rel="shortcut icon"  />
<script type="text/javascript">
/*JS全局配置*/
var APP	 =	 '__APP__';
var ROOT =	 '__ROOT__';
var PUBLIC = '__PUBLIC__';
var LANG = '<?php echo ($l); ?>';

</script>
<?php  if($catid){ $catid1 = column($Categorys,$catid,1); $catid2 = column($Categorys,$catid,2); } ?>
<!--通用-->

<!-- <link rel="stylesheet" type="text/css" href="__PUBLIC__/Css/common.css" />
<link rel="stylesheet" type="text/css" href="../Public/css/style.css" /> 

<script type="text/javascript" src="__PUBLIC__/Js/jquery.min.js" ></script>
<script type="text/javascript" src="__PUBLIC__/Js/my.js"></script>
<script type="text/javascript" src="__PUBLIC__/Js/divcms.js"></script>
<script type="text/javascript" src="__PUBLIC__/Js/divcms.nav.js"></script>
<script type="text/javascript" src="__PUBLIC__/Js/scrolltopcontrol.js"></script>
<script type="text/javascript" src="__PUBLIC__/Js/jquery.validate.js"></script> -->


<link rel="stylesheet" type="text/css" href="__STYLE__/css/style.css" />
<link rel="stylesheet" type="text/css" href="__STYLE__/css/idangerous.swiper.css" /> 
<link rel="stylesheet" type="text/css" href="__STYLE__/css/aos.css" />
<link rel="stylesheet" href="__STYLE__/css/owl.carousel.css">
<link rel="stylesheet" href="__STYLE__/css/owl.theme.css">

<script type="text/javascript" src="__STYLE__/js/jquery.min.js"></script>
<script type="text/javascript" src="__STYLE__/js/index.js"></script>


<script type="text/javascript">

var mobileAgent = new Array("iphone", "ipod", "ipad", "android", "mobile", "blackberry", "webos", "incognito", "webmate", "bada", "nokia", "lg", "ucweb", "skyfire");

var browser = navigator.userAgent.toLowerCase(); 

var isMobile = false; 

for (var i=0; i<mobileAgent.length; i++){ if (browser.indexOf(mobileAgent[i])!=-1){ isMobile = true; 

//alert(mobileAgent[i]); 

location.href = 'http://www.ieconn.com/index.php';

break; } } 

</script>






 
</head>

<body >
<!--载入头部--> 

<header class="header"  id="headdiv">
        <div class="header-bg">
          <div class="header-t">
            <div class="header_left fl">
                <p><?php echo ($index_left); ?></p>
            </div>
            <div class="fr">
              <div class="top">
                <span class="call">
                </span>
                <span class="call_tel">
                  <?php echo ($site_mphone); ?>
                </span>
                <a>
                  <span class="email">
                  </span>
                  <?php echo ($site_email); ?>
                </a>
                <a class="ewm">
                  <span class="weixin">
                  </span>
                  一贯科技公众号
                  <img src="__STYLE__/img/wei.jpg"
                  width="258" height="258" alt="一贯科技微信公众号" />
                </a>
              </div>

          </div>
          </div>
        </div>
        <div class="wrap">
          <h1 class="fl">
            <a href="<?php echo HOMEURL();?>" class="fl logo">
              <img src="<?php echo ($site_logo); ?>"
              alt="一贯科技" width="203" height="64" />
            </a>
          </h1>
          <div class="fr">
            <nav class="nav">
              <ul class="fix">
                <li <?php if($ishome=='home') : ?>id="menu"<?php endif;?>>
                  <a href="<?php echo HOMEURL();?>">
                    官网首页
                  </a>
                </li>

            <?php $n=0;foreach($Categorys as $key=>$cat):if( $cat['ismenu']==1 && intval(0)==$cat["parentid"] ) :++$n; if(0!=0 && $n > 0) break;?><li id="<?php if(is_child($catid,$cat['arrchildid'])) : ?>menu<?php endif;?>">
                  <a href="<?php echo ($cat["url"]); ?>">
                    <?php echo ($cat["catname"]); ?>
                  </a>
                </li><?php endif; endforeach;?>

              </ul>
              <span class="nav_icon">
              </span>
            </nav>
            </div>
          </div>
        </div>
      </header>

      <script type="text/javascript">
          window.onscroll=function(){
            var top=window.pageYOffset||document.documentElement.scrollTop||document.body.scrollTop;
            var node=document.getElementById('headdiv');
            if(top<100){
                node.style.top='0px';
            }else{
                node.style.top='-50px';
                node.style.transition='0.2s';
            }
        }

    </script>
      <script type="text/javascript">

        document.getElementById('menu').className = "on";

        

      </script>


      


 

<!--载入主体--> 
<div class="container">
      <div class="content" id="dowebok">
        <div class="webdesign1 section">
            <div class="bg01"></div>
            <div class="bg02">
                <h3>一贯科技高端网站建设</h3>
            </div>
            <div class="bg03"></div>
            <div class="bg04"></div>
            <div class="bg05"><a href="<?php echo ($Categorys[29]['url']); ?>" class="p_more">了解详情</a></div>
        </div>
        <div class="webdesign2 section">
            <div class="bg06">
                <h3>一贯科技微信小程序开发网站建设</h3>
            </div>
            <div class="bg07"></div>
            <div class="bg08"><a href="<?php echo ($Categorys[30]['url']); ?>" class="p_more">了解详情</a></div>
            <div class="bg09"></div>
        </div>
        <div class="webdesign3 section">
            <div class="bg10">
                <h3>一贯科技SEO优化</h3>
            </div>
            <div class="bg11"></div>
            <div class="bg12"><a href="<?php echo ($Categorys[31]['url']); ?>" class="p_more">了解详情</a></div>
            <div class="bg13"></div>
        </div>
        <div class="webdesign4 section">
            <div class="bg14"></div>
            <div class="bg15">
                <h3>一贯科技响应式网站设计</h3>
            </div>
            <div class="bg16"></div>
            <div class="bg17"><a href="<?php echo ($Categorys[32]['url']); ?>" class="p_more">了解详情</a></div>
        </div>
        <div class="webdesign5 section">
            <div class="bg18">
                 <h3>一贯科技微官网网站建设</h3>
            </div>
            <div class="bg19"></div>
            <div class="bg22"></div>
            <div class="bg20"><a href="<?php echo ($Categorys[33]['url']); ?>" class="p_more">了解详情</a></div>
            <div class="bg21"></div>
        </div>
        <div class="webdesign6 section">
            <div class="bg23">
                <h3>一贯科技网站设计服务</h3>
            </div>
            <div class="bg24"></div>
            <div class="bg25"></div>
            <div class="bg26"></div>
            <div class="bg27"></div>
            <div class="bg28"></div>
            <div class="bg29"></div>
            <div class="bg30"><a href="<?php echo ($Categorys[34]['url']); ?>" class="p_more">了解详情</a></div>
        </div>
        <div class="webdesign7 section">
            <div class="bg31"></div>
            <div class="bg32">
                <h3>一贯科技网站产品拍摄</h3>
            </div>
            <div class="bg33"></div>
            <div class="bg34"><a href="<?php echo ($Categorys[35]['url']); ?>" class="p_more">了解详情</a></div>
            <div class="bg35"></div>
        </div>
        <div class="webdesign8 section">
            <div class="bg36"></div>
            <div class="bg37">
                 <h3>一贯科技网站APP开发</h3>
            </div>
            <div class="bg38"></div>
            <div class="bg39"></div>
            <div class="bg40"></div>
            <div class="bg41"><a href="<?php echo ($Categorys[36]['url']); ?>" class="p_more">了解详情</a></div>
        </div>
        <div class="webdesign9 section">
            <div class="bg42">
                <h3>一贯科技合作流程</h3>
            </div>
        </div>
      </div>
    </div>


<script type="text/javascript" src="__STYLE__/js/jquery.fullPage.min.js"></script>
<script type="text/javascript" src="__STYLE__/js/webdesign.js"></script>



 


<!--载入页脚--> 

      <div class="index_contact">
          <div class="index_contact_tit" aos="fade-down" aos-delay="150">
            <img src="__STYLE__/img/index7.png" alt="联系我们" width="341" height="33" />
          </div>
          <p class="index_contact_p" aos="fade-up" aos-delay="300">一个人能走多远，取决于与谁同行，壹贯团队是一个富有理想和激情的团队，也是一个技术专业化、创新性和学习型的优秀团队</p>

          <div class="i_contact_ul">
            <ul>
              <li aos="fade-up" aos-delay="400"><a href="tel:0757-82903896" title="24小时服务热线"><img src="__STYLE__/img/contact_pic.png" alt="佛山网站建设电话">24小时服务热线 ：<?php echo ($site_phone); ?></a></li>
              <li aos="fade-up" aos-delay="600"><a href="mailto:1010426086@qq.com" title="E-mail"><img src="__STYLE__/img/contact_pic2.png" alt="佛山网站建设邮箱">E-mail ：<?php echo ($site_email); ?></a></li>
              <li aos="fade-up" aos-delay="800"><a href="javascript:void(0)" title="企业QQ"><img src="__STYLE__/img/contact_pic3.png" alt="佛山网站建设联系方式">企业QQ ：<?php echo ($site_qq); ?></a></li>
              <li aos="fade-up" aos-delay="1000"><a href="javascript:void(0)" title="佛山网站建设公司地址"><img src="__STYLE__/img/contact_pic4.png"><?php echo ($site_address); ?></a></li>
            </ul>
          </div>
      </div>


 <footer class="footer">
        
  <?php if($module_name == 'Index') : ?>
    <?php if($action_name == 'index') : ?>
        <div class="blogroll">
          <div class="wrap">
            <div class="index_you fl"><p class="youqing">友情链接</p></div>
            <div class="index_you_right fr">
            <span>
            <?php  $_result=M("Link")->field("*")->where(" status = 1  and lang=1 and  linktype=1")->order("id desc")->limit("10")->select();; if ($_result): $i=0;foreach($_result as $key=>$r):++$i;$mod = ($i % 2 );?><a href="<?php echo ($r['siteurl']); ?>" target="_blank" title="<?php echo ($r['name']); ?>"><?php echo ($r['name']); ?></a>&nbsp;<?php endforeach; endif;?>
            </span>
          </div>
        </div>
        </div>
    <?php endif;?>
  <?php endif;?>

        <div class="foot">
          <div class="foot_center" style="width:1200px; margin:0 auto;">
          <div class="foot_text">
          <p>Copyright © 2012-2018 深圳一贯科技佛山分公司
          </p>
          <p><a href="http://www.miitbeian.gov.cn/" target="_blank" rel="nofollow">粤ICP备12024769号-5</a></p>
          </div>


          <div class="w-share">
            <div class="bdsharebuttonbox">
              <a href="#" class="bds_more" data-cmd="more"></a>
              <a href="#" class="bds_qzone" data-cmd="qzone" title="分享到QQ空间"></a>
              <a href="#" class="bds_tsina" data-cmd="tsina" title="分享到新浪微博"></a>
              <a href="#" class="bds_tqq" data-cmd="tqq" title="分享到腾讯微博"></a>
              <a href="#" class="bds_renren" data-cmd="renren" title="分享到人人网"></a>
              <a href="#" class="bds_weixin" data-cmd="weixin" title="分享到微信"></a>
            </div>
          </div>

          <div class="foot_button">
            <ul>
              <li><a href="tencent://message/?uin=1619032865&Menu=yes&Service=300&sigT=42a1e5347953b64c5ff3980f8a6e644d4b31456cb0b6ac6b27663a3c4dd0f4aa14a543b1716f9d45" rel="external nofollow" target="_blank" title="qq客服"><img src="__STYLE__/img/foot_icon01.png" alt="qq客服"></a></li>
              <li><img src="__STYLE__/img/foot_icon02.png" class="wchat" alt="公众号"><div class="wem1"></div></li>
              <li><img src="__STYLE__/img/foot_icon04.png" class="weibo" alt="手机版"><div class="wem2"></div></li>
              <li><a href="<?php echo ($site_wb); ?>" target="_blank" rel="nofollow" title="新浪微博"><img src="__STYLE__/img/foot_icon03.png" alt="新浪微博"></a></li>
              <li><a href="<?php echo ($site_gs); ?>" target="_blank" rel="nofollow"><img src="__STYLE__/img/foot_icon0322.png"></a></li>
            </ul>
          </div>
          </div>
          </div>

      </footer>

    <div class="float_qq">
      <ul>
        <li class="float_qq1" style="left: 0px;"><a href="tencent://message/?uin=1619032865&Menu=yes&Service=300&sigT=42a1e5347953b64c5ff3980f8a6e644d4b31456cb0b6ac6b27663a3c4dd0f4aa14a543b1716f9d45" rel="external nofollow" target="_blank"><img width="24" height="24" src="__STYLE__/img/float_qqicon2.png">点击咨询</a></li>
        <li class="float_qq2" style="left: 0px;"><a href="javascript:void(0);" rel="external nofollow"><img width="24" height="24" src="__STYLE__/img/float_qqicon3.png">0757-82903896</a></li>
        <li class="float_qq3">
          <a href="javascript:void(0);" rel="external nofollow"><img width="24" height="24" src="__STYLE__/img/float_qqicon4.png"></a>
          <div class="float_shwx" style="display: none;"><img width="188" height="188" alt="壹贯科技微信" src="__STYLE__/img/wei.jpg"></div>
        </li>
        <li class="float_qq4" style="display: list-item;"><a href="javascript:void(0);" rel="external nofollow"><img width="24" height="24" src="__STYLE__/img/float_qqicon1.png"></a>
        </li>
        <!-- <li class="float_qq5" style="left: 0px;"><a href="javascript:void(0);" id="xuqiumov" style="cursor:pointer" rel="external nofollow"><img width="24" height="24" src="float_xuqiu.png">提交需求</a></li> -->
        
      </ul>
    </div>





<script type="text/javascript" src="__STYLE__/js/idangerous.swiper.min.js"></script>
<script type="text/javascript" src="__STYLE__/js/aos.js"></script>
<script type="text/javascript" src="__STYLE__/js/common.js"></script>
<script type="text/javascript">
// 底部微信二维码
  $('.wchat').hover(function(){
    $('.wem1').stop().fadeIn();
  },function(){
    $('.wem1').stop().fadeOut();
  });
  // 底部微博二维码
  $('.weibo').hover(function(){
    $('.wem2').stop().fadeIn();
  },function(){
    $('.wem2').stop().fadeOut();
  });


window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"","bdMini":"2","bdMiniList":false,"bdPic":"","bdStyle":"1","bdSize":"24"},"share":{},"selectShare":{"bdContainerClass":null,"bdSelectMiniList":["qzone","tsina","tqq","renren","weixin"]}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];


</script>

<?php if($module_name == 'Index') : ?>
    <?php if($action_name == 'index') : ?>
    <script>
    var _hmt = _hmt || [];
    (function() {
      var hm = document.createElement("script");
      hm.src = "https://hm.baidu.com/hm.js?fe7d2172cd651382c3a34594f860c76b";
      var s = document.getElementsByTagName("script")[0]; 
      s.parentNode.insertBefore(hm, s);
    })();
    </script>
    <?php endif;?>
<?php endif;?>




    

</body>
</html>