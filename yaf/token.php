<?php
<?php
/**
 * APP公共工具类
 * @name token
 */
class Token{
    static $CSRFSECRET  = 'ba4db9cfccb77f77828e01f85236baae';

    public static $nTimeout = 30;
    public static $nCTokenTimeOut = 300;

    /**
     * @return string
     */
    public static function createMd5Token(){
        $nTime = time();
        $sKey = md5($nTime . self::$CSRFSECRET);
        $sKey .= '&'.$nTime;
        return base64_encode($sKey);
    }

    public static function checkMd5Token(){
        $ct = $_REQUEST['token'];
        $ctArr = explode('&', base64_decode($ct));
        $timeOut = self::$nTimeout;

        if ($ctArr[1] + $timeOut > time() && $ctArr[0] == md5($ctArr[1] . self::$CSRFSECRET)){
            return true;
        }else{
            throw new Exception('token is error');
        }
    }

    /**
     * 获取CSRF TOKEN
     * @return string
     */
    public static function getCSRFSha1Token($sUserId)
    {
        $time = time();
        $str = hash_hmac('sha1', $time . self::$CSRFSECRET, $sUserId);
        return base64_encode($str . '&' . $time);
    }

    /**
     * 检测CSRF TOKEN
     * @return bool
     */
    public static function checkCSRFSha1Token($sUserId)
    {
        if(!isset($_REQUEST['token'])){
            throw new Exception('token is error');
        }
        $ct = $_REQUEST['token'];
        $ctArr = explode('&', base64_decode($ct));
        $timeOut = self::$nTimeout;
        if ($ctArr[1] + $timeOut > time() && $ctArr[0] == hash_hmac('sha1', $ctArr[1] . self::$CSRFSECRET, $sUserId)){
            return true;
        }else{
            throw new Exception('token is error');
        }
    }

    /**
     * 检测 TOKEN
     * @param $sKey string 密钥
     * @param $ct string 加密串
     * @return bool
     */
    public static function checkSha1Token($sKey, $ct)
    {
        $ctArr = explode('&', base64_decode($ct));
        $timeOut = self::$nTimeout;

        if ($ctArr[0] + $timeOut > time() && $ctArr[1] == hash_hmac('sha1', $ctArr[0], $sKey)){
            return true;
        }else{
            throw new Exception('token is error');
        }
    }

}

