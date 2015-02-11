<?php
require_once("../classes/Vuser.class.php");
require_once("../classes/VuserManager.class.php");

/**
 * POST variables
 */
@$kayosid        = (string) $_POST["kayosid"];
@$oldpass        = (string) $_POST["oldpass"];
@$newpass        = (string) $_POST["newpass"];
@$newpassconf    = (string) $_POST["newpassconf"];

/**
 * if POST variables not set, abort
 */
if (!isset($kayosid) || !isset($oldpass) || !isset($newpass) || !isset($newpassconf)) {
    echo "500";
    exit;
}
/**
 * if POST variables empty, abort
 */
if ($kayosid == "" || $oldpass == "" || $newpassconf == "" || $newpass == "") {
    echo "500";
    exit;
}
/**
 * if repeated password is not equal, abort
 */
if ($newpass != $newpassconf) {
    echo "500";
    exit;
}
/**
 * if submitted username is longer than 15 characters, abort
 */
if (strlen($kayosid) > 15) {
    echo "500";
    exit;
}

/**
 * Object from type "Vuser"
 */
$user = new Vuser($kayosid);

/**
 * Object from type "VuserManager"
 */
$userHandler = new VuserManager(dirname(__FILE__)."/../access.json", 3);

/**
 * if user does not exist, abort
 */
if (!$user->validUser()) {
    echo "500";
    exit;
}

/**
 * add user to attempts log if not exists
 */
$userHandler->maybeAddUser($kayosid);

/**
 * if user has entered wrong password too often, abort
 */
if ($userHandler->isLimited($kayosid)) {
    echo "600";
    exit;
}

/**
 * if old password is incorrect, abort
 */
if (!$user->validPassword($oldpass)) {
    echo "500";
    $userHandler->increaseAttempts($kayosid);
    exit;
}

$userHandler->clearAttempts($kayosid);
echo $user->setPassword($newpass);
