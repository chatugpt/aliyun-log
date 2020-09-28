<?php
namespace Le2le\AliyunLog\Models\Request;




/**
 * 
 *
 * @author log service dev
 */
class DeleteACLRequest extends Request {

    private $aclId;
    /**
     * DeleteACLRequest Constructor
     *
     */
    public function __construct($aclId=null) {
        $this->aclId = $aclId;
    }
    public function getAclId(){
        return $this->aclId;
    }
    public function setAclId($aclId){
        $this->aclId = $aclId;
    }
    
}
