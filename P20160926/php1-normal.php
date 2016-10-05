<?php 
/*---L1.表頭屬性函式---*/
    
    /*1.1 緩衝函式：啟動緩衝區，讓所有html格式駐存，可配合cookie與session*/
        ob_start(); //啟動緩衝
        //ob_clean(); //清除緩衝
        //ob_flush(); //輸出緩衝
        //ob_end_clean(); //清除緩衝+中止
        //ob_end_flush(); //輸出緩衝+中止
        
    /*1.2 header設定：頁面編碼或轉址 (為html meta功能)*/
        header('content-type: text/html; charset:utf-8'); //編碼
        //header('location: http://www.google.com'); //轉址
        //header('refresh: 2; http://www.google.com'); //刷新轉址(帶延遲秒數)
        
    /*1.3 cookie使用：可將變數以txt方式儲存至瀏覽器資料夾，只能放在表頭*/
        //setcookie(名稱,數值,自刪時間旗標,目錄,限定可存取網域); //數值之後參數可以不用設定
        setcookie('cookie_save','我是存入餅乾的值',time()+10,'../','127.0.0.1');
        //$_COOKIE['cookie_save']; //cookie裡存的值;
            //備註：第一次網頁完整執行之後才會將值存入cookie，故第二次才能讀取到cookie的值
            //沒設Cookie期限，仍會建立Cookie但是不儲存在使用者的硬碟，隨瀏覽器關閉消失
        
    /*1.4 session使用：可將變數存入server端，存到瀏覽器重啟為止*/
        session_start(); //啟動session，只能放在表頭
        $_SESSION['session_save'] = "我是存入會議的值";
        //$_SESSION['session_save']; //session裡存的值;
        session_unset(); //清空session
            //備註：比cookie安全
        
        ob_end_flush(); //終止緩衝，貼出資訊


/*---L2.常見處理用函式---*/
    $TEST = '#ffAA00'; //定義一個測試用數據
        
    /*2.0 時間相關*/
        date_default_timezone_set('Asia/Taipei'); //時區設定
        time(); //回傳當下時間標記 (時間標記是 自1970/1/1經過幾"秒"之後)
        mktime(22,0,0,8,24,2016); //回傳mktime(h,i,s,m,d,Y)時間標記
        strtotime("+1year 1month 1week 1day 1hour 1minute 1second"); //回傳相對於現在的時間標記
        $getdate = getdate(time()); //getdata為分析時間物件 (把時間參數變陣列)
            $getdate["year"]; //回傳時間參數：year年 mon月 mday號 星期wday hours點 minutes分 seconds秒
                                   //month月份名稱 weekday星期名稱
        echo date('Y-m-d h:i:s a',time()); //格式化時間標記 回傳2016-08-24 10:15:13 pm (H=24制時;w=週)
        microtime(); //回傳小於一秒的時間(0.秒)

    /*2.1 是否類型函式 回傳1或是null*/
        isset($TEST);       //存在？Y
        empty($TEST);       //為空？N
        is_array($TEST);    //陣列？N
        is_int($TEST);      //整數？N
        is_null($TEST);     //為零？N
        is_numeric($TEST);  //數字？N (數字字串也算)
        is_string($TEST);   //字串？Y

    /*2.15 簡單處理函式*/
        //輸出相關
            //echo "輸出Html"; //回傳NULL
            //print "輸出Html"; //回傳1  print比echo多一個return，其他完全一樣
            //print_r ([1,2,3]); //專門輸出陣列格式
            //var_dump ([1,2,3]); //專門輸出陣列格式，更詳細
        
        //數學相關
            mt_rand(1,100); //回傳1~100的int亂數
            pow(2,5); //回傳2的5次方
            sqrt(4); //回傳根號4
            min(1,2,3); //回傳最小(可放入陣列)
            max(1,2,3); //回傳最大
            floor(1.5);//無條件捨去 (回傳1)
            ceil(1.5);//無條件進位 (回傳2)
            round(1.5);//四捨五入 (回傳2)
        
        //設定相關
            //unset($TEST);  //刪除變數
            define('PI',3.1415); //定義函數
            ini_set("SMTP","127.0.0.1"); //暫時設定php.ini
            
        //陣列相關
            //定義法
                $B = array('one'=>1,'two'=>2,'tre'=>3); //$B[0]=$B['one']=1  $B[1]=2
                $B = ['one'=>1,'two'=>2,'tre'=>3]; //此為組和陣列 (鍵為字串，不是數字)
                $B['for'] = 10; //插入新陣列，沒設定鍵則是普通陣列 (組和陣列=鍵值陣列)
            //尋找法
                array_key_exists("one",$B); //找尋鍵 (回傳1)
                isset($B["one11"]); //找尋鍵 (回傳NULL) 
                in_array(1,$B); //尋找是否有值 (回傳1)
                array_search(1,$B); //尋找值的鍵 (回傳one)
            //讀取法
                count($B); //陣列元素數 (回傳3)
                array_sum($B); //陣列值總和 (回傳6)
                foreach ($B as $key=>$val){} //用foreach讀取鍵與值
                //list($a,$b,$c)=$B; //取出對應值$B[0~3]  (這邊會出錯，因為list不能抓組和陣列)
            //修改法
                //排序系列：sort小到大 rsort大到小
                asort($B);  arsort($B); //值排序
                ksort($B);  krsort($B); //鍵排序
                sort($B);   rsort($B);  //值排序，順便把全部組和陣列變成一般陣列
                array_push($B,4,4,4); //推入值 (只能推一般陣列，依序用逗號格開)
                $B = array_unique($B); //砍重複(回傳陣列)
                $B = array_reverse($B); //反轉(回傳陣列)
                //array_splice(array,offset,len,insert_array); //陣列刪除與插入
                    //offset修改位置(可為負數)、len連刪元素數、insert_array插入新陣列(可不設)
            
    /*2.2 字串處理函式*/
        //2.2.0 正規則表示 說明：
            /*  規則需用兩個/包住
             *      一般字元：直接比對
             *      \s：空白字元(全|半形空白)
             *      .：任意字元
             *      ^：(頭)從最左側開始判斷
             *      $：(尾)從最右側開始判斷
             *      ^str$：左右完全吻合
             *      *：([]尾)連續判斷、(str尾)連續字元|串
             *      []：內含特殊規則
             *          [a-z] 一個小寫英文字元 ([!-~]為所有一般字元)
             *          [^a]* 從左側開始連續擷取至a之前(不包含a)
             *      {}：(尾)重複前述規則|字元|串
             *          {2}重複2次、{1,3}重複1~3次、{1,}重複1次以上
             *      +：(尾)等同於{1,}重複1次以上
             *      ?：(尾)將前述規則變為非強制
             *      \：(頭)跳脫字元
             *  規則尾端：
             *      加i：不考慮英文大小寫
             *      加g：整個規則連續判斷
             *
             *  EX: "/#[0-Z]{6}/i" 規則為 不分大小寫的色碼格式，例如#12FA8e
             *  EX: "/data:([^;]*)/" 會先找出data:字串，然後從左側^連續*找至字元;
             *      data:1234567;wsdfsdf   抓取data:1234567
             */ 
        
        //2.2.1 字串資訊回傳函式
            strlen($TEST); //取得字節長度 (回傳 7，中文=3字節)
            mb_strlen($TEST, "utf8"); //取得字元數目 (回傳7，中文也是1字元)
            preg_match("/#[0-Z]{6}/i",$TEST ,$matches); //比對規則 (規則,字串,吻合者)
                //吻合者$matches 會回傳吻合之字串陣列 (每個括號內都會是一個原素)
            
        //2.2.2 字串修改函式
            //$A.= "B"; //字串連接 ($A變成AB)
            str_replace('0','zero',$TEST); //替換字串 (尋找,改值,字串)
            preg_replace('/[a-z]/','',$TEST); //替換字串依規則 (規則,改值,字串)
            explode('/','2016/08/24'); //切割字串 (符號,字串)
            trim(' 清雙空 ');  rtrim(' 清左');  ltrim('清右 '); //清除空白
            nl2br('字串'); //nl變成br
            strtolower("ABC"); //轉小寫 (回傳abc)
            strtoupper("abc"); //轉大寫 (回傳ABC)
            substr($TEST, 2 ,3); //取得部分字串(抓取點 位元數) (回傳 fAA)
            substr($TEST, -2); //取得部分字串(抓取最後幾位元) (回傳 00)
            strpos("ABCBA","B");  //正向搜尋字串位置 (字串,搜尋值) 回傳1
            strrpos("ABCBA","B"); //反向搜尋字串位置 (字串,搜尋值) 回傳3
            strchr("ABCDE","C"); //砍頭 (字串,保留字 含之後) 回傳CDE
            
        //2.2.3 字串修改格式
            (int)(1.5);//轉換格式int (回傳1)
            sprintf('我%d歲',19); //格式化輸出 回傳我19歲 (格式： %d整數 %s字串 %f小數)
                    //其他格式： %03d回傳3字元的整數、%.3f回傳小數點下3位
            htmlspecialchars("<br>"); //字串編碼為html顯示格式
            //htmlspecialchars_decode(); //反編碼函式
            addslashes("''\""); //跳脫字元加入 (\ ' "前面加入跳脫字元\)
            //stripslashes() //移除跳脫字元函式
            serialize([1,2,3]); //轉換為易儲存之格式 (字串)
            unserialize('s:1:"1";'); //儲存格式還原
            mb_internal_encoding("UTF-8"); //將內文函式編碼設定
            mb_encode_mimeheader("內文","UTF-8"); //設定字串編碼
            //mb_decode_mimeheader("編碼字串"); //解除mb編碼
            
    /*2.3 其它處理函式*/  
        //2.3.0 忽略錯誤回報
            //忽略符號：@
            //只要在那行指令前面加入忽略錯誤符號@，則PHP就不會通報notice或warning
            
        //2.3.1 跳脫函式
            //die("error_msg");
            //exit("error_msg"); //此兩個函式會讓php執行不下去
        
        //2.3.2 引入函式 include & require
            //include(url); //引入url
            //require(url); //引入url
            //這兩個函式基本一模一樣，差別在require失敗=error，include失敗=warning
            //include_once(url); 
            //require_once(url); //同上，但不會重複引入
            
    /*2.4 E-mail寄發*/
        //ini_set("SMTP", "$smtp");
        //ini_set("sendmail_from", "$from");
        //$parameter = "Content-Type:text/html;charset=utf-8;"; 
        //mail("$to", encodeMIMEString ("UTF-8", $subject), "$message", "$parameter");
        //看的懂吧

    /*2.5 迴圈與判斷*/
        //2.5.0 基本運算字元介紹
            /*  == < > 比較
             *  === 格式比較
             *  !反向 &&and ||or
             *  %mod
             */
            
        //2.5.1 基本判斷與迴圈
            //switch(變數){case'符合':執行; break; default:}
            //if(判斷){執行;}else{}
            //for(變數;條件;變數更動){執行;}
            //while(判斷){執行;}
            //do{執行;}while(判斷);
            //foreach(陣列 as 鍵=>值){執行;}
                //迴圈都可以用continue跳至下一圈 或是break中止
            //三元運算符?:  a?b:C  當a是true回傳b，否則回傳c

    /*2.6 參數相關*/
        //2.6.1 取得數值
            $_SERVER['PHP_SELF']; //取得自己的網址 (不含網域 不含GET)
            $_SERVER['REQUEST_URI']; //取得自己的網址 (不含網域 含GET)
            $_SERVER['QUERY_STRING']; //取得GET
            $_SERVER['HTTP_HOST']; //取得網域
            $_SERVER["SCRIPT_FILENAME"]; //取得該執行檔完整路徑(反斜線) 似__FILE__(正斜線)
            //$_POST['name']; //取得method為post的值 (可為陣列)
            //$_GET['name']; //取得method為get的值，get值會自帶在網址列 (可為陣列)
                //POST、GET本身就是陣列，所以只要傳送陣列，自然會變2維陣列
            
        //2.6.2 魔術常量
            __FILE__; //完整網頁路徑
            __DIR__; //執行網頁目錄
            __FUNCTION__; __CLASS__; __TRAIT__; //呼叫函數或類別名
            __METHOD__; //方法
            __NAMESPACE__; //命名空間


/*---L3.自定義函式---*/
    /*3.1 函式格式*/
        $two = 2;//function以外的變數稱為 全域(global)變數
        function doubleValue($num) //function 函式名(參數)
        {
            global $two; //用global函數將全域變數抓進function
            $two = $GLOBALS['two']; //創造一個新變數，成為global變數
                //以上兩招為函式存取全域變數的方法
            $num = $num*$two;
            static $sum=0; //static靜態變數不會隨function結束而清空
            $sum += $num; //把每次的計算都記錄
            return ($num); //回傳値
        }
        $ten = 10;
        doubleValue($ten); //傳値呼叫，輸出20，$ten維持10
                           //若是函式為function doubleValue(&$num)，那個&會把$num改為傳址呼叫
                           //傳址呼叫會改變傳入的值，$ten在乎叫完會變成20

/*---L4.heredoc技術*/
    /*4.1概念*/
        //heredoc技術是一種Perl風格的字符輸出技術，可以將Html語法與PHP變數同時輸出，但是不能解析函式
        //函數開始使用echo <<<EOT直接空行接內容，結束符號為完全貼邊前不能有空白的EOT;，註解法如html
        $temp = "EOT範例："; //EOT為自定字符，可以隨意設定
        echo <<<EOT
            $temp<br>
            <b>交雜的Html與PHP變數</b> <!--註解-->
EOT;
?>