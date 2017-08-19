<?php
require_once("../classes/Vuser.class.php");
require_once("../classes/VuserManager.class.php");

/**
 * POST variables
 */
@$companyid        = (string) $_POST["companyid"];
@$oldpass        = (string) $_POST["oldpass"];
@$newpass        = (string) $_POST["newpass"];
@$newpassconf    = (string) $_POST["newpassconf"];

/**
 * if POST variables not set, abort
 */
if (!isset($companyid) || !isset($oldpass) || !isset($newpass) || !isset($newpassconf)) {
    echo "500";
    exit;
}
/**
 * if POST variables empty, abort
 */
if ($companyid == "" || $oldpass == "" || $newpassconf == "" || $newpass == "") {
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
if (strlen($companyid) > 15) {
    echo "500";
    exit;
}

/**
 * Object from type "Vuser"
 */
$user = new Vuser($companyid);

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
$userHandler->maybeAddUser($companyid);

/**
 * if user has entered wrong password too often, abort
 */
if ($userHandler->isLimited($companyid)) {
    echo "600";
    exit;
}

/**
 * if old password is incorrect, abort
 */
if (!$user->validPassword($oldpass)) {
    echo "500";
    $userHandler->increaseAttempts($companyid);
    exit;
}

$userHandler->clearAttempts($companyid);
echo $user->setPassword($newpass);
