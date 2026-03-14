<?php

namespace Database\Seeders;

use App\Models\Property;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PropertySeeder extends Seeder
{
    public function run(): void
    {
        // Copy project images to storage/properties/
        $projectImages = ['project-image-1.jpg', 'project-image-2.jpg', 'project-image-3.jpg', 'project-image-4.jpg'];
        foreach ($projectImages as $img) {
            if (!Storage::disk('public')->exists('properties/' . $img)) {
                $srcPath = public_path('images/' . $img);
                if (file_exists($srcPath)) {
                    Storage::disk('public')->put('properties/' . $img, file_get_contents($srcPath));
                }
            }
        }

        $admin = User::first();

        $properties = [
            [
                'title'             => 'Skyline Residences, BKC',
                'slug'              => 'skyline-residences-bkc',
                'short_description' => 'Ultra-luxury 3 & 4 BHK residences in the heart of Bandra Kurla Complex.',
                'description'       => 'Skyline Residences redefines luxury living in Mumbai's most coveted business district. Offering meticulously designed 3 and 4 BHK homes with panoramic views of the BKC skyline, world-class amenities, and seamless connectivity to the city's commercial and entertainment hubs.',
                'price'             => 35000000,
                'price_type'        => 'fixed',
                'type'              => 'residential',
                'status'            => 'available',
                'area'              => 1850,
                'area_unit'         => 'sq ft',
                'bedrooms'          => 3,
                'bathrooms'         => 3,
                'floors'            => 42,
                'location'         => 'Bandra Kurla Complex',
                'city'              => 'Mumbai',
                'state'             => 'Maharashtra',
                'thumbnail'         => 'properties/project-image-1.jpg',
                'is_featured'       => true,
                'is_active'         => true,
                'sort_order'        => 1,
                'created_by'        => $admin->id,
            ],
            [
                'title'             => 'The Grand Parc, Juhu',
                'slug'              => 'the-grand-parc-juhu',
                'short_description' => 'Sea-facing luxury villas and penthouses in the exclusive Juhu neighbourhood.',
                'description'       => 'The Grand Parc offers an unparalleled living experience with private sea-facing villas and sky penthouses. Every home is crafted with premium Italian marble, smart home automation, and private terraces overlooking the Arabian Sea.',
                'price'             => 65000000,
                'price_type'        => 'fixed',
                'type'              => 'residential',
                'status'            => 'under_construction',
                'area'              => 3200,
                'area_unit'         => 'sq ft',
                'bedrooms'          => 4,
                'bathrooms'         => 4,
                'floors'            => 24,
                'location'         => 'Juhu Beach Road',
                'city'              => 'Mumbai',
                'state'             => 'Maharashtra',
                'thumbnail'         => 'properties/project-image-2.jpg',
                'is_featured'       => true,
                'is_active'         => true,
                'sort_order'        => 2,
                'created_by'        => $admin->id,
            ],
            [
                'title'             => 'Emerald Business Park, Hinjewadi',
                'slug'              => 'emerald-business-park-hinjewadi',
                'short_description' => 'Grade A commercial offices and IT park in Pune\'s prime tech corridor.',
                'description'       => 'Emerald Business Park is a LEED Gold certified commercial development offering Grade A office spaces ranging from 500 sq ft to 50,000 sq ft. Strategically located in Hinjewadi Phase 2, it offers unmatched access to Pune's IT workforce and major tech campuses.',
                'price'             => 8500000,
                'price_type'        => 'fixed',
                'type'              => 'commercial',
                'status'            => 'available',
                'area'              => 1200,
                'area_unit'         => 'sq ft',
                'bedrooms'          => null,
                'bathrooms'         => null,
                'floors'            => 18,
                'location'         => 'Hinjewadi Phase 2',
                'city'              => 'Pune',
                'state'             => 'Maharashtra',
                'thumbnail'         => 'properties/project-image-3.jpg',
                'is_featured'       => false,
                'is_active'         => true,
                'sort_order'        => 3,
                'created_by'        => $admin->id,
            ],
            [
                'title'             => 'Urban Nest, Thane West',
                'slug'              => 'urban-nest-thane-west',
                'short_description' => 'Thoughtfully designed 1 & 2 BHK homes for modern urban families.',
                'description'       => 'Urban Nest brings affordable quality homes to Thane West with excellent metro connectivity, reputed schools nearby, and a vibrant social infrastructure. The project offers 1 and 2 BHK configurations with modular kitchens, premium fittings, and a well-designed clubhouse.',
                'price'             => 8500000,
                'price_type'        => 'fixed',
                'type'              => 'residential',
                'status'            => 'available',
                'area'              => 680,
                'area_unit'         => 'sq ft',
                'bedrooms'          => 2,
                'bathrooms'         => 2,
                'floors'            => 28,
                'location'         => 'Thane West, Kolshet Road',
                'city'              => 'Thane',
                'state'             => 'Maharashtra',
                'thumbnail'         => 'properties/project-image-4.jpg',
                'is_featured'       => false,
                'is_active'         => true,
                'sort_order'        => 4,
                'created_by'        => $admin->id,
            ],
            [
                'title'             => 'Horizon Plots, Navi Mumbai',
                'slug'              => 'horizon-plots-navi-mumbai',
                'short_description' => 'Prime residential plots near the upcoming Navi Mumbai International Airport.',
                'description'       => 'Horizon Plots offers a rare opportunity to own CIDCO-approved residential plots in one of the fastest appreciating corridors of Navi Mumbai. With the international airport set to commence operations and strong infrastructure development underway, these plots offer exceptional long-term capital appreciation potential.',
                'price'             => 6500000,
                'price_label'       => 'Starting ₹65 Lakhs',
                'price_type'        => 'fixed',
                'type'              => 'plot',
                'status'            => 'available',
                'area'              => 1000,
                'area_unit'         => 'sq ft',
                'bedrooms'          => null,
                'bathrooms'         => null,
                'floors'            => null,
                'location'         => 'Ulwe, Navi Mumbai',
                'city'              => 'Navi Mumbai',
                'state'             => 'Maharashtra',
                'thumbnail'         => 'properties/project-image-1.jpg',
                'is_featured'       => true,
                'is_active'         => true,
                'sort_order'        => 5,
                'created_by'        => $admin->id,
            ],
            [
                'title'             => 'Prestige Logistics Hub, Bhiwandi',
                'slug'              => 'prestige-logistics-hub-bhiwandi',
                'short_description' => 'Grade A warehousing and logistics infrastructure in India\'s distribution capital.',
                'description'       => 'Prestige Logistics Hub provides plug-and-play warehousing solutions in Bhiwandi, India's largest logistics cluster. With 32-feet clear height, dock levellers, fire suppression systems, and 24/7 security, the facility caters to e-commerce, FMCG, and 3PL operators seeking efficient last-mile distribution.',
                'price'             => null,
                'price_label'       => 'Price on Request',
                'price_type'        => 'on_request',
                'type'              => 'industrial',
                'status'            => 'available',
                'area'              => 50000,
                'area_unit'         => 'sq ft',
                'bedrooms'          => null,
                'bathrooms'         => null,
                'floors'            => 2,
                'location'         => 'Bhiwandi, Thane District',
                'city'              => 'Bhiwandi',
                'state'             => 'Maharashtra',
                'thumbnail'         => 'properties/project-image-2.jpg',
                'is_featured'       => false,
                'is_active'         => true,
                'sort_order'        => 6,
                'created_by'        => $admin->id,
            ],
            [
                'title'             => 'The Meridian Tower, Lower Parel',
                'slug'              => 'the-meridian-tower-lower-parel',
                'short_description' => 'Premium commercial offices in Mumbai\'s most dynamic business district.',
                'description'       => 'The Meridian Tower is a landmark commercial development offering LEED Platinum certified Grade A office spaces in Lower Parel. With floor plates of 25,000 sq ft, panoramic city views, dedicated parking, and proximity to upscale hotels and restaurants, it is the preferred address for leading corporates.',
                'price'             => 25000000,
                'price_type'        => 'fixed',
                'type'              => 'commercial',
                'status'            => 'coming_soon',
                'area'              => 2500,
                'area_unit'         => 'sq ft',
                'bedrooms'          => null,
                'bathrooms'         => null,
                'floors'            => 35,
                'location'         => 'Lower Parel, Elphinstone Road',
                'city'              => 'Mumbai',
                'state'             => 'Maharashtra',
                'thumbnail'         => 'properties/project-image-3.jpg',
                'is_featured'       => true,
                'is_active'         => true,
                'sort_order'        => 7,
                'created_by'        => $admin->id,
            ],
            [
                'title'             => 'Serene Valley Villas, Lonavala',
                'slug'              => 'serene-valley-villas-lonavala',
                'short_description' => 'Exclusive weekend homes and investment villas in the Sahyadri foothills.',
                'description'       => 'Serene Valley Villas offers a collection of luxuriously appointed 3 and 4 BHK villas nestled in the Sahyadri mountain range near Lonavala. With private swimming pools, lush landscaped gardens, a clubhouse, and breathtaking valley views, these villas serve as both premium second homes and high-yield vacation rental investments.',
                'price'             => 22000000,
                'price_type'        => 'fixed',
                'type'              => 'residential',
                'status'            => 'available',
                'area'              => 2800,
                'area_unit'         => 'sq ft',
                'bedrooms'          => 3,
                'bathrooms'         => 3,
                'floors'            => 2,
                'location'         => 'Lonavala, Pune-Mumbai Expressway',
                'city'              => 'Lonavala',
                'state'             => 'Maharashtra',
                'thumbnail'         => 'properties/project-image-4.jpg',
                'is_featured'       => false,
                'is_active'         => true,
                'sort_order'        => 8,
                'created_by'        => $admin->id,
            ],
        ];

        foreach ($properties as $data) {
            Property::firstOrCreate(
                ['slug' => $data['slug']],
                $data
            );
        }
    }
}
