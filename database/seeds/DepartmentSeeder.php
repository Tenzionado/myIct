<?php

use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        date_default_timezone_set("Asia/Manila");
        DB::table('departments')->insert(
            [
                [   'name' => 'ACOUNTANCY',
                    'created_at' => now(),
                    'updated_at' => now()
                
                ],

                [   'name' => 'ACADEMY',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [   'name' => 'ACACIA',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [   'name' => 'ACCOUNTING',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [   'name' => 'DSF',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
            ]
        );
    }
}
