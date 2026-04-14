<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\SettingsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SettingController extends Controller
{
    private array $groups = [
        'general'   => ['label' => 'General',          'icon' => 'fas fa-info-circle'],
        'branding'  => ['label' => 'Branding & Colors', 'icon' => 'fas fa-palette'],
        'contact'   => ['label' => 'Contact Info',      'icon' => 'fas fa-phone'],
        'social'    => ['label' => 'Social Media',      'icon' => 'fas fa-share-alt'],
        'footer'    => ['label' => 'Footer',            'icon' => 'fas fa-align-bottom'],
        'seo'       => ['label' => 'SEO',               'icon' => 'fas fa-search'],
        'analytics' => ['label' => 'Analytics',         'icon' => 'fas fa-chart-line'],
        'email'     => ['label' => 'Email',             'icon' => 'fas fa-envelope'],
        'hero'      => ['label' => 'Hero Section',      'icon' => 'fas fa-film'],
        'about'     => ['label' => 'About Section',     'icon' => 'fas fa-info'],
    ];

    public function __construct(private SettingsService $settingsService) {}

    public function index()
    {
        return redirect()->route('admin.settings.group', 'general');
    }

    public function group(string $group)
    {
        abort_unless(array_key_exists($group, $this->groups), 404);

        $settings = $this->settingsService->getGroup($group);
        $groups   = $this->groups;

        return view('admin.settings.index', compact('settings', 'group', 'groups'));
    }

    public function update(Request $request)
    {
        $group = $request->input('group', 'general');

        abort_unless(array_key_exists($group, $this->groups), 404);

        // Handle sitemap.xml upload
        if ($request->hasFile('sitemap_file')) {
            $request->validate(['sitemap_file' => 'file|mimes:xml,txt|max:2048']);
            $request->file('sitemap_file')->move(public_path(), 'sitemap.xml');
        }

        // Handle robots.txt upload
        if ($request->hasFile('robots_file')) {
            $request->validate(['robots_file' => 'file|mimes:txt|max:512']);
            $request->file('robots_file')->move(public_path(), 'robots.txt');
        }

        $this->settingsService->updateGroup(
            $group,
            $request->except(['_token', '_method', 'group', 'sitemap_file', 'robots_file']),
            $request->allFiles()
        );

        return back()->with('success', ucfirst($group) . ' settings saved successfully.');
    }
}
