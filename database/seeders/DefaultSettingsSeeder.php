<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class DefaultSettingsSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            // General
            ['key' => 'site_name',        'value' => 'i3Realtors',         'type' => 'string', 'group' => 'general',   'label' => 'Site Name',          'is_public' => true],
            ['key' => 'site_tagline',     'value' => 'Building Trust. Creating Value.', 'type' => 'string', 'group' => 'general', 'label' => 'Site Tagline', 'is_public' => true],
            ['key' => 'site_description', 'value' => 'We are trusted builders and developers delivering modern, high-quality residential and commercial construction solutions.', 'type' => 'string', 'group' => 'general', 'label' => 'Site Description', 'is_public' => true],

            // Branding
            ['key' => 'logo',             'value' => '',                   'type' => 'string', 'group' => 'branding',  'label' => 'Header Logo',         'is_public' => true],
            ['key' => 'logo_white',       'value' => '',                   'type' => 'string', 'group' => 'branding',  'label' => 'White Logo (Footer)', 'is_public' => true],
            ['key' => 'favicon',          'value' => '',                   'type' => 'string', 'group' => 'branding',  'label' => 'Favicon',             'is_public' => true],
            ['key' => 'primary_color',    'value' => '#b8962b',            'type' => 'string', 'group' => 'branding',  'label' => 'Primary Color',       'is_public' => true],
            ['key' => 'secondary_color',  'value' => '#1a1a1a',            'type' => 'string', 'group' => 'branding',  'label' => 'Secondary Color',     'is_public' => true],

            // Contact
            ['key' => 'phone_primary',    'value' => '',                   'type' => 'string', 'group' => 'contact',   'label' => 'Primary Phone',       'is_public' => true],
            ['key' => 'phone_secondary',  'value' => '',                   'type' => 'string', 'group' => 'contact',   'label' => 'Secondary Phone',     'is_public' => true],
            ['key' => 'email_primary',    'value' => '',                   'type' => 'string', 'group' => 'contact',   'label' => 'Primary Email',       'is_public' => true],
            ['key' => 'address',          'value' => '',                   'type' => 'string', 'group' => 'contact',   'label' => 'Office Address',      'is_public' => true],
            ['key' => 'google_maps_url',  'value' => '',                   'type' => 'string', 'group' => 'contact',   'label' => 'Google Maps URL',     'is_public' => true],
            ['key' => 'business_hours',   'value' => 'Mon - Fri: 9am - 6pm', 'type' => 'string', 'group' => 'contact', 'label' => 'Business Hours',    'is_public' => true],

            // Social Media
            ['key' => 'social_facebook',  'value' => '',                   'type' => 'string', 'group' => 'social',    'label' => 'Facebook URL',        'is_public' => true],
            ['key' => 'social_twitter',   'value' => '',                   'type' => 'string', 'group' => 'social',    'label' => 'Twitter/X URL',       'is_public' => true],
            ['key' => 'social_instagram', 'value' => '',                   'type' => 'string', 'group' => 'social',    'label' => 'Instagram URL',       'is_public' => true],
            ['key' => 'social_linkedin',  'value' => '',                   'type' => 'string', 'group' => 'social',    'label' => 'LinkedIn URL',        'is_public' => true],
            ['key' => 'social_youtube',   'value' => '',                   'type' => 'string', 'group' => 'social',    'label' => 'YouTube URL',         'is_public' => true],
            ['key' => 'social_pinterest', 'value' => '',                   'type' => 'string', 'group' => 'social',    'label' => 'Pinterest URL',       'is_public' => true],

            // Footer
            ['key' => 'footer_about',     'value' => 'We are trusted builders and developers delivering modern, high-quality residential and commercial construction solutions.', 'type' => 'string', 'group' => 'footer', 'label' => 'Footer About Text', 'is_public' => true],
            ['key' => 'footer_copyright', 'value' => 'Copyright © 2025 i3Realtors. All Rights Reserved.', 'type' => 'string', 'group' => 'footer', 'label' => 'Copyright Text', 'is_public' => true],
            ['key' => 'footer_cta_title', 'value' => 'Begin your construction journey with trusted experts', 'type' => 'string', 'group' => 'footer', 'label' => 'Footer CTA Title', 'is_public' => true],

            // SEO
            ['key' => 'meta_title',       'value' => 'i3Realtors - Smart Real Estate & Reliable Construction', 'type' => 'string', 'group' => 'seo', 'label' => 'Default Meta Title', 'is_public' => false],
            ['key' => 'meta_description', 'value' => 'i3Realtors delivers modern, high-quality residential and commercial construction solutions with trust and integrity.', 'type' => 'string', 'group' => 'seo', 'label' => 'Default Meta Description', 'is_public' => false],
            ['key' => 'meta_keywords',    'value' => 'real estate, construction, property, realtors, residential, commercial', 'type' => 'string', 'group' => 'seo', 'label' => 'Default Meta Keywords', 'is_public' => false],

            // Analytics (private - contains tracking codes)
            ['key' => 'google_analytics', 'value' => '',                   'type' => 'string', 'group' => 'analytics', 'label' => 'Google Analytics ID', 'is_public' => false],
            ['key' => 'meta_pixel',       'value' => '',                   'type' => 'string', 'group' => 'analytics', 'label' => 'Meta Pixel ID',       'is_public' => false],

            // Email
            ['key' => 'mail_from_name',   'value' => 'i3Realtors',         'type' => 'string', 'group' => 'email',     'label' => 'Email From Name',     'is_public' => false],
            ['key' => 'mail_from_email',  'value' => '',                   'type' => 'string', 'group' => 'email',     'label' => 'Email From Address',  'is_public' => false],
            ['key' => 'admin_email',      'value' => '',                   'type' => 'string', 'group' => 'email',     'label' => 'Admin Notification Email', 'is_public' => false],
        ];

        foreach ($settings as $setting) {
            Setting::firstOrCreate(
                ['key' => $setting['key']],
                $setting
            );
        }
    }
}
