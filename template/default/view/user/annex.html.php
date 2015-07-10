<?php include TPL_ROOT . 'common/header.html.php';?>
<div class='row'>
  <?php include TPL_ROOT . 'user/side.html.php';$sq=1;?>
  <div class='col-md-10'>
      <div class='panel'>
        <div class='panel-heading'><strong><i class='icon-plus'></i> <?php echo $lang->user->annex;?></strong></div>
        <table class='table table-bordered table-hover' id='annex'>
          <thead>
            <tr class='text-center hidden-xxxs'>
              <th class='w-20px'><?php echo $lang->user->sq; ?></th>
              <th class='w-150px'><?php echo $lang->user->annex;?></th>
              <th class='w-150px'><?php echo $lang->user->lasttime;?></th>
              <th class='w-150px'><?php echo $lang->user->status; ?></th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($annexes as $annex):?>
            <tr class='text-center'>
              <td><?php echo $sq;$sq++;?></td>
              <td><?php echo $annex->name;?></td>
              <td><?php echo $annex->num;?></td>
              <td> <?php echo $annex->locked ?></td>
             </tr>
            <?php endforeach;?>
          </tbody>
        </table>
      </div>
  </div>
</div>
<?php include TPL_ROOT . 'common/footer.html.php';?>
