<nav class="main_navigation <?= (isset($_COOKIE['menu_opened']) && $_COOKIE['menu_opened'] == 'true') ? 'opened no_animation' : '' ?>">
    <div class="employee_info">
        <div class="profile_picture">
            <img src="/img/user.png" alt="User Profile Picture"/>
        </div>
        <span class="name">Mostafa</span>
        <span class="privilege"><?=$text_app_manager?></span>
    </div>
    <ul class="app_navigation">
        <li class = '<?= $this->matchUrl('/') === true ? 'selected' : ''  ?>'><a href="/"><?=$text_general_stat?> <i class="fa fa-dashboard"></i></a></li>
        <li class="submenu">
            <a href="javascript:;"><?=$text_transactions?> <i class="fa fa-credit-card"></i></a>
        <ul>
            <li><a href="/purchases"><i class='fa fa-gift'></i> <?=$text_transactions_purchases?></a></li>
            <li><a href="/sales"><i class='fa fa-shopping-bag'></i> <?=$text_transactions_sales?></a></li>
        </ul>
        </li>
        <li class='submenu'>
        <a href="javascript:;"><?=$text_expenses?> <i class="fa fa-money"></i></a>
        <ul>
            <li><a href="/expensescategories"><i class="fa fa-list-ul"></i> <?= $text_expenses_categories ?></a></li>
            <li><a href="/dailyexpenses"><i class="fa fa-dollar"></i> <?= $text_expenses_daily_expenses ?></a></li>
        </ul>
        </li>
        <li class='submenu'>
        <a href="javascript:;"><?=$text_store?> <i class="material-icons">store</i></a>
        <ul>
            <li><a href="/productcategories"><i class="fa fa-archive"></i> <?= $text_store_categories ?></a></li>
            <li><a href="/productlist"><i class="fa fa-tag"></i> <?= $text_store_products ?></a></li>
        </ul>
        </li>
        <li><a href="/clients"><?=$text_clients?> <i class="material-icons">contacts</i></a></li>
        <li><a href="/suppliers"><?=$text_suppliers?> <i class="material-icons">group</i></a></li>
        <li class='submenu'>
        <a href="javascript:;"><?=$text_users?> <i class="fa fa-group"></i></a>
        <ul>
            <li><a href="/users"><i class="fa fa-user-circle"></i> <?= $text_users_list ?></a></li>
            <li><a href="/usersgroups"><i class="fa fa-group"></i> <?= $text_users_groups ?></a></li>
            <li><a href="/privileges"><i class="fa fa-key"></i> <?= $text_users_privileges ?></a></li>
        </ul>
        </li>
        <li><a href="/reports"><?=$text_reports?> <i class="fa fa-bar-chart"></i></a></li>
        <li><a href="/notifications"><?=$text_notifications?> <i class="fa fa-bell"></i></a></li>
        <li><a href="/auth/logout"><?=$text_logout?> <i class="fa fa-sign-out"></i></a></li>
        <!--<li><a href=""><?=$text_?> <i class="fa fa-dashboard"></i></a></li>!-->

    </ul>
</nav>
<div class="action_view <?= (isset($_COOKIE['menu_opened']) && $_COOKIE['menu_opened'] == 'true') ? 'collapsed no_animation' : '' ?>">
<?php $messages = $this->messenger->getMessages(); if(!empty($messages)): foreach ($messages as $message):?>
<p class='message t<?=$message[1]?>'><?=$message[0]?></p>
<?php endforeach;endif;?>