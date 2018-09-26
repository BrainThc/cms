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

<link rel="stylesheet" type="text/css" href="__STYLE__/css/index.css" />

    
      <div class="banner"> 
          
<?php if($exhost[0] == 'm' || isMobile()) : ?>
 <?php  $_result=M('Slide_data')->where(" status=1 and  fid=1  and lang=1")->order(" listorder ASC ,id DESC ")->limit("3")->select();;if ($_result): $i=0;foreach($_result as $key=>$r):$i++;$mod = ($i % 2 );parse_str($r['data'],$r['param']);?>
  <div class="swiper-slide">
    <a <?php if($r[link]) : ?> href="<?php echo ($r["link"]); ?>"<?php endif;?>><img src="<?php echo ($r["small"]); ?>" alt="<?php echo ($r["title"]); ?>" height="250"></a>
  </div>
<?php endforeach; endif;?>
<?php else :?>

<!--banner-->
      
        <ul class="pic" id="pic">
        <?php  $_result=M('Slide_data')->where(" status=1 and  fid=1  and lang=1")->order(" listorder ASC ,id DESC ")->limit("3")->select();;if ($_result): $i=0;foreach($_result as $key=>$r):$i++;$mod = ($i % 2 );parse_str($r['data'],$r['param']);?>
          <li style="background-image:url(<?php echo ($r["pic"]); ?>)">
            <a title="<?php echo ($r["title"]); ?>" href="<?php echo ($r["url"]); ?>">
            </a>
          </li>
         <?php endforeach; endif;?>
        </ul>
        <ul class="list" id="list_pic">
        <?php  $_result=M('Slide_data')->where(" status=1 and  fid=1  and lang=1")->order(" listorder ASC ,id DESC ")->limit("3")->select();;if ($_result): $i=0;foreach($_result as $key=>$r):$i++;$mod = ($i % 2 );parse_str($r['data'],$r['param']);?>
          <li <?php if($i==1) : ?>class="on"<?php endif;?>>
          </li>
        <?php endforeach; endif;?>
        </ul>


<?php endif;?>
      </div>

    <!--main-->
      
     <div class="index_fuwu">
        <div class="index_fuwu_tit" aos="fade-down" aos-delay="150">
            <img src="__STYLE__/img/index1.png" alt="服务范围" width="300" height="33" />
        </div>
        <p aos="fade-up" aos-delay="300">从PC到移动互联网壹贯科技打造一个全方位的互联网营销体系</p>
        <div class="index_fuwu_list">
            <div class="wrap">
            <ul>
              <li aos="fade-up" aos-delay="300">
                <a href="<?php echo ($Categorys[29]['url']); ?>">
                  <div class="index_box">
                      <div class="index_box_1">
                        <div class="index_box_1_sm" style="background: url(<?php echo ($Categorys[29]['image']); ?>) center no-repeat;"></div>
                      </div>
                      <p class="index_box_p1"><?php echo ($Categorys[29]['catname']); ?></p>
                      <p class="index_box_p2"><?php echo ($Categorys[29]['description']); ?></p>
                  </div>
                  <div class="index_box_show">
                      <div class="index_box2">
                          <img src="__STYLE__/img/h1.png" alt="了解网站建设">
                          <a href="<?php echo ($Categorys[29]['url']); ?>" class="index_box2_more">了解更多>></a>
                      </div>
                      <p class="index_box_p1"><?php echo ($Categorys[29]['catname']); ?></p>
                      <p class="index_box_p2"><?php echo ($Categorys[29]['description']); ?></p>
                  </div>
                </a>
              </li>

              <li aos="fade-up" aos-delay="500">
                <a href="<?php echo ($Categorys[30]['url']); ?>">
                  <div class="index_box">
                      <div class="index_box_1">
                        <div class="index_box_2_sm" style="background: url(<?php echo ($Categorys[30]['image']); ?>) center no-repeat;"></div>
                         <!--  <img src="__STYLE__/img/i6.png"> -->
                      </div>
                      <p class="index_box_p1"><?php echo ($Categorys[30]['catname']); ?></p>
                      <p class="index_box_p2"><?php echo ($Categorys[30]['description']); ?></p>
                  </div>
                  <div class="index_box_show">
                      <div class="index_box2">
                          <img src="__STYLE__/img/h1.png" alt="了解网站建设">
                          <a href="<?php echo ($Categorys[30]['url']); ?>" class="index_box2_more">了解更多>></a>
                      </div>
                      <p class="index_box_p1"><?php echo ($Categorys[30]['catname']); ?></p>
                      <p class="index_box_p2"><?php echo ($Categorys[30]['description']); ?></p>
                  </div>
                </a>
              </li>

              <li aos="fade-up" aos-delay="700">
                <a href="<?php echo ($Categorys[31]['url']); ?>">
                  <div class="index_box">
                      <div class="index_box_1">
                        <div class="index_box_3_sm" style="background: url(<?php echo ($Categorys[31]['image']); ?>) center no-repeat;"></div>
                         <!--  <img src="__STYLE__/img/i6.png"> -->
                      </div>
                      <p class="index_box_p1"><?php echo ($Categorys[31]['catname']); ?></p>
                      <p class="index_box_p2"><?php echo ($Categorys[31]['description']); ?></p>
                  </div>
                  <div class="index_box_show">
                      <div class="index_box2">
                          <img src="__STYLE__/img/h1.png" alt="了解网站建设">
                          <a href="<?php echo ($Categorys[31]['url']); ?>" class="index_box2_more">了解更多>></a>
                      </div>
                      <p class="index_box_p1"><?php echo ($Categorys[31]['catname']); ?></p>
                      <p class="index_box_p2"><?php echo ($Categorys[31]['description']); ?></p>
                  </div>
                </a>
              </li>

              <li aos="fade-up" aos-delay="900">
                <a href="<?php echo ($Categorys[32]['url']); ?>">
                  <div class="index_box">
                      <div class="index_box_1">
                        <div class="index_box_4_sm" style="background: url(<?php echo ($Categorys[32]['image']); ?>) center no-repeat;"></div>
                         <!--  <img src="__STYLE__/img/i6.png"> -->
                      </div>
                      <p class="index_box_p1"><?php echo ($Categorys[32]['catname']); ?></p>
                      <p class="index_box_p2"><?php echo ($Categorys[32]['description']); ?></p>
                  </div>
                  <div class="index_box_show">
                      <div class="index_box2">
                          <img src="__STYLE__/img/h1.png" alt="了解网站建设">
                          <a href="<?php echo ($Categorys[32]['url']); ?>" class="index_box2_more">了解更多>></a>
                      </div>
                      <p class="index_box_p1"><?php echo ($Categorys[32]['catname']); ?></p>
                      <p class="index_box_p2"><?php echo ($Categorys[32]['description']); ?></p>
                  </div>
                </a>
              </li>

              <li aos="fade-up" aos-delay="300">
                <a href="<?php echo ($Categorys[33]['url']); ?>">
                  <div class="index_box">
                      <div class="index_box_1">
                        <div class="index_box_5_sm" style="background: url(<?php echo ($Categorys[33]['image']); ?>) center no-repeat;"></div>
                         <!--  <img src="__STYLE__/img/i6.png"> -->
                      </div>
                      <p class="index_box_p1"><?php echo ($Categorys[33]['catname']); ?></p>
                      <p class="index_box_p2"><?php echo ($Categorys[33]['description']); ?></p>
                  </div>
                  <div class="index_box_show">
                      <div class="index_box2">
                          <img src="__STYLE__/img/h1.png" alt="了解网站建设">
                          <a href="<?php echo ($Categorys[33]['url']); ?>" class="index_box2_more">了解更多>></a>
                      </div>
                      <p class="index_box_p1"><?php echo ($Categorys[33]['catname']); ?></p>
                      <p class="index_box_p2"><?php echo ($Categorys[33]['description']); ?></p>
                  </div>
                </a>
              </li>

              <li aos="fade-up" aos-delay="500">
                <a href="<?php echo ($Categorys[34]['url']); ?>">
                  <div class="index_box">
                      <div class="index_box_1">
                        <div class="index_box_6_sm" style="background: url(<?php echo ($Categorys[34]['image']); ?>) center no-repeat;"></div>
                         <!--  <img src="__STYLE__/img/i6.png"> -->
                      </div>
                      <p class="index_box_p1"><?php echo ($Categorys[34]['catname']); ?></p>
                      <p class="index_box_p2"><?php echo ($Categorys[34]['description']); ?></p>
                  </div>
                  <div class="index_box_show">
                      <div class="index_box2">
                          <img src="__STYLE__/img/h1.png" alt="了解网站建设">
                          <a href="<?php echo ($Categorys[34]['url']); ?>" class="index_box2_more">了解更多>></a>
                      </div>
                      <p class="index_box_p1"><?php echo ($Categorys[34]['catname']); ?></p>
                      <p class="index_box_p2"><?php echo ($Categorys[34]['description']); ?></p>
                  </div>
                </a>
              </li>

              <li aos="fade-up" aos-delay="700">
                <a href="<?php echo ($Categorys[35]['url']); ?>">
                  <div class="index_box">
                      <div class="index_box_1">
                        <div class="index_box_7_sm" style="background: url(<?php echo ($Categorys[35]['image']); ?>) center no-repeat;"></div>
                      </div>
                      <p class="index_box_p1"><?php echo ($Categorys[35]['catname']); ?></p>
                      <p class="index_box_p2"><?php echo ($Categorys[35]['description']); ?></p>
                  </div>
                  <div class="index_box_show">
                      <div class="index_box2">
                          <img src="__STYLE__/img/h1.png" alt="了解网站建设">
                          <a href="<?php echo ($Categorys[35]['url']); ?>" class="index_box2_more">了解更多>></a>
                      </div>
                      <p class="index_box_p1"><?php echo ($Categorys[35]['catname']); ?></p>
                      <p class="index_box_p2"><?php echo ($Categorys[35]['description']); ?></p>
                  </div>
                </a>
              </li>

              <li aos="fade-up" aos-delay="900">
                <a href="<?php echo ($Categorys[36]['url']); ?>">
                  <div class="index_box">
                      <div class="index_box_1">
                        <div class="index_box_8_sm" style="background: url(<?php echo ($Categorys[36]['image']); ?>) center no-repeat;"></div>
                         <!--  <img src="__STYLE__/img/i6.png"> -->
                      </div>
                      <p class="index_box_p1"><?php echo ($Categorys[36]['catname']); ?></p>
                      <p class="index_box_p2"><?php echo ($Categorys[36]['description']); ?></p>
                  </div>
                  <div class="index_box_show">
                      <div class="index_box2">
                          <img src="__STYLE__/img/h1.png" alt="了解网站建设">
                          <a href="<?php echo ($Categorys[36]['url']); ?>" class="index_box2_more">了解更多>></a>
                      </div>
                      <p class="index_box_p1"><?php echo ($Categorys[36]['catname']); ?></p>
                      <p class="index_box_p2"><?php echo ($Categorys[36]['description']); ?></p>
                  </div>
                </a>
              </li>

            </ul>
            </div>
        </div>
     </div> 
      
     <!-- case  -->

     <div class="index_case">
           <div class="index_case_tit" aos="fade-down" aos-delay="150">
            <img src="__STYLE__/img/index2.png" alt="案例展示" width="300" height="33" />
           </div>
           <p aos="fade-up" aos-delay="300">一个人能走多远，取决于与谁同行，壹贯团队是一个富有理想和激情的团队，也是一个技术专业化、创新性和学习型的优秀团队</p>

           <!-- Demo -->
            <div class="dowebok-outer">
              <div id="dowebok" class="owl-carousel">
                <?php  $_result=M("Product")->field("title,thumb,url,indeximg")->where(" 1  and lang=1 AND status=1  AND catid=12")->order("id desc")->limit("12")->select();; if ($_result): $k=0;foreach($_result as $key=>$r):++$k;$mod = ($k % 2 );?><div class="item" aos="fade-up" aos-delay="<?php echo 200*$k;?>" >
                    <a href="<?php echo ($r["url"]); ?>" target="_blank">
                      <img src="<?php echo ($r["indeximg"]); ?>" alt="<?php echo ($r["title"]); ?>" width="290" height="305">
                      <div class="txt">
                        <h3><?php echo ($r["title"]); ?></h3>
                        <p class="index_case_more">MORE<span></span></p>
                      </div>
                      <div class="bg"></div>
                      <img src="__STYLE__/img/i05.png" alt="查看网站建设案例一" class="i5">
                      <img src="__STYLE__/img/i06.png" alt="查看网站建设案例二" class="i6">
                    </a>
                </div><?php endforeach; endif;?>
            </div>
          </div>

            <!-- Demo end -->
            
            <div class="index_case_c" aos="fade-up" aos-delay="200">
                <a href="<?php echo ($Categorys[2]['url']); ?>">更多案例赏析>></a>
            </div>

     </div>


     <!-- chose -->
     
     <div class="index_chose">
           <div class="index_chose_tit" aos="fade-down" aos-delay="150">
              <img src="__STYLE__/img/index6.png" alt="为什么选择我们" width="493" height="38" />
           </div>
           <p aos="fade-up" aos-delay="200">我们最大的使命就是您们的满意，为客户创造最大的价值从而实现自己的价值</p>

           <div class="index_chose_box">
                <div class="index_chose_box_1 fl" aos="fade-right" aos-delay="400">
                    <div class="index_chose_box_1_img fl">
                        <img src="__STYLE__/img/p1.png" alt="网站优化图一">
                    </div>
                    <div class="index_chose_box_1_tit fr">
                        <h3>懂网民的搜索习惯</h3>
                        <p>拥有多年行业经验积累，我们更懂用户需求是什么。</p>
                    </div>
                </div>

                <div class="index_chose_box_2 fl" aos="fade-right" aos-delay="800">
                    <div class="index_chose_box_2_img fl">
                        <img src="__STYLE__/img/p2.png" alt="网站优化图二">
                    </div>
                    <div class="index_chose_box_2_tit fr">
                        <h3>懂搜索引擎收录规则</h3>
                        <p>我们能首页霸屏，与全国几千家企业合作共赢</p>
                    </div>
                </div>

                <div class="index_chose_box_3 fl" aos="fade-right" aos-delay="1200">
                    <div class="index_chose_box_3_img fl">
                        <img src="__STYLE__/img/p3.png" alt="网站优化图三">
                    </div>
                    <div class="index_chose_box_3_tit fr">
                        <h3>懂全网推广运营</h3>
                        <p>高级资深设计师群内直接沟通，贴心服务，致力打造全方位开创品牌式网站营销</p>
                    </div>
                </div>

           </div>

           <h3 class="index_chose_h3" aos="fade-down" aos-delay="300">成本相同盈利不同&nbsp;&nbsp;让您的网站免费排名在前</h3>
           <p class="index_chose_p" aos="fade-up" aos-delay="600">站在用户的角度思考问题，与客户深入沟通，找到网站设计与推广的最佳解决方案</p>
           <div class="index_chose_ims wrap" aos="fade-up" aos-delay="200">
              <div class="index_chose_ims_left fl">
                  <ul>
                    <li>
                      <div class="index_chose_ims_left_l fl">
                        <h3>01</h3>
                      </div>
                      <div class="index_chose_ims_left_r fr">
                        <p aos="fade-right" aos-delay="400">吸引客户目标</p>
                      </div>
                    </li>
                    <li>
                      <div class="index_chose_ims_left_l fl">
                        <h3>02</h3>
                      </div>
                      <div class="index_chose_ims_left_r fr">
                        <p aos="fade-right" aos-delay="400">合理布局关键词</p>
                      </div>
                    </li>
                    <li>
                      <div class="index_chose_ims_left_l fl">
                        <h3>03</h3>
                      </div>
                      <div class="index_chose_ims_left_r fr">
                        <p class="index_chose_p3" aos="fade-right" aos-delay="200">编辑核心页面Mate标签</p>
                      </div>
                    </li>
                  </ul>
              </div>

              <div class="index_chose_ims_center fl" aos="fade-down" aos-delay="1200">
                  <img src="__STYLE__/img/seo.png" alt="网站设计与推广的最佳解决方案">
              </div>

              <div class="index_chose_ims_right fr">
                  <ul>
                    <li>
                      <div class="index_chose_ims_right_l fl">
                        <h3>04</h3>
                      </div>
                      <div class="index_chose_ims_right_r fr" aos="fade-left" aos-delay="400">
                        <p>客户咨询机率高</p>
                      </div>
                    </li>
                    <li>
                      <div class="index_chose_ims_right_l fl" >
                        <h3>05</h3>
                      </div>
                      <div class="index_chose_ims_right_r fr" >
                        <p aos="fade-left" aos-delay="400">让客户更快找到你</p>
                      </div>
                    </li>
                    <li>
                      <div class="index_chose_ims_right_l fl">
                        <h3>06</h3>
                      </div>
                      <div class="index_chose_ims_right_r fr">
                        <p class="index_chose_p3" aos="fade-left" aos-delay="400">挑选准确关键词</p>
                      </div>
                    </li>
                  </ul>
              </div>
           </div>
     </div>


     <!-- jiejue -->

     <div class="index_so">
         <div class="index_so_tit" aos="fade-down" aos-delay="150">
            <img src="__STYLE__/img/index3.png" alt="解决方案" width="300" height="33" />
        </div>
        <p class="index_so_p" aos="fade-up" aos-delay="300">一个人能走多远，取决于与谁同行，壹贯团队是一个富有理想和激情的团队，也是一个技术专业化、创新性和学习型的优秀团队</p>
        <div class="wrap index_so_box">
            <ul>
                <li aos="fade-up" aos-delay="400">
                    <div class="index_so_box_2">
                         <div class="index_so_box_2_bottom">
                            <p class="index_so_p1"><?php echo ($Categorys[38]['catname']); ?></p>
                            <div class="icbox"></div>
                            <p class="index_so_p2"><?php echo ($Categorys[38]['description']); ?></p>
                         </div> 
                    </div>
                    <div class="index_so_box_img2">
                         <img src="__STYLE__/img/j1.png" alt="<?php echo ($Categorys[38]['catname']); ?>"> 
                    </div>
                </li>
                <li aos="fade-up" aos-delay="800">
                    <div class="index_so_box_img">
                         <img src="__STYLE__/img/j2.png" alt="<?php echo ($Categorys[39]['catname']); ?>"> 
                    </div>
                    <div class="index_so_box_1">
                         <div class="index_so_box_1_bottom">
                            <p class="index_so_p1"><?php echo ($Categorys[39]['catname']); ?></p>
                            <div class="icbox"></div>
                            <p class="index_so_p2"><?php echo ($Categorys[39]['description']); ?></p>
                         </div> 
                    </div>
                </li>
                <li aos="fade-up" aos-delay="1200">
                    <div class="index_so_box_2">
                         <div class="index_so_box_2_bottom">
                            <p class="index_so_p1"><?php echo ($Categorys[40]['catname']); ?></p>
                            <div class="icbox"></div>
                            <p class="index_so_p2"><?php echo ($Categorys[40]['description']); ?></p>
                         </div> 
                    </div>
                    <div class="index_so_box_img2">
                         <img src="__STYLE__/img/j3.png" alt="<?php echo ($Categorys[40]['catname']); ?>"> 
                    </div>
                </li>
                <li aos="fade-up" aos-delay="1600">
                    <div class="index_so_box_img">
                         <img src="__STYLE__/img/j1.png" alt="<?php echo ($Categorys[41]['catname']); ?>"> 
                    </div>
                    <div class="index_so_box_1">
                         <div class="index_so_box_1_bottom">
                            <p class="index_so_p1"><?php echo ($Categorys[41]['catname']); ?></p>
                            <div class="icbox"></div>
                            <p class="index_so_p2"><?php echo ($Categorys[41]['description']); ?></p>
                         </div> 
                    </div>
                </li>
            </ul>
        </div>
     </div>

    <!--partner-->

      <div class="home_partner">
        <div class="home_partner_title" aos="fade-down" aos-delay="150">
          
            <img src="__STYLE__/img/index4.png"
            alt="合作伙伴" width="300" height="33" />
        </div>
        <p class="index_so_p" aos="fade-up" aos-delay="300">一个人能走多远，取决于与谁同行，壹贯团队是一个富有理想和激情的团队，也是一个技术专业化、创新性和学习型的优秀团队</p>
        <div class="home_partner_list wrap" aos="fade-up" aos-delay="400">
          <table>
            <tr>

            <?php  $_result=M("Link")->field("*")->where(" status = 1  and lang=1 and typeid=3 and  linktype=2")->order("id desc")->limit("0,5")->select();; if ($_result): $i=0;foreach($_result as $key=>$r):++$i;$mod = ($i % 2 );?><td>
                <div class="pic partner_box">
                  <div class="cont1">
                  <!-- <a href="<?php echo ($r['siteurl']); ?>" target="_blank" title="<?php echo ($r['name']); ?>"> -->
                    <img src="<?php echo ($r['logo']); ?>"
                    width="150" height="100" alt="<?php echo ($r['name']); ?>" />
                    <!-- </a> -->
                  </div>
                  <div class="cont2">
                   <!--  <a href="<?php echo ($r['siteurl']); ?>" target="_blank" title="<?php echo ($r['name']); ?>"> -->
                    <img src="<?php echo ($r['logo_new']); ?>"
                    width="150" height="100" alt="<?php echo ($r['name']); ?>" />
                   <!--  </a> -->
                  </div>
                </div>
              </td><?php endforeach; endif;?>

            </tr>

            <tr>

              <?php  $_result=M("Link")->field("*")->where(" status = 1  and lang=1 and typeid=3 and  linktype=2")->order("id desc")->limit("5,5")->select();; if ($_result): $i=0;foreach($_result as $key=>$r):++$i;$mod = ($i % 2 );?><td>
                <div class="pic partner_box">
                  <div class="cont1">
                  <!-- <a href="<?php echo ($r['siteurl']); ?>" target="_blank" title="<?php echo ($r['name']); ?>"> -->
                    <img src="<?php echo ($r['logo']); ?>"
                    width="150" height="100" alt="<?php echo ($r['name']); ?>" />
                   <!--  </a> -->
                  </div>
                  <div class="cont2">
                    <!-- <a href="<?php echo ($r['siteurl']); ?>" target="_blank" title="<?php echo ($r['name']); ?>"> -->
                    <img src="<?php echo ($r['logo_new']); ?>"
                    width="150" height="100" alt="<?php echo ($r['name']); ?>" />
                    <!-- </a> -->
                  </div>
                </div>
              </td><?php endforeach; endif;?>

            </tr>

          </table>
        </div>
      </div>


      <!-- youshi -->

      <div class="index_ys">
          <div class="index_so_tit" aos="fade-down" aos-delay="150">
            <img src="__STYLE__/img/index5.png" alt="我们的优势" width="341" height="33" />
          </div>
          <p class="index_so_p" aos="fade-up" aos-delay="300">一个人能走多远，取决于与谁同行，壹贯团队是一个富有理想和激情的团队，也是一个技术专业化、创新性和学习型的优秀团队</p>

          <div class="advantage">

                <div class="num_box">

                    <div class="num_li" aos="fade-up" aos-delay="100">

                      <div class="num_bg"></div>

                                <div class="num_line"></div>

                      <div class="num">6</div>

                      <h3>6年高端网站设计经验</h3>

                    </div>

                </div>
            
             <div class="num_box">

                    <div class="num_li" aos="fade-up" aos-delay="200">

                      <div class="num_bg"></div>

                                <div class="num_line"></div>

                      <div class="num timer" id="count-number" data-to="20" data-speed="1500">20</div>

                      <h3>20多家政府单位的认可</h3>

                    </div>

                </div>

            
            <div class="num_box">

                    <div class="num_li" aos="fade-up" aos-delay="400">

                      <div class="num_bg"></div>

                                <div class="num_line"></div>

                      <div class="num timer" id="count-number" data-to="30" data-speed="2500">30</div>

                      <h3>30多家上市公司的选择</h3>

                    </div>

                </div>

                        <div class="num_box">

                    <div class="num_li" aos="fade-up" aos-delay="600">

                      <div class="num_bg"></div>

                                <div class="num_line"></div>

                      <div class="num timer" id="count-number" data-to="800" data-speed="2800">800</div>

                      <h3>800多家品牌客户的选择</h3>

                    </div>

                </div>

                       <div class="num_box">

                    <div class="num_li" aos="fade-up" aos-delay="1000">

                      <div class="num_bg"></div>

                                <div class="num_line"></div>

                      <div class="num timer" id="count-number" data-to="2300" data-speed="4500">2300</div>

                      <h3>2300多家企业客户的选择</h3>

                    </div>

                </div>

              

            </div>
      </div>


      <div class="index_about" aos="fade-up" aos-delay="400">
          <div class="wrap index_about_box">
            <div class="anout_more"><a href="<?php echo ($Categorys[3]['url']); ?>">了解更多>></a></div>
          </div>
      </div>




    <!--news-->

      <div class="home_news">
        <div class="home_news_list">
          <div class="wrap">
            

            <div class="index_6_2">
              <div class="index_6_2_1">
                <div class="index_6_2_1_1" aos="fade-up" aos-delay="300">
                  <i class="index_3_1lii yi"></i>
                  <h3 class="index_coloe">公司新闻</h3>
                </div>

                <?php  $_result=M("Article")->field("id,catid,url,title,title_style,keywords,description,thumb,createtime")->where(" 1  and lang=1 AND status=1  AND catid=8")->order("id desc")->limit("0,1")->select();; if ($_result): $i=0;foreach($_result as $key=>$v):++$i;$mod = ($i % 2 );?><div class="index_6_2_1_3" aos="fade-up" aos-delay="400">
                  <div class="index_6_2_1_3_1">
                    <a href="<?php echo ($v["url"]); ?>" title="<?php echo ($v["title"]); ?>" target="_blank"><img src="<?php echo ($v["thumb"]); ?>" alt="<?php echo ($v["title"]); ?>" style="width:160px; height:116px; border:1px #CCC solid; padding:2px;">
                    </a>
                  </div>
                  <div class="index_6_2_1_3_2">
                    <h5><a href="<?php echo ($v["url"]); ?>" target="_blank"><?php echo ($v["title"]); ?></a></h5>
                    <p><?php echo ($v["description"]); ?></p>
                  </div>
                </div><?php endforeach; endif;?>

                <?php  $_result=M("Article")->field("id,catid,url,title,title_style,keywords,description,thumb,createtime")->where(" 1  and lang=1 AND status=1  AND catid=8")->order("id desc")->limit("1,5")->select();; if ($_result): $k=0;foreach($_result as $key=>$v):++$k;$mod = ($k % 2 );?><div class="index_6_2_1_4" aos="fade-up" aos-delay="<?php echo 200*$k;?> " >
                  <a href="<?php echo ($v["url"]); ?>" title="<?php echo ($v["title"]); ?>" target="_blank">
                    <div class="index_6_2_1_4_1">
                      <div class="index_6_2_1_4_1_1"><?php echo (todate($v["createtime"],'d')); ?>日</div>
                      <div class="index_6_2_1_4_1_2"><?php echo (todate($v["createtime"],'Y')); ?>年<?php echo (todate($v["createtime"],'m')); ?>月</div>
                    </div>
                  </a>
                  <div class="index_6_2_1_4_2">
                    <h2><a href="<?php echo ($v["url"]); ?>" title="<?php echo ($v["title"]); ?>" target="_blank"><?php echo ($v["title"]); ?></a></h2>
                    <p><?php echo ($v["description"]); ?></p>
                  </div>
                </div><?php endforeach; endif;?>

                </div>
              </div>
              <div class="index_6_2_1">
                <div class="index_6_2_1_1" aos="fade-up" aos-delay="300">
                  <i class="index_3_1lii er"></i>
                  <h3 class="index_coloe">建站资讯</h3>
                </div>

                <?php  $_result=M("Article")->field("id,catid,url,title,title_style,keywords,description,thumb,createtime")->where(" 1  and lang=1 AND status=1  AND catid in(9,10)")->order("id desc")->limit("0,1")->select();; if ($_result): $i=0;foreach($_result as $key=>$r):++$i;$mod = ($i % 2 );?><div class="index_6_2_1_3" aos="fade-up" aos-delay="400">
                    <div class="index_6_2_1_3_1">
                      <a href="<?php echo ($r["url"]); ?>" title="<?php echo ($r["title"]); ?>" target="_blank"><img src="<?php echo ($r["thumb"]); ?>" alt="<?php echo ($v["title"]); ?>" style="width:160px; height:116px; border:1px #CCC solid; padding:2px;"></a>
                    </div>
                    <div class="index_6_2_1_3_2">
                      <h5><a href="<?php echo ($r["url"]); ?>"><?php echo ($r["title"]); ?></a></h5>
                      <p><?php echo ($r["description"]); ?></p>
                    </div>
                  </div><?php endforeach; endif;?>

              <?php  $_result=M("Article")->field("id,catid,url,title,title_style,keywords,description,thumb,createtime")->where(" 1  and lang=1 AND status=1  AND catid in(9,10)")->order("id desc")->limit("1,5")->select();; if ($_result): $k=0;foreach($_result as $key=>$v):++$k;$mod = ($k % 2 );?><div class="index_6_2_1_4" aos="fade-up" aos-delay="<?php echo 200*$k;?>" >
                  <a href="<?php echo ($v["url"]); ?>" title="<?php echo ($v["title"]); ?>" target="_blank">
                    <div class="index_6_2_1_4_1">
                      <div class="index_6_2_1_4_1_1"><?php echo (todate($v["createtime"],'d')); ?>日</div>
                      <div class="index_6_2_1_4_1_2"><?php echo (todate($v["createtime"],'Y')); ?>年<?php echo (todate($v["createtime"],'m')); ?>月</div>
                    </div>
                  </a>
                  <div class="index_6_2_1_4_2">
                    <h2><a href="<?php echo ($v["url"]); ?>" title="<?php echo ($v["title"]); ?>" target="_blank"><?php echo ($v["title"]); ?></a></h2>
                    <p><?php echo ($v["description"]); ?></p>
                  </div>
                </div><?php endforeach; endif;?>

              </div>
            </div>

            <div class="c"></div>
            <div class="btn_news_more" aos="fade-up" aos-delay="300">
              <a href="<?php echo ($Categorys[4]['url']); ?>" title="最新动态"
              class="btn">
                查看更多
              </a>
            </div>
          </div>
        </div>
      </div>

      

    

<script src="__STYLE__/js/owl.carousel.min.js"></script>
<script src="__STYLE__/js/jquery.animateNumber.min.js"></script>


<script>
  
$(function(){
  $('#dowebok').owlCarousel({
    items: 4,
    navigation: true,
    navigationText: ["",""],
    scrollPerPage: true
  });
});


//窗口显示才加载
  var wrapTop = $(".advantage").offset().top;
  var istrue = true;
  $(window).on("scroll",
  function() {
      var s = $(window).scrollTop();
      if (s > wrapTop - 500 && istrue) {
          $(".timer").each(count);
          function count(a) {
              var b = $(this);
              a = $.extend({},
              a || {},
              b.data("countToOptions") || {});
              b.countTo(a)
          };
          istrue = false;
      };
  })
  //设置计数
  $.fn.countTo = function (options) {
    options = options || {};
    return $(this).each(function () {
      //当前元素的选项
      var settings = $.extend({}, $.fn.countTo.defaults, {
        from:            $(this).data('from'),
        to:              $(this).data('to'),
        speed:           $(this).data('speed'),
        refreshInterval: $(this).data('refresh-interval'),
        decimals:        $(this).data('decimals')
      }, options);
      //更新值
      var loops = Math.ceil(settings.speed / settings.refreshInterval),
          increment = (settings.to - settings.from) / loops;
      //更改应用和变量
      var self = this,
      $self = $(this),
      loopCount = 0,
      value = settings.from,
      data = $self.data('countTo') || {};
      $self.data('countTo', data);
      //如果有间断，找到并清除
      if (data.interval) {
        clearInterval(data.interval);
      };
      data.interval = setInterval(updateTimer, settings.refreshInterval);
      //初始化起始值
      render(value);
      function updateTimer() {
        value += increment;
        loopCount++;
        render(value);
        if (typeof(settings.onUpdate) == 'function') {
          settings.onUpdate.call(self, value);
        }
        if (loopCount >= loops) {
          //移出间隔
          $self.removeData('countTo');
          clearInterval(data.interval);
          value = settings.to;
          if (typeof(settings.onComplete) == 'function') {
            settings.onComplete.call(self, value);
          }
        }
      }
      function render(value) {
        var formattedValue = settings.formatter.call(self, value, settings);
        $self.html(formattedValue);
      }
      });
        };
        $.fn.countTo.defaults={
          from:0,               //数字开始的值
          to:0,                 //数字结束的值
          speed:1000,           //设置步长的时间
          refreshInterval:100,  //隔间值
          decimals:0,           //显示小位数
          formatter: formatter, //渲染之前格式化
          onUpdate:null,        //每次更新前的回调方法
          onComplete:null,       //完成更新的回调方法
        };
        function formatter(value, settings){
          return value.toFixed(settings.decimals);
        }
        //自定义格式
        $('#count-number').data('countToOptions',{
          formmatter:function(value, options){
            return value.toFixed(options.decimals).replace(/\B(?=(?:\d{3})+(?!\d))/g, ',');
            
          }
        });
        //定时器
        

        $('.timer').each(count);
        function count(options){
          var $this=$(this);
          options=$.extend({}, options||{}, $this.data('countToOptions')||{});
          $this.countTo(options);
        }



  // var percent_number_step = $.animateNumber.numberStepFactories.append('+')
  // $('#lines1').animateNumber({ 
  //   number: 20,
  //   numberStep: percent_number_step
  //   },1000);
  // $('#lines2').animateNumber({ 
  //   number: 30,
  //   numberStep: percent_number_step
  //   },1200);
  // $('#lines3').animateNumber({ 
  //   number: 600,
  //   numberStep: percent_number_step
  //   },1300);
  // $('#lines4').animateNumber({ 
  //   number: 2000,
  //   numberStep: percent_number_step
  //   },1500);
</script>



 


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