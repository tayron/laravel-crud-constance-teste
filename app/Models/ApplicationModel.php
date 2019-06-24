<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApplicationModel extends Model
{
    public function getId()
    {
        return $this->id;
    }
}
