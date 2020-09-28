<?php
namespace Le2le\AliyunLog\Models\Response;




/**
 * The response of the DeleteShard API from log service.
 *
 * @author log service dev
 */
class DeleteShardResponse extends Response {
    /**
     * DeleteShardResponse constructor
     *
     * @param array $header
     *            DeleteShard HTTP response header
     */
    public function __construct($headers) {
        parent::__construct ( $headers );
    }
}
