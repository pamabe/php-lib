<?php
/** 
 * 统一封装 http请求方法GET、PUT、POST、DELETE
 * */
class Curl{
    const CONNECT_TIME_OUT = 3;
    const TIME_OUT = 3;
    /**
     * curl get data form url
     * @param url
     * @param $retry 重试次数
     * @param data
     * @return reslut 
     */
    public static function get($url, $retry=3) {
        //{{{
        $process = curl_init($url);

        curl_setopt($process, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($process, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($process, CURLOPT_CONNECTTIMEOUT, self::CONNECT_TIME_OUT);
        curl_setopt($process, CURLOPT_TIMEOUT, self::TIME_OUT);
        $return = curl_exec($process);
        curl_close($process);
                                                                                                                                                             
        if ($return === false && $retry > 1){                                                                                                                
            return self::get($url, $retry-1);                                                                       
        }                                                                                                                                                    
                                                                                                                                                             
        return $return;
        //}}}
    }

    /**
     * curl get data form url
     * @param url
     * @param $retry 重试次数
     * @param data
     * @param aAuth array
     * @param aHeader array
     * @return reslut 
     */
    public static function post($url, $data, $retry=3, $aAuth = array(), $aHeader = array()) {
        //{{{
        $process = curl_init($url);

        if(!empty($data)){
            curl_setopt($process, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));
        }
        if(!empty($aHeader)){
            curl_setopt($process, CURLOPT_HTTPHEADER, $aHeader);
        }

        curl_setopt($process, CURLOPT_POSTFIELDS, $data);
        curl_setopt($process, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($process, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($process, CURLOPT_POST, 1);
        curl_setopt($process, CURLOPT_CONNECTTIMEOUT, self::CONNECT_TIME_OUT);
        curl_setopt($process, CURLOPT_TIMEOUT, self::TIME_OUT);
        if(!empty($aAuth) && isset($aAuth['passwd']) && !empty($aAuth['passwd'])){
            curl_setopt($process, CURLOPT_USERPWD, $aAuth['user'].':'.$aAuth['passwd']);
        }
        $return = curl_exec($process);
        curl_close($process);
                                                                                                                                                             
        if ($return === false && $retry > 1){                                                                                                                
            return self::post($url, $data, $retry-1, $aAuth, $aHeader);                                                                       
        }                                                                                                                                                    
                                                                                                                                                             
        return $return;
        //}}}
    }

    /**
     * curl get data form url
     * @param url
     * @param $retry 重试次数
     * @param data
     * @return reslut 
     */
    public static function put($url, $data, $retry=3, $aAuth = array()) {
        //{{{
        $process = curl_init($url);
        curl_setopt($process, CURLOPT_POSTFIELDS, $data);
        curl_setopt($process, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($process, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($process, CURLOPT_CUSTOMREQUEST, 'PUT');
        curl_setopt($process, CURLOPT_CONNECTTIMEOUT, self::CONNECT_TIME_OUT);
        curl_setopt($process, CURLOPT_TIMEOUT, self::TIME_OUT);
        if(!empty($aAuth) && isset($aAuth['passwd']) && !empty($aAuth['passwd'])){
            curl_setopt($process, CURLOPT_USERPWD, $aAuth['user'].':'.$aAuth['passwd']);
        }
        $return = curl_exec($process);
        curl_close($process);
        if ($return === false && $retry > 1){
            return self::put($url, $data, $retry-1, $aAuth);
        }
        return $return;
        //}}}
    }

    /**
     * @param url
     * @return reslut 
     */
    public static function delete($url, $aAuth = array()) {
        //{{{
        $process = curl_init($url);
        curl_setopt($process, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($process, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($process, CURLOPT_CUSTOMREQUEST, 'DELETE');
        curl_setopt($process, CURLOPT_CONNECTTIMEOUT, self::CONNECT_TIME_OUT);
        curl_setopt($process, CURLOPT_TIMEOUT, self::TIME_OUT);
        if(!empty($aAuth) && isset($aAuth['passwd']) && !empty($aAuth['passwd'])){
            curl_setopt($process, CURLOPT_USERPWD, $aAuth['user'].':'.$aAuth['passwd']);
        }
        $return = curl_exec($process);
        curl_close($process);
    
        return $return;
        //}}}
    }
}