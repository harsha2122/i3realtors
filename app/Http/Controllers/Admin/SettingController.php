<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    private array $groups = [
        'general'  => ['label' => 'General',         'icon' => 'fas fa-info-circle'],
        'branding' => ['label' => 'Branding & Colors','icon' => 'fas fa-palette'],
        'contact'  => ['label' => 'Contact Info',    'icon' => 'fas fa-phone'],
        'social'   => ['label' => 'Social Media',    'icon' => 'fas fa-share-alt'],
        'footer'   => ['label' => 'Footer',          'icon' => 'fas fa-align-bottom'],
        'seo'      => ['label' => 'SEO',             'icon' => 'fas fa-search'],
        'analytics'=> ['label' => 'Analytics',       'icon' => 'fas fa-chart-line'],
        'email'    => ['label' => 'Email',           'icon' => 'fas fa-envelope'],
    ];

    public function index()
    {
        return redirect()->route('admin.settings.group', 'general');
    }

    public function group(string $group)
    {
        abort_unless(array_key_exists($group, $this->groups), 404);

        $settings = \App\Models\Setting::where('group', $group)->get()->keyBy('key');
        $groups   = $this->groups;

        return view('admin.settings.index', compact('settings', 'group', 'groups'));
    }

    public function update(Request $request)
    {
        $group = $request->input('group', 'general');

        $settings = \App\Models\Setting::where('group', $group)->get();

        foreach ($settings as $setting) {
            if ($request->has($setting->key)) {
                $value = $request->input($setting->key);

                // Handle file uploads
                if ($request->hasFile($setting->key)) {
                    $path  = $request->file($setting->key)->store("settings/{$group}", 'public');
                    $value = $path;
                }

                $setting->update(['value' => $value]);
            }
        }

        // Clear settings cache
        \App\Models\Setting::clearCache();

        return back()->with('success', ucfirst($group) . ' settings saved successfully.');
    }
}
