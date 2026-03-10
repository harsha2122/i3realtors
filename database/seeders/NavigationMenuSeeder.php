<?php

namespace Database\Seeders;

use App\Models\NavigationMenu;
use App\Models\NavigationItem;
use Illuminate\Database\Seeder;

class NavigationMenuSeeder extends Seeder
{
    public function run(): void
    {
        // Skip if header menu already exists
        if (NavigationMenu::where('slug', 'header-menu')->exists()) {
            return;
        }

        // Create Header Menu
        $headerMenu = NavigationMenu::create([
            'name' => 'Main Header Menu',
            'slug' => 'header-menu',
            'description' => 'Main navigation menu displayed in website header',
            'position' => 'header',
            'is_active' => true,
            'order' => 0,
        ]);

        // Header menu items
        NavigationItem::create([
            'menu_id' => $headerMenu->id,
            'label' => 'Home',
            'route_name' => 'home',
            'icon' => 'fa-home',
            'order' => 0,
            'is_visible' => true,
        ]);

        NavigationItem::create([
            'menu_id' => $headerMenu->id,
            'label' => 'About Us',
            'route_name' => 'about',
            'icon' => 'fa-info-circle',
            'order' => 1,
            'is_visible' => true,
        ]);

        NavigationItem::create([
            'menu_id' => $headerMenu->id,
            'label' => 'Services',
            'route_name' => 'services',
            'icon' => 'fa-briefcase',
            'order' => 2,
            'is_visible' => true,
        ]);

        $projectsItem = NavigationItem::create([
            'menu_id' => $headerMenu->id,
            'label' => 'Projects',
            'route_name' => 'projects.index',
            'icon' => 'fa-building',
            'order' => 3,
            'is_visible' => true,
        ]);

        NavigationItem::create([
            'menu_id' => $headerMenu->id,
            'label' => 'Blog',
            'route_name' => 'blog.index',
            'icon' => 'fa-newspaper',
            'order' => 4,
            'is_visible' => true,
        ]);

        NavigationItem::create([
            'menu_id' => $headerMenu->id,
            'label' => 'Our Team',
            'route_name' => 'team',
            'icon' => 'fa-users',
            'order' => 5,
            'is_visible' => true,
        ]);

        NavigationItem::create([
            'menu_id' => $headerMenu->id,
            'label' => 'Contact',
            'route_name' => 'contact',
            'icon' => 'fa-envelope',
            'order' => 6,
            'is_visible' => true,
        ]);

        // Create Footer Menu
        $footerMenu = NavigationMenu::create([
            'name' => 'Footer Menu',
            'slug' => 'footer-menu',
            'description' => 'Navigation menu displayed in website footer',
            'position' => 'footer',
            'is_active' => true,
            'order' => 1,
        ]);

        // Footer menu items
        NavigationItem::create([
            'menu_id' => $footerMenu->id,
            'label' => 'Home',
            'route_name' => 'home',
            'order' => 0,
            'is_visible' => true,
        ]);

        NavigationItem::create([
            'menu_id' => $footerMenu->id,
            'label' => 'About',
            'route_name' => 'about',
            'order' => 1,
            'is_visible' => true,
        ]);

        NavigationItem::create([
            'menu_id' => $footerMenu->id,
            'label' => 'Privacy Policy',
            'url' => '#',
            'order' => 2,
            'is_visible' => true,
        ]);

        NavigationItem::create([
            'menu_id' => $footerMenu->id,
            'label' => 'Terms of Service',
            'url' => '#',
            'order' => 3,
            'is_visible' => true,
        ]);

        // Create Mobile Menu
        $mobileMenu = NavigationMenu::create([
            'name' => 'Mobile Menu',
            'slug' => 'mobile-menu',
            'description' => 'Navigation menu for mobile devices',
            'position' => 'mobile',
            'is_active' => true,
            'order' => 2,
        ]);

        NavigationItem::create([
            'menu_id' => $mobileMenu->id,
            'label' => 'Home',
            'route_name' => 'home',
            'icon' => 'fa-home',
            'order' => 0,
            'is_visible' => true,
        ]);

        NavigationItem::create([
            'menu_id' => $mobileMenu->id,
            'label' => 'Properties',
            'route_name' => 'projects.index',
            'icon' => 'fa-building',
            'order' => 1,
            'is_visible' => true,
        ]);

        NavigationItem::create([
            'menu_id' => $mobileMenu->id,
            'label' => 'Contact',
            'route_name' => 'contact',
            'icon' => 'fa-phone',
            'order' => 2,
            'is_visible' => true,
        ]);
    }
}
