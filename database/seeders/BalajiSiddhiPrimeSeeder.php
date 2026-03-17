<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\ProjectImage;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class BalajiSiddhiPrimeSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::first();

        // ── Copy placeholder images to storage (if not already present) ───
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

        // ── Build full description with all project details ───────────────
        $description = <<<'DESC'
Balaji Siddhi Prime is a thoughtfully designed residential project located in Narhe, Pune, offering spacious 1 BHK and 2 BHK homes built for comfortable modern living. Strategically positioned off the Mumbai–Bangalore Highway, the project provides excellent connectivity to major areas like Sinhgad Road, Katraj, Swargate, and Pune city center.

Developed by Shree Siddhivinayak Developers, the project features well-planned layouts, quality construction, and modern lifestyle amenities including a clubhouse, gymnasium, landscaped garden, children's play area, and advanced security systems.

Balaji Siddhi Prime is surrounded by reputed schools, colleges, hospitals, and shopping destinations such as D-Mart, Abhiruchi Mall, and Navale Hospital, making it an ideal residential choice for families as well as a promising real estate investment opportunity in Pune.

**Pricing:** ₹45 Lakhs Onwards

**Unit Sizes:**
- 1 BHK: 490 sq.ft
- 2 BHK: 725 – 726 sq.ft

**Project Highlights:**
- Ready to Move Homes
- Located Off Mumbai–Bangalore Highway
- Spacious 1 & 2 BHK Layouts
- 1 BHK With Double Washroom Option
- Excellent Connectivity to Sinhgad Road & Katraj
- Close to Schools, Colleges, Hospitals & Retail Centers

**Amenities:**
Security Cabin at Main Entrance · CCTV Surveillance for Parking & Common Areas · Clubhouse · Gymnasium · Generator Backup · Fire Fighting System · Solar Water Heating System · Rain Water Harvesting · Landscaped Garden · Children's Play Area · Staff Sanitation Facility

**Nearby Landmarks:**

*Schools & Colleges*
- Orchids International School – 0.14 km
- Podar International School – 1.02 km
- Abhinav College – 0.96 km
- Sinhgad Institutes – 2.96 km
- JSPM Institutes – 3.03 km

*Retail & Entertainment*
- Excellaa Plaza – 0.08 km
- D-Mart – 1.07 km
- C'lai World – 1 km
- Rajiv Gandhi Zoo – 4 km
- Abhiruchi Mall – 3 km

*Hospitals*
- Navale Hospital – 1.01 km
- Bharati Vidyapeeth Hospital – 4.03 km
- Pulse Multispeciality – 2.05 km
- Aura Multispeciality – 2.09 km
DESC;

        // ── Create or update project ───────────────────────────────────────
        $project = Project::updateOrCreate(
            ['slug' => 'balaji-siddhi-prime-narhe-pune'],
            [
                'title'             => 'Balaji Siddhi Prime, Narhe Pune',
                'short_description' => 'Ready-to-move 1 & 2 BHK apartments near Mumbai–Bangalore Highway with modern amenities, excellent connectivity, and easy access to schools, hospitals, and shopping destinations.',
                'description'       => $description,
                'status'            => 'completed',
                'type'              => 'residential',
                'area'              => 490.00,
                'area_unit'         => 'sqft',
                'units'             => null,
                'floors'            => 13,
                'completion_year'   => null,
                'location'          => 'Near Babji Petrol Pump, Ambegaon BK, Mumbai–Katraj Bypass Highway',
                'city'              => 'Pune',
                'state'             => 'Maharashtra',
                'google_maps_url'   => 'https://www.google.com/maps/search/Balaji+Siddhi+Prime+Narhe+Pune',
                'thumbnail'         => 'projects/project-image-1.jpg',
                'meta_title'        => 'Balaji Siddhi Prime Narhe Pune | 1 & 2 BHK Apartments Near Mumbai Bangalore Highway',
                'meta_description'  => 'Balaji Siddhi Prime offers ready to move 1 & 2 BHK apartments in Narhe Pune with modern amenities, excellent connectivity to Sinhgad Road and Mumbai Bangalore Highway, and close proximity to schools, hospitals, and shopping centers.',
                'is_featured'       => false,
                'is_active'         => true,
                'sort_order'        => 2,
                'created_by'        => $admin?->id,
            ]
        );

        // ── Add gallery images (only if none exist for this project) ───────
        if ($project->images()->count() === 0) {
            $galleryImages = [
                ['image' => 'projects/project-image-1.jpg', 'caption' => 'Project Elevation',    'sort_order' => 0],
                ['image' => 'projects/project-image-2.jpg', 'caption' => 'Aerial View',           'sort_order' => 1],
                ['image' => 'projects/project-image-3.jpg', 'caption' => 'Master Layout',         'sort_order' => 2],
                ['image' => 'projects/project-image-4.jpg', 'caption' => 'Amenities',             'sort_order' => 3],
                ['image' => 'projects/project-image-1.jpg', 'caption' => '1 BHK Layout',          'sort_order' => 4],
                ['image' => 'projects/project-image-2.jpg', 'caption' => '2 BHK Layout',          'sort_order' => 5],
                ['image' => 'projects/project-image-3.jpg', 'caption' => 'Location Map',          'sort_order' => 6],
            ];

            foreach ($galleryImages as $img) {
                if (Storage::disk('public')->exists($img['image'])) {
                    ProjectImage::create([
                        'project_id' => $project->id,
                        'image'      => $img['image'],
                        'caption'    => $img['caption'],
                        'sort_order' => $img['sort_order'],
                    ]);
                }
            }
        }

        $this->command->info('Balaji Siddhi Prime seeded successfully.');
    }
}
