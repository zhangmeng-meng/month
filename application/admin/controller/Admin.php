<?php

namespace app\admin\controller;

use app\goods\model\Goods;
use think\Controller;
use think\Request;

class Admin extends Controller
{
    function index(){
        return view('/login');
    }
    //返回管理页面
    function guan(){
        return view('/guan');
    }
    //管理员登录
    public function login(){
        //接收数据
        $data = \request()->param();
        //验证数据
        $validate = $this->validate($data,[
            'name|用户名' => "require",
            "pwd|密码" => "require"
        ]);
        if (true !== $validate) {
            $this->error($validate);
        }
        //根据用户名查询数据
        $info = \app\admin\model\Admin::where('name',$data['name'])->find();
        if ($info) {
            if ($info['pwd'] == $data['pwd']){
                $this->redirect('admin/Admin/guan');
            }else{
                $this->error("密码不正确");
            }
        }else{
            $this->error("用户名不存在");
        }
    }
    /**
     * 商品添加
     */
    public function add(){
        //接收数据
        $data = \request()->param();
        $file = \request()->file('img');
        //验证数据
        $validate = $this->validate($data,[
            'name|商品名称' => "require",
            "number|库存量" => "require"
        ]);
        if (true !== $validate) {
            $this->error($validate);
        }
        //验证文件大小 后缀
        $info = $file->validate(['size'=>1024*1024*2,'ext'=>'jpeg,jpg,png,gif'])->move(ROOT_PATH . 'public' . DS . 'uploads');
        if (!$info) {
            return $this->error($file->getError());
        }
        //获取文件路径
        $data['img'] = "/uploads/".$info->getSaveName();
        //添加入库
        $res = Goods::create($data,true);
        if ($res) {
            $this->redirect('admin/Admin/list');
        }
    }
    /**
     * 查询商品数据
     */
    public function list(){
        $data = Goods::paginate(5);
        return view('/list',['data'=>$data]);
    }
    /**
     * 删除
     */
    function del(){
        //接收数据
        $id = input('id');
        //验证数据
        if (!is_numeric($id)){
            $this->error('参数不正确');
        }
        //删除数据
        $res = Goods::destroy($id);
        if ($res) {
            $this->redirect('admin/Admin/list');
        }
    }
}
