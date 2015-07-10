<?php
/**
 * The create view of group module of RanZhi.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv11.html)
 * @author      Xiying Guan <guanxiying@xirangit.com>
 * @package     group
 * @version     $Id: create.html.php 4129 2013-01-18 01:58:14Z wwccss $
 * @link        http://www.ranzhico.com
 */
?>
<?php include '../../common/view/header.modal.html.php';?>
<form class='form-condensed' method='post' id='ajaxForm' action='<?php echo inlink('create');?>'>
  <table align='center' class='table table-form' cols="4">
    <tr>
      <th class='w-150px'><?php echo $lang->group->annexgroupname;?></th>
      <td class="w-300px"><?php echo html::input('name', '', "class=form-control style='width:250px'");?></td>
    </tr>  
    <tr>
      <td colspan="2" class='text-center'><?php echo $lang->group->desc;?></td>
    </tr>
      <tr>
            <td colspan="2">
                  <table class="table table-form">
                      <thead><tr class="text-center"><th class="w-20px">编号</th><th class="w-150px">优惠内容</th><th class="w-20px">次数</th><th class="w-80px">操作</th></tr></thead>
                      <tbody>
                        <tr class="text-center"><td >1</td><td>spa项目</td><td>100</td><td><span>编辑</span></td></tr>
                        <tr class="text-center"><td >2</td><td>spa项目</td><td>100</td><td><span>编辑</span></td></tr>
                        <tr class="text-center"><td >3</td><td>spa项目</td><td>100</td><td><span>编辑</span></td></tr>
                      </tbody>
                  </table>
            </td>
      </tr>
    <tr><td colspan='2' class='text-center'><?php echo html::submitButton();?></td></tr>
  </table>
</form>
<?php include '../../common/view/footer.modal.html.php';?>
