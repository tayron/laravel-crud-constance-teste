<?php

namespace App\Models;

use App\Models\ApplicationModel;

class Profile extends ApplicationModel
{
    protected $table = 'profiles';

    public function getName()
    {
        return $this->name;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }
}
