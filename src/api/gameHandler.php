<?php

include_once $_SERVER['DOCUMENT_ROOT'] . "/src/api/GameAPI.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/src/api/PlayerAPI.php";

if(isset($_GET['action'])) {
    switch($_GET['action']) {
        default:
            echo json_encode(["status" => "failed"]);
            
        case "retrieve":
            echo retrieveGame();
            break;

        case "remove":
            echo removePlayer();
            break;

        case "add":
            echo addPlayer();
            break;
    }
}

function retrieveGame() {
    if(isset($_GET['id'])) {
        $game = GameAPI::get($_GET['id']);
        if($game != null && !empty($game)) {
            echo $game->toJson();
        } else {
            echo json_encode(["status" => "failed"]);
        }
    } else {
        echo json_encode(["status" => "empty"]);
    }
}

function addPlayer() {
    if (isset($_GET['id'])) {
        if (isset($_GET['playerId'])) {
            $addition = GameAPI::addPlayer($_GET['id'], $_GET['playerId']);
            if ($addition) {
               $player = Player::getById($_GET['playerId']);
               return json_encode(["status" => "success", "player" => $player->toArray()]);
            } else {
                echo json_encode(["status" => "failed"]);
            }
        } else if (isset($_GET['nickName']) && isset($_GET['gender'])) {
            $player = PlayerAPI::get($_GET['nickname'], $_GET['genderId']);
            $addition = GameAPI::addPlayer($_GET['id'], $player->getId());
            if ($addition != null && !empty($addition)) {
                echo json_encode(["status" => "success"]);
            } else {
                echo json_encode(["status" => "failed"]);
            }
        } else {
            echo json_encode(["status" => "failed"]);//here
        }
    } else {
        echo json_encode(["status" => "error"]);
    }
}

function getPlayer()
{
    if (isset($_GET['id'])) {
        $player = PlayerAPI::getById($_GET['id']);
        if ($player != null && !empty($player)) {
            echo $player->toJson();
        } else {
            echo json_encode(["status" => "failed"]);
        }
    } else {
        echo json_encode(["status" => "empty"]);
    }
}

function removePlayer()
{
    if (isset($_GET['id']) && isset($_GET['playerId'])) {
        $player = PlayerAPI::getById($_GET['playerId']);
        $removal = GameAPI::removePlayer($_GET['id'], $player->getId());
        if ($removal != null && !empty($removal)) {
            echo $removal;
        } else {
            echo json_encode(["status" => "failed"]);
        }
    } else {
        echo json_encode(["status" => "failed"]);
    }
}
