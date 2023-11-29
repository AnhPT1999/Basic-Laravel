<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Doctrine\DBAL\Types\IntegerType;
use Faker\Core\Number;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\Cast\Int_;
use Psy\Util\Str;
use Ramsey\Uuid\Type\Integer;
use function Webmozart\Assert\Tests\StaticAnalysis\numeric;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $faker = Faker::create();
        foreach (range(1,2) as $index){
            DB::table('posts')->insert([
                'title' => $faker->title,
                'description' => $faker->text,
                'status' => $faker->numberBetween(0,1)
            ]);
        }

//        $fakerComment = Faker::create();
//        foreach (range(1,10) as $i){
//            DB::table('comments')->insert([
//                'postId' => $fakerComment->randomNumber(2),
//                'content' => $fakerComment->text,
//            ]);
//        }
    }
}
