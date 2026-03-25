<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class HeroSettingsSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            [
                'key'         => 'hero_fluid_animation',
                'value'       => '1',
                'type'        => 'boolean',
                'group'       => 'hero',
                'label'       => 'Fluid Animation',
                'description' => 'Enable or disable the fluid/liquid animation in the hero background.',
                'is_public'   => false,
            ],
            [
                'key'         => 'hero_video_type',
                'value'       => 'none',
                'type'        => 'string',
                'group'       => 'hero',
                'label'       => 'Hero Video Type',
                'description' => 'Choose between no video, a YouTube link, or an uploaded video file.',
                'is_public'   => false,
            ],
            [
                'key'         => 'hero_video_url',
                'value'       => '',
                'type'        => 'string',
                'group'       => 'hero',
                'label'       => 'YouTube Video URL',
                'description' => 'Paste the full YouTube URL (e.g. https://www.youtube.com/watch?v=XXXXX). Used when video type is set to YouTube.',
                'is_public'   => false,
            ],
            [
                'key'         => 'hero_video_start',
                'value'       => '0',
                'type'        => 'integer',
                'group'       => 'hero',
                'label'       => 'Video Start Time (seconds)',
                'description' => 'Start playback at this many seconds into the video.',
                'is_public'   => false,
            ],
            [
                'key'         => 'hero_video_end',
                'value'       => '0',
                'type'        => 'integer',
                'group'       => 'hero',
                'label'       => 'Video End Time (seconds)',
                'description' => 'Stop playback at this many seconds (0 = play to the end).',
                'is_public'   => false,
            ],
            [
                'key'         => 'hero_video_file',
                'value'       => '',
                'type'        => 'file',
                'group'       => 'hero',
                'label'       => 'Upload Video File',
                'description' => 'Upload an MP4 video to use as the hero background. Used when video type is set to Upload.',
                'is_public'   => false,
            ],
        ];

        foreach ($settings as $data) {
            Setting::updateOrCreate(['key' => $data['key']], $data);
        }
    }
}
