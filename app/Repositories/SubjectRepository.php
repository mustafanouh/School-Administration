<?php

namespace App\Repositories;

use App\Models\Grade;
use App\Models\Subject;
use App\Models\Track;

class SubjectRepository
{
    public function getAllSubject()
    {
        return Subject::with(['grade', 'track'])->paginate(10);
    }

    public function getGrades()
    {
        $grades = Grade::all();

        return $grades;
    }
    public function getTracks()
    {
        $tracks = Track::all();
        return $tracks;
    }

 public function subjectCreate(array $data) 
    {
        return Subject::create($data);
    }

    public function subjectUpdate(Subject $subject, array $data)
    {
        return $subject->update($data);
    }

    public function subjectDestroy($id)
    {
        $subject = Subject::findOrFail($id);
        return $subject->delete();
    }


}
