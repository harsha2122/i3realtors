<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $jobs = [
            [
                'title'            => 'Sales Executive',
                'category'         => 'sales',
                'employment_type'  => 'Full-Time',
                'location'         => 'Pune',
                'experience'       => '1–3 Years',
                'description'      => 'Drive project sales through direct client engagement, investor outreach, and developer mandate presentations.',
                'responsibilities' => json_encode([
                    'Client acquisition and relationship management',
                    'Investor presentations and site visits',
                    'Pipeline management and deal closures',
                ]),
                'requirements'     => json_encode([
                    '1–3 years in real estate sales',
                    'Strong communication and negotiation skills',
                    'Knowledge of Pune real estate market',
                ]),
                'status'           => 'active',
                'sort_order'       => 1,
                'created_at'       => now(),
                'updated_at'       => now(),
            ],
            [
                'title'            => 'Marketing Executive',
                'category'         => 'marketing',
                'employment_type'  => 'Full-Time',
                'location'         => 'Pune',
                'experience'       => '1–3 Years',
                'description'      => 'Plan and execute digital and offline marketing campaigns for real estate projects under developer mandate partnerships.',
                'responsibilities' => json_encode([
                    'Project marketing strategy and execution',
                    'Digital campaigns, social media, and lead generation',
                    'Brand positioning and content creation',
                ]),
                'requirements'     => json_encode([
                    '1–3 years in real estate or digital marketing',
                    'Proficiency in social media and Google Ads',
                    'Creative thinking and analytical mindset',
                ]),
                'status'           => 'active',
                'sort_order'       => 2,
                'created_at'       => now(),
                'updated_at'       => now(),
            ],
            [
                'title'            => 'Pre-Sales Executive',
                'category'         => 'presales',
                'employment_type'  => 'Full-Time',
                'location'         => 'Pune',
                'experience'       => '0–2 Years',
                'description'      => 'Qualify leads, handle initial client inquiries, and support the sales team with project information and client coordination.',
                'responsibilities' => json_encode([
                    'Lead qualification and follow-up',
                    'Client communication and CRM management',
                    'Supporting sales team with project briefs',
                ]),
                'requirements'     => json_encode([
                    'Good communication skills in English and Hindi',
                    'Comfortable with CRM tools and Excel',
                    'Freshers with real estate interest welcome',
                ]),
                'status'           => 'active',
                'sort_order'       => 3,
                'created_at'       => now(),
                'updated_at'       => now(),
            ],
            [
                'title'            => 'Admin & Operations',
                'category'         => 'operations',
                'employment_type'  => 'Full-Time',
                'location'         => 'Pune',
                'experience'       => '1–3 Years',
                'description'      => 'Support day-to-day office operations, HR coordination, accounts, MIS reporting, and CRM management for the team.',
                'responsibilities' => json_encode([
                    'Office administration and HR support',
                    'Accounts, MIS, and reporting',
                    'CRM data management and coordination',
                ]),
                'requirements'     => json_encode([
                    '1–3 years in admin / back-office role',
                    'Proficiency in Excel and CRM tools',
                    'Organised, detail-oriented, and proactive',
                ]),
                'status'           => 'active',
                'sort_order'       => 4,
                'created_at'       => now(),
                'updated_at'       => now(),
            ],
        ];

        DB::table('career_jobs')->insert($jobs);
    }

    public function down(): void
    {
        DB::table('career_jobs')->truncate();
    }
};
