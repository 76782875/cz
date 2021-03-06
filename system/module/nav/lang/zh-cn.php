<?php
/**
 * The common simplified chinese file of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv11.html)
 * @author      DaiTingting 
 * @package     chanzhiEPS
 * @version     $Id$
 * @link        http://www.zentao.net
 */

$lang->nav->common   = '导航设置';
$lang->nav->setNav   = '导航设置';
$lang->nav->add      = '添加';
$lang->nav->addChild = '添加子导航';
$lang->nav->delete   = '删除导航';

$lang->nav->inputUrl        = '请输入链接';
$lang->nav->inputTitle      = '请输入标题';
$lang->nav->cannotRemoveAll = '不能删除所有导航';

/* nav type   */
$lang->nav->types['system']  = '系统模块';
$lang->nav->types['article'] = '文章类目';
$lang->nav->types['product'] = '产品类目';
$lang->nav->types['page']    = '单页';
$lang->nav->types['custom']  = '自定义';

/* common navs.*/
$lang->nav->system = new stdclass();
$lang->nav->system->home    = '首页';
$lang->nav->system->company = '关于我们';
$lang->nav->system->forum   = '论坛';
$lang->nav->system->blog    = '博客';
$lang->nav->system->book    = '手册';
$lang->nav->system->message = '留言';

/* Targets setting. */
$lang->nav->newWindow = new stdclass();
$lang->nav->newWindow->_blank = '新开窗口';
