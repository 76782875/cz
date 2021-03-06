<?php
/**
 * The control file of message module of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv11.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     message
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
class message extends control
{
    /**
     * The index page of message front.
     * 
     * @param  int    $pageID 
     * @access public
     * @return void
     */
    public function index($pageID = 1)
    {
        $recPerPage = !empty($this->config->site->messageRec) ? $this->config->site->messageRec : $this->config->message->recPerPage;
        $this->app->loadClass('pager', $static = true);
        $pager = new pager($recTotal = 0, $recPerPage, $pageID);

        $this->view->messages    = $this->message->getByObject($type = 'message', $objectType = 'message', $objectID = 0, $pager);
        $this->view->pager       = $pager;
        $this->view->title       = $this->lang->message->list;
        $this->view->startNumber = ($pageID - 1) * 10;
        $this->display();
    }

    /**
     * Show the comment of one object, and print the comment form.
     * 
     * @param string $objectType 
     * @param string $objectID 
     * @access public
     * @return void
     */
    public function comment($objectType, $objectID, $pageID = 1)
    {
        $recPerPage = !empty($this->config->site->commentRec) ? $this->config->site->commentRec : $this->config->message->recPerPage;
        $this->app->loadClass('pager', $static = true);
        $pager = new pager($recTotal = 0 , $recPerPage, $pageID);

        $this->view->objectType  = $objectType;
        $this->view->objectID    = $objectID;
        $this->view->comments    = $this->message->getByObject($type = 'comment', $objectType, $objectID, $pager);
        $this->view->pager       = $pager;
        $this->view->startNumber = ($pageID - 1) * 10;
        $this->lang->message     = $this->lang->comment;
        $this->display();
    }

    /**
     * View a message 
     * 
     * @param  int    $messageID 
     * @access public
     * @return void
     */
    public function view($messageID)
    {
        $message = $this->message->getByID($messageID);
        if($message->to != $this->app->user->account) die();
        $this->message->markReaded($message->id);
        if($message->link) $this->locate($message->link);
        $this->locate($this->createLink('user', 'message'));
    }

    /**
     * show notify in msgBox.
     * 
     * @access public
     * @return string
     */
    public function notify()
    {
        $messages = $this->dao->select('COUNT(*) as count')->from(TABLE_MESSAGE)->where('`to`')->eq($this->app->user->account)->andWhere('readed')->eq(0)->fetch('count');
        if($messages) echo  html::a(helper::createLink('user', 'message'), sprintf($this->lang->user->message->mine, $messages));
    }

    /**
     * Get the latest approvaled messages.
     * 
     * @param  string $type 
     * @param  string $status 
     * @param  int    $recTotal 
     * @param  int    $recPerPage 
     * @param  int    $pageID 
     * @access public
     * @return void
     */
    public function admin($type = 'message', $status = '0', $recTotal = 0, $recPerPage = 5, $pageID = 1)
    {
        if(!($this->loadModel('wechat')->getList())) unset($this->lang->message->menu->wechat);

        $this->app->loadClass('pager', $static = true);
        $pager = new pager($recTotal, $recPerPage, $pageID);

        $this->view->title    = $this->lang->message->common;
        $this->view->messages = $this->message->getList($type, $status, $pager);
        $this->view->pager    = $pager;
        $this->view->type     = $type;
        $this->view->status   = $status;
        $this->display();
    }

    /**
     * Post a message.
     * 
     * @param  string  $type
     * @access public
     * @return void
     */
    public function post($type)
    {
        $this->lang->message = $this->lang->$type;
        if($_POST)
        {
            $isAuto = ((isset($this->config->site->captcha) and $this->config->site->captcha == 'auto') or !isset($this->config->site->captcha)) ? true : false;
            $isOpen = (isset($this->config->site->captcha) and $this->config->site->captcha == 'open') ? true : false;
            /* If no captcha but is garbage, return the error info. */
            if($this->post->captcha === false and (($isAuto and $this->loadModel('captcha')->isEvil($this->post->content)) or $isOpen))
            {
                $this->send(array('result' => 'fail', 'reason' => 'needChecking', 'captcha' => $this->loadModel('captcha')->create4Comment()));
            }

            /* Try to save to database. */
            $messageID = $this->message->post($type);

            /* If save fail, return the error info. */
            if(!$messageID)
            {
                $this->send(array('result' => 'fail', 'reason' => 'error', 'message' => dao::getError()));
            }

            /* If save successfully, save the cookie and send success info. */
            $this->message->setCookie($messageID);
            $this->send(array('result' => 'success', 'message' => $this->lang->message->thanks));
        }
    }

    /**
     * Reply a message.
     * 
     * @param  int    $messageID 
     * @access public
     * @return void
     */
    public function reply($messageID)
    {
        if($_POST)
        {
            $isAuto = ((isset($this->config->site->captcha) and $this->config->site->captcha == 'auto') or !isset($this->config->site->captcha)) ? true : false;
            $isOpen = (isset($this->config->site->captcha) and $this->config->site->captcha == 'open') ? true : false;
            /* If no captcha but is garbage, return the error info. */
            if($this->post->captcha === false and (($isAuto and $this->loadModel('captcha')->isEvil($this->post->content)) or $isOpen))
            {
                $this->send(array('result' => 'fail', 'reason' => 'needChecking', 'captcha' => $this->loadModel('captcha')->create4MessageReply()));
            }

            $replyID = $this->message->reply($messageID);
            if(!$replyID) $this->send(array('result' => 'fail', 'reason' => 'error', 'message' => dao::getError()));
            $this->message->setCookie($replyID);
            $this->send(array('result' => 'success', 'message' => $this->lang->sendSuccess));
        }

        $message = $this->message->getByID($messageID);

        $this->view->title      = "<i class='icon-mail-reply'></i> " . $this->lang->message->reply . ':' . $message->from;
        $this->view->modalWidth = 600;
        $this->view->message    = $message;
        $this->display();
    }

    /**
     * Pass messages.
     * 
     * @param  int    $messageID 
     * @param  string $type 
     * @access public
     * @return void
     */
    public function pass($messageID, $type)
    {
        $this->message->pass($messageID, $type);
        if(!dao::isError()) $this->send(array('result' => 'success'));
        $this->send(array('result' => 'fail', 'message' => dao::getError()));
    }

    /** 
     * Delete messages.
     *
     * @param int    $messageID 
     * @param string $type          single|pre
     * @access public
     * @return void
     */
    public function delete($messageID, $type)
    {
        $this->message->delete($messageID, $type);
        if(!dao::isError()) $this->send(array('result' => 'success'));
        $this->send(array('result' => 'fail', 'message' => dao::getError()));
    }

    /**
     * Batch delete messages.
     * 
     * @access public
     * @return void
     */
    public function batchDelete()
    {
        $messages = $this->post->messages;
        if(empty($messages)) $this->send(array('result' => 'fail', 'message' => $this->lang->message->noSelectedMessage));

        foreach($messages as $message) 
        {
            $result = $this->message->deleteByAccount($message);
            if(!$result) $this->send(array('result' => 'fail', 'message' => dao::getError()));
        }

        $this->send(array('result' => 'success', 'message' => $this->lang->deleteSuccess, 'locate' => $this->createLink('user', 'message')));
    }
}
