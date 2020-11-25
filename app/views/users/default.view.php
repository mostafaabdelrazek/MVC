

<a class="button" href="/users/create"><i class = 'fa fa-plus'></i> <?=$text_new_item?></a>

<table class="data dataTable">
    <thead>
        <tr>
        <th><?=$text_table_username?></th>
        <th><?=$text_table_group?></th>
        <th><?=$text_table_email?></th>
        <th><?=$text_table_subscription_date?></th>
        <th><?=$text_table_last_login?></th>
        <th><?=$text_table_control?></th>
    </thead>
    <tbody>
    <?php if(false !== $users): foreach ($users as $user): ?>
        <tr>
        <td><?= $user->Username?></td>
        <td><?= $user->GroupName?></td>
        <td><?= $user->Email?></td>
        <td><?= $user->SubscriptionDate?></td>
        <td><?= $user->Lastlogin?></td>
        <td></td>
        </tr>
    <?php endforeach; endif;?>
    </tbody>
</table>