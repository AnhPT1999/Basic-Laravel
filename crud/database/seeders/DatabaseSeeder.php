<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Doctrine\DBAL\Types\IntegerType;
use Faker\Core\Number;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\Cast\Int_;
use Psy\Util\Str;
use Ramsey\Uuid\Type\Integer;
use function Laravel\Prompts\table;
use function Webmozart\Assert\Tests\StaticAnalysis\numeric;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $faker = Faker::create();
        foreach (range(1,10) as $index){
            DB::table('posts')->insert([
                'title' => $faker->title,
                'description' => $faker->text,
                'status' => $faker->numberBetween(0,1)
            ]);
        }

        $fakerComment = Faker::create();
        foreach (range(1,30) as $i){
            DB::table('comments')->insert([
                'postId' => random_int(DB::table('posts')->min('id'),DB::table('posts')->max('id')),
                'content' => $fakerComment->text,
            ]);
        }
    }
}
