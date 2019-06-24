<?php

namespace App\Models;

use App\Models\ApplicationModel;

class Profile extends ApplicationModel
{
    protected $table = 'profiles';

    public function getName() : string
    {
        return (string) $this->name;
    }

    public function getDescription() : string
    {
        return (string) $this->description;
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function setDescription(string $description)
    {
        $this->description = $description;
    }
}
