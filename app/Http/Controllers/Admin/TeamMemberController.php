<?php

namespace App\Http\Controllers\Admin;

use App\Domains\Services\Models\TeamMember;
use App\Domains\Services\Models\TeamSkill;
use App\Domains\Services\Models\TeamSocial;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TeamMemberController extends Controller
{
    public function index()
    {
        $members = TeamMember::latest()->paginate(15);
        return view('admin.team.index', compact('members'));
    }

    public function create()
    {
        $skills = TeamSkill::all();
        $socials = TeamSocial::all();
        return view('admin.team.create', compact('skills', 'socials'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'position' => 'required|string',
            'department' => 'nullable|string',
            'bio' => 'nullable|string',
            'email' => 'required|email|unique:team_members',
            'phone' => 'nullable|string',
            'linkedin_url' => 'nullable|url',
            'profile_image' => 'nullable|image|max:2048',
            'joining_date' => 'nullable|date',
        ]);

        if ($request->hasFile('profile_image')) {
            $validated['profile_image'] = $request->file('profile_image')->store('team', 'public');
        }

        $member = TeamMember::create($validated);

        if ($request->has('skills')) {
            foreach ($request->input('skills') as $skillId => $proficiency) {
                $member->skills()->attach($skillId, ['proficiency' => $proficiency]);
            }
        }

        return redirect()->route('admin.team.show', $member)->with('success', 'Member created');
    }

    public function show(TeamMember $member)
    {
        $member->load('skills', 'socials');
        return view('admin.team.show', compact('member'));
    }

    public function edit(TeamMember $member)
    {
        $member->load('skills', 'socials');
        $skills = TeamSkill::all();
        $socials = TeamSocial::all();
        return view('admin.team.edit', compact('member', 'skills', 'socials'));
    }

    public function update(Request $request, TeamMember $member)
    {
        $validated = $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'position' => 'required|string',
            'department' => 'nullable|string',
            'bio' => 'nullable|string',
            'email' => 'required|email|unique:team_members,email,' . $member->id,
            'phone' => 'nullable|string',
            'linkedin_url' => 'nullable|url',
            'profile_image' => 'nullable|image|max:2048',
            'joining_date' => 'nullable|date',
        ]);

        if ($request->hasFile('profile_image')) {
            $validated['profile_image'] = $request->file('profile_image')->store('team', 'public');
        }

        $member->update($validated);
        return redirect()->back()->with('success', 'Member updated');
    }

    public function destroy(TeamMember $member)
    {
        $member->delete();
        return redirect()->back()->with('success', 'Member deleted');
    }
}
