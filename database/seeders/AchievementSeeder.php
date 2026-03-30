<?php

namespace Database\Seeders;

use App\Models\Achievement;
use Illuminate\Database\Seeder;

class AchievementSeeder extends Seeder
{
    public function run(): void
    {
        $achievements = [
            [
                'title'           => 'OREE REALITY',
                'image'           => null, // upload via admin
                'units'           => '107',
                'sales_value'     => '100 Cr.',
                'sold_percentage' => '98%',
                'time_period'     => '3 Months',
                'location'        => 'Bavdhan (PMC)',
                'sort_order'      => 1,
                'is_active'       => true,
            ],
            [
                'title'           => 'OREE REALITY',
                'image'           => null,
                'units'           => '72',
                'sales_value'     => '90 Cr.',
                'sold_percentage' => '95%',
                'time_period'     => '3 Months',
                'location'        => 'Bavdhan (PMC)',
                'sort_order'      => 2,
                'is_active'       => true,
            ],
            [
                'title'           => 'OREE REALITY',
                'image'           => null,
                'units'           => '120',
                'sales_value'     => '90 Cr.',
                'sold_percentage' => '85%',
                'time_period'     => '4 Months',
                'location'        => 'Bhugaon (PMRDA)',
                'sort_order'      => 3,
                'is_active'       => true,
            ],
            [
                'title'           => 'SNEHA CONSTRUCTION',
                'image'           => null,
                'units'           => '70',
                'sales_value'     => '18 Cr.',
                'sold_percentage' => null,
                'time_period'     => null,
                'location'        => 'Donje (PMRDA)',
                'sort_order'      => 4,
                'is_active'       => true,
            ],
            [
                'title'           => 'OREE REALITY',
                'image'           => null,
                'units'           => '120',
                'sales_value'     => '90 Cr.',
                'sold_percentage' => null,
                'time_period'     => null,
                'location'        => 'Bhugaon (PMRDA)',
                'sort_order'      => 5,
                'is_active'       => true,
            ],
        ];

        foreach ($achievements as $data) {
            Achievement::create($data);
        }
    }
}
