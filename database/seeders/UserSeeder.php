<?php

namespace Database\Seeders;

use App\Models\School;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $schools = School::all();
        $number = 2;

        // SuperAdmin
        $superAdmin = User::create([
            'name' => 'superAdmin',
            'lastName' => null,
            'email' => 'superAdmin@example.test',
            'password' => bcrypt('password'),
        ]);
        $superAdmin->assignRole('superAdmin');

        foreach ($schools as $school) {
            $admin = User::create([
                'school_id' => $school->id,
                'name' => 'admin'.$school->id,
                'lastName' => null,
                'email' => 'admin'.$school->id.'@example.test',
                'password' => bcrypt('password'),
            ]);
            $admin->assignRole('admin');
        }

        // Doctor
        foreach ($schools as $school) {
            for ($u=0; $u < $number ; $u++) {
                $doctor = User::create([
                    'school_id' => $school->id,
                    'name' => 'doctor-'.$school->id.$u,
                    'lastName' => null,
                    'email' => 'doctor'.$school->id.$u.'@example.test',
                    'password' => bcrypt('password'),
                ]);
                $doctor->assignRole('doctor');
            }
        }

        // Teacher
        foreach ($schools as $school) {
            for ($u=0; $u < $number ; $u++) {
                $teacher = User::create([
                    'school_id' => $school->id,
                    'name' => 'teacher-'.$school->id.$u,
                    'lastName' => null,
                    'email' => 'teacher'.$school->id.$u.'@example.test',
                    'password' => bcrypt('password'),
                ]);
                $teacher->assignRole('teacher');
            }
        }

        // Secretary
        foreach ($schools as $school) {
            for ($u=0; $u < $number ; $u++) {
                $secretary = User::create([
                    'school_id' => $school->id,
                    'name' => 'secretary-'.$school->id.$u,
                    'lastName' => null,
                    'email' => 'secretary'.$school->id.$u.'@example.test',
                    'password' => bcrypt('password'),
                ]);
                $secretary->assignRole('secretary');
            }
        }
    }
}
