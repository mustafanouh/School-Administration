<?php

use App\Models\Student;
use function Livewire\Volt\{state, updated};

// تعريف الحالة (State) للمكون
state([
    'students' => fn() => Student::all(),
    'studentId' => null,
    'info' => null,
]);

// مراقبة تغير قيمة الطالب المختار
updated([
    'studentId' => function ($value) {
        if (!$value) {
            $this->info = null;
            return;
        }

        $student = Student::find($value);
        $lastEnrollment = $student
            ->enrollments()
            ->with(['section.grade', 'academicYear'])
            ->latest()
            ->first();

        if ($lastEnrollment) {
            $this->info = [
                'label' => 'Grade: ' . $lastEnrollment->section->grade->name,
                'status_text' => strtoupper($lastEnrollment->status),
                'status_class' => getStatusClass($lastEnrollment->status),
                'year' => $lastEnrollment->academicYear?->name,
            ];
        } else {
            $this->info = [
                'label' => 'New Student (No history)',
                'status_text' => 'NEW',
                'status_class' => 'bg-orange-100 text-orange-700 border-orange-200',
                'year' => '',
            ];
        }
    },
]);

// دالة مساعدة لتحديد الألوان (تعمل داخل نطاق Volt)
function getStatusClass($status)
{
    return match ($status) {
        'passed' => 'bg-green-100 text-green-700 border-green-200',
        'failed' => 'bg-red-100 text-red-700 border-red-200',
        'enrolled' => 'bg-blue-100 text-blue-700 border-blue-200',
        default => 'bg-gray-100 text-gray-700 border-gray-200',
    };
}

?>

<div>
    <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Select Student</label>

    <select wire:model.live="studentId"
        class="w-full bg-gray-50 dark:bg-white/5 border border-gray-100 dark:border-white/10 rounded-xl px-4 py-3 text-gray-700 dark:text-white">
        <option value="">Choose a student...</option>
        @foreach ($students as $student)
            <option value="{{ $student->id }}">{{ $student->first_name }} {{ $student->last_name }}</option>
        @endforeach
    </select>

    @if ($info)
        <div class="mt-3 p-4 rounded-xl border border-dashed border-indigo-200 bg-indigo-50/30">
            <div class="flex items-center gap-4 text-sm">
                <span class="text-gray-500">Previous Record:</span>
                <div class="flex gap-2">
                    <span class="px-2 py-1 bg-white rounded shadow-sm font-bold text-indigo-600">
                        {{ $info['label'] }}
                    </span>
                    <span class="px-2 py-1 rounded font-bold uppercase text-[10px] border {{ $info['status_class'] }}">
                        {{ $info['status_text'] }}
                    </span>
                </div>
                <span class="text-xs text-gray-400 ml-auto">{{ $info['year'] }}</span>
            </div>
        </div>
    @endif
</div>
