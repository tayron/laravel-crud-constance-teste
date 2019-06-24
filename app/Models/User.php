<?php

namespace App\Models;

use App\Models\ApplicationModel;

class User extends ApplicationModel
{
    protected $table = 'users';

    public function getProfile() : int
    {
        return (int) $this->profile_id;
    }

    public function getName() : string
    {
        return (string) $this->name;
    }

    public function getEmail() : string
    {
        return (string) $this->email;
    }

    public function getPhone() : string
    {
        return (string) $this->phone;
    }

    public function getBirthdate() : \DateTime
    {
        return new \DateTime($this->birthdate);
    }

    public function getOccupation() : string
    {
        return $this->occupation;
    }

    public function getSalary() : string
    {
        return (string) $this->salary;
    }

    public function getPhoto() : string
    {
        return (string) $this->photo;
    }

    public function setProfile(int $idProfile)
    {
        $this->profile_id = $idProfile;
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    public function setPhone(string $phone)
    {
        $this->phone = $phone;
    }

    public function setBirthdate(\DateTime $birthdate)
    {
        $this->birthdate = $birthdate;
    }

    public function setOccupation(string $occupation)
    {
        $this->occupation = $occupation;
    }

    public function setSalary(string $salary)
    {
        $this->salary = str_replace(['.', ','], ['', '.'], $salary);
    }

    public function setPhoto(string $namePhoto)
    {
        $this->photo = $namePhoto;
    }

    public function profile()
    {
        return $this->belongsTo('App\Http\Models\Profile', 'id', 'profile_id');
    }
}
