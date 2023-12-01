<?php
$query1 = $pdo->prepare("SELECT `avl_qty` FROM `items` WHERE `item_id`=:item_id");
$query1->bindParam(':item_id', $item_id);
$query1->execute();
$row = $query1->fetch(PDO::FETCH_ASSOC);

$rem_qty = $type == 'Sell' ? $row['avl_qty'] - $quantity : $row['avl_qty'] + $quantity; // $_GET['quantity'];


$query = $pdo->prepare("UPDATE `items` SET `avl_qty`=:quantity WHERE `item_id`=:item_id");
$query->bindParam(':item_id', $item_id, PDO::PARAM_STR);
$query->bindParam(':quantity', $rem_qty, PDO::PARAM_STR);
$query->execute();