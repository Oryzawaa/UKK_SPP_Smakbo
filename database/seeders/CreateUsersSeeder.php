<?php
  
namespace Database\Seeders;
  
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
  
class CreateUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
               'username' =>'Petugas',
               'name_petugas' =>'Dio',
               'level' =>'petugas',
               'password'=> bcrypt('petugas123'),
            ],
            [
               'username' =>'Admin',
               'name_petugas' =>'Diofan',
               'level' => 'admin',
               'password'=> bcrypt('admin123'),
            ],
            [
                'username' =>'Siswa',
                'name_petugas' =>'Diofah',
                'level' =>'siswa',
                'password'=> bcrypt('siswa123'),
            ],
        ];
    
        foreach ($users as $key => $user) {
            User::create($user);
        }
    }
}