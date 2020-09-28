<?php

require_once 'vendor/autoload.php';

$endpoint= 'http://cn-shenzhen.log.aliyuncs.com';
$accessKeyId = '';
$accessKey = '';
$project = '';
$logstore = '';
$token= '';
$client = new Le2le\AliyunLog\Client($endpoint, $accessKeyId, $accessKey,$token);

$topic = 'TestTopic';

$array = [['342423']];
$logitems = [];
foreach ($array as $one)
{
	$logItem = new \Le2le\AliyunLog\Models\LogItem();
	$logItem->setTime(time());
	$logItem->setContents($one);
	$logitems[] = $logItem;
}

$request = new Le2le\AliyunLog\Models\Request\PutLogsRequest($project, $logstore,
	$topic, null, $logitems);

try {
	$response = $client->putLogs($request);
} catch (\Aliyun_Log_Exception $ex) {
} catch (\Exception $ex) {
}

var_dump($response);