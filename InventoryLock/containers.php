<?php

include 'init.php';

use App\Models\Container;

if ($_GET){
    if (!empty($_GET['container_id'])){
        $container = Container::getContainerInfo($_GET['container_id']);
        $response['color'] = $container['color'];
        $response['status'] = $container['status'];
        echo json_encode($response);
    }
    else if(!empty($_GET['load_all'])){
        if($_GET['load_all'] = 1){
            $containers = Container::loadAll();
            foreach($containers as $container):
                $response['id'] = $container['color'];
                $response['color'] = $container['color'];
                $response['status'] = $container['status'];
                echo json_encode($response);
            endforeach;
        }
    }
    else {
        $response['errore_message'] = "Неверный запрос";
        echo json_encode($response);
    }
}