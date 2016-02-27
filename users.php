<?php
    session_start();
    require_once('./config.php');
    require_once('./classes/User.php');

    $allUsers = User::getAllUsers();
?>

<div id="users">
    <ul class="unstyled">
        <li class="headRow">
            <span>First Name</span>
            <span>Last Name</span>
            <span>Balance</span>
            <span>Transfer Balance</span>
        </li>
        <?php foreach($allUsers as $user) { ?>
            <li>
                <span><?php echo $user->firstName  ?></span>
                <span><?php echo $user->lastName  ?></span>
                <span><?php echo $user->balance  ?></span>
                <span class="transferWrap">
                    <input type="number" class="amountToTransfer">
                    <button type="button" class="transfer">Transfer Amount</button>
                </span>
            </li>
        <?php } ?>
    </ul>
</div>
