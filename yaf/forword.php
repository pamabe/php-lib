<?php
    /**
     * yaf 路由转发 
     * 业务类型，接口统一封装入口中使用到 
     * 将当前请求转给另外一个动作处理
     *forward只是登记下要forward的目的地, 并不会立即跳转. 而是会等到当前的Action执行完成以后, 才会进行新的一轮dispatch.
     * */

     /**
      * action -> action 
      public boolean Yaf_Controller_Abstract::forward( string  $action ,array  $params = NULL );
      * controller->controller 
      public boolean Yaf_Controller_Abstract::forward( string  $controller ,string  $action ,array  $params = NULL );
      * module -> module                                           
      public boolean Yaf_Controller_Abstract::forward( string  $module ,string  $controller ,string  $action ,array  $params = NULL ); 

      * module : 要转给动作的模块, 注意要首字母大写, 如果为空, 则转给当前模块
      * controller: 要转给动作的控制器, 注意要首字母大写, 如果为空, 则转给当前控制器
      * action: 要转给的动作, 注意要全部小写
      * params: 关联数组, 附加的参数, 可通过Yaf_Request_Abstract::getParam获取
      */

    /** 
     *示例 controller -> controller 
     */
    class Action_Chat extends User_Api_Base_Action {
        /**
         * chat 模块路由转fa
         * @param null
         * @return json-string
         */
        public function __execute(){
            try{
                $arrRequest = User_SmartMain::getCgi();
                $arrInput   = $arrRequest['request_param'];
                //cAction 业务码
                $cAction = isset($arrInput['cAction']) ?  trim(htmlspecialchars($arrInput['cAction'])) : "";
                if(empty($cAction)){
                    throw new Exception("参数cAction不能为空");
                }
                $cActions = array(
                    'entity' => 'chat',
                    'download' => 'template',
                );
                if(!isset($cActions[$cAction])){
                    throw new Exception("cAction参数取值参考(". implode(",", array_keys($cActions)). ")");
                }
                Yaf_Controller_Abstract::forward($cActions[$cAction], $cAction, $arrInput);
            }catch(Exception $e){
                Ikefu_Util::response('failed',array(),$e->getMessage());
            }
        }
}
        
               
?>