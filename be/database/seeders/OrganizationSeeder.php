<?php

namespace Database\Seeders;

use App\Models\Organization;
use Illuminate\Database\Seeder;

class OrganizationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'college_id' => rand(1, 6),
                'organization' => 'Organization 1 Sample',
                'abbreviation' => 'ORG1S',
            ],
            [
                'college_id' => rand(1, 6),
                'organization' => 'Organization 2 Sample',
                'abbreviation' => 'ORG2S',
            ],
            [
                'college_id' => rand(1, 6),
                'organization' => 'Organization 3 Sample',
                'abbreviation' => 'ORG3S',
            ],
            [
                'college_id' => rand(1, 6),
                'organization' => 'Organization 4 Sample',
                'abbreviation' => 'ORG4S',
            ],
            [
                'college_id' => rand(1, 6),
                'organization' => 'Organization 5 Sample',
                'abbreviation' => 'ORG5S',
            ],
            [
                'college_id' => rand(1, 6),
                'organization' => 'Organization 6 Sample',
                'abbreviation' => 'ORG6S',
            ],
            [
                'college_id' => rand(1, 6),
                'organization' => 'Organization 7 Sample',
                'abbreviation' => 'ORG7S',
            ],
            [
                'college_id' => rand(1, 6),
                'organization' => 'Organization 8 Sample',
                'abbreviation' => 'ORG8S',
            ],
            [
                'college_id' => rand(1, 6),
                'organization' => 'Organization 9 Sample',
                'abbreviation' => 'ORG9S',
            ],
            [
                'college_id' => rand(1, 6),
                'organization' => 'Organization 10 Sample',
                'abbreviation' => 'ORG10S',
            ],
            [
                'college_id' => rand(1, 6),
                'organization' => 'Organization 11 Sample',
                'abbreviation' => 'ORG11S',
            ],
        ];

        foreach($data as $org) {
            Organization::create($org);
        }
    }
}
