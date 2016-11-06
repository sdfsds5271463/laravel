<?php
/*---L1.編輯文字檔---(以下編輯的路徑也都可以改為網址)*/
    /*1.1 基本檔案處理函式*/
        //is_dir(目錄？);
        //is_file(檔案？);
        //is_readable(可讀？);
        //is_writable(可寫？);
        //file_exists(存在？); //可判斷目錄
        //filesize(檔名); //取得大小
        //dirname(檔案路徑); //取得檔案目錄
        //'.'當前目錄   '..'上層目錄
        //mkdir(目錄路徑); //創造目錄
    
    /*1.15 寫入的格式轉換*/
        $A = array(1,2,3);
        serialize($A); //儲存格式轉換
        unserialize($A); //儲存格式還原，如實儲存php變數的方法
        htmlspecialchars("<br>"); //html顯示編碼，回傳的值可以echo出來喔
        htmlspecialchars_decode(); //反編碼函式

    /*1.2 直接讀寫檔案*/
        //路徑要用正斜線/，因為反斜線\是跳脫字元
        //寫入檔案成功時，皆回傳寫入位元數
        file_get_contents("test.txt"); //回傳檔案內容 (可以抓網址的資料)
        file_put_contents("test.txt","複寫文字\n"); //將檔案整個複寫，沒檔案會開新檔
        file_put_contents("test.txt","續寫文字\n",FILE_APPEND | LOCK_EX); 
            //加入旗標：FILE_APPEND續寫檔案、LOCK_EX保護寫入中的檔案
        $err = 123;
        error_log($err,3,"error.log"); //錯誤回報：將字串續寫入log檔案 (寫3檔案 2郵件 1系統)
        
    /*1.3 開啟檔案後處理檔案*/
        $fh = fopen("test.txt","r+");
            //r僅讀、r+讀後可寫、w重寫不可讀、w+重寫可讀、a續寫不可讀、a+續寫可讀
            //當檔案不存在時，只有w具開啟新檔功能
        fgets($fh); //讀取一行內容(依序)
        fgetc($fh); //讀取一位元內容(依序)
        fputs($fh,"從讀取旗標覆寫入"); //fputs與fwright完全一樣，重頭寫入檔案
            //fgets、fgetc每次執行都會依序改變讀取旗標的位置
        fclose($fh); //關閉檔案
        
        unlink("error.log"); //刪除檔案

/*---L2.管理檔案與目錄---*/
    /*2.1 目錄檔案編輯*/
        scandir('.',0); //取得工作目錄內容，後帶參數0、1為排序，陣列形式讀取
            //'.' = 當前工作目錄 = getcwd()
        copy("test.txt","D:/A.txt"); //拷貝檔案
        unlink("test.txt"); //刪除檔案
        chdir("D:/"); //切換工作目錄
        getcwd(); //回傳工作目錄位置
        rename("A.txt","B.txt"); //重新命名
        unlink("B.txt"); //刪除檔案
        //實體目錄路徑 __DIR__
        //實體檔案路徑 __FILE__  (正斜線格開)
        //實體檔案路徑 $_SERVER["SCRIPT_FILENAME"]  (反斜線格開)
        //basename(路徑) 回傳最外層的資料夾或檔案名 
        
    /*2.2 表單上傳檔案*/
        /* 以下為表單

        
            <form action="" method="post" enctype="multipart/form-data">
                <input type="file" name="UpFile" accept="image/gif, image/jpeg">
                <input type="hidden" name="MAX_FILE_SIZE" value="1000000">
                <input type="submit" value="送出">
            </form>

                //表單函式注意： 1.方法post 2.需enctype="multipart/form-data" 3.輸入類型file
                //accept可增加限制上傳圖片功能，參數設image/* 則是所有種類圖片

        //接收函式(假設input name=UpFile)：
        //$_FILES["UpFile"]["tmp_name"]; //上傳後成為暫存檔的路徑+名稱 (生成必須)
        //$_FILES["UpFile"]["name"]; //原始檔名
        //$_FILES["UpFile"]["type"]; //類型
        //$_FILES["UpFile"]["size"]; //大小
        //$_FILES["UpFile"]["error"]; //錯誤代碼
        //上傳完成的檔案會是.tmp，需要使用move_uploaded_file(tmp路徑,生成路徑)函數移動生成：
        //move_uploaded_file($_FILES["UpFile"]["tmp_name"],"D:/test.txt");
        */


?>