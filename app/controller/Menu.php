<?php


namespace app\controller;

use app\controller\Base;

use app\model\AdminRole;
use app\model\MenuModel as models;
use think\exception\ValidateException;
use \app\validate\Menu as MenuV;
use hg\apidoc\annotation as Apidoc;


class Menu extends Base
{
    protected $model;

    /**
     * 菜单控制器
     */
    public function initialize()
    {
        $this->model = new models();
        parent::initialize(); // TODO: Change the autogenerated stub
    }


    /**
     * @Apidoc\Title("菜单栏目树")
     * @Apidoc\Method("POST")
     * @Apidoc\Url("/menu/list")
     * @Apidoc\Param("admin_type", type="int",require=true, desc="admin_type")
     * @Apidoc\Returned("data", type="bool", desc="返回成功失败结果")
     */
    public function index()
    {
        //这里查询用户可访问权限节点查询
        $admin = $this->request->admin_user;
        if (empty($admin)) $this->failed('请登录');
        $role = AdminRole::where('id', $admin['role'])->find();
        !empty($role) && $role = $role->toArray();

        if ($role['status'] != 1) $this->failed('该角色被禁用');

        if ($admin['role'] == 1) {
            $list = $this->vip_menu($admin);//超级管理员
        } else {
            $list = $this->select_menu($admin);
        }
        //处理栏目树
        $this->success($list);
    }

    public function vip_menu($admin)
    {
        //查询可访问的菜单
        $list = $this->model->where(['pid' => 0, 'status' => 1])->order('sort asc')->paginate()->each(function ($item, $key) {
            $item->children = $this->model->where(['pid' => $item['id'], 'status' => 1])->order('sort asc')->select();
        });
        return $list;
    }


    public function select_menu($admin)
    {
        //查询可访问的菜单
        $menu = \app\model\RoleMenu::where('role_id', $admin['role'])->find();
        if (empty($menu)) return [];
        return $this->model->where(['pid' => 0, 'status' => 1])->whereIn('id', $menu['auth_ids'])->order('sort asc')->paginate()->each(function ($item, $key) use ($menu) {
            $item->children = $this->model->where(['pid' => $item['id'], 'status' => 1])->order('sort asc')->whereIn('id', $menu['auth_ids'])->select();
        });
    }
    /**
     * @Apidoc\Title("菜单列表")
     * @Apidoc\Method("POST")
     * @Apidoc\Url("/menu/column")
     * @Apidoc\Param("page", type="int",require=true,default="1", desc="页码")
     * @Apidoc\Param("limit", type="int",require=true,default="10",desc="条数")
     * @Apidoc\Returned("data", type="bool", desc="返回成功失败结果")
     */
    public function lists()
    {
        //当前页
        $page = $this->request->post('page', 1);
        //每页显示数量
        $limit = $this->request->post('limit', 10);
        //查询搜索条件

        $list = $this->model->order('pid desc')
            ->where(['pid' => 0])
            ->paginate(['list_rows' => $limit, 'page' => $page])
            ->each(function ($item, $key) {
                $menu = $this->model->menu;
                $item->menus = isset($menu[$item->pid]) ?? '顶级菜单';
                //查询下一级
                $item->children = $this->model->where(['pid' => $item['id'], 'status' => 1])->select();
            });
        $this->success($list);
    }

    /**
     * @Apidoc\Title("菜单添加")
     * @Apidoc\Method("POST")
     * @Apidoc\Url("/menu/add")
     * @Apidoc\Param("pid", type="int",require=true, desc="上级ID")
     * @Apidoc\Param("title", type="string",require=true, desc="菜单名称")
     * @Apidoc\Param("status", type="int",require=false, desc="status")
     * @Apidoc\Param("path", type="string",require=false, desc="路劲")
     * @Apidoc\Param("icon", type="string",require=false, desc="图标")
     * @Apidoc\Returned("data", type="bool", desc="返回成功失败结果")
     */
    public function add()
    {
        //过滤数据
        $postField = 'pid,title,status,path,icon';
        $post = $this->request->only(explode(',', $postField), 'post', null);

        //验证数据
        try {
            validate(MenuV::class)->scene('add')->check($post);
        } catch (ValidateException $e) {
            // 验证失败 输出错误信息
            $this->failed($e->getError());
        }

        //验证成功，查询是否存在该用户
        $user = $this->model->where('title', $post['title'])->find();
        if ($user) $this->failed('该菜单以存在');

        $post['status'] = 1;

        $post['admin_uid'] = $this->request->admin_user['id'];
        $save = $this->model->save($post);
        if ($save) $this->success([]);
        $this->failed('新增失败');
    }

    /**
     * @Apidoc\Title("菜单查询")
     * @Apidoc\Method("POST")
     * @Apidoc\Url("/menu/detail")
     * @Apidoc\Param("id", type="int",require=true, desc="ID")
     * @Apidoc\Returned("data", type="bool", desc="返回成功失败结果")
     */
    public function detail()
    {
        //过滤数据
        $postField = 'id';
        $post = $this->request->only(explode(',', $postField), 'post', null);
        try {//验证数据
            validate(MenuV::class)->scene('detail')->check($post);
        } catch (ValidateException $e) {
            $this->failed($e->getError());// 验证失败 输出错误信息
        }
        $user = $this->model->find($post['id']);//查询用户数据
        if ($user) $this->success($user);
        $this->failed('菜单不存在');
    }

    /**
     * @Apidoc\Title("菜单修改")
     * @Apidoc\Method("POST")
     * @Apidoc\Url("/menu/edit")
     * @Apidoc\Param("pid", type="int",require=true, desc="上级ID")
     * @Apidoc\Param("title", type="string",require=true, desc="菜单名称")
     * @Apidoc\Param("status", type="int",require=false, desc="status")
     * @Apidoc\Param("path", type="string",require=false, desc="路劲")
     * @Apidoc\Param("icon", type="string",require=false, desc="图标")
     * @Apidoc\Returned("data", type="bool", desc="返回成功失败结果")
     */
    public function edit()
    {
        $postField = 'id,pid,title,status,path,icon';//过滤数据
        $post = $this->request->only(explode(',', $postField), 'post', null);
        try {//验证数据
            validate(MenuV::class)->scene('edit')->check($post);
        } catch (ValidateException $e) {
            $this->failed($e->getError()); // 验证失败 输出错误信息
        }

        //查询是否重复的该菜单
        $find = $this->model->where('title', $post['title'])->where('id', '<>', $post['id'])->find();
        if ($find) $this->failed('该菜单以存在');

        $post['admin_uid'] = $this->request->admin_user['id'];
        //执行修改数据
        $save = $this->model->update($post);
        if ($save) $this->success([]);
        $this->failed('修改失败');
    }
}