<?php
/**
 * The logo view file of ui module of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv11.html)
 * @author      Xiying Guan <guanxiying@xirangit.com>
 * @package     ui
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<?php include '../../common/view/header.admin.html.php';?>
<div class='panel'>
  <div class='panel-heading'>
    <strong><i class='icon-certificate'></i><?php echo $lang->ui->setLogo;?></strong>
  </div>
  <div class='panel-body'>
    <form method='post' id='ajaxForm' enctype='multipart/form-data'>
      <table class='table table-form'>
        <tr>
          <td><?php echo html::file('files', "class='form-control'");?></td>
          <td><?php echo html::submitButton();?><?php if(isset($logo->webPath)) commonModel::printLink('ui', 'deleteLogo', '', $lang->reset, "class='btn'");?></td>
          <td><strong class='text-info'><?php echo $lang->ui->suitableLogoSize; ?></strong></td>
        </tr>
        <tr><td colspan='3'><?php if(isset($logo->webPath)) echo html::image($logo->webPath, "class='logo'");?></td></tr>
      </table>
    </form>
  </div>
</div>
<?php include '../../common/view/footer.admin.html.php';?>
