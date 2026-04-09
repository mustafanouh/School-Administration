<?php

namespace App\Repositories;

use App\Models\Semester;

class SemesterRepository
{
    public function getById($id)
    {
        return Semester::findOrFail($id);
    }
 

}
