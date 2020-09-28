<?php
namespace Le2le\AliyunLog\Models\Request;




/**
 * 
 *
 * @author log service dev
 */
class DeleteMachineGroupRequest extends Request {


    private $groupName; 
    /**
     * DeleteMachineGroupRequest Constructor
     *
     */
    public function __construct($groupName) {
        $this->groupName = $groupName;
    }

    public function getGroupName(){
        return $this->groupName;
    }

    public function setGroupName($groupName){
        $this->groupName = $groupName;
    }
    
}
