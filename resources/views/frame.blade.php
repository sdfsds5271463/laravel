<!DOCTYPE html>
<html lang="zh-tw">

    <head>
        <!--bootstrap + jquery引入-->
    	<link href="public/css/bootstrap.min.css" rel="stylesheet">
		<script src="public/js/jquery-ui-1-11-4-custom/external/jquery/jquery.js"></script>
		<script src="public/js/bootstrap.min.js"></script>
		<!--jquery UI引入-->
		<link href="public/js/jquery-ui-1-11-4-custom/jquery-ui.css" rel="stylesheet">
		<script src="public/js/jquery-ui-1-11-4-custom/jquery-ui.js"></script>
		<!--frame css+js引入-->
		<link href="public/css/frame.css" rel="stylesheet">
		<script src="public/js/frame.js"></script>
			<script src="public/js/Services/onlineUsersAmount.js"></script>

		<!--RWD設定-->
		<script src="public/js/Respond-master/dest/respond.min.js"></script><!--此項為了讓IE6 7 8懂@media-->
        <meta http-equiv="X-UA-Compatible" content="IE=edge"><!--此項僅為了讓IE以最新版設定-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

        <!--網站OG資訊-->
        <meta property="og:url" content="http://{{$_SERVER['HTTP_HOST']}}">
        <meta property="og:title" content="粉碎領域 PHP程式學習空間">
        <meta property="og:description" content="個人PHP網頁設計學習與討論空間">
        <meta property="og:type" content="website">
        <meta property="og:image" content="http://{{$_SERVER['HTTP_HOST']}}/public/images/index_img.jpg">
        <!--註冊使用者ID-->
        <meta property="fb:admins" content="100000562184706"/>
        <meta property="fb:app_id" content="965388553566794">

		<meta charset="utf-8" keywords="粉碎領域,AJAX,PHP,工程師,部落格,個人網頁">
		<title>粉碎領域 PHP程式學習空間</title>
		<link rel="Shortcut Icon" type="image/x-icon" href="public/images/logo.ico" />
	</head>

    <body>
		<!--bootstrap圖示索引清單 http://getbootstrap.com/components/ -->

    	<!--LOGO img-->
        <header>
        	@yield('hat')
        	<div class="container">
	        	<div class="row">
		            <div class="col-sm-12 headerSm12">
		            <!--FB LIKE-->
		            <!--<div class="fb-like" data-share="true" data-width="290" data-show-faces="true"></div>-->
		        		<div class="search whiteFontCase">
		        			<!-- Search Google -->
			        		<form method="get" name="searchform" action="http://www.google.com/search" target="_blank">
			        			<input type="hidden" name="sitesearch" value="{{$_SERVER['HTTP_HOST']}}" />
			        			<input type="text" name="as_q" size="20" class="search_input" placeholder=" GoogleSearch" required />
			        			<input type="submit" value="搜尋" class="search_button normalButton"/>
		        			</form><!-- Search Google -->
		        			<a href="#"><span class="glyphicon glyphicon-map-marker"></span>網站地圖</a><br>
		        			在線 <span class="OnlineAmount">0</span> 人
		        		</div>
		        		<div class="thanks blackFontCase">感謝<a href="http://www.pixiv.net/member.php?id=4041740" target="_blank">強者朋友</a>供圖
		        		</div>

		        	</div>
		        </div>
		    </div>
        </header><!--LOGO img-->


        <!--清單巡覽列-->
        <nav>
	        <div class="navbar navbar-default">
	            <div class="navbar-header">
	                <span class="navbar-brand">
	                	<a href="{{ url('/') }}">
		                	<span><img src="public/images/logo.png" width="20px"></span>
		                	<b>粉碎領域</b> <span class="smallWord">PHP程式學習空間</span>
		                </a>
	                </span>
	                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#TEMPnav">
	                    <span class="glyphicon glyphicon-menu-hamburger"></span><!--上面是按鈕設定，這是按鈕圖示-->
	                </button>
	            </div>

	            <!-- 選單(縮小時(<768px)消失) -->
	            <div id="TEMPnav" class="navbar-collapse collapse">
	                <ul class="navbar-nav nav">
	                	<li><a href="teach"><span class="glyphicon glyphicon-edit"></span> 超新手架站教學</a></li>
	                    <li><a href="ajaxChatRoom"><span class="glyphicon glyphicon-pencil"></span> AJAX塗鴉聊天室</a></li>
	                    <li><a href="weather"><span class="glyphicon glyphicon-certificate"></span> XML天氣概況</a></li>
	                    <li><a href="box2d"><span class="glyphicon glyphicon-apple"></span> Box2D物理空間</a></li>
	                    <li><a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-stats"></span> 三軸加速度感測器
	                        <span class="caret"></span></a><!--span的類別caret是下拉專屬圖示▼-->
	                        <ul class="dropdown-menu">
	                            <li><a href="axis3Record"><span class="glyphicon glyphicon-record"></span> 感測器線上監控</a></li>
	                            <li class="divider"></li><!-- 分隔線 -->
	                            <li><a href="axis3Video"><span class="glyphicon glyphicon-film"></span> 步態Html5影片播放</a></li>
	                            <li><a href="axis3Data"><span class="glyphicon glyphicon-list-alt"></span> 三軸步態研究資料</a></li>
	                        </ul>
	                    </li>
	                </ul>
	            </div>
	        </div>
	    </nav><!--清單巡覽列-->


        <main>
	        <div class="container">
	            <div class="row">
	                <div class="col-sm-9">
	                    @yield('main')
	                    <br><h2>FB留言板</h2>
	                    ※由於FB部分服務並不支援免費網域(.tk)，因此我以smasharea.tkfb做為留言板地址，留言者無法直接從FB中的訊息回到此網站※
				        <div 	class="fb-comments"
				        		data-href="{{$_SERVER['HTTP_HOST']}}fb{{$_SERVER['REQUEST_URI']}}"
				        		data-numposts="5"
				        		data-width="100%"
				        ></div>
				        <div id="fb-root"></div>
	                </div>
	                <div class="col-sm-3">
	                	<div class="menu">
	                		<h1>本頁原碼</h1>
	                		本站使用 Laravel 5.1.33 建置
	                    	<span class="code">內容模板</span>
	                    	<span class="code">AJAX接收請求端</span>
	                    	<span class="code">控制器php</span>
	                    	<span class="code">控制器service</span>
	                    	<span class="code">控制器javaScript</span>
	                    	<span class="code">控制器javaScript2</span>
	                    	<span class="code">資料庫model</span>
	                    	<span class="code">服務提供者</span>
	                    	<span class="code">路由設定</span>
	                    	<span class="code">框架模板</span>
	                    	<span class="code">框架css</span>
	                    	<span class="code">框架javaScript</span>
	                    	開啟本站GitHub查看原碼
	                    	<a href="https://github.com/sdfsds5271463/laravel" target="_blank">open GitHub</a>

	                    	<h1>站長的話</h1>
	                    	<p>小弟只是興趣使然的PHP一般使用者，此網站僅供個人學習、記錄與分享，有錯誤請不吝於提出指教謝謝。</p>
	                    	<p>下方個人學習紀錄區提供個人整理的PHP相關文件，由於僅是自己的原碼學習紀錄，因此裡面可能雜亂錯誤，僅供參考。</p>

	                    	<h1>個人學習紀錄</h1>
	                    	不負責任的個人學習紀錄文件<br>
	                    	<b>HTML</b>
	                    	<span class="code">Html基本語法</span>
	                    	<span class="code">Css基本語法</span>
	                    	<span class="code">Rwd頁面基礎</span>
	                    	<b>Javascript</b>
	                    	<span class="code">javascript基本語法</span>
	                    	<span class="code">canvas基本操作</span>
	                    	<span class="code">jQuery基本語法</span>
	                    	<span class="code">jQuery UI常用語法</span>
	                    	<b>PHP</b>
	                    	<span class="code">php類別基礎</span>
	                    	<span class="code">php基本語法</span>
	                    	<span class="code">php檔案處理</span>
	                    	<span class="code">php資料庫相關</span>
	                    	<span class="code">php dataURL</span>
	                    	<span class="code">php 其他雜記</span>
	                    	<h1>瀏覽人次</h1>
	                    	<h4>總共瀏覽：<span class="onlineUserId"></span>次</h4>
	                    	<h4>目前在線：<span class="OnlineAmount"></span>人</h4>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </main>


	    <footer>
	        <div class="container">
	            <div class="row">
	                <div class="col-sm-12">
	                	©Since 2016 | <b>粉碎領域</b> | PHP程式學習空間 | 豐原鄭<br>
	                	本站使用HTML5+CSS3，建議使用瀏覽器版本：<br>
	                	IE10+、Firefox4+、Chrome19+、Safari6+ <br>
	                	All rights reserved
	                </div>
	            </div>
	        </div>
	    </footer>


    	<!-- 置頂箭頭 -->
    	<div id="top-bar"><a href="#toTop"><span class="glyphicon glyphicon-triangle-top"></span><br>TOP</a></div>

    	<!--ajax傳輸參數-->
    	<input id="_token" type="hidden" value="{{ csrf_token() }}">
    	<input type="hidden" id="onlineUserId" value=@if(isset($_COOKIE['onlineUserId'])){{ $_COOKIE['onlineUserId']}}
											       @else "-1" @endif >

    	<!--程式碼顯示交談窗-->
        <div id="dialog">
        	<pre><code><span id="dialogCodeMain"></span></code></pre>
            <span id="closedialog"><span class="glyphicon glyphicon-remove"></span>關閉這個視窗 (快捷鍵Esc)</span>
        </div>
    </body>


</html>










<!--
	        <div class="container">


	            <div class="row">
	                <div class="col-sm-3">
	                    <img src="tmp.jpg" class="img-responsive img-circle">
	                </div>
	                <div class="col-sm-9 table-responsive">
	                    <table class="table table-hover">
	                        <tr><th>欄位A</th><td>內容A</td></tr>
	                        <tr><th>欄位B</th><td>內容B</td></tr>
	                    </table>
	                </div>
	            </div>
	            <div class="row">
	                <div class="col-sm-3">文字文字1</div>
	                <div class="col-sm-3">文字文字2</div>
	                <div class="col-sm-3">文字文字2</div>
	                <div class="col-sm-3">
	                	<img src="tmp.jpg" class="img-responsive img-circle"> 特殊美工樣式類別可選用：img-circle切圓、img-rounded圓角、img-thumbnail加框
	                </div>
	            </div>


	        </div>
-->
