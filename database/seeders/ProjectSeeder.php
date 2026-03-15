<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\ProjectImage;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        // Copy project images to projects storage folder
        $sourceImages = [
            'project-image-1.jpg',
            'project-image-2.jpg',
            'project-image-3.jpg',
            'project-image-4.jpg',
        ];

        foreach ($sourceImages as $img) {
            if (!Storage::disk('public')->exists('projects/' . $img)) {
                $srcPath = public_path('images/' . $img);
                if (file_exists($srcPath)) {
                    Storage::disk('public')->put('projects/' . $img, file_get_contents($srcPath));
                }
            }
        }

        $admin = User::first();

        $projects = [
            // ── ONGOING ──────────────────────────────────────────────
            [
                'title'             => 'Skyline Heights, BKC',
                'slug'              => 'skyline-heights-bkc',
                'short_description' => 'Ultra-premium 3 & 4 BHK residences rising in the heart of Bandra Kurla Complex.',
                'description'       => "Skyline Heights is a landmark residential tower redefining luxury living in Mumbai's most coveted business district.\n\nOffering spacious 3 and 4 BHK homes with panoramic skyline views, premium Italian marble interiors, and world-class amenities including a rooftop sky deck, infinity pool, and a fully-equipped clubhouse.\n\nSeamless connectivity to the city's commercial and entertainment hubs makes this an ideal home for corporate professionals and investors alike.",
                'status'            => 'ongoing',
                'type'              => 'residential',
                'area'              => 185000,
                'area_unit'         => 'sq ft',
                'units'             => 280,
                'floors'            => 42,
                'completion_year'   => 2026,
                'location'          => 'Bandra Kurla Complex, G-Block',
                'city'              => 'Mumbai',
                'state'             => 'Maharashtra',
                'thumbnail'         => 'projects/project-image-1.jpg',
                'is_featured'       => true,
                'is_active'         => true,
                'sort_order'        => 1,
                'created_by'        => $admin->id,
            ],
            [
                'title'             => 'Emerald Business Park, Hinjewadi',
                'slug'              => 'emerald-business-park-hinjewadi',
                'short_description' => 'Grade A commercial offices and IT park in Pune\'s prime tech corridor.',
                'description'       => "Emerald Business Park is a LEED Gold certified commercial development offering Grade A office spaces ranging from 500 sq ft to 50,000 sq ft.\n\nStrategically located in Hinjewadi Phase 2, it offers unmatched access to Pune's IT workforce and major tech campuses.\n\nAmenities include dedicated parking, a food court, conference facilities, and 24/7 security — making it the preferred business address for leading corporates and startups.",
                'status'            => 'ongoing',
                'type'              => 'commercial',
                'area'              => 420000,
                'area_unit'         => 'sq ft',
                'units'             => null,
                'floors'            => 18,
                'completion_year'   => 2026,
                'location'          => 'Hinjewadi Phase 2',
                'city'              => 'Pune',
                'state'             => 'Maharashtra',
                'thumbnail'         => 'projects/project-image-2.jpg',
                'is_featured'       => true,
                'is_active'         => true,
                'sort_order'        => 2,
                'created_by'        => $admin->id,
            ],
            [
                'title'             => 'Urban Nest Phase II, Thane West',
                'slug'              => 'urban-nest-phase-2-thane-west',
                'short_description' => 'Smartly designed 1 & 2 BHK homes for modern urban families in Thane West.',
                'description'       => "Urban Nest Phase II continues the success of Phase I, bringing an additional 320 homes to Thane West with excellent metro connectivity.\n\nEach home comes with modular kitchens, premium fittings, and energy-efficient design. The project includes a well-designed clubhouse, outdoor sports courts, and a children's play area.\n\nReputed schools, hospitals, and shopping centers are all within a 5-minute radius.",
                'status'            => 'ongoing',
                'type'              => 'residential',
                'area'              => 68000,
                'area_unit'         => 'sq ft',
                'units'             => 320,
                'floors'            => 32,
                'completion_year'   => 2027,
                'location'          => 'Thane West, Kolshet Road',
                'city'              => 'Thane',
                'state'             => 'Maharashtra',
                'thumbnail'         => 'projects/project-image-3.jpg',
                'is_featured'       => false,
                'is_active'         => true,
                'sort_order'        => 3,
                'created_by'        => $admin->id,
            ],
            [
                'title'             => 'Prestige Logistics Hub Phase II, Bhiwandi',
                'slug'              => 'prestige-logistics-hub-phase-2-bhiwandi',
                'short_description' => 'Expanding Grade A warehousing in India\'s largest logistics cluster.',
                'description'       => "Building on the success of Phase I, Prestige Logistics Hub Phase II adds 1.2 million sq ft of state-of-the-art warehousing infrastructure in Bhiwandi.\n\nFeatures include 36-feet clear height, dock levellers, solar rooftop integration, fire suppression systems, and EV charging bays — designed for e-commerce, FMCG, and 3PL operators seeking next-generation distribution solutions.",
                'status'            => 'ongoing',
                'type'              => 'industrial',
                'area'              => 1200000,
                'area_unit'         => 'sq ft',
                'units'             => null,
                'floors'            => 2,
                'completion_year'   => 2026,
                'location'          => 'Bhiwandi, Thane District',
                'city'              => 'Bhiwandi',
                'state'             => 'Maharashtra',
                'thumbnail'         => 'projects/project-image-4.jpg',
                'is_featured'       => false,
                'is_active'         => true,
                'sort_order'        => 4,
                'created_by'        => $admin->id,
            ],

            // ── COMPLETED ─────────────────────────────────────────────
            [
                'title'             => 'The Grand Parc, Juhu',
                'slug'              => 'the-grand-parc-juhu',
                'short_description' => 'Sold-out sea-facing luxury villas and penthouses in the exclusive Juhu neighbourhood.',
                'description'       => "The Grand Parc stands as one of Mumbai's most successful luxury residential completions — a collection of sea-facing villas and sky penthouses in Juhu.\n\nEvery home was crafted with private sea-facing terraces, smart home automation, and premium Italian marble finishes. All 96 units were successfully sold prior to project completion, making it a landmark mandate delivery for i3 Realtors.",
                'status'            => 'completed',
                'type'              => 'residential',
                'area'              => 320000,
                'area_unit'         => 'sq ft',
                'units'             => 96,
                'floors'            => 24,
                'completion_year'   => 2024,
                'location'          => 'Juhu Beach Road',
                'city'              => 'Mumbai',
                'state'             => 'Maharashtra',
                'thumbnail'         => 'projects/project-image-2.jpg',
                'is_featured'       => true,
                'is_active'         => true,
                'sort_order'        => 5,
                'created_by'        => $admin->id,
            ],
            [
                'title'             => 'Serene Valley Villas, Lonavala',
                'slug'              => 'serene-valley-villas-lonavala',
                'short_description' => 'Fully sold luxury weekend homes and investment villas in the Sahyadri foothills.',
                'description'       => "Serene Valley Villas delivered a collection of 3 and 4 BHK villas nestled in the Sahyadri mountains near Lonavala — all successfully sold and handed over.\n\nEach villa features a private swimming pool, landscaped gardens, and breathtaking valley views. The project achieved 100% sales within 6 months of launch through the i3 Realtors mandate, generating strong returns for investors.",
                'status'            => 'completed',
                'type'              => 'residential',
                'area'              => 280000,
                'area_unit'         => 'sq ft',
                'units'             => 64,
                'floors'            => 2,
                'completion_year'   => 2023,
                'location'          => 'Lonavala, Pune-Mumbai Expressway',
                'city'              => 'Lonavala',
                'state'             => 'Maharashtra',
                'thumbnail'         => 'projects/project-image-4.jpg',
                'is_featured'       => false,
                'is_active'         => true,
                'sort_order'        => 6,
                'created_by'        => $admin->id,
            ],
            [
                'title'             => 'The Meridian Tower, Lower Parel',
                'slug'              => 'the-meridian-tower-lower-parel',
                'short_description' => 'LEED Platinum certified Grade A offices successfully sold in Mumbai\'s dynamic business district.',
                'description'       => "The Meridian Tower is a landmark commercial development in Lower Parel — now fully occupied and operational.\n\nWith floor plates of 25,000 sq ft, panoramic city views, and proximity to upscale hotels and restaurants, it has become the preferred address for leading corporates. i3 Realtors managed the full mandate sale of 8 floors, achieving above-market valuations.",
                'status'            => 'completed',
                'type'              => 'commercial',
                'area'              => 250000,
                'area_unit'         => 'sq ft',
                'units'             => null,
                'floors'            => 35,
                'completion_year'   => 2023,
                'location'          => 'Lower Parel, Elphinstone Road',
                'city'              => 'Mumbai',
                'state'             => 'Maharashtra',
                'thumbnail'         => 'projects/project-image-3.jpg',
                'is_featured'       => true,
                'is_active'         => true,
                'sort_order'        => 7,
                'created_by'        => $admin->id,
            ],
            [
                'title'             => 'Horizon Plots, Navi Mumbai',
                'slug'              => 'horizon-plots-navi-mumbai',
                'short_description' => 'CIDCO-approved residential plots near Navi Mumbai International Airport — all units sold.',
                'description'       => "Horizon Plots offered a rare opportunity to own CIDCO-approved residential plots in one of the fastest appreciating corridors of Navi Mumbai — near the upcoming international airport.\n\nAll 150 plots were sold within 4 months of launch. Buyers have already seen significant capital appreciation as airport-related infrastructure development accelerates in the area.",
                'status'            => 'completed',
                'type'              => 'infrastructure',
                'area'              => 150000,
                'area_unit'         => 'sq ft',
                'units'             => 150,
                'floors'            => null,
                'completion_year'   => 2022,
                'location'          => 'Ulwe, Navi Mumbai',
                'city'              => 'Navi Mumbai',
                'state'             => 'Maharashtra',
                'thumbnail'         => 'projects/project-image-1.jpg',
                'is_featured'       => false,
                'is_active'         => true,
                'sort_order'        => 8,
                'created_by'        => $admin->id,
            ],
        ];

        foreach ($projects as $data) {
            $project = Project::firstOrCreate(
                ['slug' => $data['slug']],
                $data
            );

            // Add a gallery image if none exist yet
            if ($project->wasRecentlyCreated && $project->images()->count() === 0) {
                // Use the next image in the rotation as a gallery image
                $galleryImgIndex = (($data['sort_order'] - 1) % 4) + 1;
                $galleryImg = "projects/project-image-{$galleryImgIndex}.jpg";
                if (Storage::disk('public')->exists($galleryImg)) {
                    ProjectImage::create([
                        'project_id' => $project->id,
                        'image'      => $galleryImg,
                        'sort_order' => 0,
                    ]);
                }
            }
        }
    }
}
