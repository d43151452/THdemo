<?php

namespace app\http;

use think\worker\Server;
use app\index\model\Users;

class Worker extends Server
{  
    protected $socket = 'websocket://0.0.0.0:8123';
    protected $name = 'zyz';

    public $user = [];

    public function onWorkerStart(){
        
    }
    public function onConnect($connection)
	{

    }
    
    public function onMessage($connection,$data)
	{
        $data = json_decode($data);
        if($data['type'] == 'connect'){
            $user = Users::where('token',$data['token'])->find();
            
        }
    }
    
    public function onClose($connection){

    }
}
