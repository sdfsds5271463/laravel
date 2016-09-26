<?php
    if (! empty($_POST)) //當有POST請求時
    { 
        $post = [];
        foreach($_POST as $key => $value) { 
            $post[$key] = $value;
        }
        echo json_encode($post);  //Array to Json字串 回傳
        exit(); //防止ajax輸出html資料
    }

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>jQuery讀取JSON與XML格式</title>
        <script src="http://code.jquery.com/jquery-2.1.4.js"></script>
        <script>
            $(function(){
                /*L1.JSON格式讀取：*/
                //$.getJSON("位址",function(JSON物件名){});  將資料讀取至物件並執行函數
                    $.getJSON("http://httpbin.org/headers",function(data){
                        //console.log(data); //顯示讀取的JSON物件
                        //console.log(data.headers.Accept); //用.往下層物件讀取
                    }); //可以用each函數拆解它
                
                /*L2.XML格式讀取：*/
                //$.get("位址",function(XML物件名){});  將資料讀取至物件並執行函數
                    $.get("http://httpbin.org/xml",function(data){
                        //console.log(data); //顯示讀取的XML物件
                        //console.log($(data).find('slideshow').attr('title')); 
                    }); //用.find搜尋標籤名稱，拆解它
                    
                 /*L3.XML或是JSON的跨域存取 使用YQL*/
                    //此種存取方法沒有跨域的問題，可以抓取xml與json兩種格式，但是輸出都是xml格式的字串
                    //抓取的語言種類選擇，要從YQL的設定select * from選擇
                    var yURL="http://httpbin.org/headers";
                    var yql ='http://query.yahooapis.com/v1/public/yql?q=' + 
                            encodeURIComponent('select * from json where url="' + 
                            yURL + '"') + '&format=xml&callback=?'; //使用YQL
                    $.getJSON(yql, function (data) {
                        //console.log(data.results[0]); //輸出XML字串
                        //console.log($(data.results[0]).find('Host').text()); //一樣用find處理
                    });
                    
                 /*L4.JSONP跨域存取JSON格式*/
                    $.ajax({
                         type: "post",
                         url: "http://opendata.epa.gov.tw/ws/Data/REWXQA/?$orderby=SiteName&$skip=0&$top=1000&format=json",
                         dataType: "jsonp",
                         success: function(res){ //成功時執行
                             //console.log(res);
                         },
                         error: function(){ //失敗時執行
                             //console.log("JSONP抓取失敗");
                         },
                         complete: function(){ //結束時執行
                             //console.log("JSONP執行結束");
                         }
                     });
                     
                 /*L5.jQuery post的post方法*/
                    var formData = "name=ravi&age=31"; //字串傳輸，一定要傳組合陣列
                    var formData = {name:"ravi",age:"31"}; //JSON傳輸
                    //$.post('URL',formData,function(data){/*回傳表頭PHP與全部html內容*/}
                    $.post('',formData,function(data){
                        data = JSON.parse(data); //取回JSON格式資料
                        console.log(data);
                    });
                    
                 /*L6.jQuery ajax的post方法*/
                    //功能同上，但是多了error complete函數可選用
                    $.ajax(
                    {
                        type: 'post',
                        url:'',
                        data: formData,
                        success:function(data)
                        {
                            //data = JSON.parse(data);
                            //console.log(data);
                        },
                        error:function()
                        {
                            ///console.log();
                        }
                    });

                /*L7.表單的AJAX*/
                    /*
                    $(".form1").ajaxSubmit(); 
                    $(".form1").resetForm(); //呼叫送出與重設參數
                    */

            });
        </script>
    </head>
    <body>
        <span id="show"></span>
    </body>
</html>