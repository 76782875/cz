<?php
/**
 * The browse view file of group module of RanZhi.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv11.html)
 * @author      Xiying Guan <guanxiying@xirangit.com>
 * @package     group
 * @version     $Id: browse.html.php 4769 2013-05-05 07:24:21Z wwccss $
 * @link        http://www.ranzhico.com
 */
?>
<?php include '../../common/view/header.admin.html.php';?>
<div class='panel'>
  <div class='panel-heading'>
    <strong><i class='icon-plus'></i> <?php echo $lang->group->annexgroup;?></strong>
    <span class='panel-actions pull-right'><?php commonModel::printLink('annex', 'addanxgrpcrt', '', $lang->group->annexgroupcreate, "class='btn btn-primary' data-toggle='modal'");?></span>
  </div>
  <table class='table table-hover table-striped'>
    <thead>
      <tr>
       <th class='w-20px text-center'><?php echo $lang->group->id;?></th>
       <th class='w-150px text-center'><?php echo $lang->group->annexgroupname;?></th>
       <th class='w-220px text-center'><?php echo $lang->group->annexgroupcontent;?></th>
       <th class='w-120px text-center'><?php echo $lang->actions;?></th>
      </tr>
    </thead>
    <tbody>
    <?php foreach($groups as $group):?>
    <?php $users = implode(' ', $groupUsers[$group->id]);?>
    <tr>
      <td class='text-center'><?php echo $group->id;?></td>
      <td><?php echo $group->name;?></td>
      <td class='visible-lg'><?php echo $group->desc;?></td>
      <td class='text-center'>
        <?php commonModel::printLink('group', 'managePriv', "type=byGroup&param={$group->id}", $lang->group->managePriv);?>
        <?php commonModel::printLink('group', 'manageMember', "groupID={$group->id}", $lang->group->manageMember);?>
        <?php commonModel::printLink('group', 'edit', "groupID={$group->id}", $lang->edit, "data-toggle='modal'");?>
        <?php commonModel::printLink('group', 'delete', "groupID={$group->id}", $lang->delete, "class='deleter'");?>
      </td>
    </tr>
    <?php endforeach;?>
    </tbody>
  </table>
</div>
<?php include '../../common/view/footer.admin.html.php';?>
