<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>JQuery UI相關程式頁面</title>
        <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/redmond/jquery-ui.css">
            <!--引用jQUI css，預設主題為smoothness，可找樣式至這裡http://jqueryui.com/themeroller/ -->
        <script src="http://code.jquery.com/jquery-2.1.4.js"></script>

        <link href="public/js/jquery-ui-1.11.4.custom/jquery-ui.css" rel="stylesheet">
        <script src="public/js/jquery-ui-1.11.4.custom/jquery-ui.js"></script>

        <!--<script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>--><!--ui的js必須引用在一般jq後-->
        <style>
            h1 {clear:both; margin:30px 0 0 0; font-size: 18px;}
        </style>
    </head>
    <body>
<!------------------------------------------------------------------------------------------------>
        <h1>第一段 選單</h1><hr>
        <!--引用類型：ul(內含li)     UI物件：menu-->
        <style>
            #menu{width:fit-content; font-family:"微軟正黑體";} /*最外圈ul大小 (fit-content = 最適大小)*/
            #menu ul{width:150px;} /*子清單ul外框寬度*/
            #menu>li{float:left;} /*第一層子清單li橫排*/
        </style>
        <ul id="menu"><!--巢狀ul+il會自動變成選單-->
            <li>選單1</li>
            <li>選單2
                <ul>
                    <li>選單2-1</li><li>--</li><!--兩個橫線--表示畫一條分隔線-->
                    <li>選單2-3<ul><li>2-3-2</li><li>2-3-3</li></ul></li>
                </ul>
            </li>
            <li>選單3</li>
        </ul>
        <script>
            $('#menu').menu //UI初始設定：  .menu=將ul變成選單，()下面接陣列括號{}做設定
            ({
                icons: {submenu: 'ui-icon-triangle-1-s'},   //符號參數，樣式上官網查
                position: {at: 'left bottom' , my: "left top"}  //對其角落參數，at主清單 對齊 my分清單
            });
            console.log($('#menu').menu('option')); //使用colsole帶參數'option'查詢所有參數
                //'option','參數名' 讀取參數值  'option','參數名','參數值' 設定參數值
            $('#menu').menu('option','icons',{submenu: 'ui-icon-plusthick'}); //+符號
        </script>
        
<!------------------------------------------------------------------------------------------------>
        <h1>第二段 日期</h1><hr>
        <!--引用類型：input,div        UI物件：datepicker-->
        <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.1/i18n/jquery-ui-i18n.min.js"></script>
            <!--引用萬國語系日期，會自動抓取語言-->
        <div id="divdate"></div>
        <input id="inputdate" type="text">
        <script>
            $('#divdate').datepicker();
            $('#inputdate').datepicker
            ({
                firstDay: 1,              // 以週一為每週首日  
		numberOfMonths: 2,        // 顯示的月數
		showOtherMonths: true,    // 顯示其它月份日期
		selectOtherMonths: true,  // 可選其它月份日期
		changeMonth: true,        // 月份選單        
		changeYear: true,         // 年份選單 
		showAnim: 'fadeIn',       // 淡入效果，或是選擇slideDown
		duration: 750,            // 效果秒數
                dateFormat: 'yy-m-d'       // 日期格式
            });
            console.log($('#divdate').datepicker('option')); //使用colsole帶參數'option'查詢所有參數
        </script>
        
<!------------------------------------------------------------------------------------------------>
        <h1>第三段 進度條</h1><hr>
        <!--引用類型：div       UI物件：progressbar-->
        <style>
            #progbar {width:500px;}
        </style>
        <div id="progbar"></div>
        <script>
            $('#progbar').progressbar({
                value: 0,   //值
                max: 100,   //最大值
                change: function(){}    //當change時呼叫此
            });
            $('#progbar').click(function(){
                var BV = $('#progbar').progressbar('option','value');
                $('#progbar').progressbar('option','value',BV+5);
            });
        </script>
        
<!------------------------------------------------------------------------------------------------>
        <h1>第四段 滑桿</h1><hr>
        <!--引用類型：div       UI物件：slider-->
        <style>
            #slider {width:500px;}
        </style>
        <div id="slider"></div>
        <p id="sliderValue">0</p>
        <script>
            $('#slider').slider({
                value: 0,   //值
                max: 100,   //最大值
                change: function(){  //當change時呼叫此
                    $('#sliderValue').text($('#slider').slider('option','value'));
                }    
            });
        </script>
        
<!------------------------------------------------------------------------------------------------>
        <h1>第五段 標籤</h1><hr>
        <!--引用類型：div(內含ul li a+div)       UI物件：tabs-->
        <div id="tabsdiv">
            <ul>
                <li><a href="#t1">第一頁</a></li>
                <li><a href="#t2">第二頁</a></li>
            </ul>
            <div id="t1">123<br>123</div>
            <div id="t2">456</div>
        </div>
        <script>
            $('#tabsdiv').tabs({
                collapsible: false, //可摺疊嗎 預設f
                event: 'click', //怎麼觸發 預設click
                heightStyle: 'content', //高度調整：content依據內容(預設)、auto依據最高的頁、fill依據外部css
                hide: 0, //收起 切換頁面效果： 數字=淡出淡入(秒數)、bounce彈跳、puff放大飛、slideUp向上拉移
                show: 0 //顯示 切換頁面效果
            });
        </script>
        
<!------------------------------------------------------------------------------------------------>
        <h1>第六段 交談窗</h1><hr>
        <!--引用類型：div       UI物件：dialog-->
        <a id="opdialog" href="#">開啟交談窗</a>
        <div id="dialog">
            <a id="closedialog" href="#">關閉這個視窗</a>
        </div>
        <script>
            $('#dialog').dialog({
                autoOpen: false,  //自動彈出 預設f
                title: '彈出來!',  
                closeOnEscape: true, //按esc關閉 預設t
                modal: true, //鎖住背景 預設f
                resizable: true, //可調大小 預設t
                width: 500, //寬度 預設300
                height: 'auto' //高度 預設auto自適應
            });
            $('#opdialog').click(function(){
                $('#dialog').dialog('open');    //專門開啟交談視窗呼叫法
            });
            $('#closedialog').click(function(){
                $('#dialog').dialog('close');    //專門開啟交談視窗呼叫法
            });
        </script>
    </body>
    
<!------------------------------------------------------------------------------------------------>
        <h1>第七段 美化按鈕</h1><hr>
        <!--引用類型：button       UI物件：button-->
        <button id="button">123456</button>
        <script>
            $('#button').button({
                icons:{primary:'',secondary:'ui-icon-circle-close'} //設定小圖示(前 後)
            });
        </script>
    </body>
</html>