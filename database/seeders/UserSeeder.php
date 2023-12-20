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
        $superAdmin->assignRole('admin');

        // Admin
        foreach ($schools as $school) {
            $admin = User::create([
                'name' => 'admin'.$school->id,
                'lastName' => null,
                'email' => 'admin'.$school->id.'@example.test',
                'password' => bcrypt('password'),
            ]);
            $admin->assignRole('responsabile sede');
            $admin->schools()->attach($school->id);
        }

        // medico
        foreach ($schools as $school) {
            for ($u=0; $u < $number ; $u++) {
                $medico = User::create([
                    'name' => 'medico-'.$school->id.$u,
                    'lastName' => null,
                    'email' => 'medico'.$school->id.$u.'@example.test',
                    'password' => bcrypt('password'),
                ]);
                $medico->assignRole('medico');
                $medico->schools()->attach($school->id);
            }
        }

        // Teacher
        foreach ($schools as $school) {
            for ($u=0; $u < $number ; $u++) {
                $teacher = User::create([
                    'name' => 'teacher-'.$school->id.$u,
                    'lastName' => null,
                    'email' => 'teacher'.$school->id.$u.'@example.test',
                    'password' => bcrypt('password'),
                ]);
                $teacher->assignRole('insegnante');
                $teacher->schools()->attach($school->id);
            }
        }

        // Instructor
        foreach ($schools as $school) {
            for ($u=0; $u < $number ; $u++) {
                $instructor = User::create([
                    'name' => 'instructor-'.$school->id.$u,
                    'lastName' => null,
                    'email' => 'instructor'.$school->id.$u.'@example.test',
                    'password' => bcrypt('password'),
                ]);
                $instructor->assignRole('istruttore');
                $instructor->schools()->attach($school->id);
            }
        }

        // Secretary
        foreach ($schools as $school) {
            for ($u=0; $u < $number ; $u++) {
                $secretary = User::create([
                    'name' => 'secretary-'.$school->id.$u,
                    'lastName' => null,
                    'email' => 'secretary'.$school->id.$u.'@example.test',
                    'password' => bcrypt('password'),
                ]);
                $secretary->assignRole('segretaria');
                $secretary->schools()->attach($school->id);
            }
        }
    }
}
