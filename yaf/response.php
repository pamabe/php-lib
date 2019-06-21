<?php
/**
 * APP http请求接口json
 * @name Response
 */
class Response{
    
    /**
     * @param array $data
     * @return void
     */
    public static function responseJson($sResult, $data = [], $errMsg = ''){
        header('Content-Type: application/json; charset=UTF-8');
        $res = array(
            'result' => $sResult,
            'data'   => $data,
            'msg' => $errMsg,
        );
        //中文不使用unicode编码
        echo json_encode($res, JSON_UNESCAPED_UNICODE);
    }

	/**
	 * @param array $data
	 * @return void
	 **/
    public static function response($sResult, $data = [], $errMsg = '', $sCode = '', $column = ''){
        //{{{
        header('Content-Type: application/json; charset=UTF-8');
        if($sResult === 'success'){
            $res = array(
                'success' => true,
                'data'   => $data,
            );
        }else{
            $nRequestId = time() . rand(0,1000) . rand(0,1000);
            if($errMsg === 'not login'){
                header('HTTP/1.1 403 Forbidden');
            }
            $res = array(
                'success' => false,
                'code' => !empty($sCode) ? $sCode : 'BAD_PARAM',
                'requestId' => $nRequestId,
                'message' => $errMsg,
            );
            if (!empty($column)) {
                $res['column'] = $column;
            }
            error_log($nRequestId.',msg:'.$errMsg);
        }
        //中文不使用unicode编码
        echo json_encode($res, JSON_UNESCAPED_UNICODE);
        //}}}
    }

	/**
	 * @param array $data
	 * @return void
	 */
    public static function responseRestful($sResult, $data = [], $errMsg = '', $sCode = ''){
        //{{{
        header('Content-Type: application/json; charset=UTF-8');
        if($sResult === 'success'){
            $res = $data;
        }else{
            $sStr = time().'request_id';
            $sRequestId = md5($sStr).'-'.rand(0,1000).'-'.rand(0,1000);
            if($errMsg === 'not login'){
                header('HTTP/1.1 403 Forbidden');
            }else{
                header('HTTP/1.1 400 Bad Request');
            }
            $res = array(
                'code' => !empty($sCode) ? $sCode : 'BAD_PARAM',
                'requestId' => $sRequestId,
                'message' => $errMsg,
            );
            error_log($sRequestId.',msg:'.$errMsg);
        }
        //中文不使用unicode编码
        echo json_encode($res, JSON_UNESCAPED_UNICODE);
        //}}}
    }
    
    /**
     * 失败返回接口
     *
	 * @param array $data
	 * @return void
	 **/
    public static function apiScuuess($res){
        header('Content-Type: application/json; charset=UTF-8');
        //中文不使用unicode编码
        echo json_encode($res, JSON_UNESCAPED_UNICODE);
    }
}
