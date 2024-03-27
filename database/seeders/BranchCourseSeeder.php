<?php

namespace Database\Seeders;

use App\Models\Branch;
use App\Models\Course;
use App\Models\CourseVariant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BranchCourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $branches = Branch::all();
        $courses = Course::all();
        $courseVariants = CourseVariant::all();

        foreach ($branches as $branch) {
            $absences = 0;

            if ($branch->id == 1) {
                $absences = 3;
            }

            foreach ($courses as $course) {
                if (in_array($course->id , [14, 16])) {
                    $guides = 10;
                } else {
                    $guides = 0;
                }

                if ($branch->id == 3 && in_array($course->id , [12,13,14])) {
                    $course->branchCourses()->create([
                        'branch_id' => $branch->id,
                        'absences' => $absences,
                        'guides' => 10,
                    ]);
                }

                if ($branch->id == 1 || $branch->id == 2) {
                    $course->branchCourses()->create([
                        'branch_id' => $branch->id,
                        'absences' => $absences,
                        'guides' => $guides,
                    ]);

                }
            }

            foreach ($courseVariants as $courseVariant) {
                if (in_array($courseVariant->course_id , [14, 16])) {
                    $guides = 10;
                } else {
                    $guides = 0;
                }

                if ($branch->id == 3 && in_array($course->id , [12,13,14])) {
                    $courseVariant->branchCourses()->create([
                        'branch_id' => $branch->id,
                        'absences' => $absences,
                        'guides' => 10,
                    ]);
                }

                if ($branch->id == 1 || $branch->id == 2) {
                    $courseVariant->branchCourses()->create([
                        'branch_id' => $branch->id,
                        'absences' => $absences,
                        'guides' => $guides,
                    ]);

                }
            }
        }
    }
}
