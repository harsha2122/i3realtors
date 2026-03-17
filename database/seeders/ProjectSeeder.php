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
        // ── Remove all existing project data ──────────────────────────
        ProjectImage::query()->delete();
        Project::query()->delete();

        // ── Copy placeholder images to storage ───────────────────────
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

            // ── 1. Cloud 51 Ultimate ─────────────────────────────────
            [
                'title'             => 'Cloud 51 Ultimate',
                'slug'              => 'cloud-51-ultimate',
                'short_description' => 'IGBC Gold-rated luxury 2 & 3 BHK residences in Central Bavdhan, Pune — starting ₹95 Lakhs.',
                'description'       => "Cloud 51 Ultimate by OREE Reality is a premium IGBC Gold-rated residential project in the heart of Central Bavdhan, Pune. Offering spacious 2 and 3 BHK homes ranging from 850 to 1,300 sq ft, starting at ₹95 Lakhs.\n\nThe project blends luxury living with sustainable design, featuring rooftop amenities, a resort-style swimming pool, a modern clubhouse, and a fully equipped gym. Enjoy morning walks along the dedicated jogging track or open-air evenings at the landscaped amphitheatre.\n\n**Highlights:** IGBC Gold Rated | Luxury Living | Rooftop Amenities\n\n**Amenities:** Swimming Pool · Clubhouse · Gym · Jogging Track · Amphitheatre\n\nCentrally located in Bavdhan, Cloud 51 Ultimate offers excellent connectivity to Pune's IT hubs, educational institutions, and retail centres — making it the ideal home for discerning buyers and investors.",
                'status'            => 'ongoing',
                'type'              => 'residential',
                'area'              => 850,
                'area_unit'         => 'sq ft',
                'units'             => null,
                'floors'            => null,
                'completion_year'   => null,
                'location'          => 'Central Bavdhan',
                'city'              => 'Pune',
                'state'             => 'Maharashtra',
                'thumbnail'         => 'projects/project-image-1.jpg',
                'meta_title'        => 'Cloud 51 Ultimate Bavdhan Pune | Luxury 2 & 3 BHK IGBC Gold Homes',
                'meta_description'  => 'IGBC Gold-rated luxury 2 & 3 BHK apartments in Central Bavdhan, Pune. Swimming pool, clubhouse, gym & rooftop amenities. Starting ₹95 Lakhs.',
                'is_featured'       => true,
                'is_active'         => true,
                'sort_order'        => 1,
                'created_by'        => $admin?->id,
            ],

            // ── 2. Elegance Vega ─────────────────────────────────────
            [
                'title'             => 'Elegance Vega',
                'slug'              => 'elegance-vega',
                'short_description' => 'Modern 2 BHK homes with commercial spaces on Baner Sus Road, Pune — starting ₹75 Lakhs.',
                'description'       => "Elegance Vega by Elegance Landmarks is a contemporary mixed-use development on the sought-after Baner Sus Road, Pune. Featuring well-designed 2 BHK homes ranging from 760 to 907 sq ft, starting at ₹75 Lakhs.\n\nThe project strikes a balance between residential comfort and commercial convenience, with integrated commercial spaces at the podium level — ideal for retail, offices, or service businesses.\n\n**Highlights:** Prime Baner Location | Commercial Spaces | Modern Design\n\n**Amenities:** Open Gym · Meditation Area · Kids Play Area · Walking Track\n\nSituated on Baner Sus Road, Elegance Vega offers seamless access to Baner, Balewadi, and Hinjewadi IT Park — making it a strong choice for professionals and end-users alike.",
                'status'            => 'ongoing',
                'type'              => 'mixed_use',
                'area'              => 760,
                'area_unit'         => 'sq ft',
                'units'             => null,
                'floors'            => null,
                'completion_year'   => null,
                'location'          => 'Baner Sus Road',
                'city'              => 'Pune',
                'state'             => 'Maharashtra',
                'thumbnail'         => 'projects/project-image-2.jpg',
                'meta_title'        => 'Elegance Vega Baner Pune | 2 BHK Homes & Commercial Spaces',
                'meta_description'  => 'Modern 2 BHK apartments with commercial spaces on Baner Sus Road, Pune. Open gym, kids play area & walking track. Starting ₹75 Lakhs.',
                'is_featured'       => true,
                'is_active'         => true,
                'sort_order'        => 2,
                'created_by'        => $admin?->id,
            ],

            // ── 3. Redision Royal ────────────────────────────────────
            [
                'title'             => 'Redision Royal',
                'slug'              => 'redision-royal',
                'short_description' => 'Spacious 2 & 3 BHK homes in Kondhwa, Pune by Charanraj Construction & Siddhi Group — starting ₹65 Lakhs.',
                'description'       => "Redision Royal is a premium residential project in Kondhwa, Pune — jointly developed by Charanraj Construction and Siddhi Group. Offering well-appointed 2 and 3 BHK homes ranging from 850 to 1,250 sq ft, starting at ₹65 Lakhs.\n\nDesigned for families seeking comfort and lifestyle, Redision Royal delivers a curated set of amenities including a fully equipped gym, a party lawn for celebrations, indoor games, a kids' area, and a dedicated walking track.\n\n**Amenities:** Gym · Party Lawn · Indoor Games · Kids Area · Walking Track\n\nKondhwa's established residential neighbourhood, good schools, hospitals, and retail infrastructure make this an attractive investment and a great place to call home.",
                'status'            => 'ongoing',
                'type'              => 'residential',
                'area'              => 850,
                'area_unit'         => 'sq ft',
                'units'             => null,
                'floors'            => null,
                'completion_year'   => null,
                'location'          => 'Kondhwa',
                'city'              => 'Pune',
                'state'             => 'Maharashtra',
                'thumbnail'         => 'projects/project-image-3.jpg',
                'meta_title'        => 'Redision Royal Kondhwa Pune | 2 & 3 BHK Homes',
                'meta_description'  => 'Spacious 2 & 3 BHK homes in Kondhwa, Pune by Charanraj Construction & Siddhi Group. Gym, party lawn & kids area. Starting ₹65 Lakhs.',
                'is_featured'       => false,
                'is_active'         => true,
                'sort_order'        => 3,
                'created_by'        => $admin?->id,
            ],

            // ── 4. Shivneri Torna ────────────────────────────────────
            [
                'title'             => 'Shivneri Torna',
                'slug'              => 'shivneri-torna',
                'short_description' => 'Spacious high-rise 2 & 3 BHK apartments in Pune by Prasad Deshpande Group — starting ₹85 Lakhs.',
                'description'       => "Shivneri Torna is a high-rise residential project by the reputed Prasad Deshpande Group, offering spacious 2 and 3 BHK homes ranging from 760 to 1,134 sq ft, starting at ₹85 Lakhs.\n\nWith well-planned layouts and quality construction, Shivneri Torna is built for those who value space, natural light, and thoughtful design. The project features landscaped common areas, ample parking, lifts, and round-the-clock security.\n\n**Highlights:** Spacious Homes | High-Rise Towers | Prime Location\n\n**Amenities:** Landscaped Areas · Parking · Lift · Security\n\nStrategically located in Pune with easy access to arterial roads, schools, hospitals, and commercial hubs — Shivneri Torna offers both lifestyle comfort and long-term investment value.",
                'status'            => 'ongoing',
                'type'              => 'residential',
                'area'              => 760,
                'area_unit'         => 'sq ft',
                'units'             => null,
                'floors'            => null,
                'completion_year'   => null,
                'location'          => 'Pune',
                'city'              => 'Pune',
                'state'             => 'Maharashtra',
                'thumbnail'         => 'projects/project-image-4.jpg',
                'meta_title'        => 'Shivneri Torna Pune | 2 & 3 BHK High-Rise Apartments',
                'meta_description'  => 'Spacious 2 & 3 BHK high-rise apartments in Pune by Prasad Deshpande Group. Landscaped areas, parking & security. Starting ₹85 Lakhs.',
                'is_featured'       => false,
                'is_active'         => true,
                'sort_order'        => 4,
                'created_by'        => $admin?->id,
            ],

            // ── 5. Valeentina Tower ──────────────────────────────────
            [
                'title'             => 'Valeentina Tower',
                'slug'              => 'valeentina-tower',
                'short_description' => 'Premium 2 & 3 BHK residences near Vadgaon Bridge, Pune by Chaandrai Construction — starting ₹75 Lakhs.',
                'description'       => "Valeentina Tower is a premium residential development by Chaandrai Construction, located near Vadgaon Bridge, Vadgaon BK, Pune. Offering 2 and 3 BHK homes ranging from 781 to 1,254 sq ft, starting at ₹75 Lakhs.\n\nDesigned for modern families, Valeentina Tower brings together spacious layouts, quality finishes, and a lifestyle-oriented amenity suite that includes a swimming pool, jogging track, open gym, and a basketball court. Children can enjoy dedicated play areas, and residents can unwind at the beautifully designed gazebo.\n\n**Highlights:** 2 & 3 BHK Homes | Prime Location | Spacious Layouts\n\n**Amenities:** Swimming Pool · Jogging Track · Open Gym · Kids Play Area · Basketball Court · Gazebo\n\nConveniently located near Vadgaon Bridge with easy access to Sinhagad Road, NH-48, schools, hospitals, and major retail centres.",
                'status'            => 'ongoing',
                'type'              => 'residential',
                'area'              => 781,
                'area_unit'         => 'sq ft',
                'units'             => null,
                'floors'            => null,
                'completion_year'   => null,
                'location'          => 'Near Vadgaon Bridge, Vadgaon BK',
                'city'              => 'Pune',
                'state'             => 'Maharashtra',
                'thumbnail'         => 'projects/project-image-1.jpg',
                'meta_title'        => 'Valeentina Tower Pune | 2 & 3 BHK Homes Vadgaon BK',
                'meta_description'  => 'Premium 2 & 3 BHK apartments near Vadgaon Bridge, Pune by Chaandrai Construction. Swimming pool, gym & sports amenities. Starting ₹75 Lakhs.',
                'is_featured'       => true,
                'is_active'         => true,
                'sort_order'        => 5,
                'created_by'        => $admin?->id,
            ],

            // ── 6. Chaandrai Vrundavan Biz Park ──────────────────────
            [
                'title'             => 'Chaandrai Vrundavan Biz Park',
                'slug'              => 'vrundavan-biz-park',
                'short_description' => 'Premium commercial office spaces and showrooms near Sinhagad Road, Pune — starting ₹65 Lakhs.',
                'description'       => "Chaandrai Vrundavan Biz Park by Chaandrai Construction is a thoughtfully designed commercial project near Sinhagad Road, Pune. Offering premium office spaces and showrooms ranging from 278 to 1,154 sq ft, starting at ₹65 Lakhs.\n\nThe project features a striking glass facade, modern infrastructure, and a curated range of business-grade amenities including a rooftop cafeteria, beverage counter, high-speed lifts, scooter lifts, digital lock washrooms, CCTV security, and a grand lobby.\n\n**Highlights:** Premium Commercial Offices & Showrooms | Glass Facade | Modern Infrastructure | Rooftop Cafeteria | High-Speed Lifts | Basement Parking\n\n**Amenities:** Rooftop Cafeteria · Beverage Counter · High-Speed Lifts · Scooter Lifts · Digital Lock Washrooms · CCTV Security · Lobby\n\n**Connectivity:** Katraj Chowk – 3.3 km · Swargate – 9.7 km · Pune Station – 13.9 km\n\nAn ideal address for businesses, professionals, and commercial investors seeking premium space in South Pune's growing corridor.",
                'status'            => 'ongoing',
                'type'              => 'commercial',
                'area'              => 278,
                'area_unit'         => 'sq ft',
                'units'             => null,
                'floors'            => null,
                'completion_year'   => null,
                'location'          => 'Near Sinhagad Road',
                'city'              => 'Pune',
                'state'             => 'Maharashtra',
                'thumbnail'         => 'projects/project-image-2.jpg',
                'meta_title'        => 'Chaandrai Vrundavan Biz Park Pune | Premium Office & Showroom Spaces',
                'meta_description'  => 'Premium commercial offices and showroom spaces near Sinhagad Road, Pune. Glass facade, rooftop cafeteria & modern infrastructure. Starting ₹65 Lakhs.',
                'is_featured'       => true,
                'is_active'         => true,
                'sort_order'        => 6,
                'created_by'        => $admin?->id,
            ],

        ];

        foreach ($projects as $data) {
            $project = Project::create($data);

            // Add one gallery image per project
            $imgIndex = (($data['sort_order'] - 1) % 4) + 1;
            $galleryImg = "projects/project-image-{$imgIndex}.jpg";
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
