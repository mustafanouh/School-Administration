<?php

namespace App\Services;

use App\Models\Teacher;
use App\Notifications\RealTimeNotification;
use App\Repositories\TeacherRepository;
use Illuminate\Support\Facades\DB;

class TeacherService
{
    protected TeacherRepository $teacherRepository;
    public function __construct(TeacherRepository $teacherRepository)
    {
        $this->teacherRepository = $teacherRepository;
    }

    public function storeTeacher(array $data)
    {
        DB::transaction(function () use ($data) {
            $teacher = $this->teacherRepository->create($data);

            if ($teacher->employee->user) {
                $this->sendAddTeacherNotification($teacher->employee->user, $teacher);
            }
            return $teacher;
        });
    }

    public function updateTeacher(Teacher $teacher, array $data)
    {
        return DB::transaction(function () use ($teacher, $data) {
            $teacher = $this->teacherRepository->update($teacher, $data);
            if ($teacher->employee->user) {
                $this->sendUpdateTeacherNotification($teacher->employee->user, $teacher);
            }
            return $teacher;
        });
    }

    protected function sendAddTeacherNotification($user, Teacher $teacher): void
    {
        $message = "A new teacher has been added: {$teacher->name}";
        $user->notify(new RealTimeNotification($message));
    }
    protected function sendUpdateTeacherNotification($user, Teacher $teacher): void
    {
        $message = "A teacher has been updated: {$teacher->name}";
        $user->notify(new RealTimeNotification($message));
    }
}
