<?php

namespace app\goods\controller;

use think\Controller;
use think\Request;

class Goods extends Controller
{
    /**
     * 查询数据
     *
     * @return \think\Response
     */
    public function index()
    {
        //查询数据 根据添加时间排序
        $data = \app\goods\model\Goods::order('time','desc')->select()->toArray();
        return json(['code'=>200,'msg'=>'success','data'=>$data]);

    }
    //详情
    function detail(){
        //接收数据
        $id = input('id');
        //验证参数
        if (!is_numeric($id)){
            return json(['code' => 100,'msg'=>'参数格式不正确','data'=>[]]);
        }
        //查询数据
        $info = \app\goods\model\Goods::where('id',$id)->find();
        return json(['msg'=>'success','code'=>200,'data'=>$info]);
    }

}
