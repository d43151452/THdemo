<?php

namespace app\http;

use think\worker\Server;
use app\index\model\Users;

class Worker extends Server
{  
    protected $socket = 'websocket://0.0.0.0:8123';

    public function onWorkerStart(){
        
    }
    public function onConnect($connection)
	{

    }
    
    public function onMessage($connection,$data)
	{
		$connection->send(json_encode($data));
	}
}
