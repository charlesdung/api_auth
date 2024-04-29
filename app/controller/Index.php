<?php
namespace app\controller;

use app\BaseController;
use hg\apidoc\annotation as Apidoc;

class Index extends BaseController
{
    public function index()
    {
        return 'just do it!';
    }

    public function hello($name = 'ThinkPHP6')
    {
        return 'hello,' . $name;
    }
}
