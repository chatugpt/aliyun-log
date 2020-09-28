<?php
namespace Le2le\AliyunLog\Models\Response;




class CreateShipperResponse extends Response{

    /**
     * CreateShipperResponse constructor
     *
     * @param array $resp
     *            GetLogs HTTP response body
     * @param array $header
     *            GetLogs HTTP response header
     */
    public function __construct($resp, $header) {
        parent::__construct ( $header );
    }
}