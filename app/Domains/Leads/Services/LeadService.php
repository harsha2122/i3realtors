<?php

namespace App\Domains\Leads\Services;

use App\Domains\Leads\Models\Lead;
use App\Domains\Leads\Repositories\LeadRepository;

class LeadService
{
    public function __construct(
        private LeadRepository $repository,
    ) {}

    public function createLead(array $data): Lead
    {
        $lead = $this->repository->create($data);
        $lead->addInteraction('note', 'Lead created from ' . ($data['source'] ?? 'form'));

        return $lead;
    }

    public function updateLead(Lead $lead, array $data): Lead
    {
        $this->repository->update($lead, $data);
        return $lead->fresh();
    }

    public function deleteLead(Lead $lead): bool
    {
        return $this->repository->delete($lead);
    }

    public function assignLead(Lead $lead, int $userId): Lead
    {
        $this->repository->assign($lead, $userId);
        $lead->addInteraction('assignment', "Lead assigned to user {$userId}");

        return $lead->fresh();
    }

    public function unassignLead(Lead $lead): Lead
    {
        $this->repository->unassign($lead);
        $lead->addInteraction('assignment', 'Lead unassigned');

        return $lead->fresh();
    }

    public function updateLeadStatus(Lead $lead, string $status, ?int $userId = null): Lead
    {
        $lead->updateStatus($status, $userId);
        return $lead->fresh();
    }

    public function addNote(Lead $lead, string $note, ?int $userId = null): void
    {
        $lead->addNote($note, $userId);
    }

    public function convertToCustomer(Lead $lead): Lead
    {
        $lead->updateStatus('converted');
        return $lead->fresh();
    }

    public function getStats()
    {
        return $this->repository->getStats();
    }
}
