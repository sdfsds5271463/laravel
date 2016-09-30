<?php //創造XML 使用DOMDocument方法
    ob_start(); //不輸出任何html
    header('Content-Type: text/xml'); //設定表頭格式
    header('Content-Type: application/vnd.ms'); 
    header("Content-Disposition:filename=export.xml");
    $dom = new DOMDocument('1.0'); //設定版本與編碼
    $dom->encoding = 'UTF-8';

    $root = $dom->createElement('root'); //建立母節點 $root
    $root->setAttribute('name', 'xxx'); //建立設定屬性
    $dom->appendChild($root); //母結點加入DOM

    $child = $dom->createElement('child','預設內容'); //建立子結點
    $root->appendChild($child);

    $text = $dom->createTextNode('後加文字'); //增加結點文字
    $child->appendChild($text);

    $xmlStr = $dom->saveXML(); //輸出
    echo $xmlStr;
    
    /* 結果如下：
     * <root name="xxx">
     *     <child>預設內容後加文字</child>
     * </root>
     */
?>