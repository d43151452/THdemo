<?php
namespace app\index\controller;

use think\Controller;
use think\Request;
use app\index\model\Users;
use Db;

class Index extends Controller
{
    public $middleware = [
        'Check' => ['only' => ['index','userDel','logout','userEdit','userUpdate']],
    ];

    //用户列表
    public function index()
    {
        $data['user'] = Users::select();
        return view('',$data);
    }
    //登录
    public function login()
    {
        return view();
    }
    //提交登录
    public function doLogin(Request $req){
        $data = $req->only(['uname','password']);

        $validate = \Validate::make([
            'uname'  => 'require|max:10',
            'password'  => 'require|min:6|max:16',
        ],[],[
            'uname'  => '用户名',
            'password'  => '密码',
        ]);

        if(!$validate->check($data)){
            return $this->error($validate->getError());
        }

        $data['password'] = base64_encode(md5($data['password']));
        $user = Users::where($data)->find();
        if(!$user){
            return $this->error('用户名或密码不正确');
        }

        $token = base64_encode($user->uname.$user->password.'123');
        $user->token = $token;
        $user->save();
        //设置cookie时间
        if($req->seven_day){
            \Cookie::set('token',$token,3600*24*7);
        }
        session('user_id',$user->id);
        session('uname',$user->uname);
        session('token',$token);
        return $this->success('登录成功','/');
    }
    //注册
    public function register(){
        return view();
    }
    //提交注册
    public function doRegister(Request $req, Users $user){
        $data = $req->param();
        $validate = \Validate::make([
            'uname'  => 'require|max:10',
            'password'  => 'require|min:6|max:16',
            'tel_num' => 'require|mobile',
        ],[],[
            'uname'  => '用户名',
            'password'  => '密码',
            'tel_num' => '电话号码',
        ]);

        if(!$validate->check($data)){
            return $this->error($validate->getError());
        }

        $info = $user->where('uname',$data['uname'])->find();
        if($info != null){
            return $this->error('用户名被占用');
        }

        $data['password'] = base64_encode(md5($data['password']));
        $data['reg_time'] = Db::raw('now()');
        $info = Users::create($data);
        if($info){
            return $this->success('注册成功','/login.html');
        }
        return $this->error('注册失败');
    }

    public function logout(){
        \Cookie::clear('token');
        \Session::clear();
        return $this->success('退出成功','/login.html');
    }

    public function userDel($id){
        if($id == session('user_id')){
            return $this->error('您不可以删除自己');
        }
        $info = Users::destroy($id);
        if($info){
            return $this->success('删除成功');
        }
        return $this->errror('删除失败');
    }

    public function userEdit($id){
        $data['user'] = Users::get($id);
        return view('',$data);
    }
    
    public function userUpdate(Request $req, $id){
        $data = $req->param();

        $validate = \Validate::make([
            'uname'  => 'require|max:10',
            'tel_num' => 'require|mobile',
        ],[],[
            'uname'  => '用户名',
            'tel_num' => '电话号码',
        ]);

        if(!$validate->check($data)){
            return $this->error($validate->getError());
        }

        $info = Users::where('id', $id)->update($data);
        if($info){
            return $this->success('修改成功','/');
        }
        return $this->error('修改失败');
    }
}
