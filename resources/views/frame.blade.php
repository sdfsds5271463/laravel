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

		<meta charset="utf-8" keywords="粉碎領域,AJAX,PHP,工程師,部落格,個人網頁">
		<title>粉碎領域 PHP程式學習空間</title>
		<link rel="Shortcut Icon" type="image/x-icon" href="public/images/logo.ico" />
	</head>

    <body>
		<!--bootstrap圖示索引清單 http://getbootstrap.com/components/ -->

    	<!--LOGO img-->
        <header>
        	<div class="container">
	        	<div class="row">
		            <div class="col-sm-12">
		        		<div class="search">
		        			<!-- Search Google -->
			        		<form method="get" name="searchform" action="http://www.google.com/search" target="_blank">
			        			<input type="hidden" name="sitesearch" value="allen.lionfree.net" />
			        			<input type="text" name="as_q" size="20" class="search_input" placeholder=" GoogleSearch" required />
			        			<input type="submit" value="搜尋" class="search_button" />
		        			</form><!-- Search Google -->
		        			<a href="#"><span class="glyphicon glyphicon-map-marker"></span>網站地圖</a><br>
		        			在線 <span class="OnlineAmount">0</span> 人
		        		</div>
		        		<div class="thanks">感謝<a href="http://www.pixiv.net/member.php?id=4041740" target="_blank">強者朋友</a>供圖
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
	                	<a href="index.php">
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
	                    <li><a href="ajaxChatRoom"><span class="glyphicon glyphicon-pencil"></span> AJAX塗鴉聊天室</a></li>
	                    <li><a href="#"><span class="glyphicon glyphicon-certificate"></span> XML即時氣象</a></li>
	                    <li><a href="box2d"><span class="glyphicon glyphicon-apple"></span> jQuery物理空間</a></li>
	                    <li><a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-stats"></span> 三軸加速度感測器
	                        <span class="caret"></span></a><!--span的類別caret是下拉專屬圖示▼-->
	                        <ul class="dropdown-menu">
	                            <li><a href="#"><span class="glyphicon glyphicon-record"></span> 行動裝置線上監控</a></li>
	                            <li><a href="#"><span class="glyphicon glyphicon-search"></span> 資料查詢</a></li>
	                            <li class="divider"></li><!-- 分隔線 -->
	                            <li><a href="#"><span class="glyphicon glyphicon-film"></span> 實驗訊號影片</a></li>
	                        </ul>
	                    </li>
	                    <li><a href="index"><span class="glyphicon glyphicon-edit"></span> 站長murmur</a></li>
	                </ul>
	            </div>
	        </div>
	    </nav><!--清單巡覽列-->


        <main>
	        <div class="container">
	            <div class="row">
	                <div class="col-sm-9">
	                    @yield('main')
	                </div>
	                <div class="col-sm-3">
	                	<div class="menu">
	                		<h1>本頁原碼</h1>
	                		本站使用 Laravel 5.1.33 建置
	                    	<a href="#code">內容模板</a>
	                    	<a href="#code">AJAX接收請求端</a>
	                    	<a href="#code">控制器php</a>
	                    	<a href="#code">控制器service</a>
	                    	<a href="#code">控制器javaScript</a>
	                    	<a href="#code">資料庫model</a>
	                    	<a href="#code">服務提供者</a>
	                    	<a href="#code">路由設定</a>
	                    	<a href="#code">框架模板</a>
	                    	<a href="#code">框架css</a>
	                    	<a href="#code">框架javaScript</a>

	                    	<h1>站長的話</h1>
	                    	<p>小弟只是興趣使然的PHP一般使用者，此網站僅供個人學習、記錄與分享，有錯誤請不吝於提出指教謝謝。</p>
	                    	<p>下方個人學習紀錄區提供個人整理的PHP相關文件，由於僅是自己的原碼學習紀錄，因此裡面可能雜亂錯誤，僅供參考。</p>

	                    	<h1>個人學習紀錄</h1>
	                    	不負責任的個人學習紀錄文件<br>
	                    	<b>HTML</b>
	                    	<a href="#code">框架模板</a>
	                    	<a href="#code">框架模板</a>
	                    	<a href="#code">框架模板</a>
	                    	<a href="#code">框架模板</a>
	                    	<a href="#code">框架模板</a>
	                    	<b>HTML</b>
	                    	<a href="#code">框架模板</a>
	                    	<a href="#code">框架模板</a>
	                    	<a href="#code">框架模板</a>
	                    	<a href="#code">框架模板</a>
	                    	<a href="#code">框架模板</a>
	                    	<b>HTML</b>
	                    	<a href="#code">框架模板</a>
	                    	<a href="#code">框架模板</a>
	                    	<a href="#code">框架模板</a>
	                    	<a href="#code">框架模板</a>
	                    	<a href="#code">框架模板</a>

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
            <a id="closedialog" href="#close"><span class="glyphicon glyphicon-remove"></span>關閉這個視窗 (快捷鍵Esc)</a>
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