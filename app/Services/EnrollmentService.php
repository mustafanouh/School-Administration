<?php

namespace App\Services;

use App\Repositories\EnrollmentRepository;
use App\Models\{Track, Student, Section, AcademicYear, Grade, Enrollment};
use Exception;

class EnrollmentService
{
    protected $repo;

    
    public function __construct(EnrollmentRepository $repo)
    {
        $this->repo = $repo;
    }

   
    public function getIndexData()
    {
        return $this->repo->getAllPaginated(10);
    }

    /**
     * تحضير البيانات اللازمة لنماذج الإدخال (Create/Edit)
     * @throws Exception في حال عدم وجود سنة دراسية نشطة
     */
    public function getCreateFormData()
    {
        $activeYear = $this->repo->getActiveYear();

        if (!$activeYear) {
            throw new Exception('Please activate an academic year first.');
        }

        return [
            'activeYear'             => $activeYear,
            'tracks'                 => Track::all(),
            'sectionsGroupedByGrade' => $this->repo->getSectionsGroupedByGrade($activeYear->id),
            'students'               => $this->repo->getStudentsNotEnrolledInYear($activeYear->id),
        ];
    }

    /**
     * جلب بيانات التعديل
     */
    public function getEditFormData(Enrollment $enrollment)
    {
        return [
            'enrollment'    => $enrollment,
            'students'      => Student::all(),
            'sections'      => Section::all(),
            'tracks'        => Track::all(),
            'academicYears' => AcademicYear::all(),
            'grades'        => Grade::all(),
        ];
    }

    /**
     * تنفيذ عملية التسجيل في قاعدة البيانات
     */
    public function storeEnrollment(array $data)
    {
        try {
            return $this->repo->create($data);
        } catch (Exception $e) {
            throw new Exception("Failed to enroll student: " . $e->getMessage());
        }
    }

    /**
     * تحديث بيانات التسجيل
     */
    public function updateEnrollment(Enrollment $enrollment, array $data)
    {
        try {
            return $this->repo->update($enrollment, $data);
        } catch (Exception $e) {
            throw new Exception("Update failed: " . $e->getMessage());
        }
    }

    /**
     * حذف سجل التسجيل
     */
    public function deleteEnrollment(Enrollment $enrollment)
    {
        try {
            // يمكنك هنا إضافة منطق فحص قبل الحذف (مثلاً إذا كان الطالب لديه درجات)
            return $this->repo->delete($enrollment);
        } catch (Exception $e) {
            throw new Exception("Error occurred while deleting the record.");
        }
    }
}
