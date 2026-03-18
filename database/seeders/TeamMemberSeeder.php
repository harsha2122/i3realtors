<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Domains\Services\Models\TeamMember;

class TeamMemberSeeder extends Seeder
{
    public function run(): void
    {
        $members = [
            [
                'first_name'   => 'Ankit',
                'last_name'    => 'Nigam',
                'position'     => 'Founder & Managing Director',
                'department'   => 'Leadership',
                'bio'          => '14+ years of experience in real estate builder relations and mandate partnerships. Worked with leading developers like Shapoorji Pallonji, Puranik, and Gagan Developers. 1.1 Million Sq.ft sold | ₹770+ Cr business value.',
                'email'        => 'ankit@i3realtors.com',
                'linkedin_url' => null,
                'status'       => 'active',
                'order'        => 1,
                'joining_date' => '2018-01-01',
            ],
            [
                'first_name'   => 'Pravin',
                'last_name'    => 'Kolte',
                'position'     => 'Director – Strategy',
                'department'   => 'Leadership',
                'bio'          => '14+ years of experience in real estate sales strategy and developer partnerships. Handled multiple residential and commercial mandates across Pune, Mumbai, and Raigad. 2.4 Million Sq.ft sold | ₹1700+ Cr business value.',
                'email'        => 'pravin@i3realtors.com',
                'linkedin_url' => null,
                'status'       => 'active',
                'order'        => 2,
                'joining_date' => '2018-01-01',
            ],
            [
                'first_name'   => 'Shrikant',
                'last_name'    => 'Potale',
                'position'     => 'Director – Sales & Marketing',
                'department'   => 'Leadership',
                'bio'          => '12+ years of experience in builder relations and sales execution. Worked with Kumar Properties, Kolte Patil, and Mantra. 1 Million Sq.ft sold | ₹600+ Cr business value.',
                'email'        => 'shrikant@i3realtors.com',
                'linkedin_url' => null,
                'status'       => 'active',
                'order'        => 3,
                'joining_date' => '2018-01-01',
            ],
        ];

        foreach ($members as $data) {
            TeamMember::firstOrCreate(['email' => $data['email']], $data);
        }
    }
}
