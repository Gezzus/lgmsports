<?php

include_once $_SERVER['DOCUMENT_ROOT'] . "/src/api/UserAPI.php";

if (isset( $_POST['username'] ) && isset( $_POST['password']) &&
    isset( $_POST['nickname'] ) && isset( $_POST['gender'])
   /*isset( $_POST['skill'] ) && isset( $_POST['email']*/) {
        $result = UserAPI::register($_POST['username'], $_POST['password'], $_POST['nickname'], $_POST['gender']);
        echo $result;
} else {
    echo json_encode(["status" => "empty"]);
}

?>
