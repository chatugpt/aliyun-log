<?php
namespace Le2le\AliyunLog\Models\Request;




/**
 * The request used to list logstore from log service.
 *
 * @author log service dev
 */
class ListLogstoresRequest extends Request{
    
    /**
     * ListLogstoresRequest constructor
     * 
     * @param string $project project name
     */
    public function __construct($project=null) {
        parent::__construct($project);
    }
}
