<?php

class UserTableSeeder extends Seeder {

	public function run()
	{
		$users = array(
			array(
                'username' => 'admin',
                'password' => Hash::make('*a5pro123'),
                'email'	=> 'administrator_test@a5project.com',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ),
		    array(
		        'username' => 'engineering_test1',
		        'password' => Hash::make('*test123'),
		        'email'	=> 'engineering_test1@a5project.com',
		        'created_at' => date('Y-m-d H:i:s', strtotime('+1 day')),
		        'updated_at' => date('Y-m-d H:i:s', strtotime('+1 day'))
		    ),
		    array(
		        'username' => 'engineering_test2',
		        'password' => Hash::make('*test123'),
		        'email'	=> 'engineering_test2@a5project.com',
		        'created_at' => date('Y-m-d H:i:s', strtotime('+3 day')),
		        'updated_at' => date('Y-m-d H:i:s', strtotime('+3 day'))
		    ),
		    array(
		        'username' => 'engineering_test3',
		        'password' => Hash::make('*test123'),
		        'email'	=> 'engineering_test3@a5project.com',
		        'created_at' => date('Y-m-d H:i:s', strtotime('+2 day')),
		        'updated_at' => date('Y-m-d H:i:s', strtotime('+2 day'))
		    ),
		    array(
		        'username' => 'engineering_test4',
		        'password' => Hash::make('*test123'),
		        'email'	=> 'engineering_test4@a5project.com',
		        'created_at' => date('Y-m-d H:i:s', strtotime('+4 day')),
		        'updated_at' => date('Y-m-d H:i:s', strtotime('+4 day'))
		    ),
		    array(
		        'username' => 'engineering_test5',
		        'password' => Hash::make('*test123'),
		        'email'	=> 'engineering_test5@a5project.com',
		        'created_at' => date('Y-m-d H:i:s', strtotime('+6 day')),
		        'updated_at' => date('Y-m-d H:i:s', strtotime('+6 day'))
		    ),
		    array(
		        'username' => 'engineering_test6',
		        'password' => Hash::make('*test123'),
		        'email'	=> 'engineering_test6@a5project.com',
		        'created_at' => date('Y-m-d H:i:s', strtotime('+5 day')),
		        'updated_at' => date('Y-m-d H:i:s', strtotime('+5 day'))
		    ),
		    array(
		        'username' => 'engineering_test7',
		        'password' => Hash::make('*test123'),
		        'email'	=> 'engineering_test7@a5project.com',
		        'created_at' => date('Y-m-d H:i:s', strtotime('+7 day')),
		        'updated_at' => date('Y-m-d H:i:s', strtotime('+7 day'))
		    ),
		    array(
		        'username' => 'engineering_test8',
		        'password' => Hash::make('*test123'),
		        'email'	=> 'engineering_test8@a5project.com',
		        'created_at' => date('Y-m-d H:i:s', strtotime('+9 day')),
		        'updated_at' => date('Y-m-d H:i:s', strtotime('+9 day'))
		    ),
		    array(
		        'username' => 'engineering_test9',
		        'password' => Hash::make('*test123'),
		        'email'	=> 'engineering_test9@a5project.com',
		        'created_at' => date('Y-m-d H:i:s', strtotime('+8 day')),
		        'updated_at' => date('Y-m-d H:i:s', strtotime('+8 day'))
		    )
		);

		DB::table('users')->insert($users);
	}

}
