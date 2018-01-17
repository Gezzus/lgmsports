<?php

include_once $_SERVER['DOCUMENT_ROOT'] . "/src/model/PersistentEntity.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/src/model/Seriarizable.php";

class Player extends PersistentEntity implements Seriarizable {

    private $id;
    private $nickName;
    private $genderId;
    private $levelId;

    public function __construct($id, $nickName, $genderId, $levelId) {
        $this->id = $id;
        $this->nickName = $nickName;
        $this->genderId = $genderId;
        $this->levelId = $levelId;
    }

    public static function createPlayer($nickName, $genderId) {
        $dbPlayer = self::queryWithParameters("SELECT * FROM player WHERE nickName = ? AND genderId = ?", array(self::sanitize($nickName), $genderId));
        if($dbPlayer->rowCount() == 0) {
            self::queryWithParameters("INSERT INTO player (nickName, genderId) VALUES(?, ?)", array(self::sanitize($nickName), $genderId));
            return self::getPlayer(self::lastInsertId());
        } else{
            return null;
        }
    }

    public static function getPlayer($playerId){
        $dbPlayer = self::queryWithParameters("SELECT * FROM player WHERE id = ?", array($playerId));
        if($dbPlayer->rowCount() == 1) {
            $playerData = $dbPlayer->fetch();
            return new Player($playerData["id"], $playerData["nickName"], $playerData["genderId"], $playerData["levelId"]);
        } else {
            return null;
        }
    }

    public static function deletePlayer($nickName){
        self::queryWithParameters("DELETE FROM player WHERE nickName = ?", array(self::sanitize($nickName)));
    }

    public function toJson() {
        $return = [
            "id" => $this->id,
            "nickName" => $this->nickName,
            "genderId" => $this->genderId,
            "levelId" => $this->levelId
        ];
        return json_encode($return);
    }

    public function getId() {
        return $this->id;
    }

    public function getNickName() {
        return $this->nickName;
    }

    public function getGenderId() {
        return $this->genderId;
    }

    public function getLevelId() {
        return $this->levelId;
    }

}
