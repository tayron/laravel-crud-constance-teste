<?php

namespace App\Models;

use App\Models\ApplicationModel;

class User extends ApplicationModel
{
    protected $table = 'users';

    public function getProfile()
    {
        return $this->profile_id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getPhone()
    {
        return $this->phone;
    }

    public function getBirthdate()
    {
        return new \DateTime($this->birthdate);
    }

    public function getOccupation()
    {
        return $this->occupation;
    }

    public function getSalary()
    {
        return $this->salary;
    }

    public function getPhoto()
    {
        return $this->photo;
    }

    public function setProfile($profile)
    {
        $this->profile_id = $profile;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    public function setBirthdate(\DateTime $birthdate)
    {
        $this->birthdate = $birthdate;
    }

    public function setOccupation($occupation)
    {
        $this->occupation = $occupation;
    }

    public function setSalary($salary)
    {
        $this->salary = str_replace(['.', ','], ['', '.'], $salary);
    }

    public function setPhoto($photo)
    {
        $this->photo = $photo;
    }

    public function profile()
    {
        return $this->belongsTo('App\Http\Models\Profile', 'id', 'profile_id');
    }
}
