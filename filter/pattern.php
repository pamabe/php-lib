<?php
/** 
 * 正则表达式效验，过滤处理
 * */


//校验是否有英文大小写数字中文以外的字符
$sPattern = "/^[0-9_a-zA-Z\x{4e00}-\x{9fa5}]+$/u";

//只能包含中文, 大小写字母, 数字, 长度1-20
$sPattern = "/^[\x{4e00}-\x{9fa5}A-Za-z0-9]{1,20}$/u";

//判断字符串是不是utf8格式
$sPattern = "%^(?:
			[\x09\x0A\x0D\x20-\x7E]
			| [\xC2-\xDF][\x80-\xBF]
			| \xE0[\xA0-\xBF][\x80-\xBF]
			| [\xE1-\xEC\xEE\xEF][\x80-\xBF]{2} 
			| \xED[\x80-\x9F][\x80-\xBF]
			| \xF0[\x90-\xBF][\x80-\xBF]{2}
			| [\xF1-\xF3][\x80-\xBF]{3}
			| \xF4[\x80-\x8F][\x80-\xBF]{2}
        )*$%xs";

//手机号验证 
$pattern = "/^1[34578]{1}\d{9}$/";

//匹配网址URL
$sPattern = "/^[a-zA-z]+://[^\s]+$/u";


//正则验证手机号 正确返回 true
function preg_mobile($mobile) {
    if(preg_match("/^1[34578]\d{9}$/", $mobile)) {
        return TRUE;
    } else {
        return FALSE;
    }
}
//验证电话号码
function preg_tel($tel) {
    if(preg_match("/^(\(\d{3,4}\)|\d{3,4}-)?\d{7,8}$/", $tel)) {
        return TRUE;
    } else {
        return FALSE;
    }
}
//验证身份证号（15位或18位数字）
function preg_idcard($idcard) {
    if(preg_match("/^\d{15}|\d{18}$/", $idcard)) {
        return TRUE;
    } else {
        return FALSE;
    }
}
//验证是否是数字(这里小数点会认为是字符)
function preg_digit($digit) {
    if(preg_match("/^\d*$/", $digit)) {
        return TRUE;
    } else {
        return FALSE;
    }
}
//验证是否是数字(可带小数点的数字)
function preg_num($num) {
    if(is_numeric($num)) {
        return TRUE;
    } else {
        return FALSE;
    }
}
//验证由数字、26个英文字母或者下划线组成的字符串
function preg_str($str) {
    if(preg_match("/^\w+$/", $str)) {
        return TRUE;
    } else {
        return FALSE;
    }
}
//验证用户密码(以字母开头，长度在6-18之间，只能包含字符、数字和下划线)
function preg_password($str) {
    if(preg_match("/^[a-zA-Z]\w{5,17}$/", $str)) {
        return TRUE;
    } else {
        return FALSE;
    }
}
//验证汉字
function preg_chinese($str) {
    if(preg_match("/^[\u4e00-\u9fa5],{0,}$/", $str)) {
        return TRUE;
    } else {
        return FALSE;
    }
}
//验证Email地址
function preg_email($email) {
    if(preg_match("/^\w+[-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/", $email)) {
        return TRUE;
    } else {
        return FALSE;
    }
}
//验证网址URL
function preg_link($url) {
    if(preg_match("/http:\/\/[\w.]+[\w\/]*[\w.]*\??[\w=&amp;\+\%]*/is", $url)) {
        return TRUE;
    } else {
        return FALSE;
    }
}
//腾讯QQ号
function preg_qq($qq) {
    if(preg_match("/^[1-9][0-9]{4,}$/", $qq)) {
        return TRUE;
    } else {
        return FALSE;
    }
}
//验证中国邮政编码 6位数字
function preg_post($post) {
    if(preg_match("/^[1-9]\d{5}(?!\d)$/", $post)) {
        return TRUE;
    } else {
        return FALSE;
    }
}
//验证IP地址
function preg_ip($ip) {
    if(preg_match("/^[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}$/", $ip)) {
        return TRUE;
    } else {
        return FALSE;
    }
}