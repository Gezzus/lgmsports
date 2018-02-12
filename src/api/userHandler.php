<?php

include_once $_SERVER['DOCUMENT_ROOT'] . "/src/model/Session.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/src/model/User.php";

switch ($_GET["action"]){
    default: {
        return json_encode(["status" => "error"]);
    }
    case "validate":
        validateSession();
        break;
    case "get":
        get();
        break;
}

function get(){
    $session = new Session;
    $session->start();
    if($session->validate() != null) {
        if($user = User::getById($session->getId())){
            echo json_encode(["status" => "success","username" => $user->getUserName(), "roleId" => $user->getRoleId(), "playerId" => $user->getPlayerId()]);
        } else {
            echo json_encode(["status" => "failed"]);
        }
    }
}


function validateSession(){
    $session = new Session;
    $session->start();

    if(isset($_GET["validation"]) && (!empty($_GET["validation"]))){
        $validation = $_GET["validation"];
        if(isset($_GET["role"]) && (!empty($_GET["role"]))) {
            $role = $_GET["role"];
        } else {
            $role = null;
        }
    } else {
        return json_encode(["status" => "failed","errorMsg" => "Missing parameters"]);
    }

    switch ($validation) {
        case 'logedIn':
            if($session->validate() != null) {
                if($role != null) {
                    switch ($role) {
                        case 'admin':
                            $user = User::getById($session->getId());
                            if($user->getRoleId() != 2){
                                echo json_encode(["status" => "failed","username" => $user->getUserName(), "roleId" => $user->getRoleId(), "playerId" => $user->getPlayerId()]);
                            } else {
                                echo json_encode(["status" => "success","username" => $user->getUserName(), "roleId" => $user->getRoleId(), "playerId" => $user->getPlayerId()]);
                            }
                            break;

                        default:
                            json_encode(["status" => "failed","errorMsg" => "Missing parameters"]);
                            break;
                    }
                } else {
                    $user = User::getById($session->getId());
                    echo json_encode(["status" => "success","username" => $user->getUserName(), "roleId" => $user->getRoleId(), "playerId" => $user->getPlayerId()]);
                }
            } else {
                echo json_encode(["status" => "failed"]);
            }
            break;

        case 'logedOut':
            if($session->validate() != null){
                $user = User::getById($session->getId());
                echo json_encode(["status" => "failed","username" => $user->getUserName(), "roleId" => $user->getRoleId(), "playerId" => $user->getPlayerId()]);
            } else {
                echo json_encode(["status" => "success"]);
            }
            break;

        case 'all':
            if($session->validate() != null){
                $user = User::getById($session->getId());
                echo json_encode(["status" => "success","username" => $user->getUserName(), "roleId" => $user->getRoleId(), "playerId" => $user->getPlayerId()]);
            } else {
                echo json_encode(["status" => "success"]);
            }
            break;

        default:
            json_encode(["status" => "failed","errorMsg" => "Missing parameters"]);
            break;
    }

}