<?php

namespace App\Repositories;

use App\Models\Exam;

class ExamRepository
{
    public function getPaginated($perPage = 10)
    {
        return Exam::with(['subject', 'semester'])
            ->whereHas('semester', function ($query) {
                $query->where('is_active', true);
            })
            ->latest()->paginate($perPage);
    }

    public function create(array $data)
    {
        return Exam::create($data);
    }

    public function update(Exam $exam, array $data)
    {
        return $exam->update($data);
    }

    public function delete(Exam $exam)
    {
        return $exam->delete();
    }
}
