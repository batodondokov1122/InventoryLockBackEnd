<?php

include 'init.php';

use App\Models\Accounting;

if($_POST){
    $accounting = new Accounting($_POST);
    if ($accounting->validate()){
        $accounting->save();
    }else{
        $response['errore_message'] = $accounting->getError();
        echo json_encode($response);
    }
    
}