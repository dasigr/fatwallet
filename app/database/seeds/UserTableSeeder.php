<?php

class UserTableSeeder extends Seeder {

	public function run()
	{
        $now = date('Y-m-d H:i:s');

		$users = array(
			array(
                'username' => 'admin',
                'password' => Hash::make('*a5pro123'),
                'email'	=> 'admin@laravelcommerce.com',
                'created_at' => $now,
                'updated_at' => $now
            ),
		    array(
		        'username' => 'engineering_test1',
		        'password' => Hash::make('*test123'),
		        'email'	=> 'engineering_test1@a5project.com',
		        'created_at' => $now,
		        'updated_at' => $now
		    ),
		    array(
		        'username' => 'engineering_test2',
		        'password' => Hash::make('*test123'),
		        'email'	=> 'engineering_test2@a5project.com',
		        'created_at' => $now,
		        'updated_at' => $now
		    ),
		    array(
		        'username' => 'engineering_test3',
		        'password' => Hash::make('*test123'),
		        'email'	=> 'engineering_test3@a5project.com',
		        'created_at' => $now,
		        'updated_at' => $now
		    ),
		    array(
		        'username' => 'engineering_test4',
		        'password' => Hash::make('*test123'),
		        'email'	=> 'engineering_test4@a5project.com',
		        'created_at' => $now,
		        'updated_at' => $now
		    ),
		    array(
		        'username' => 'engineering_test5',
		        'password' => Hash::make('*test123'),
		        'email'	=> 'engineering_test5@a5project.com',
		        'created_at' => $now,
		        'updated_at' => $now
		    ),
		    array(
		        'username' => 'engineering_test6',
		        'password' => Hash::make('*test123'),
		        'email'	=> 'engineering_test6@a5project.com',
		        'created_at' => $now,
		        'updated_at' => $now
		    ),
		    array(
		        'username' => 'engineering_test7',
		        'password' => Hash::make('*test123'),
		        'email'	=> 'engineering_test7@a5project.com',
		        'created_at' => $now,
		        'updated_at' => $now
		    ),
		    array(
		        'username' => 'engineering_test8',
		        'password' => Hash::make('*test123'),
		        'email'	=> 'engineering_test8@a5project.com',
		        'created_at' => $now,
		        'updated_at' => $now
		    ),
		    array(
		        'username' => 'engineering_test9',
		        'password' => Hash::make('*test123'),
		        'email'	=> 'engineering_test9@a5project.com',
		        'created_at' => $now,
		        'updated_at' => $now
		    )
		);

		DB::table('users')->insert($users);
	}

}
