<?php
    /*
        OOP基本權限概念：
        public    共用：全世界都能存取(預設值)
        private   私人：只有他自己能用
        protected 保護：他自己跟他親生兒子能用
     */
    class oop_test //定義一個物件導向class
    {
        //1.基本參數定義
            var $test1;
            private $test2;
            protected $test3;
        
        //2.方法函數定義
            //2.1 Magic Function
            //建構方法：class建立時執行，可帶建立參數
            function __construct($t1,$t2,$t3)
            {
                $this->test1 = $t1;
                $this->test2 = $t2;
                $this->test3 = $t3;
            }
            //解構方法：class被清除時執行
            function __destruct()
            {/*程式結束或是unset時執行*/}
            
            //2.2 自訂方法 (方法前面也能加入private、protected等權限字眼)
            function get_t123()
            {                
                return $this->test1 . "," . $this->test2 . "," . $this->test3;
            }
            
        //3.靜態參數定義
            //靜態參數為所有class共同存取，不過private的靜態參數就只限同名class存取
            static public $test4=444;
            function get_t4() 
            {
                return self::$test4; //使用靜態參數的方法 (在外面要把self改成class名)
            }
        
        //4.類別常數 (跟define一樣，定義出來的東西不用再加$符號)
            //將某名稱定義成數值或陣列，只有public權限可選擇
            const PI = "3.14159";
            function get_PI() 
            {
                return self::PI; //使用類別常數的方法
            }
    }
    class child extends oop_test{
        function __construct($t4)
        {
            parent::__construct($t4,$t4,$t4); //parent::繼承父親函式、變數
                                              //現在已經可以使用$this->test1之類的父親物件
        }
    }
    
    
    $T = new oop_test(111,222,333); //創造class物件
    echo $T->test1; //直接抓取public變數
    echo $T->get_t123(); //使用public方法
    echo oop_test::$test4; //使用public靜態參數
    echo oop_test::PI; //使用類別常數
    
    $Tc = new child(444); //定義孩子
    echo $Tc->test1; //孩子有父親變數

?>