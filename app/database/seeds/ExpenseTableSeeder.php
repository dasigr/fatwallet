<?php

class ExpenseTableSeeder extends Seeder {

    public function run()
    {
        $now = date('Y-m-d H:i:s');

        $seeds = array(
            array(
                'amount' => 24443,
                'merchant_id' => 1,
                'category_id' => 1,
                'notes' => 'Lorem ipsum set amet.',
                'attachment_id' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                'amount' => 66638,
                'merchant_id' => 1,
                'category_id' => 1,
                'notes' => 'Lorem ipsum set amet.',
                'attachment_id' => 1,
                'created_at' => date('Y-m-d H:i:s', strtotime('+1 day')),
		        'updated_at' => date('Y-m-d H:i:s', strtotime('+1 day'))
            ),
            array(
                'amount' => 29437,
                'merchant_id' => 2,
                'category_id' => 2,
                'notes' => 'Lorem ipsum set amet.',
                'attachment_id' => 1,
                'created_at' => date('Y-m-d H:i:s', strtotime('+3 day')),
		        'updated_at' => date('Y-m-d H:i:s', strtotime('+3 day'))
            ),
            array(
                'amount' => 94628,
                'merchant_id' => 2,
                'category_id' => 2,
                'notes' => 'Lorem ipsum set amet.',
                'attachment_id' => 1,
                'created_at' => date('Y-m-d H:i:s', strtotime('+2 day')),
		        'updated_at' => date('Y-m-d H:i:s', strtotime('+2 day'))
            ),
            array(
                'amount' => 97492,
                'merchant_id' => 4,
                'category_id' => 4,
                'notes' => 'Lorem ipsum set amet.',
                'attachment_id' => 1,
                'created_at' => date('Y-m-d H:i:s', strtotime('+5 day')),
		        'updated_at' => date('Y-m-d H:i:s', strtotime('+5 day'))
            ),
            array(
                'amount' => 98474,
                'merchant_id' => 4,
                'category_id' => 4,
                'notes' => 'Lorem ipsum set amet.',
                'attachment_id' => 1,
                'created_at' => date('Y-m-d H:i:s', strtotime('+4 day')),
		        'updated_at' => date('Y-m-d H:i:s', strtotime('+4 day'))
            ),
            array(
                'amount' => 94595,
                'merchant_id' => 5,
                'category_id' => 5,
                'notes' => 'Lorem ipsum set amet.',
                'attachment_id' => 1,
                'created_at' => date('Y-m-d H:i:s', strtotime('+7 day')),
		        'updated_at' => date('Y-m-d H:i:s', strtotime('+7 day'))
            ),
            array(
                'amount' => 42372,
                'merchant_id' => 5,
                'category_id' => 5,
                'notes' => 'Lorem ipsum set amet.',
                'attachment_id' => 1,
                'created_at' => date('Y-m-d H:i:s', strtotime('+6 day')),
		        'updated_at' => date('Y-m-d H:i:s', strtotime('+6 day'))
            )
        );

        DB::table('expense')->insert($seeds);
    }

}
