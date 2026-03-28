<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\ProjectImage;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        ProjectImage::query()->delete();
        Project::query()->delete();

        // Copy placeholder images to storage
        foreach (['project-image-1.jpg','project-image-2.jpg','project-image-3.jpg','project-image-4.jpg'] as $img) {
            if (!Storage::disk('public')->exists('projects/'.$img)) {
                $src = public_path('images/'.$img);
                if (file_exists($src)) {
                    Storage::disk('public')->put('projects/'.$img, file_get_contents($src));
                }
            }
        }

        $upcoming = [
            ['title' => 'Hingne',                      'area' => 950000],
            ['title' => 'Datta Nagar',                 'area' => 950000],
            ['title' => 'Singhad Road',                'area' => 230000],
            ['title' => 'Kharadi',                     'area' => 1050000],
            ['title' => 'Bavdhan',                     'area' => 950000],
            ['title' => 'Lokmanya Nagar',              'area' => 231000],
            ['title' => 'Kothrud 1 Vanaz',             'area' => 74000],
            ['title' => 'Kothrud 2 Model Colony',      'area' => 60000],
            ['title' => 'Kothrud 3 Chintamani Socity', 'area' => 950000],
            ['title' => 'Sahakar Nagar',               'area' => 200000],
            ['title' => 'Aundh',                       'area' => 31000],
            ['title' => 'Rambaug Colony',              'area' => 84000],
            ['title' => 'Kiwale',                      'area' => 960000],
            ['title' => 'Warje',                       'area' => 120000],
            ['title' => 'Archana Nagar',               'area' => 360000],
            ['title' => 'Alankar Talkies',             'area' => 110000],
        ];

        $ongoing = [
            ['title' => 'ShivToran',        'area' => 196510,  'sales_value' => '2,16,16,10,000'],
            ['title' => 'Valeentina',       'area' => 360000,  'sales_value' => '2,59,20,00,000'],
            ['title' => 'The Icon',         'area' => 82000,   'sales_value' => '82,00,00,000'],
            ['title' => 'Riviera Vista',    'area' => 103000,  'sales_value' => '1,08,15,00,000'],
            ['title' => 'Galaxy',           'area' => 129000,  'sales_value' => '92,88,00,000'],
            ['title' => 'Balaji Siddhi',    'area' => 55000,   'sales_value' => '35,75,00,000'],
            ['title' => 'Vrundavan',        'area' => 45000,   'sales_value' => '40,50,00,000'],
            ['title' => 'Redision Royal-R', 'area' => 411780,  'sales_value' => '2,67,65,70,000'],
            ['title' => 'Redision Royal-C', 'area' => 118300,  'sales_value' => '21,29,40,000'],
            ['title' => 'Cloud 51',         'area' => 101200,  'sales_value' => '79,44,20,000'],
        ];

        $completed = [
            ['title' => 'Donje',                 'area' => 34105,  'sales_value' => '10,91,36,000'],
            ['title' => 'Elegance Vega (Baner)',  'area' => 75464,  'sales_value' => '54,33,40,800'],
            ['title' => 'Cloud51 (A & B)',        'area' => 372668, 'sales_value' => '2,60,86,76,000'],
            ['title' => 'Cloud51 (Elevate)',      'area' => 148838, 'sales_value' => '1,11,62,85,000'],
            ['title' => 'Cloud51 (Ultimate)',     'area' => 143111, 'sales_value' => '1,11,19,72,470'],
            ['title' => 'Cloud 28',               'area' => 141023, 'sales_value' => '84,61,38,000'],
            ['title' => 'Golden Lake',            'area' => 96213,  'sales_value' => '60,61,41,900'],
        ];

        $order = 1;
        $imgs = ['projects/project-image-1.jpg','projects/project-image-2.jpg','projects/project-image-3.jpg','projects/project-image-4.jpg'];

        foreach ($upcoming as $p) {
            Project::create([
                'title'       => $p['title'],
                'slug'        => Str::slug($p['title'].'-'.$order),
                'status'      => 'upcoming',
                'type'        => 'residential',
                'area'        => $p['area'],
                'area_unit'   => 'sq ft',
                'city'        => 'Pune',
                'state'       => 'Maharashtra',
                'thumbnail'   => $imgs[($order - 1) % 4],
                'is_active'   => true,
                'is_featured' => false,
                'sort_order'  => $order++,
            ]);
        }

        foreach ($ongoing as $p) {
            Project::create([
                'title'             => $p['title'],
                'slug'              => Str::slug($p['title'].'-'.$order),
                'short_description' => 'Sales Value: ₹'.$p['sales_value'],
                'status'            => 'ongoing',
                'type'              => 'residential',
                'area'              => $p['area'],
                'area_unit'         => 'sq ft',
                'city'              => 'Pune',
                'state'             => 'Maharashtra',
                'thumbnail'         => $imgs[($order - 1) % 4],
                'is_active'         => true,
                'is_featured'       => true,
                'sort_order'        => $order++,
            ]);
        }

        foreach ($completed as $p) {
            Project::create([
                'title'             => $p['title'],
                'slug'              => Str::slug($p['title'].'-'.$order),
                'short_description' => 'Sales Value: ₹'.$p['sales_value'],
                'status'            => 'completed',
                'type'              => 'residential',
                'area'              => $p['area'],
                'area_unit'         => 'sq ft',
                'city'              => 'Pune',
                'state'             => 'Maharashtra',
                'thumbnail'         => $imgs[($order - 1) % 4],
                'is_active'         => true,
                'is_featured'       => false,
                'sort_order'        => $order++,
            ]);
        }

        $total = count($upcoming) + count($ongoing) + count($completed);
        $this->command->info("Seeded {$total} projects: ".count($upcoming)." upcoming, ".count($ongoing)." ongoing, ".count($completed)." completed.");
    }
}
