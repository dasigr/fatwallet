<?php

class VocabularyTableSeeder extends Seeder {

    public function run()
    {
        $now = date('Y-m-d H:i:s');

        $seeds = array(
            array(
                'name' => 'Home',
                'description' => 'Lorem ipsum set amet.',
                'created_at' => $now,
                'updated_at' => $now
            ),
            array(
                'name' => 'Auto & Transport',
                'description' => 'Lorem ipsum set amet.',
                'created_at' => $now,
                'updated_at' => $now
            ),
            array(
                'name' => 'Food & Dining',
                'description' => 'Lorem ipsum set amet.',
                'created_at' => $now,
                'updated_at' => $now
            ),
            array(
                'name' => 'Shopping',
                'description' => 'Lorem ipsum set amet.',
                'created_at' => $now,
                'updated_at' => $now
            ),
            array(
                'name' => 'Bills & Utilities',
                'description' => 'Lorem ipsum set amet.',
                'created_at' => $now,
                'updated_at' => $now
            ),
            array(
                'name' => 'Travel',
                'description' => 'Lorem ipsum set amet.',
                'created_at' => $now,
                'updated_at' => $now
            ),
            array(
                'name' => 'Entertainment',
                'description' => 'Lorem ipsum set amet.',
                'created_at' => $now,
                'updated_at' => $now
            ),
            array(
                'name' => 'Fees & Charges',
                'description' => 'Lorem ipsum set amet.',
                'created_at' => $now,
                'updated_at' => $now
            ),
            array(
                'name' => 'Personal Care',
                'description' => 'Lorem ipsum set amet.',
                'created_at' => $now,
                'updated_at' => $now
            ),
            array(
                'name' => 'Business Services',
                'description' => 'Lorem ipsum set amet.',
                'created_at' => $now,
                'updated_at' => $now
            ),
            array(
                'name' => 'Education',
                'description' => 'Lorem ipsum set amet.',
                'created_at' => $now,
                'updated_at' => $now
            ),
            array(
                'name' => 'Gifts & Donations',
                'description' => 'Lorem ipsum set amet.',
                'created_at' => $now,
                'updated_at' => $now
            ),
            array(
                'name' => 'Kids',
                'description' => 'Lorem ipsum set amet.',
                'created_at' => $now,
                'updated_at' => $now
            ),
            array(
                'name' => 'Insurance',
                'description' => 'Lorem ipsum set amet.',
                'created_at' => $now,
                'updated_at' => $now
            ),
            array(
                'name' => 'Investment',
                'description' => 'Lorem ipsum set amet.',
                'created_at' => $now,
                'updated_at' => $now
            ),
            array(
                'name' => 'Others',
                'description' => 'Lorem ipsum set amet.',
                'created_at' => $now,
                'updated_at' => $now
            ),
            array(
                'name' => 'Uncategorized',
                'description' => 'Lorem ipsum set amet.',
                'created_at' => $now,
                'updated_at' => $now
            )
        );

        DB::table('vocabulary')->insert($seeds);
    }

}
