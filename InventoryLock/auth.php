<?php

include 'init.php';

use App\Models\Auth;

if ($_POST){
    $auth = new Auth($_POST);
    if ($auth->validate()){
        $response['token'] = $auth->save();
        echo json_encode($response);
    }else{
        $response['errore_message'] = $auth->getError();
        echo json_encode($response);
    }
}