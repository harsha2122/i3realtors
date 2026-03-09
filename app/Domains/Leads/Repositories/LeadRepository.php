<?php

namespace App\Domains\Leads\Repositories;

use App\Domains\Leads\Models\Lead;

class LeadRepository
{
    public function all(int $perPage = 15)
    {
        return Lead::with('assignedUser')
            ->latest()
            ->paginate($perPage);
    }

    public function byStatus(string $status, int $perPage = 15)
    {
        return Lead::byStatus($status)
            ->with('assignedUser')
            ->latest()
            ->paginate($perPage);
    }

    public function bySource(string $source, int $perPage = 15)
    {
        return Lead::bySource($source)
            ->with('assignedUser')
            ->latest()
            ->paginate($perPage);
    }

    public function thisMonth(int $perPage = 15)
    {
        return Lead::thisMonth()
            ->with('assignedUser')
            ->latest()
            ->paginate($perPage);
    }

    public function search(string $query, int $perPage = 15)
    {
        return Lead::where(function ($q) use ($query) {
            $q->where('first_name', 'like', "%{$query}%")
                ->orWhere('last_name', 'like', "%{$query}%")
                ->orWhere('email', 'like', "%{$query}%")
                ->orWhere('phone', 'like', "%{$query}%");
        })
            ->with('assignedUser')
            ->latest()
            ->paginate($perPage);
    }

    public function findById(int $id)
    {
        return Lead::with('interactions.user')->findOrFail($id);
    }

    public function create(array $data): Lead
    {
        return Lead::create($data);
    }

    public function update(Lead $lead, array $data): bool
    {
        return $lead->update($data);
    }

    public function delete(Lead $lead): bool
    {
        return $lead->delete();
    }

    public function assign(Lead $lead, int $userId): bool
    {
        return $lead->update(['assigned_to' => $userId]);
    }

    public function unassign(Lead $lead): bool
    {
        return $lead->update(['assigned_to' => null]);
    }

    public function getStats()
    {
        return [
            'total' => Lead::count(),
            'this_month' => Lead::thisMonth()->count(),
            'new' => Lead::byStatus('new')->count(),
            'contacted' => Lead::byStatus('contacted')->count(),
            'qualified' => Lead::byStatus('qualified')->count(),
            'converted' => Lead::byStatus('converted')->count(),
        ];
    }
}
