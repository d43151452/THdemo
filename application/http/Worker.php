<?php

namespace app\http;

use think\worker\Server;
use app\index\model\Users;
use app\index\model\Chat;
use Db;

class Worker extends Server
{  
    protected $socket = 'websocket://0.0.0.0:8123';
    protected $name = 'zyz';

    public $user = [];
    
    public function onMessage($connection,$data)
	{
        $data = json_decode($data);
        if($data->type == 'connect'){

            $user = Users::where('token',$data->token)->find();
            if(!$user){
                $connection->send(json_encode(['type'=>'error','data'=>'用户不存在']));
            }
            $this->user['id'.$user->id] = $connection;
            $connection->send(json_encode(['type'=>'connect', 'data'=>'连接成功']));
            echo $user->id;

        }else if($data->type == 'message'){
            if($data->get_id == 0){
                $connection->send(json_encode(['type'=>'msgsuccess']));
                foreach($this->user as $k => $v){
                    $v->send(json_encode([
                        'type'=>'all',
                        'send_id'=>$data->send_id,
                        'send_name'=>$data->send_name,
                        'message'=>$data->message
                    ]));
                }
                $sql = Chat::create([
                    'send_id'=>$data->send_id,
                    'get_id'=>$data->get_id,
                    'send_time'=>Db::raw('now()'),
                    'message'=>$data->message,
                    'send_name'=>$data->send_name,
                ]);
            }else if(!isset($this->user['id'.$data->get_id])){
                $connection->send(json_encode(['type'=>'error','data'=>'该用户不在线']));
            }else{
                $connection->send(json_encode(['type'=>'msgsuccess']));
                $this->user['id'.$data->get_id]
                    ->send(json_encode([
                        'type'=>'get',
                        'send_id'=>$data->send_id,
                        'send_name'=>$data->send_name,
                        'message'=>$data->message
                    ]));
                Chat::create([
                    'send_id'=>$data->send_id,
                    'get_id'=>$data->get_id,
                    'send_time'=>Db::raw('now()'),
                    'message'=>$data->message,
                    'send_name'=>$data->send_name,
                ]);
            }
        }
    }
    
    public function onClose($connection){
        foreach ($this->user as $k => $v){
            if($v == $connection){
                unset($this->user[$k]);
                echo '删除成功';
                break;
            }
        }
    }
}
