<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Student;
use App\Models\Grade;
use App\Models\AcademicYear;

class PromoteStudents extends Command
{

    protected $signature = 'students:promote';
    protected $description = 'Automatically promote students to the next grade';

    public function handle()
    {
        $activeYear = AcademicYear::getActiveYear();

        if (!$activeYear) {
            $this->error('No active academic year found.');
            return;
        }

        $students = Student::whereNotNull('current_grade')->get();

        foreach ($students as $student) {
            $nextGrade = Grade::where('id', '>', $student->current_grade)
                ->orderBy('id', 'asc')
                ->first();

            if ($nextGrade) {
                $student->update(['current_grade' => $nextGrade->id]);
            }
        }

        // Close the current academic year and create a new one
        $activeYear->update(['is_active' => false]);
        AcademicYear::create(['year' => $activeYear->year + 1, 'is_active' => true]);

        $this->info('Students have been promoted successfully.');
    }
}
