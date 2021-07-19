<?php
session_start();
function log_write($message, $type)
{
	$enable_log = true;
	if ($enable_log) {
		$createlog = false;
	    $log = "[".date("Y-m-d\ h:i:s A")."][".$type."] ".$message."\n";
	    $logfile = "log.txt";
	    if (!file_exists($logfile)){
			$createlog = true;
	    }
	    $openfile = fOpen($logfile , "a+");
	    if ($createlog){
			fWrite($openfile, "[".date("h:i:s A")."][Information] Creating new log file (".$logfile.")\n");
	    }
	    fWrite($openfile, $log);
	    fClose($openfile);
	}
		return true;
}

// عنوان ملف موقعكم الذي سيضم الصفحة
DEFINE('WEBSITE_URL', 'http://omar-info.cf'); 
// تعيين وقت إرسال الرسالة
date_default_timezone_set('Asia/Riyadh');
if(isset($_POST['postname']) and isset($_POST['postemail']) and isset($_POST['postmsg'])){

if (isset($_POST['postname'])) {
  $error = array(); // تعيين جدول لجمع الأخطاء

  if (empty($_POST['postname'])) { //إذا كان حقل الإسم فارغا
    //إضافة خطأ للجدول
    $error[] = 'المرجو ملأ حقل الإسم'; 
  } else {
    $user = $_POST['postname']; //إنشاء متغير للإسم
  }

  if (empty($_POST['postemail'])) {
    $error[] = 'المرجو ملأ حقل البريد الإلكتروني';
  } else {
    if (!filter_var($_POST['postemail'], FILTER_VALIDATE_EMAIL) or $_POST['postemail'] == 'o20121900@gmail.com') {
      $error[] = "! عذرا ، البريد الإلكتروني غير صحيح";
    } else {
      $email = $_POST['postemail'];
    }
  }

  if (empty($_POST['postmsg'])) {
    $error[] = 'المرجو ملأ حقل الرسالة ';
  } else {
    $msg = $_POST['postmsg'];
  }


  if (empty($error))
  {
	if(isset($_SESSION['last_send']) and $_SESSION['last_send'] >= microtime(true)){
	echo'
                                <div class="alert alert-info alert-outline alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="fa fa-times"></i></button>
                             <center>          <strong>عذراً! لقد قمت بإرسال رسالة مؤخرآ , الرجاء المحاولة في وقت آخر</strong></center> 
                                </div>
';
die;
}else{
	$_SESSION['last_send'] = microtime(true)+300;
}

    // تعيين شيفرة  
 //   $activation = md5(uniqid(rand(), true));
	
    // عنوان الرسالة
    $subject ='Email From #Mr.omar';
    // رأس الرسالة
    $header = "From: \"Admin\"<admin@mail.com> \n";
    $header.= "Reply-to: \"Admin\" <admin@mail.com> \n";
    $header.= "MIME-Version: 1.0 \n";	
   // محتوى الرسالة 
$myweb = 'www.omar-info.cf';
    $message = " تم إستلام رسالتك\n\n سوف يتم الرد عليك في أقرب وقت ممكن/n ".$myweb."";
   // إرسال الرسالة إلى بريد العضو
    mail($email, $subject, $message, $header);
log_write($email." send you massege (".$msg.") From ( ".$_SERVER['REMOTE_ADDR'].") and His Name ( ".$user." )", "New Massege");
	

    // إنهاء الصفحة
    echo '<div class="success"><h3> .
      لقد تم إرسال الرسالة بنجاح  
        <br>  سوف يتم الرد عليك في أقرب وقت ممكن  </h3></div>';
		die;
 } else { // أو نقوم بعرض الأخطاء الناجمة
       echo '<div> <ol>';
       foreach ($error as $key => $values) {
          echo ' <strong> <li>' . $values . '</li>';
echo"<form>
								<input id='name' type='text' name='name' value='إسمك' onfocus='this.value = '';' onblur='if (this.value == '') {this.value = 'إسمك';}' required=''>
								<input id='email' type='email' name='email' value='الإيميل الخاص بك' onfocus='this.value = '';' onblur='if (this.value == '') {this.value = 'الإيميل الخاص بك';}' required=''>
								<textarea  id='msg' type='text' name='msg' onfocus='this.value = '';' onblur='if (this.value == '') {this.value = 'الرسالة...';}' required=''>الرسالة...</textarea>
								<input type='button' value='إرسال' onclick='post();' class='hvr-bounce-in'>
							</form>";

die;
       }
       echo '</ol></div>';
   }

}else {
echo '<p>المرجو ملأ الإستمارة</p>';
}


}


?>

<!DOCTYPE html>
<html>
        <style id="css-main">@font-face{font-family:myFirstFont;src:url(hcdd.ttf)/*tpa=*/ format('truetype');unicode-range:U +0600-06EF , U +06FA-0903}@font-face{font-family:dinar2;src:url(ge-dinar2.ttf)/*tpa=*/ format("truetype");font-weight:normal;font-style:normal;unicode-range:U +0600-06EF , U +06FA-0903}@font-face{font-family:h-tunisia;src:url(H-Tunisia.ttf)/*tpa=*/ format('truetype');unicode-range:U +0600-06EF , U +06FA-0903}@font-face{font-family:h-tunisia;src:url(H-Tunisia-B.ttf)/*tpa=*/ format('truetype');font-weight:bold;unicode-range:U +0600-06EF , U +06FA-0903}@font-face{font-family:h-pro;src:url(H-Promoter.ttf)/*tpa=*/ format('truetype');unicode-range:U +0600-06EF , U +06FA-0903}@font-face{font-family:h-pro;src:url(H-Promoter-M.ttf)/*tpa=*/ format('truetype');font-weight:bold;unicode-range:U +0600-06EF , U +06FA-0903}div h1,div h2,div h3,div h4,div p,div.h1,div.h2,div.h3,div.h3{font-family:'Open Sans',dinar2}div{font-family:myFirstFont,'Open Sans'}font1{font-family:myFirstFont,'Open Sans'!important}font2{font-family:dinar2,'Open Sans'!important}.progamer{font-family:h-pro!important;font-weight:bold!important}</style>

<head>
<title>omar-info</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="description" content="عمر الظافري">
  <meta name="keywords" content="عمر الظافري">
  <meta name="author" content="عمر الظافري">
<link rel="shortcut icon" href="http://b.top4top.net/p_162n4ia1.png""><html>
<script type="text/javascript">
var sc_project=11406575; 
var sc_invisible=1; 
var sc_security="de2b7d7b"; 
var scJsHost = (("https:" == document.location.protocol) ?
"https://secure." : "http://www.");
document.write("<sc"+"ript type='text/javascript' src='" +
scJsHost+
"statcounter.com/counter/counter.js'></"+"script>");
</script>
<noscript><div class="statcounter"><a title="real time web
analytics" href="http://statcounter.com/"
target="_blank"><img class="statcounter">
src="//c.statcounter.com/11406575/0/de2b7d7b/1/" alt="real
time web analytics"></a></div></noscript>
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
		function hideURLbar(){ window.scrollTo(0,1); } </script>
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
<link href="css/hover.css" rel="stylesheet" type="text/css" />

<script type="text/javascript" src="js/jquery-2.1.4.min.js"></script>
<script type="text/javascript" src="js/snowstorm.js"></script>

<link href='//fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
<style>
body form input[type="button"] {
	border : solid 0px #000000;
	border-radius : 3px;
	moz-border-radius : 3px;
	-webkit-box-shadow : 0px 0px 2px rgba(0,0,0,1.0);
	-moz-box-shadow : 0px 0px 2px rgba(0,0,0,1.0);
	box-shadow : 0px 0px 2px rgba(0,0,0,1.0);
	font-size : 20px;
	color : #ffffff;
	padding : 1px 17px;
	background : #5f6166;
	background : -webkit-gradient(linear, left top, left bottom, color-stop(0%,#5f6166), color-stop(100%,#00060a));
	background : -moz-linear-gradient(top, #5f6166 0%, #00060a 100%);
	background : -webkit-linear-gradient(top, #5f6166 0%, #00060a 100%);
	background : -o-linear-gradient(top, #5f6166 0%, #00060a 100%);
	background : -ms-linear-gradient(top, #5f6166 0%, #00060a 100%);
	background : linear-gradient(top, #5f6166 0%, #00060a 100%);
	filter : progid:DXImageTransform.Microsoft.gradient( startColorstr='#5f6166', endColorstr='#00060a',GradientType=0 );

}
</style>
<link href='//fonts.googleapis.com/css?family=Acme' rel='stylesheet' type='text/css'><!-- //fonts -->

		<script type="text/javascript" src="js/move-top.js"></script>
		<script type="text/javascript" src="js/easing.js"></script>
		<script type="text/javascript">
			jQuery(document).ready(function($) {
				$(".scroll").click(function(event){		
					event.preventDefault();
					$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
				});
			});
		</script>

<!-- skills -->
<script src="js/pie-chart.js" type="text/javascript"></script>
 <script type="text/javascript">

        $(document).ready(function () {
            $('#demo-pie-1').pieChart({
                barColor: '#10A7AF',
                trackColor: '#fff',
                lineCap: 'round',
                lineWidth: 8,
                onStep: function (from, to, percent) {
                    $(this.element).find('.pie-value').text(Math.round(percent) + '%');
                }
            });

            $('#demo-pie-2').pieChart({
                barColor: '#10A7AF',
                trackColor: '#fff',
                lineCap: 'butt',
                lineWidth: 8,
                onStep: function (from, to, percent) {
                    $(this.element).find('.pie-value').text(Math.round(percent) + '%');
                }
            });

            $('#demo-pie-3').pieChart({
                barColor: '#10A7AF',
                trackColor: '#fff',
                lineCap: 'square',
                lineWidth: 8,
                onStep: function (from, to, percent) {
                    $(this.element).find('.pie-value').text(Math.round(percent) + '%');
                }
            });
			
			$('#demo-pie-4').pieChart({
                barColor: '#10A7AF',
                trackColor: '#fff',
                lineCap: 'square',
                lineWidth: 8,
                onStep: function (from, to, percent) {
                    $(this.element).find('.pie-value').text(Math.round(percent) + '%');
                }
            });
        });
    </script>

<!-- skills -->
<script type="text/javascript" src="js/numscroller-1.0.js"></script>

<audio id="wlc" autoplay="autoplay" hidden="hidden" controls loop> <source src="wlc.mp3" type="audio/mp3""></source></audio>
<script>
var audio = document.getElementById("wlc");
audio.volume = 0.1;
</script> 

</head>
<body>
<!-- banner -->
<div class="header-top">
<center>
	<div class="container">
		<ul>
			<li><a class="scroll" href="#about"><span class="glyphicon glyphicon-user" aria-hidden="true"></span>من انا ؟</a></li>
			<li><a class="scroll" href="#emailme"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>لتواصل معي</a></li>
			<li><a href="javascript:window.print()"><span class="glyphicon glyphicon-print" aria-hidden="true"></span>طباعة الملف  التعريفي</a></li>
			<li><a href="#portfolioModal9" class="portfolio-link b-link-diagonal b-animate-go" data-toggle="modal">
		</ul>
	</div>
</div>	
<div class="header">
	<div class="container">
		<div class="col-md-8 header-left">
			<div class="col-sm-5 pro-pic">
				<img  class="img-responsive" src="images/pic1.JPG" alt=" "/>
			</div>
			<div class="col-sm-5 pro-text">
				<h1>#Mr.omar<br> عمر الظافري</h1>
				<p>مبرمج</p>
			</div>
			<div class="clearfix"></div>
		</div>
		<div class="col-md-4 header-right ">
			<ul class="list-left">
				<li>Email:</li>
				<li>Website:</li>
				<li>TeleGram:</li>
				<li>Address: </li>
			</ul>
			<ul class="list-right">
				<li><a href="mailto:o20121900@gmail.com">o20121900@gmail.com</a></li>
				<li>www.omar-info.cf</li>
				<li>@Mr_omarr</li>
				<li>Saudi Arabia</li>
			</ul>
			<div class="clearfix"></div>
		</div>
		<div class="clearfix"></div>
	</div>
</div>
<!-- //banner -->
<!-- about -->
<div id="about" class="about">
	<div class="container">
		<h3 class="tittle">من انا ؟</h3>
		<p class="abt-para">
		طالب ومبرمج مختص في مجال برمجة المواقع , رسالتي هي الأمانة مع توفير كل ماهو متاح للإرتقاء بالمستوى البرمجي لعالمنا العربي عن طريق أداء خدمة متميزه في صورة سهله 
		وبسيطه لتكون متوافقه مع احتياجات العميل
		
		
		</p>
	</div>
	<div class="col-md-6 abt-left ">
		<h2>اللغات والتقنيات المتقنه </h2>
				<div class="accordion">
							<div class="accordion-section">
								<h5><a class="accordion-section-title" href="#accordion-1">
									<span>WebSites</span> برمجة المواقع
								<i class="glyphicon glyphicon-chevron-down"></i><div class="clearfix"></div>
								</a></h5>
								<div id="accordion-1" class="accordion-section-content">
									<h6>التقنيات & اللغات</h6>
									<ul>
										<li><span class="glyphicon glyphicon-ok" aria-hidden="true"></span>PHP</li>
										<li><span class="glyphicon glyphicon-ok" aria-hidden="true"></span>Ajax</li>
										<li><span class="glyphicon glyphicon-ok" aria-hidden="true"></span>HTML</li>
										<li><span class="glyphicon glyphicon-ok" aria-hidden="true"></span>JavaScript</li>
									</ul>
								</div>
							</div>

							
							
				</div>
				<script>
							jQuery(document).ready(function() {
								function close_accordion_section() {
									jQuery('.accordion .accordion-section-title').removeClass('active');
									jQuery('.accordion .accordion-section-content').slideUp(300).removeClass('open');
								}

								jQuery('.accordion-section-title').click(function(e) {
									// Grab current anchor value
									var currentAttrValue = jQuery(this).attr('href');

									if(jQuery(e.target).is('.active')) {
										close_accordion_section();
									}else {
										close_accordion_section();

										// Add active class to section title
										jQuery(this).addClass('active');
										// Open up the hidden content panel
										jQuery('.accordion ' + currentAttrValue).slideDown(300).addClass('open'); 
									}

									e.preventDefault();
								});
							});
				</script>
	</div>
	<div class="col-md-6 abt-right ">
		<div class="col-sm-4 abt-gd-left text-center">
			<div id="demo-pie-1" class="pie-title-center" data-percent="60"> <span class="pie-value"></span> </div>
			<h4>Ajax</h4>
		</div>
		
		<div class="col-sm-4 abt-gd-left text-center">		   
			<div id="demo-pie-3" class="pie-title-center" data-percent="80"> <span class="pie-value"></span> </div>
			<h4>HTML</h4>
		</div>
		<div class="col-sm-4 abt-gd-left text-center">		   
			<div id="demo-pie-4" class="pie-title-center" data-percent="75"> <span class="pie-value"></span> </div>
			<h4>PHP</h4>
		</div>

		<div class="clearfix"></div>
	</div>
	<div class="clearfix"></div>
</div>
<!-- about -->
<!-- education -->
<div class="employment">
	<div class="container">
		<h3 class="tittle ">الخبرة البرمجية</h3>
		<p class="abt-para ">مع كل مشروع يتم تنفيذه تزداد الخبرة البرمجية بشكل اكبر واوسع  . 
		<br> - عضو سابق في فرقة مخمخه البرمجية
		</p>
		<div class="col-md-6 employ-left">
			<h4>#</h4>
		</div>
		<div class="col-md-6 employ-right">
			<h5><span class="glyphicon glyphicon-briefcase" aria-hidden="true"></span>برمجة المواقع</h5>
			<p>توفر الخبرة البرمجيه لإنشاء وبرمجة المواقع  على أعلى مستوى من الدقة والإحتراف والإلتزام </p>
		</div>
		<div class="clearfix"></div>
	</div>
</div>
<!-- education -->
<!-- portfolio -->
<div class="portfolio">
	<div class="container">
		<h3 class="tittle ">أعمالي</h3>
			<div class="portfolio-grids">
				<script src="js/easyResponsiveTabs.js" type="text/javascript"></script>
				<script type="text/javascript">
									$(document).ready(function () {
										$('#horizontalTab').easyResponsiveTabs({
											type: 'default', //Types: default, vertical, accordion           
											width: 'auto', //auto or any width like 600px
											fit: true   // 100% fit in a container
										});
									});
									
				</script>
				<div class="sap_tabs">
					<div id="horizontalTab" style="display: block; width: 100%; margin: 0px;">
						<ul class="resp-tabs-list">
							<li class="resp-tab-item" aria-controls="tab_item-0" role="tab"><span>بعض الأعمال</span></li> 
						</ul>				  	 
						<div class="resp-tabs-container">
							<div class="tab-1 resp-tab-content" aria-labelledby="tab_item-0">
								<div class="col-md-3 team-gd ">
									<div class="thumb">
										<a href="#portfolioModal1" class="portfolio-link b-link-diagonal b-animate-go" data-toggle="modal"><img src="images/pic4.jpg" alt="">
										<div class="team_pos">
											<ul>
												<li>
													<div class="morph pic fb_icon1">
													</div>
												</li>
											</ul>
										</div>
										</a>
									</div>
								</div>
								<div class="col-md-3 team-gd ">
									<div class="thumb">
										<a href="#portfolioModal3" class="portfolio-link b-link-diagonal b-animate-go" data-toggle="modal"><img src="images/pic5.jpg" alt="">
										<div class="team_pos">
											<ul>
												<li>
													<div class="morph pic fb_icon1">
													</div>
												</li>
											</ul>
										</div>
										</a>
									</div>
								</div>
								<div class="col-md-3 team-gd ">
									<div class="thumb">
										<a href="#portfolioModal2" class="portfolio-link b-link-diagonal b-animate-go" data-toggle="modal"><img src="images/pic9.jpg" alt="">
										<div class="team_pos">
											<ul>
												<li>
													<div class="morph pic fb_icon1">
													</div>
												</li>
											</ul>
										</div>
										</a>
									</div>
								</div>
								<div class="col-md-3 team-gd ">
									<div class="thumb">
										<a href="#portfolioModal4" class="portfolio-link b-link-diagonal b-animate-go" data-toggle="modal"><img src="images/pic6.jpg" alt="">
										<div class="team_pos">
											<ul>
												<li>
													<div class="morph pic fb_icon1">
													</div>
												</li>
											</ul>
										</div>
										</a>
									</div>
								</div>
								<div class="col-md-3 team-gd yes_marg ">
									<div class="thumb">
										<a href="#portfolioModal5" class="portfolio-link b-link-diagonal b-animate-go" data-toggle="modal"><img src="images/pic10.jpg" alt="">
										<div class="team_pos">
											<ul>
												<li>
													<div class="morph pic fb_icon1">
													</div>
												</li>
											</ul>
										</div>
										</a>
									</div>
								</div>
								<div class="col-md-3 team-gd yes_marg ">
									<div class="thumb">
										<a href="#portfolioModal6" class="portfolio-link b-link-diagonal b-animate-go" data-toggle="modal"><img src="images/pic11.jpg" alt="">
										<div class="team_pos">
											<ul>
												<li>
													<div class="morph pic fb_icon1">
													</div>
												</li>
											</ul>
										</div>
										</a>
									</div>
								</div>
								<div class="col-md-3 team-gd yes_marg ">
									<div class="thumb">
										<a href="#portfolioModal7" class="portfolio-link b-link-diagonal b-animate-go" data-toggle="modal"><img src="images/pic13.jpg" alt="">
										<div class="team_pos">
											<ul>
												<li>
													<div class="morph pic fb_icon1">
													</div>
												</li>
											</ul>
										</div>
										</a>
									</div>
								</div>
								<div class="col-md-3 team-gd yes_marg ">
									<div class="thumb">
										<a href="#portfolioModal8" class="portfolio-link b-link-diagonal b-animate-go" data-toggle="modal"><img src="images/pic14.jpg" alt="">
										<div class="team_pos">
											<ul>
												<li>
													<div class="morph pic fb_icon1">
													</div>
												</li>
											</ul>
										</div>
										</a>
									</div>
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="tab-1 resp-tab-content" aria-labelledby="tab_item-1">
								<div class="col-md-3 team-gd ">
									<div class="thumb">
										<a href="#portfolioModal5" class="portfolio-link b-link-diagonal b-animate-go" data-toggle="modal"><img src="images/pic10.jpg" alt="">
										<div class="team_pos">
											<ul>
												<li>
													<div class="morph pic fb_icon1">
													</div>
												</li>
											</ul>
										</div>
										</a>
									</div>
								</div>
								<div class="col-md-3 team-gd  ">
									<div class="thumb">
										<a href="#portfolioModal6" class="portfolio-link b-link-diagonal b-animate-go" data-toggle="modal"><img src="images/pic11.jpg" alt="">
										<div class="team_pos">
											<ul>
												<li>
													<div class="morph pic fb_icon1">
													</div>
												</li>
											</ul>
										</div>
										</a>
									</div>
								</div>
								<div class="col-md-3 team-gd ">
									<div class="thumb">
										<a href="#portfolioModal7" class="portfolio-link b-link-diagonal b-animate-go" data-toggle="modal"><img src="images/pic13.jpg" alt="">
										<div class="team_pos">
											<ul>
												<li>
													<div class="morph pic fb_icon1">
													</div>
												</li>
											</ul>
										</div>
										</a>
									</div>
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="tab-1 resp-tab-content" aria-labelledby="tab_item-2">
								<div class="col-md-3 team-gd ">
									<div class="thumb">
										<a href="#portfolioModal2" class="portfolio-link b-link-diagonal b-animate-go" data-toggle="modal"><img src="images/pic9.jpg" alt="">
										<div class="team_pos">
											<ul>
												<li>
													<div class="morph pic fb_icon1">
													</div>
												</li>
											</ul>
										</div>
										</a>
									</div>
								</div>
								<div class="col-md-3 team-gd ">
									<div class="thumb">
										<a href="#portfolioModal4" class="portfolio-link b-link-diagonal b-animate-go" data-toggle="modal"><img src="images/pic6.jpg" alt="">
										<div class="team_pos">
											<ul>
												<li>
													<div class="morph pic fb_icon1">
													</div>
												</li>
											</ul>
										</div>
										</a>
									</div>
								</div>
								<div class="col-md-3 team-gd">
									<div class="thumb">
										<a href="#portfolioModal5" class="portfolio-link b-link-diagonal b-animate-go" data-toggle="modal"><img src="images/pic10.jpg" alt="">
										<div class="team_pos">
											<ul>
												<li>
													<div class="morph pic fb_icon1">
													</div>
												</li>
											</ul>
										</div>
										</a>
									</div>
								</div>
								<div class="col-md-3 team-gd">
									<div class="thumb">
										<a href="#portfolioModal6" class="portfolio-link b-link-diagonal b-animate-go" data-toggle="modal"><img src="images/pic11.jpg" alt="">
										<div class="team_pos">
											<ul>
												<li>
													<div class="morph pic fb_icon1">
													</div>
												</li>
											</ul>
										</div>
										</a>
									</div>
								</div>
								<div class="clearfix"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
	</div>
</div>
<!-- //portfolio -->
<!-- more skills -->
<div class="more">
	<div class="container">
		<h3 class="tittle ">لغات وتقنيات جاري تعلمها :)</h3>
		<div class="col-md-6 skill-left ">
			<div class="progress">
				  <div class="progress-bar progress-bar-success" style="width: 30%">مبرمج برامج
					<span class="sr-only">30% Complete (success)</span>
				  </div>
				  <div class="progress-bar progress-bar-warning " style="width: 1%">
					<span class="sr-only"></span>
				  </div>
				  <p>30%</p>
				  <div class="clearfix"></div>
			</div>
			<div class="progress">
				  <div class="progress-bar progress-bar-success1" style="width: 15%">مبرمج تطبيقات أندرويد
					<span class="sr-only">15% Complete (success)</span>
				  </div>
				  <div class="progress-bar progress-bar-warning1" style="width: 1%">
					<span class="sr-only"></span>
				  </div>
				  <p>15%</p>
				  <div class="clearfix"></div>
			</div>
			<div class="progress">
				  <div class="progress-bar progress-bar-success3" style="width: 25%">مصمم صور
					<span class="sr-only">25% Complete (success)</span>
				  </div>
				  <div class="progress-bar progress-bar-warning3 " style="width: 3%">
					<span class="sr-only"></span>
				  </div>
				  <p>25%</p>
				  <div class="clearfix"></div>
			</div>
			
			<div class="progress no-marg">
				  <div class="progress-bar progress-bar-success4" style="width: 10%">Python
					<span class="sr-only">10% Complete (success)</span>
				  </div>
				  <div class="progress-bar progress-bar-warning4" style="width: 2%">
					<span class="sr-only"></span>
				  </div>
				  <p>10%</p>
				  <div class="clearfix"></div>
			</div>
		</div>
		<div class="col-md-6 skill-right ">
			<div class="scrollbar scrollbar1">
				<div class="more-gds">
					<div class="col-sm-3 more-left">
						<span class="glyphicon glyphicon-scissors" aria-hidden="true"></span>
					</div>
					<div class="col-sm-9 more-right">
						<h4>تصميم الصور</h4>
						<p>تصميم الصور بشكل مبدع بإستخدام برامج التصميم مثل الفوتشوب .</p>
					</div>
					<div class="clearfix"></div>
				</div>
				<div class="more-gds yes_marg">
					<div class="col-sm-9 more-right2">
						<h4>تطبيقات الأندرويد</h4>
						<p>تطبيقات مبتكرة للجوال يتم برمجتها لخدمة العميل<p>
					</div>
					<div class="col-sm-3 more-left">
						<span class="glyphicon glyphicon-phone" aria-hidden="true"></span>
					</div>
					<div class="clearfix"></div>
				</div>
				<div class="more-gds yes_marg">
					<div class="col-sm-3 more-left">
						<span class="glyphicon glyphicon-tint" aria-hidden="true"></span>
					</div>
					<div class="col-sm-9 more-right">
						<h4>Python</h4>
						<p>لغة برمجة، من لغات المستوى العالي، تتميز ببساطة كتابتها وقراءتها، سهلة التعلم، تستخدم أسلوب البرمجة الكائنية</p>
					</div>
					<div class="clearfix"></div>
				</div>
				<div class="more-gds yes_marg">
					<div class="col-sm-9 more-right2">
						<h4>برمجة البرامج</h4>
						<p>برمجة برامج وتطبيقات سطح المكتب بإستخدام الفيجوال بيسك</p>
					</div>
					<div class="col-sm-3 more-left">
						<span class="glyphicon glyphicon-credit-card" aria-hidden="true"></span>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
		<div class="clearfix"></div>
	</div>
</div>
<!-- more skills -->
<!-- contact -->
<div id="emailme" class="contact">
	<div class="container"><center>
		<h3 class="tittle">لتواصل</h3>
			<div class="horizontal-tab">
			
				<ul class="nav nav-tabs">
					<li class="active"><a href="#tab1" data-toggle="tab" aria-expanded="false">لتواصل معي</a></li>
				</ul>
				<div class="tab-content">
					<div class="tab-pane active in" id="tab1">
						<div class="contact-form">
							<ul>
								<li><i class="glyphicon glyphicon-envelope" aria-hidden="true"></i><a href="mailto:o20121900@gmail.com">Email : o20121900@gmail.com</a></li>
								<li><i class="glyphicon glyphicon-send" aria-hidden="true"></i>TeleGram : @Mr_omarr</li>
							</ul>

<script type="text/javascript" src="js/bostrap.js"></script>

<div id="result">
							<form>
								<input id="name" type="text" name="name" value="إسمك" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'إسمك';}" required="">
								<input id="email" type="email" name="email" value="الإيميل الخاص بك" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'الإيميل الخاص بك';}" required="">
								<textarea  id="msg" type="text" name="msg" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'الرسالة...';}" required="">الرسالة...</textarea>
								<input type="button"  value="إرسال" onclick="post();"
class="hvr-bounce-in">
							</form></div>
						</div>
					 
					</div>
					
				</div>
            </div>
		<div class="clearfix"></div>
		<p class="copy-right">&copy <script>document.write(new Date().getFullYear())</script> #Mr.omar. All rights reserved </p>
	</div>
</div>
<!-- //contact -->
<!-- for bootstrap working -->
	<script src="js/bootstrap.js"></script>
<!-- //for bootstrap working -->
<div class="portfolio-modal modal fade slideanim" id="portfolioModal1" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-content port-modal">
        <div class="close-modal" data-dismiss="modal">
            <div class="lr">
                <div class="rl"></div>
            </div>
        </div>
        <div class="container">
			<div class="row">
                <div class="col-lg-8 col-lg-offset-2 text-center">
                    <div class="modal-body">
						<h3>متجر</h3>
                        <img src="images/pic4.jpg" class="img-responsive img-centered" alt="">
                        <p>تصميم وبرمجة متجر خاص  </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="portfolio-modal modal fade slideanim" id="portfolioModal2" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-content port-modal">
        <div class="close-modal" data-dismiss="modal">
            <div class="lr">
                <div class="rl"></div>
            </div>
        </div>
        <div class="container">
			<div class="row">
                <div class="col-lg-8 col-lg-offset-2 text-center">
                    <div class="modal-body">
						<h3>متجر </h3>
                        <img src="images/pic9.jpg" class="img-responsive img-centered" alt="">
                        <p>تصميم وبرمجة متجر خاص  </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="portfolio-modal modal fade slideanim" id="portfolioModal3" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-content port-modal">
        <div class="close-modal" data-dismiss="modal">
            <div class="lr">
                <div class="rl"></div>
            </div>
        </div>
        <div class="container">
			<div class="row">
                <div class="col-lg-8 col-lg-offset-2 text-center">
                    <div class="modal-body">
						<h3>لوحة تحكم</h3>
                        <img src="images/pic5.jpg" class="img-responsive img-centered" alt="">
                        <p>تصميم وبرمجة لوحة تحكم لسيرفر خاص  </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="portfolio-modal modal fade slideanim" id="portfolioModal4" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-content port-modal">
        <div class="close-modal" data-dismiss="modal">
            <div class="lr">
                <div class="rl"></div>
            </div>
        </div>
        <div class="container">
			<div class="row">
                <div class="col-lg-8 col-lg-offset-2 text-center">
                    <div class="modal-body">
						<h3>موقع  </h3>
                        <img src="images/pic6.jpg" class="img-responsive img-centered" alt="">
                        <p>تصميم وبرمجة موقع لسيرفر عام  </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="portfolio-modal modal fade slideanim" id="portfolioModal5" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-content port-modal">
        <div class="close-modal" data-dismiss="modal">
            <div class="lr">
                <div class="rl"></div>
            </div>
        </div>
        <div class="container">
			<div class="row">
                <div class="col-lg-8 col-lg-offset-2 text-center">
                    <div class="modal-body">
						<h3>صفحة خطأ</h3>
                        <img src="images/pic10.jpg" class="img-responsive img-centered" alt="">
                        <p>تصميم صفحة خطأ  </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="portfolio-modal modal fade slideanim" id="portfolioModal6" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-content port-modal">
        <div class="close-modal" data-dismiss="modal">
            <div class="lr">
                <div class="rl"></div>
            </div>
        </div>
        <div class="container">
			<div class="row">
                <div class="col-lg-8 col-lg-offset-2 text-center">
                    <div class="modal-body">
						<h3>لوحة تحكم</h3>
                        <img src="images/pic11.jpg" class="img-responsive img-centered" alt="">
                        <p>تصميم وبرمجة لوحة تحكم لسيرفر خاص  </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="portfolio-modal modal fade slideanim" id="portfolioModal7" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-content port-modal">
        <div class="close-modal" data-dismiss="modal">
            <div class="lr">
                <div class="rl"></div>
            </div>
        </div>
        <div class="container">
			<div class="row">
                <div class="col-lg-8 col-lg-offset-2 text-center">
                    <div class="modal-body">
						<h3>صفحة خطأ</h3>
                        <img src="images/pic13.jpg" class="img-responsive img-centered" alt="">
                        <p>تصميم وبرمجة صفحة خطأ  </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="portfolio-modal modal fade slideanim" id="portfolioModal8" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-content port-modal">
        <div class="close-modal" data-dismiss="modal">
            <div class="lr">
                <div class="rl"></div>
            </div>
        </div>
        <div class="container">
			<div class="row">
                <div class="col-lg-8 col-lg-offset-2 text-center">
                    <div class="modal-body">
						<h3>موقع شخصي</h3>
                        <img src="images/pic14.jpg" class="img-responsive img-centered" alt="">
                        <p>تصميم وبرمجة موقع شخصي  </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="portfolio-modal modal fade slideanim" id="portfolioModal9" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-content port-modal">
        <div class="close-modal" data-dismiss="modal">
            <div class="lr">
                <div class="rl"></div>
            </div>
        </div>
        <div class="container">
			<div class="row">
                <div class="col-lg-8 col-lg-offset-2 text-center">
                    <div class="modal-body">
                        <img src="images/pic1.JPG" class="img-responsive img-centered" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type='text/javascript'>
$(document).ready(function(){ 
    $(window).scroll(function(){ 
        if ($(this).scrollTop() > 100) { 
            $('#scroll').fadeIn(); 
        } else { 
            $('#scroll').fadeOut(); 
        } 
    }); 
    $('#scroll').click(function(){ 
        $("html, body").animate({ scrollTop: 0 }, 600); 
        return false; 
    }); 
});
if (window.Event) 
document.captureEvents(Event.MOUSEUP); 

function nocontextmenu() 
{
event.cancelBubble = true
event.returnValue = false;

return false;
}

function norightclick(e) 
{
if (window.Event) 
{
if (e.which == 2 || e.which == 3)
return false;
}
else
if (event.button == 2 || event.button == 3)
{
event.cancelBubble = true
event.returnValue = false;
return false;
}

}

document.oncontextmenu = nocontextmenu; 
document.onmousedown = norightclick; 
</script>
<script language = "JavaScript" type= "text/javascript">
if(window.location.href.indexOf('index.php') > -1) // or 0 
window.location.href = window.location.href.replace('index.php', '');
$(document).keydown(function(event){
    if(event.keyCode==123){
    return false;
   }
else if(event.ctrlKey && event.shiftKey && event.keyCode==73){        
      return false;  //Prevent from ctrl+shift+i
   }
});

</script>
<script type='text/javascript'>
var isCtrl = false;
document.onkeyup=function(e)
{
    if(e.which == 17)
    isCtrl=false;
}
document.onkeydown=function(e)
{
    if(e.which == 17)
    isCtrl=true;
    if((e.which == 85)  && (isCtrl == true))// 67 for copy
    {
        return false;
    }
}
var isNS = (navigator.appName == "Netscape") ? 1 : 0;
if(navigator.appName == "Netscape") document.captureEvents(Event.MOUSEDOWN||Event.MOUSEUP);
function mischandler(){
    return false;
}
function mousehandler(e){
    var myevent = (isNS) ? e : event;
    var eventbutton = (isNS) ? myevent.which : myevent.button;
    if((eventbutton==2)||(eventbutton==3)) return false;
}
document.oncontextmenu = mischandler;
document.onmousedown = mousehandler;
document.onmouseup = mousehandler;
</script>

	<!--scrolling js-->
	<script src="js/jquery.nicescroll.js"></script>
	<script src="js/scripts.js"></script>
	<!--//scrolling js-->
	<!-- smooth scrolling -->
	<script type="text/javascript">
		$(document).ready(function() {
		/*
			var defaults = {
			containerID: 'toTop', // fading element id
			containerHoverID: 'toTopHover', // fading element hover id
			scrollSpeed: 1200,
			easingType: 'linear' 
			};
		*/								
		$().UItoTop({ easingType: 'easeOutQuart' });
		});
	</script>
	<a href="#" id="toTop" style="display: block;"> <span id="toTopHover" style="opacity: 1;"> </span></a>
<!-- //smooth scrolling -->

</body>
</html>