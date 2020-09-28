<?php
namespace Le2le\AliyunLog\Models\Response;



require_once realpath(dirname(__FILE__) . '/Config.php');
/**
 * The response of the GetLog API from log service.
 *
 * @author log service dev
 */
class GetConfigResponse extends Response {


    private $config;

    /**
     * GetConfigResponse constructor
     *
     * @param array $resp
     *            GetLogs HTTP response body
     * @param array $header
     *            GetLogs HTTP response header
     */
    public function __construct($resp, $header) {
        parent::__construct ( $header );
        $this->config = new Config();
        $this->config->setFromArray($resp);
    }

    public function getConfig(){
        return $this->config;
    }
   
}
