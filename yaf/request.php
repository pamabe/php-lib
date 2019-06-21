<?php 
/**
 * @file Request.php
 * @version $revision$ 
 *  
 **/
class Request {

    public static $cgiInfo = null;

    /**
     * @brief  SAF cgi流程获得CGI数据对外接口
     *
     * @return 失败false, 成功array()
    **/
    public static function getCgi() {
        if(!empty(self::$cgiInfo)){
            return self::$cgiInfo;
        }
        if (class_exists('Yaf_Dispatcher')) {
            $params = Yaf_Dispatcher::getInstance()->getRequest()->getParams();
            if (!empty($params)) {
                foreach($params as $key => $value) {
                    $_GET[$key] = $value;
                }
            }
        }
        $request_get = $_GET;
        $request_post = $_POST;
        $arguments = file_get_contents('php://input');
        $request_put = json_decode($arguments, true);
        if(empty($request_put)){
            $request_put = array();
        }
        $request_param = array_merge($request_get, $request_post, $request_put);
        
        self::$cgiInfo = $request;
        return $request;
    }

} 

/* vim: set ts=4 sw=4 sts=4 tw=100 */
