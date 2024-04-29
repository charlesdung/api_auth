<?php
use think\facade\Route;

Route::rule('login/index$', '/Login/index');//登陆
Route::rule('login/captcha$', '/Login/captcha');//验证码
Route::rule('login/captcha_check$', '/Login/captcha_check');//验证码
Route::rule('login/agent$', '/agentLogin/index');//服务商登陆

//base里面的方法。都可以调用，三方登录过后调取接口获得后台用户信息（自己信息）
Route::rule('admin/info$', '/Action/curl_user_info');

Route::rule('action/list$', '/Action/index');//后台控制列表
Route::rule('action/add$', '/Action/add');//后台控制列表
Route::rule('action/edit$', '/Action/edit');//后台控制列表
Route::rule('action/del$', '/Action/del');//后台控制列表
Route::rule('action/status$', '/Action/status');//后台控制列表

Route::rule('auth/action$', '/BranchAuth/action_list');//控制器列表
Route::rule('auth/action_edit$', '/BranchAuth/action_edit');//控制器列表
Route::rule('auth/menu$', '/BranchAuth/menu_list');//菜单列表
Route::rule('auth/menu_edit$', '/BranchAuth/menu_edit');//菜单列表

Route::rule('menu/list$', '/Menu/index');//后台菜单列表
Route::rule('menu/add$', '/Menu/add');//后台菜单添加
Route::rule('menu/edit$', '/Menu/edit');//后台菜单修改
Route::rule('menu/detail$', '/Menu/detail');//后台菜单修改
Route::rule('menu/del$', '/Menu/del');//后台菜单删除
Route::rule('menu/column$', '/Menu/lists');//后台表单列表
Route::rule('menu/status$', '/Menu/status');//后台表单列表

Route::rule('role/list$', '/Role/index');//角色列表
Route::rule('role/add$', '/Role/add');//角色列表add
Route::rule('role/edit$', '/Role/edit');//角色列表edit
Route::rule('role/del$', '/Role/del');//角色列表del
Route::rule('role/status$', '/Role/status');//角色列表

Route::rule('role_menu/list$', '/RoleMenu/index');//角色菜单列表分组
Route::rule('role_menu/add$', '/RoleMenu/add');//角色菜单列表添加
Route::rule('role_menu/edit$', '/RoleMenu/edit');//角色菜单列表

Route::rule('power/list$', '/RolePower/index');//角色 api接口列表
Route::rule('power/add$', '/RolePower/add');//角色 api接口列表
Route::rule('power/edit$', '/RolePower/edit');//角色 api接口列表


Route::rule('relevant/list$', '/AgentList/index');//代理关系链

//下注
Route::rule('records/list$', '/Records/index');
Route::rule('records/edit$', '/Records/edit');
Route::rule('records/del$', '/Records/del');
Route::rule('records/retreat$', '/Records/retreat');
//游戏列表
Route::rule('gamename/list$', '/GameName/index');
Route::rule('gamename/status$', '/GameName/status');
Route::rule('gamename/edit$', '/GameName/edit');
Route::rule('gamename/add$', '/GameName/add');
Route::rule('gamename/del$', '/GameName/del');
//游戏规则
Route::rule('gamelang/list$', '/GameName/game_lang_list');
Route::rule('gamelang/edit$', '/GameName/game_lang_edit');

//盈亏排行榜
Route::rule('profit/list$', '/Profit/index');
Route::rule('usersort/list$', '/UserSort/index');
//游戏赔率列表
Route::rule('gameodds/list$', '/Odds/index');
Route::rule('gameodds/edit$', '/Odds/edit');
Route::rule('gameodds/add$', '/Odds/add');
Route::rule('gameodds/del$', '/Odds/del');
Route::rule('gameodds/game$', '/Odds/game');



Route::rule('config/list$', '/SysConfig/index');//后台配置文件列表
Route::rule('config/add$', '/SysConfig/add');//后台添加
Route::rule('config/edit$', '/SysConfig/edit');//后台修改
Route::rule('config/detail$', '/SysConfig/detail');//配置详情
Route::rule('config/del$', '/SysConfig/del');//配置删除
Route::rule('config/info$', '/SysConfig/config_info');//配置
#Route::rule('config/info$', '/SysConfig/config_info');//配置
Route::rule('clear/token$', '/SysConfig/clear_token');//清理token
Route::rule('mysql/backups$', '/SysConfig/mysql_backups');//备份露珠表
Route::rule('mysql/records$', '/SysConfig/mysql_records');//备份下注表

Route::rule('dashboard/all$', '/Dashboard/index');//控制面板


//露珠
Route::rule('luzhu/list$', '/luzhu/index');
Route::rule('luzhu/add$', '/luzhu/add');
Route::rule('luzhu/edit$', '/luzhu/edit');
Route::rule('luzhu/status$', '/luzhu/status');
Route::rule('luzhu/del$', '/luzhu/newdel');
Route::rule('luzhu/retreat$', '/luzhu/retreat');
Route::rule('print/start$', '/PrintLuzhu/printData');//打印露珠
Route::rule('print/list$', '/PrintLuzhu/index');//打印露珠列表
//作废露珠
Route::rule('vold/list$', '/VoidLuzhu/index');
Route::rule('vold/retreat$', '/VoidLuzhu/retreat');//记录


//台桌
Route::rule('desktop/list$', '/desktop/index');
Route::rule('desktop/add$', '/desktop/add');
Route::rule('desktop/edit$', '/desktop/edit');
Route::rule('desktop/status$', '/desktop/status');
Route::rule('desktop/updatedianji', '/desktop/updatedianji');
Route::rule('desktop/del$', '/desktop/del');
Route::rule('desktop/game$', '/desktop/game');//游戏分类
Route::rule('desktop/table$', '/desktop/table_list');//根据游戏类型获取台座列表
Route::rule('desktop/isxh$', '/desktop/is_xh');//限红开启关闭
//多语言
Route::rule('tablelang/list$', '/desktop/game_lang_list');
Route::rule('tablelang/edit$', '/desktop/game_lang_edit');


Route::rule('user/is_status$', '/User/is_status');//用户是否虚拟账号设置
Route::rule('user/list$', '/User/index');//用户列表
Route::rule('user/agent$', '/User/agent');//代理商信息
Route::rule('user/agentedit$', '/User/agentedit');//代理商修改密码
Route::rule('user/info$', '/User/user_info');//指定用户信息
Route::rule('money/edit$', '/User/money_edit');//用户余额修改
Route::rule('xian_hong/edit$', '/User/xian_hong');//用户限红

Route::rule('user/edit$', '/User/edit');//用户修改
Route::rule('user/add$', '/User/add');//
Route::rule('user/del$', '/User/del');//
Route::rule('user/detail$', '/User/detail');//用户详情
Route::rule('user/status$', '/User/status');//用户状态修改
Route::rule('userreal/list$', '/RealName/index');//用户身份证列表

Route::rule('pay_bank/list$', '/PayBank/index');//支付银行卡列表
Route::rule('pay_bank/del$', '/PayBank/del');//支付银行卡删除
Route::rule('pay_bank/default$', '/PayBank/default');//支付银行卡修改默认卡
Route::rule('pay_bank/info$', '/PayBank/info');//用户银行卡信息
Route::rule('pay_bank/edit$', '/PayBank/edit');//修改银行卡信息

//用户消费洗码==统计
Route::rule('records/total$', '/CountRecords/index');

Route::rule('money/type$', '/MoneyLog/status_type');//资金流动类型
Route::rule('login/log$', '/LoginLog/index');//登陆日志
Route::rule('money/log$', '/MoneyLog/index');//资金流动日志
Route::rule('admin/log$', '/AdminLog/index');//后台操作日志
Route::rule('pay/list$', '/PayCash/index');//提现列表日志
Route::rule('xima/list$', '/PayCash/xima_list');//洗码列表日志
Route::rule('agent_auth/list$', '/PayCash/auth_list');//授权列表日志
Route::rule('record_money/list$', 'admin/log.PayCash/record_list');//下注结算列表日志

Route::rule('recharge/list$', '/PayRecharge/index');//充值列表日志
Route::rule('recharge/status$', '/PayRecharge/status');//确认充值

Route::rule('upload/video$', '/upload.UploadData/video');//都可以上传

Route::rule('admin/list$', '/Admins/index');//后台用户列表
Route::rule('admin/add$', '/Admins/add');//后台用户添加
Route::rule('/$', '/Index/index');//后台首页
Route::rule('admin/edit$', '/Admins/edit');//后台用户修改
Route::rule('admin/detail$', '/Admins/detail');//后台用户信息查看
Route::rule('admin/del$', '/Admins/del');//后台用户删除


Route::rule('market_level/list$', '/MarketLevel/index');//市场部等级
Route::rule('market_level/add$', '/MarketLevel/add');//市场部等级
Route::rule('market_level/edit$', '/MarketLevel/edit');//市场部等级
Route::rule('market_level/del$', '/MarketLevel/del');//市场部等级
Route::rule('market_level/detail$', '/MarketLevel/detail');//市场部等级


Route::rule('notice/list$', '/Notice/index');//公告列表
Route::rule('notice/add$', '/Notice/add');//公告添加
Route::rule('notice/edit$', '/Notice/edit');//公告修改
Route::rule('notice/del$', '/Notice/del');//公告删除
Route::rule('notice/detail$', '/Notice/detail');//公告详情
Route::rule('notice/position$', '/Notice/position');//公告位置
Route::rule('notice/status$', '/Notice/status');//公告上下架