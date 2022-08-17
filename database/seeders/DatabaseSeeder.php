<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         \App\Models\User::factory(10)->create();
         $categories=['cooking', 'new', 'dance'];
         foreach ($categories as $category){
             Category::create(['name'=>$category]);
         }
//         \App\Models\User::factory()->create([
//             'name' => 'Test User',
//             'email' => 'test@example.com',
//         ]);

        foreach (User::all() as $user){
            foreach (Category::all() as $category){
                $user->categories()->attach($category->id);
            }
        }
    }
}
