<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

// time
use CodeIgniter\I18n\Time;

class OrangSeeder extends Seeder
{
	public function run()
	{
		// $data = [
		// 	'nama'   => 'Apif Supriadi',
		// 	'alamat' => 'Jln. ABC No. 123, Tangerang',
		// 	'created_at' => Time::now(),
		// 	'updated_at' => Time::now()
		// ];

		// Faker
		$faker = \Faker\Factory::create('id_ID');

		for ($i = 0; $i < 100; $i++) {
			$data = [
				'nama'   => $faker->name,
				'alamat' => $faker->address,
				'created_at' => Time::createFromTimestamp($faker->unixTime()),
				'updated_at' => Time::now()
			];
			// Using Query Builder
			$this->db->table('orang')->insert($data);
		}


		// Simple Queries
		// $this->db->query(
		// 	"INSERT INTO orang (nama, alamat, created_at, updated_at) VALUES (:nama:, :alamat:, :created_at:, :updated_at:)",
		// 	$data
		// );

	}
}
