<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Post;
use App\Models\Category;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $users = User::factory(15) -> create();

        $posts = collect();
        for ($i = 0; $i < 30; $i++){
            $p = Post::factory() -> create([
                'author_id' => $users -> random() // 1:N kapcsolat seedelése
            ]);
            $posts -> add($p -> id);
        }

        $categories = Category::factory(5) -> create();
        foreach($categories as $c){
            $c -> posts() -> attach($posts -> random(rand(0, count($posts)))); // N:N kapcsolat seedelése
        }
    }
}
