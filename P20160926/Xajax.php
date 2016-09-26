<?php
/*使用ajax library需要下載ajax套件，然後用require引用*/
require_once ('xajax/xajax_core/xajax.inc.php'); //引用

//接下來，ajax會用到一個物件(連結JS)、任意個註冊、任意個函式，都可以自行命名
$ADDxaj= new xajax(); //建立物件
$ADDxaj->configure('javascript URI', 'xajax/'); //物件連結javascript
$ADDreg= $ADDxaj->register(XAJAX_FUNCTION, 'ADDfun'); //建立註冊 連結函式
$ADDxaj->processRequest(); //設定完成，進行處理回應
    //無路用函式$ADDreg->useSingleQuote(); // 輸出的程式碼使用單引號

//使用變數產生 (設定幾個則function就要有幾個回傳値，注意字串要用雙單兩種引號包住)
$ADDreg->setParameter(0,XAJAX_FORM_VALUES,'form1');   //set索引0陣列  抓取表單  ID=form1
$ADDreg->addParameter(  XAJAX_JS_VALUE, '" (評價："'); //add接續索引   一般變數  "'字串'"
$ADDreg->setParameter(2,XAJAX_JS_VALUE, 100);         //set索引2陣列  一般變數  數字
function ADDfun($form,$a,$b){ //表單陣列抓取屬性name為索引値，上設定中的_FORM_也可改為INPUT或CHECKED
    //這邊可以放入任何php程式做溝通，但是不能輸出html
    $ADDrsp = new xajaxResponse(); //產生結果函式
    return $ADDrsp->assign('ans', 'innerHTML', $form['n1']+$form['n2'].$a.$b."分的程式)");
    //修改元素屬性->assign('元素ID','屬性',修改的值); (可改append或prepend指定位置就不會覆蓋過既有屬性)
    //產生彈跳視窗->alert(值);
    //呼叫JS 函式->call('test'); //test為函式名
    //window語法->script('alert()');
    //網頁重新轉址->redirect('URL');
}   
?>
<html>
<head>
  <meta charset="UTF-8">
  <title>XAJAX範例</title>
  <script src="http://code.jquery.com/jquery-2.1.4.js"></script>
  <?php $ADDxaj->printJavascript(''); ?> <!--要在head輸出專屬script-->

  <script>
      $(function(){
          $("#button1").click(function(){
              <?php 
                    $ADDreg->printscript();  //xajax觸發函數
                    //echo $ADDreg->getscript();  //這兩個函數相同，只是上面那個自帶pring
                    //echo "xajax_ADDfun(1,2,3)"; //可以手動處發函數，但是就不會自動抓取form值
              ?>
          });
      });
  </script>
</head>
<body>

  <form id="form1">
    <input type="text" name="n1">+<input type="text" name="n2">
    <button type="button" id="button1">=</button><span id="ans"></span>
  </form>
</body>
</html>