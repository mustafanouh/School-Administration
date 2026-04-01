<?php

namespace App\Services;

use App\Models\Enrollment;
use App\Models\Mark;
use App\Notifications\RealTimeNotification;
use App\Repositories\MarkRepository;
use Illuminate\Support\Facades\DB;

class MarkService
{
    protected MarkRepository $markRepository;

    public function __construct(MarkRepository $markRepository)
    {
        $this->markRepository = $markRepository;
    }

    public function storeMarkEntry(array $data): Mark
    {
        return DB::transaction(function () use ($data) {
            $mark = $this->markRepository->create($data);

            $enrollment = Enrollment::with('student.user')->find($mark->enrollment_id);


            if ($enrollment?->student?->user) {
                $this->sendMarkNotification($enrollment->student->user, $mark);
            }

            return $mark;
        });
    }


    protected function sendMarkNotification($user, Mark $mark): void
    {

        $message = "A new mark has been recorded for you: {$mark->score} degree in your {$mark->exam->subject->name} exam.";
        $user->notify(new RealTimeNotification($message));
    }

    public function updateMarkEntry(Mark $mark, array $data): Mark
    {
        return DB::transaction(function () use ($mark, $data) {

            $mark->update($data);


            $mark->load(['enrollment.student.user', 'exam.subject']);


            if ($user = $mark->enrollment?->student?->user) {
                $this->sendMarkUpdateNotification($user, $mark);
            }

            return $mark;
        });
    }

    protected function sendMarkUpdateNotification($user, Mark $mark): void
    {
        $message = "Your mark has been updated: {$mark->score} degree in your {$mark->exam->subject->name} exam.";
        $user->notify(new RealTimeNotification($message));
    }
    public function destroy(Mark $mark)
    {
        try {
            $this->markRepository->delete($mark);

            return redirect()->route('marks.index')
                ->with('success', 'Student grade record has been removed.');
        } catch (\Exception $e) {


            return back()->with('error', 'Failed to delete the record. It might be linked to other results or reports.');
        }
    }
}
