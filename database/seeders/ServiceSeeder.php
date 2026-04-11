<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            [
                'icon'        => 'fas fa-house-chimney',
                'title'       => 'Residential',
                'description' => 'End-to-end mandate management for residential projects — from launch positioning to sales execution and investor connect.',
                'order'       => 1,
            ],
            [
                'icon'        => 'fas fa-building',
                'title'       => 'Commercial',
                'description' => 'Commercial property sales advisory and mandate representation to maximise developer returns and buyer engagement.',
                'order'       => 2,
            ],
            [
                'icon'        => 'fas fa-store',
                'title'       => 'Retail',
                'description' => 'Retail space leasing, tenant mix strategy, and mandate services tailored to high-footfall commercial developments.',
                'order'       => 3,
            ],
            [
                'icon'        => 'fas fa-chart-line',
                'title'       => 'Investment Banking',
                'description' => 'Structured real estate investment solutions, deal syndication, and financial advisory for large-scale developments.',
                'order'       => 4,
            ],
            [
                'icon'        => 'fas fa-file-signature',
                'title'       => 'Commercial Leasing',
                'description' => 'Strategic leasing mandates for office spaces, warehouses, and retail units — negotiated for optimal occupancy and yield.',
                'order'       => 5,
            ],
            [
                'icon'        => 'fas fa-concierge-bell',
                'title'       => 'Hospitality',
                'description' => 'Hospitality real estate consulting, hotel project mandates, and investment advisory for premium leisure developments.',
                'order'       => 6,
            ],
            [
                'icon'        => 'fas fa-diagram-project',
                'title'       => 'Project Management',
                'description' => 'Complete project oversight from planning to delivery — coordinating timelines, resources, and stakeholder communication.',
                'order'       => 7,
            ],
            [
                'icon'        => 'fas fa-compass-drafting',
                'title'       => 'Designing',
                'description' => 'Architectural design consultation and interior planning to elevate project appeal and buyer experience.',
                'order'       => 8,
            ],
            [
                'icon'        => 'fas fa-bullhorn',
                'title'       => 'Branding',
                'description' => 'Developer and project branding, identity creation, and marketing collateral to build lasting market presence.',
                'order'       => 9,
            ],
            [
                'icon'        => 'fas fa-hand-holding-dollar',
                'title'       => 'Fund Raising',
                'description' => 'Real estate fund structuring, investor outreach, and capital raising services for developers and project promoters.',
                'order'       => 10,
            ],
        ];

        foreach ($services as $svc) {
            DB::table('services')->updateOrInsert(
                ['slug' => Str::slug($svc['title'])],
                array_merge($svc, [
                    'slug'       => Str::slug($svc['title']),
                    'status'     => 'active',
                    'created_at' => now(),
                    'updated_at' => now(),
                ])
            );
        }
    }
}
