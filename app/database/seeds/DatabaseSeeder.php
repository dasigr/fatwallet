<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		$this->call('UserTableSeeder');
		$this->command->info('User table seeded!');

		$this->call('VocabularyTableSeeder');
		$this->command->info('Vocabulary table seeded!');

		$this->call('MerchantTableSeeder');
		$this->command->info('Merchant table seeded!');
	}

}
