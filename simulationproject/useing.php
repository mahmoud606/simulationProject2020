<?php
require_once 'inventory.php';
$req=new Inventory();
if(isset($_POST['submit'])){
    if(isset($_POST['name'])) {
        $number=count($_POST['name']);
        if ($number > 0) {
            for ($i = 0; $i < $number; $i++) {
                if (trim($_POST["name"][$i] != '')) {
                     $_POST['name'][$i];
                }
            }
        }
        $number=filter_input(INPUT_POST,'number',FILTER_SANITIZE_NUMBER_INT);
        $number=$_POST['name'];
        $req->setFrequency($number);
        $req->calculate_probability();
    }
}