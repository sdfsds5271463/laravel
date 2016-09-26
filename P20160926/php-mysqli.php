<!--
    0.mysql概念
        MySQL資料庫軟體->資料庫（database）->資料表（table）->資料列（row） 
         - 資料庫（database）底下可以有許多資料表。通常一個網站會有一個專屬的資料庫。
         - 資料表（table）是儲存資料的地方，一個網站通常會有數個資料表。 
         - 欄位（column），每個資料表可以有數筆資料，又可以分類存放數個欄位。 

    0.5.table架構概念
        0.5.1 所有型態共通欄位：
            1.預設值：若沒有指定時的預設值，可以自行定義
            2.編碼與排序：可留空，會隨資料表或是資料庫的主設定utf8_unicode_ci
            3.空值：是否同意欄位為null
            4.索引： PRIMARY KEY，主鍵，唯一、不可重複(必要)
                    Index，搜尋索引，非唯一、可重複
                    Unique，獨特索引，非唯一、不可重複
            5. A_I：依序自動產生PRIMARY KEY ID功能，限用於主鍵
        0.5.2 INT整數型態：
            1.長度/值：只影響SQL顯示時長度，在屬性留空的情況下無作用
            2.屬性： 設定UNSIGNED時，會用空白將資料長度補足長度/值設定
                    設定ZEROFILL時，會用0將資料長度補足長度/值設定
	0.5.3 FLOAT浮點數型態：
            1.長度/值：預設12，更改無效
            2.屬性： 設定UNSIGNED時，會用空白將資料長度補足長度/值設定
                    設定ZEROFILL時，會用0將資料長度補足長度/值設定
	0.5.4 VARCHAR字串型態：
            1.長度/值：字串的最大字元數，使用空間會視實際儲存字元變動

    1.5.SQL讀取語法格式
        SELECT 欄位 FROM 資料表 其他子句
        1.5.1.欄位：
            所有欄位：*
            指定欄位：欄位名1 , 欄位名2
            指定同時更改欄位名稱：欄位名 As 新欄位名
            指定同時更改欄位內容：欄位名*0.5 As 欄位名
			(欄位其他運算式：AVG() COUNT() MAX() MIN() SUM() )
	1.5.2資料表：
            單資料表：資料表名
            雙資料表：資料表名1 JOIN 資料表名2 ON 欄位名1 = 欄位名2
			(系統會依據ON的連接條件，將資料表2資料連至後方)
	1.5.3其他子句：
            WHERE 欄位名 運算式 (基本式=、>、<、IS NULL，敘述式AND、OR、NOT、BETWEEN…AND)
					(Like可用於尋找字串，%為任意數字元、_為單一數字元)
					EX：WHERE 'col1' > 100 AND 'col2' LIKE '_的%''
					EX：WHERE 欄位=( SELECT 欄位 FROM 資料表 其他子句)
            ORDER BY 欄位名 排序方式 (排序ASC小到大、DESC大到小、RAND()隨機排)
            LIMIT 啟始筆數,要幾筆 (可不設定，即所有筆數)
-->
<?php //此文章一到四段介紹程序導向介面，五段以後為物件導向函式
    //第一段為連線資訊，可單獨儲存為connect.inc.php

    header('content-type: text/html; charset:utf-8'); //頁面編碼設定
    
    $mysqliIp = 'localhost';
    $user = 'root';
    $passwd = 'abcd1234';
    $useDb = 'test0821';
    $conn = mysqli_connect ($mysqliIp , $user ,$passwd,$useDb); //資料庫連線語法
    mysqli_set_charset($conn, "utf8"); //選擇本次連線編碼

    //mysqli_select_db($conn, $useDb); //選擇使用的資料庫 (重新選擇or連線時沒指定現在選)
    //mysqli_connect_errno(); //回傳是否出錯
    //mysqli_close($conn); //關閉本次連線
?>

<?php
    //第二段為讀取資料庫，可以引用第一段的資訊
    //include_once 'connect.inc.php';

    $sql = "SELECT * FROM student"; //sql敘述：連線資料表
    $result = mysqli_query($conn, $sql); //執行sql敘述建立result旗標
    $rows = mysqli_num_rows($result);   //資料數
    $fields = mysqli_num_fields($result);   //欄位數
    $array = mysqli_fetch_array($result);   //讀取陣列，索引値可以是數字或欄位名稱
                                            //mysqli_fetch_row是類似函數，但索引値只能數字
    $fieldName = mysqli_fetch_field_direct($result, 0)->name; //第一欄位名稱
    echo "此連線有 $rows 筆 $fields 欄，第一筆第一欄$fieldName = $array[0] <br>"; 
        //$array內引數可直接指定欄位名
?>

<?php
    //第三段為修改資料庫，使用mysqli_query執行sql敘述

    $sql="CREATE DATABASE newdatabase"; //sql敘述：建立資料庫
    $sql="DROP DATABASE newdatabase";	//sql敘述：刪除資料庫
    $sql="CREATE TABLE addName (id1 int (10) UNSIGNED null , id2 TINYINT not null )";
                                        //sql敘述：創造資料表 (需先連線至資料庫)
    $sql="DROP TABLE addName";          //sql敘述：刪除資料表 
    $sql="INSERT INTO book(bkname,price) values('$fields','1000')";
                                        //sql敘述：插入數據
    $sql="UPDATE book SET bkname='好書',price='1500' WHERE id='3'";
                                        //sql敘述：更新數據
    $sql="DELETE FROM book WHERE id='4'";
                                        //sql敘述：刪除數據
    //以上動作設定好sql語法之後，需使用mysqli_query進行執行
    //mysqli_query($conn, $sql); //執行sql敘述
?>

<?php
    //第四段為其他概念

    //防止SQL注入1，將可能惡意語法(' " \)加入跳脫字元轉化
    @$passwd = mysqli_real_escape_string($conn,$_POST['passwd']);
    
    //防止SQL注入2，stmt綁定欄位值行
    $TT = "測試書名";
    $T2 = 12345;    //準備好要綁定的變數，於sql敘述中有相對應的?符號
    $sql="INSERT INTO book(bkname,price) values(?,?)";
    $stmt = mysqli_prepare($conn,$sql); //準備stmt
    mysqli_stmt_bind_param($stmt,'si',$TT,$T2); //將變數綁入sql敘述 
        //(前面字串為限定格式，'sidb'分別代表字串、整數、浮點數、布林)
    //mysqli_stmt_execute($stmt); //stmt執行sql敘述
    mysqli_stmt_close($stmt); //關閉stmt
    
        //以下為防止SQL注入WHERE之stmt資料取出的範例
    $sql="SELECT * FROM book WHERE id >= ?";
    $stmt = mysqli_prepare($conn,$sql);
    $T3 = "3";
    mysqli_stmt_bind_param($stmt,'i',$T3);
    mysqli_stmt_execute($stmt); //stmt執行sql敘述後，還需要以下綁定輸出結果
    mysqli_stmt_bind_result($stmt,  $id,$bkname,$bystuid,$price);
    
    mysqli_stmt_fetch($stmt);
    echo "$id,$bkname,$bystuid,$price <br>"; //取出資料
?>

<?php
    //第五段物件導向存取mysqli
    $mysqliIp = 'localhost';
    $user = 'root';
    $passwd = 'abcd1234';
    $useDb = 'test0821';
    $mysqli = new mysqli($mysqliIp , $user , $passwd, $useDb); //資料庫連線語法
    $mysqli->set_charset("utf8"); //選擇本次連線編碼

    //$mysqli->select_db($useDb); //選擇使用的資料庫 (重新選擇or連線時沒指定現在選)
    //$mysqli->connect_errno; //回傳是否出錯
    //$mysqli->close(); //關閉本次連線
?>

<?php
    //第六段為讀取資料庫，可以引用第五段的資訊
    //include_once 'connect.inc.php';

    $sql = "SELECT * FROM student"; //sql敘述：連線資料表
    $result = $mysqli->query($sql); //執行sql敘述建立result旗標
    $rows = $result->num_rows;   //資料數
    $fields = $result->field_count;   //欄位數
    $array = $result->fetch_array();   //讀取陣列
    //$array = $result->fetch_all();   //讀取所有陣列(二維)
    $fieldName = $result->fetch_field_direct(0)->name; //第一欄位名稱
    echo "此連線有 $rows 筆 $fields 欄，第一筆第一欄$fieldName = $array[0] <br>"; 
    //寫入sql敘述同程序導向，執行sql敘述之語法為$mysqli->query($sql);
?>

<?php 
    //第七段為物件導向之stmt
        //以下為防止SQL注入WHERE之stmt資料取出的範例
    $sql="SELECT * FROM book WHERE id >= ?";
    $stmt = $mysqli->prepare($sql);
    $T4 = "3";
    $stmt->bind_param('i',$T4);
    $stmt->execute(); //stmt執行sql敘述後，還需要以下綁定輸出結果
    $stmt->bind_result($id,$bkname,$bystuid,$price);
    
    $stmt->fetch();
    echo "$id,$bkname,$bystuid,$price <br>"; //取出資料
?>

<?php
    //第八段為PDO存取資料庫
    $mysqliIp = 'localhost';
    $user = 'root';
    $passwd = 'abcd1234';
    $useDb = 'test0821';
    $dsn = "mysql:host=$mysqliIp; dbname=$useDb; charset=utf8";
    try{
        $conn = new PDO($dsn, $user, $passwd); //建立pdo連線
    }catch (PDOException $e)
    {
        die($e->getCode()); //使用try可以操控錯誤頁面
    }
    
    //$pdo=NULL; //關閉本次連線
    
    $sql = "SELECT * FROM student"; //sql敘述：連線資料表
    $result = $conn->query($sql); //執行sql敘述建立result旗標
    //(執行完execute的stmt物件同於此旗標)
        $rows = $result->rowCount();   //資料數
        $fields = $result->columnCount();   //欄位數
        $array = $result->fetch();   //讀取陣列
        //$array = $result->fetchAll();   //讀取所有陣列(二維)
        $fieldMeta = $result->getColumnMeta(0); 
        $fieldName = $fieldMeta['name']; //第一欄位名稱
        echo "此連線有 $rows 筆 $fields 欄，第一筆第一欄$fieldName = $array[0] <br>"; 
    //寫入sql敘述同程序導向，執行sql敘述之語法為$conn->query($sql);

    //pdo stmt防止注入 讀取
    $sql = "SELECT * FROM book WHERE id >= ?"; 
    $stmt = $conn->prepare($sql);
        $T4 = "3";
        $stmt->execute(array($T4)); //第一種綁定法：綁定?
    $array = $stmt->fetch(PDO::FETCH_OBJ); //fetch的()內，加入PDO::FETCH_OBJ表示以物件輸出
                                           //若()內留空，則成為陣列，用$array[0]讀取
    echo "$array->id ,$array->bkname ,$array->bystuid, $array->price <br>";
    
    //pdo stmt防止注入 插入
    $sql = "INSERT INTO book(bkname,bystuid,price) values(:bkname,:bystuid,:price)"; 
    $stmt = $conn->prepare($sql);
        $bkname = "說書"; $bystuid = "10217003"; $price = 2500;
        $stmt->bindParam(':bkname', $bkname); //第一二種綁定法：綁定冒號變數
        $stmt->bindParam(':bystuid', $bystuid);
        $stmt->bindParam(':price', $price);
    $stmt->execute(); //插入
        $stmt->bindParam(':bkname', $bkname);
    $stmt->execute(); //可連續插入
    
?>