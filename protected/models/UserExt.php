<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UserExt
 *
 * @author w4919_000
 */


class UserExt {
    public $id;
    public $projectId;
    public $firstname;
    public $lastname;
    public $password;
    public $usergroup;
    public $email;
    public $projectName;
    
public function __construct(User $user, $projectName) {
        $this->id = $user->id;
        $this->projectId = $user->projectId;
        $this->firstname = $user->firstname;
        $this->lastname = $user->lastname;
        $this->password = $user->password;
        $this->usergroup = $user->usergroup;
        $this->email = $user->email;
        $this->projectName = $projectName;
    }
}
