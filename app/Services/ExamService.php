<?php

namespace App\Services;

use App\Repositories\ExamRepository;
use App\Models\{Subject, AcademicYear, Semester, Grade, Exam};

class ExamService
{
    protected $examRepo;

    public function __construct(ExamRepository $examRepo)
    {
        $this->examRepo = $examRepo;
    }

    public function getIndexData()
    {
        return $this->examRepo->getPaginated();
    }

   
    public function getFormData()
    {
        return [
            'subjects'      => Subject::all(),
            'academicYears' => AcademicYear::where('is_active', true)->get(),
            'grades'        => Grade::all(),
            'semesters'     => Semester::whereHas('academicYear', function ($q) {
                $q->where('is_active', true);
            })->get(),
        ];
    }

    public function storeExam(array $data)
    {
        return $this->examRepo->create($data);
    }

    public function updateExam(Exam $exam, array $data)
    {
        return $this->examRepo->update($exam, $data);
    }

    public function deleteExam(Exam $exam)
    {
       
        if ($exam->marks()->exists()) {
            throw new \Exception('Cannot delete this exam because it already has student marks recorded.');
        }

        return $this->examRepo->delete($exam);
    }
}
