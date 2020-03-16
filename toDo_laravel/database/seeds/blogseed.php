<?php

use Illuminate\Database\Seeder;

class blogseed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\blog::class,5)->create();
    }
}
