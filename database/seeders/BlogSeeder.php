<?php

namespace Database\Seeders;

use App\Domains\Blogs\Models\Category;
use App\Domains\Blogs\Models\Post;
use App\Domains\Blogs\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BlogSeeder extends Seeder
{
    public function run(): void
    {
        // Copy post images to storage/blog/
        $postImages = ['post-1.jpg', 'post-2.jpg', 'post-3.jpg'];
        foreach ($postImages as $img) {
            if (!Storage::disk('public')->exists('blog/' . $img)) {
                $srcPath = public_path('images/' . $img);
                if (file_exists($srcPath)) {
                    Storage::disk('public')->put('blog/' . $img, file_get_contents($srcPath));
                }
            }
        }

        $author = User::first();

        // Categories
        $categories = [
            ['name' => 'Market Insights',   'slug' => 'market-insights',   'description' => 'Latest trends and analysis from the real estate market.'],
            ['name' => 'Investment Tips',    'slug' => 'investment-tips',    'description' => 'Smart strategies for real estate investors.'],
            ['name' => 'Property News',      'slug' => 'property-news',      'description' => 'Breaking news and updates from the property sector.'],
            ['name' => 'Developer Stories',  'slug' => 'developer-stories',  'description' => 'Success stories and case studies from developers.'],
        ];

        foreach ($categories as $cat) {
            Category::firstOrCreate(['slug' => $cat['slug']], $cat);
        }

        // Tags
        $tagNames = ['Real Estate', 'Investment', 'Mumbai', 'Pune', 'Residential', 'Commercial', 'NRI', 'Luxury Homes', 'Affordable Housing', 'RERA'];
        $tags = [];
        foreach ($tagNames as $name) {
            $tags[$name] = Tag::firstOrCreate(['slug' => Str::slug($name)], ['name' => $name]);
        }

        $marketCat    = Category::where('slug', 'market-insights')->first();
        $investCat    = Category::where('slug', 'investment-tips')->first();
        $newsCat      = Category::where('slug', 'property-news')->first();
        $developerCat = Category::where('slug', 'developer-stories')->first();

        $posts = [
            [
                'title'          => 'Mumbai Real Estate Market: Trends to Watch in 2025',
                'slug'           => 'mumbai-real-estate-market-trends-2025',
                'featured_image' => 'blog/post-1.jpg',
                'excerpt'        => 'Mumbai\'s property market continues to evolve with new micro-markets emerging and infrastructure driving demand.',
                'content'        => '<p>Mumbai\'s real estate landscape is transforming rapidly. Key infrastructure projects like the metro expansion, coastal road, and the upcoming Navi Mumbai airport are reshaping demand across the city.</p><p>Mid-segment housing between ₹80 lakh to ₹1.5 crore continues to be the sweet spot, with developers focusing on this category to meet genuine end-user demand. Localities like Thane, Navi Mumbai, and the western suburbs are seeing robust absorption rates.</p><p>For investors, the commercial segment in BKC, Lower Parel, and Bandra continues to offer stable rental yields. Co-working spaces and managed offices are adding a new dimension to commercial real estate investment.</p><p>RERA compliance has improved buyer confidence significantly, with more transparent project timelines and delivery commitments from credible developers.</p>',
                'category_id'    => $marketCat?->id,
                'author_id'      => $author->id,
                'status'         => 'published',
                'published_at'   => now()->subDays(5),
                'tags'           => ['Real Estate', 'Mumbai', 'Investment'],
            ],
            [
                'title'          => 'Top 5 Strategies for NRI Real Estate Investment in India',
                'slug'           => 'top-strategies-nri-real-estate-investment-india',
                'featured_image' => 'blog/post-2.jpg',
                'excerpt'        => 'NRIs looking to invest in Indian real estate must understand regulatory frameworks, currency risks, and emerging opportunities.',
                'content'        => '<p>India remains one of the most attractive real estate markets for NRI investors, offering a combination of strong capital appreciation, rental income potential, and an emotional connect to the homeland.</p><p><strong>1. Understand FEMA Guidelines</strong><br>NRIs can purchase residential and commercial properties in India but are restricted from agricultural land. Repatriation rules must be clearly understood before committing capital.</p><p><strong>2. Focus on RERA-Registered Projects</strong><br>Only invest in projects registered under RERA to ensure legal protection and timely delivery. Always verify the project\'s RERA registration number on the official state portal.</p><p><strong>3. Leverage the Currency Advantage</strong><br>A favorable USD/INR or AED/INR exchange rate can effectively reduce your acquisition cost by 10–15%, making high-value properties more accessible.</p><p><strong>4. Prefer Established Developers</strong><br>Track record matters. Look for developers with at least 5 completed projects and clean financial histories.</p><p><strong>5. Work with Mandated Real Estate Advisors</strong><br>Engaging a RERA-registered advisor with a strong developer network ensures you access exclusive inventory and get unbiased guidance.</p>',
                'category_id'    => $investCat?->id,
                'author_id'      => $author->id,
                'status'         => 'published',
                'published_at'   => now()->subDays(12),
                'tags'           => ['NRI', 'Investment', 'Real Estate'],
            ],
            [
                'title'          => 'RERA Amendment 2025: What Buyers and Developers Need to Know',
                'slug'           => 'rera-amendment-2025-buyers-developers',
                'featured_image' => 'blog/post-3.jpg',
                'excerpt'        => 'The latest RERA amendments bring stronger buyer protections and new compliance requirements for developers.',
                'content'        => '<p>The Real Estate (Regulation and Development) Act continues to evolve as regulators strengthen buyer protections and tighten compliance norms for developers across India.</p><p>Key highlights of the 2025 amendments include stricter penalties for project delays, mandatory escrow account audits every quarter, and enhanced disclosure requirements for project financials.</p><p>For buyers, the amendments mean greater transparency in project timelines and stronger legal recourse in case of developer defaults. The mandatory upload of construction progress photographs every 90 days provides real-time visibility into project status.</p><p>Developers who proactively comply will benefit from increased buyer trust and faster project approvals. Those with established track records will find it easier to attract both retail buyers and institutional investors.</p>',
                'category_id'    => $newsCat?->id,
                'author_id'      => $author->id,
                'status'         => 'published',
                'published_at'   => now()->subDays(18),
                'tags'           => ['Real Estate', 'RERA'],
            ],
            [
                'title'          => 'Affordable Housing in Pune: Opportunities for First-Time Buyers',
                'slug'           => 'affordable-housing-pune-first-time-buyers',
                'featured_image' => 'blog/post-1.jpg',
                'excerpt'        => 'Pune\'s affordable housing segment offers first-time buyers excellent value in well-connected corridors.',
                'content'        => '<p>Pune has emerged as one of India\'s most vibrant real estate markets, particularly for the affordable and mid-income housing segments. With a young, growing workforce from the IT and manufacturing sectors, demand for quality homes in the ₹35–65 lakh range continues to outpace supply.</p><p>Corridors like Hinjewadi, Wakad, Undri, and Wagholi are offering excellent value with proximity to employment hubs, improving social infrastructure, and good connectivity.</p><p>Under the Pradhan Mantri Awas Yojana (PMAY), first-time homebuyers can avail interest subsidies of up to ₹2.67 lakh, making the effective cost of ownership significantly lower.</p><p>Key tips for first-time buyers: fix your budget including stamp duty and registration costs, get pre-approved for a home loan, verify the RERA registration, and engage a trusted advisor to shortlist projects.</p>',
                'category_id'    => $investCat?->id,
                'author_id'      => $author->id,
                'status'         => 'published',
                'published_at'   => now()->subDays(25),
                'tags'           => ['Affordable Housing', 'Pune', 'Residential'],
            ],
            [
                'title'          => 'Commercial Real Estate: Why Managed Offices Are Gaining Traction',
                'slug'           => 'commercial-real-estate-managed-offices-gaining-traction',
                'featured_image' => 'blog/post-2.jpg',
                'excerpt'        => 'Managed office spaces are redefining how corporates and startups think about real estate in tier-1 and tier-2 cities.',
                'content'        => '<p>The commercial real estate landscape has shifted dramatically. Traditional long-term office leases are giving way to flexible, managed office solutions that offer businesses agility without sacrificing quality of space.</p><p>Managed offices — also called Grade A flex spaces — typically offer fully furnished turnkey offices with amenities, IT infrastructure, and facilities management included in a single monthly fee. This model has found takers across startups, MNCs looking to scale quickly, and enterprises downsizing their permanent office footprint.</p><p>For investors, managed office REITs and fractional ownership platforms are providing access to institutional-grade commercial assets at lower ticket sizes, democratizing access to premium commercial real estate.</p><p>Cities like Hyderabad, Bengaluru, and Pune are seeing the strongest demand, driven by tech companies and the growing startup ecosystem.</p>',
                'category_id'    => $marketCat?->id,
                'author_id'      => $author->id,
                'status'         => 'published',
                'published_at'   => now()->subDays(32),
                'tags'           => ['Commercial', 'Investment', 'Real Estate'],
            ],
            [
                'title'          => 'How i3 Realtors Helped a Developer Sell 80% of Inventory Pre-Launch',
                'slug'           => 'i3-realtors-helped-developer-sell-80-percent-pre-launch',
                'featured_image' => 'blog/post-3.jpg',
                'excerpt'        => 'A case study on how strategic channel partnerships and investor network activation drove exceptional pre-launch sales.',
                'content'        => '<p>When a leading Pune developer approached i3 Realtors with a mandate for a 200-unit residential project, the brief was clear: maximize pre-launch sales velocity while maintaining healthy price discovery.</p><p>Our approach combined three pillars: targeted investor outreach through our 500+ investor network, a curated developer-buyer conclave for exclusive pre-launches, and a digital-first marketing strategy targeting NRI buyers in the UAE and UK.</p><p>Within 45 days of soft launch, 160 units (80% of inventory) were booked at prices 8% above initial project pricing, validating the demand for quality inventory in that micro-market.</p><p>The project\'s success reinforced our mandate-first approach: by working exclusively with credible developers on clearly defined terms, we deliver consistent outcomes for both developers and investors.</p>',
                'category_id'    => $developerCat?->id,
                'author_id'      => $author->id,
                'status'         => 'published',
                'published_at'   => now()->subDays(40),
                'tags'           => ['Real Estate', 'Investment', 'Mumbai'],
            ],
        ];

        foreach ($posts as $postData) {
            $postTags = $postData['tags'];
            unset($postData['tags']);

            $post = Post::firstOrCreate(
                ['slug' => $postData['slug']],
                $postData
            );

            // Attach tags
            $tagIds = collect($postTags)
                ->map(fn($name) => $tags[$name]?->id)
                ->filter()
                ->toArray();

            $post->tags()->syncWithoutDetaching($tagIds);
        }
    }
}
