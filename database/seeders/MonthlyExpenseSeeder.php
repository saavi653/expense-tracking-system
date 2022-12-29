<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MonthlyExpenseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('monthly_expenses')->insert([
           'name' => 'January'
        ]);
        DB::table('monthly_expenses')->insert([
            'name' => 'February'
         ]);
         DB::table('monthly_expenses')->insert([
            'name' => 'March'
         ]);
         DB::table('monthly_expenses')->insert([
            'name' => 'April'
         ]);
         DB::table('monthly_expenses')->insert([
            'name' => 'May'
         ]);
         DB::table('monthly_expenses')->insert([
            'name' => 'June'
         ]);
         DB::table('monthly_expenses')->insert([
            'name' => 'July'
         ]);
         DB::table('monthly_expenses')->insert([
            'name' => 'August'
         ]);
         DB::table('monthly_expenses')->insert([
            'name' => 'September'
         ]);
         DB::table('monthly_expenses')->insert([
            'name' => 'October'
         ]);
         DB::table('monthly_expenses')->insert([
            'name' => 'November'
         ]);
         DB::table('monthly_expenses')->insert([
            'name' => 'December'
         ]);

    }
}
