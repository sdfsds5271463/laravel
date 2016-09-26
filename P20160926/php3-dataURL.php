<?php
$dataURL = "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAGQAAABkCAYAAABw4pVUAAACN0lEQVR4Xu2cwVHDQBAE11HhgCAOIA4X+UBU8PDXlnaoo72imi+D56pbK/nOlE/lzygCp1GrcTGlkGEXgUIUMozAsOU4IQoZRmDYcpwQhQwjMGw5TshRhXxWfQ9b+7LlnGvOfqw9IQpZ5n/zhRRSVU4Ic7G1WxTSRsUEFcJwbrcopI2KCSqE4dxuUUgbFRNUCMO53aKQNiomqBCGc7tFIW1UTFAhDOd2i0LaqJigQhjO7RaFtFExQYUwnNstCmmjYoIKYTi3WxRSVR/13Ab218FLvbyt7Xh6/+3rPewjXIXcVqaQqnJCvGXdvaM5IU7I9eLwGeIz5O5twmeIE+IzZGtf4IQ4IU6IE7JzduC7LN9l+S5ra0icECfECXFC8kN4z7I8y/Isa2tunBAnxAlxQnaerZ5leZblWZZnWZ5l5ZuQCr7jY/VXa3h04tGJRyceneR3LTeGbgzdGLox/I8bw/xuuPcXX697ieP+Hvjv9/VwFHKLafuhrpCEgBOS0AKyCgEgJxUKSWgBWYUAkJMKhSS0gKxCAMhJhUISWkBWIQDkpEIhCS0gqxAAclKhkIQWkFUIADmpUEhCC8gqBICcVCgkoQVkFQJATioUktACsocUAnA5YMUDP8I9IC1gyQoBICcVCkloAVmFAJCTCoUktICsQgDISYVCElpAViEA5KRCIQktIKsQAHJSoZCEFpBVCAA5qVBIQgvIKgSAnFQoJKEFZBUCQE4qFJLQArIKASAnFQpJaAHZH88c5mUDkjv8AAAAAElFTkSuQmCC";

//拆解dataURL
if (!preg_match('/data:(.*);base64,(.*)/', $dataURL, $matches)) {
    die("error");
}
 
//解碼
$content = base64_decode($matches[2]);

	//另存新檔
	file_put_contents('creat.png',$content);
	unlink('creat.png');
 
//輸出圖片抬頭
header('Content-Type: '.$matches[1]);
header('Content-Length: '.strlen($content));
 
//輸出圖片
echo $content;

die;
?>