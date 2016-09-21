<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge"><!--此項僅為了讓IE以最新版設定-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>bootstrap框架應用</title>
        <!--以下為bootstrap框架必須引用之 .css jquery.js bootstrap.js-->
        <link href="public/css/bootstrap.min.css" rel="stylesheet">
        <script src="public/js/jquery-2.1.4.min.js"></script>
        <script src="public/js/bootstrap.min.js"></script> 
            <!--更多網頁特效可以直接到這http://getbootstrap.com/components/ 找到效果與程式碼-->
        <style>
            .carousel-inner img,#TEMPnav{ margin: 0 auto;} /*輪播圖片置中*/
        </style>
    </head>

    <body>
        <!--L0.特殊圖示引用法 (圖示索引清單 http://getbootstrap.com/components/ )-->
            <!--EX：<span class="glyphicon glyphicon-chevron-right"></span>
                使用span引用圖示，直接將class設定為圖示索引即可-->
        
        <!--L1.相片輪播元件-->
        <div id="TEMPslide" class="carousel slide" data-ride="carousel" data-interval="3000">
            <!--輪播元件建立，一定要設id、並指派class="carousel slide"(旋轉換燈片類別)
                data-ride="carousel"開啟輪播功能、data-interval輪播間格(預設5000)-->
            <!--L1.1 相片清單(必要)-->
                <div class="carousel-inner">
                    <div class="item active"><img src="tmp.jpg"></div>
                    <div class="item">       <img src="tmp.jpg"></div>
                    <div class="item">       <img src="tmp.jpg"></div>
                </div><!--清單div類別carousel-inner，內部每個相片都用類別item(起始的要加active)的div包起-->
            <!--L1.2 左右切換照片(非必要) --> 
                <a class="left  carousel-control" href="#TEMPslide" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left"></span></a>
                <a class="right carousel-control" href="#TEMPslide" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right"></span></a>
                    <!--左右照片切換是元素a的類別設定，超連結錨點到輪播元件，元素內容可設定圖片比較漂亮-->
            <!--L1.3 中央圓點瀏覽控制(非必要) --> 
                <ol class="carousel-indicators">
                    <li data-target="#TEMPslide" data-slide-to="0" class="active"></li>
                    <li data-target="#TEMPslide" data-slide-to="1"></li>
                    <li data-target="#TEMPslide" data-slide-to="2"></li>
                </ol><!--圓點控制是ol設計li清單指定類別的效果，清單內容需NULL-->
        </div>
        
        <!--L2.清單巡覽列-->
        <nav class="navbar navbar-default"><!--navbar表示清單，空白後面是樣式：
                                            (無輸入)白底、navbar-default灰底、navbar-inverse黑底-->
            <!-- 選單表頭(常駐顯示)+後方按鈕清單(縮小時出現) -->
            <div class="navbar-header">
                <span class="navbar-brand">測試網站XD</span><!--選單表頭(常駐顯示，非必要)-->
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#TEMPnav">
                    <span class="glyphicon glyphicon-menu-hamburger"></span><!--上面是按鈕設定，這是按鈕圖示-->
                </button>
            </div>

            <!-- 選單(縮小時(<768px)消失) -->
            <div id="TEMPnav" class="navbar-collapse collapse">
                <ul class="navbar-nav nav">
                    <li><a href="#">普通選單1</a></li>
                    <li><a href="#">普通選單2</a></li>
                    <li><a href="#" class="dropdown-toggle" data-toggle="dropdown">下拉選單
                        <span class="caret"></span></a><!--span的類別caret是下拉專屬圖示▼-->
                        <ul class="dropdown-menu">
                            <li><a href="#">下拉項目1</a></li>
                            <li><a href="#">下拉項目2</a></li>
                            <li class="divider"></li><!-- 分隔線 -->
                            <li><a href="#">下拉項目3</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>

        <!--L3.RWD網頁內容-->  
            <!--
        概念說明：
            1.版面元件全部都是div帶類別 (或是同功能區域標籤)
            2.最外層container 內層直行row 橫列col
                2.1 container設定有兩種模式：
                    一、class="container"，則滿版寬全部為固定値，如以下
                    二、class="container-fiuid"，則滿版寬全部為100%，不會套用以下設定 (不建議)
                2.2 row的概念
                    每層row必須包含正好12格的col，可見以下範例，當col交疊時不會超出row範圍
            3.橫列col設定時，會將版面切為12橫段，依據裝置解析度決定以幾段顯示
                3.2 col寬度設定：(若只設定單項類別，則不會判斷套用時機)
                    名稱    套用寬時機   滿版寬   舉例裝置
                    xs     <768px     100%    iphone (一般都是以768為分水嶺)
                    sm     >=768px    768px   ipad
                    md     >=992px    970px   小筆電
                    lg     >=1120px   1170px  一般電腦
                    所以如果我希望手機瀏覽時 欄位相疊且解析度為裝置100%、其他瀏覽時欄位並排解析度768px
                        設定如兩個此div：<div class="col-xs-12 col-sm-6"></div>
                    如果我希望解析度為1170px，並排的兩欄位若你裝置解析度小於1170px就會重疊成585px的雙欄
                        設定如兩個此div：<div class="col-lg-6"></div>
            4.圖片元素
                全部的圖片元素都必須加入 img-rounded 類別
                另外還有特殊美工樣式類別可選用：img-circle切圓、img-rounded圓角、img-thumbnail加框
            5.表格元素
                表格元素必須被<div class="table-responsive"></div>包住，
                表格必須加入 table 類別，另外還有美工類別可用：table-hover 滑上去時有特效
        -->
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <img src="tmp.jpg" class="img-responsive img-circle">
                </div>
                <div class="col-lg-8 table-responsive">
                    <table class="table table-hover">
                        <tr><th>欄位A</th><td>內容A</td></tr>
                        <tr><th>欄位B</th><td>內容B</td></tr>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4">文字文字1</div>
                <div class="col-lg-4">文字文字2</div>
                <div class="col-lg-4">文字文字3</div>
            </div>
        </div>
        <!--以上效果：1170px版面寬，電腦瀏覽時會有2直欄，手機瀏覽時會有5直欄-->
    </body>
</html>