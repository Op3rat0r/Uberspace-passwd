<?php

class VuserManager {
    private $members;
    private $filename;
    private $maxAttempts;

    public function __construct($filename, $maxAttempts) {
        $this->filename     = $filename;
        $this->maxAttempts  = $maxAttempts;
        if (file_exists($filename))
            $this->members = json_decode(file_get_contents($filename), true);
        else
            $this->members = array();
    }

    public function maybeAddUser($username) {
        if(array_key_exists($username, $this->members))
            return;
        $this->members[$username] = 0;
        $this->save();
    }

    public function save() {
        file_put_contents($this->filename, json_encode($this->members));
    }

    public function isLimited($username) {
        if (!array_key_exists($username, $this->members))
            return false;
        if ($this->members[$username] >= $this->maxAttempts)
            return true;
        return false;
    }

    public function increaseAttempts($username) {
        if (!array_key_exists($username, $this->members))
            return;
        $this->members[$username] += 1;
        $this->save();
    }

    public function clearAttempts($username) {
        if (!array_key_exists($username, $this->members))
            return;
        $this->members[$username] = 0;
        $this->save();
    }
} 