<div class="container">
  <div class="row">
    <div class="col-md-12">
      <blockquote>
        <h1 style="font-size:14px;"><?= $Lang->get("Toutes les informations sur la dernière version du serveur !"); ?></h1>
      </blockquote>

      <div class="row">

        <table class="table">
          <thead>
            <tr>
              <th><?= $Lang->get("TABLE_HEAD_LEVEL"); ?></th>
              <th><?= $Lang->get("TABLE_HEAD_DATE"); ?></th>
              <th><?= $Lang->get("TABLE_HEAD_AUTHOR"); ?></th>
              <th><?= $Lang->get("TABLE_HEAD_COMMENT"); ?></th>
            </tr>
          </thead>

          <tbody>
            <?php foreach($Intervention as $changlog){ ?>
            <tr>
              <td class="col-md-1" style="font-size:18px;">

              <?php
              $level = $changlog['Intervention']['level'];
              if($level == 1){
                echo '<span class="label label-info" style="padding:8px;">TERMINÉ</span>';
              }else if($level == 2){
                echo '<span class="label label-warning" style="padding:8px;">EN COURS</span>';
              }else if($level == 3){
                echo '<span class="label label-danger" style="padding:8px;">ÉCHEC</span>';
              }else{
                echo '<span class="label label-success" style="padding:8px;">PLANIFIER</span>';
              }
              ?>

              </td>
              <td class="col-md-2"><?= date("d-m-Y H:i:s", strtotime($changlog['Intervention']['created'])); ?></td>
              <td class="col-md-1"><?= $changlog['Intervention']['author']; ?></td>
              <td class="col-md-9"><?= $changlog['Intervention']['description']; ?></td>
            </tr>
            <?php } ?>
          </tbody>
        </table>

        </div>
    </div>
  </div>
</div>