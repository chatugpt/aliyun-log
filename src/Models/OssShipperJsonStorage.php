<?php
namespace Le2le\AliyunLog\Models;
/**
 * Copyright (C) Alibaba Cloud Computing
 * All rights reserved
 */

class OssShipperJsonStorage extends OssShipperStorage{

    public function to_json_object(){
        return array();
    }
}