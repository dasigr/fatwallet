<?php

class MerchantTableSeeder extends Seeder {

    public function run()
    {
        $now = date('Y-m-d H:i:s');

        $seeds = array(
            array(
                'name' => 'Lourdes Rental Properties',
                'category_id' => 1,
                'created_at' => $now,
                'updated_at' => $now
            ),
            array(
                'name' => 'Shell',
                'category_id' => 2,
                'created_at' => $now,
                'updated_at' => $now
            ),
            array(
                'name' => 'Jollibee',
                'category_id' => 3,
                'created_at' => $now,
                'updated_at' => $now
            ),
            array(
                'name' => 'SM Mall',
                'category_id' => 4,
                'created_at' => $now,
                'updated_at' => $now
            ),
            array(
                'name' => 'Veco',
                'category_id' => 5,
                'created_at' => $now,
                'updated_at' => $now
            ),
            array(
                'name' => 'Cebu Pacific',
                'category_id' => 6,
                'created_at' => $now,
                'updated_at' => $now
            )
        );

        DB::table('merchant')->insert($seeds);
    }

}
