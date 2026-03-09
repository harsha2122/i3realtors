<?php

namespace App\Http\Controllers\Admin;

use App\Domains\Leads\Models\Lead;
use App\Domains\Leads\Repositories\LeadRepository;
use App\Domains\Leads\Services\LeadService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LeadController extends Controller
{
    public function __construct(
        private LeadRepository $repository,
        private LeadService $service,
    ) {}

    public function index()
    {
        $leads = $this->repository->all(15);
        $stats = $this->service->getStats();

        return view('admin.leads.index', compact('leads', 'stats'));
    }

    public function show(Lead $lead)
    {
        $lead->load('interactions.user');

        return view('admin.leads.show', compact('lead'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:leads',
            'phone' => 'nullable|string',
            'source' => 'required|string',
            'property_id' => 'nullable|exists:properties,id',
        ]);

        $lead = $this->service->createLead($validated);

        return redirect()->route('admin.leads.show', $lead)
            ->with('success', 'Lead created successfully');
    }

    public function update(Request $request, Lead $lead)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:leads,email,' . $lead->id,
            'phone' => 'nullable|string',
            'status' => 'required|in:new,contacted,qualified,negotiating,converted,lost',
            'assigned_to' => 'nullable|exists:users,id',
        ]);

        $this->service->updateLead($lead, $validated);

        return redirect()->back()->with('success', 'Lead updated successfully');
    }

    public function destroy(Lead $lead)
    {
        $this->service->deleteLead($lead);

        return redirect()->route('admin.leads.index')
            ->with('success', 'Lead deleted successfully');
    }

    public function addNote(Request $request, Lead $lead)
    {
        $validated = $request->validate([
            'note' => 'required|string',
        ]);

        $this->service->addNote($lead, $validated['note'], auth()->id());

        return redirect()->back()->with('success', 'Note added');
    }

    public function updateStatus(Request $request, Lead $lead)
    {
        $validated = $request->validate([
            'status' => 'required|in:new,contacted,qualified,negotiating,converted,lost',
        ]);

        $this->service->updateLeadStatus($lead, $validated['status'], auth()->id());

        return redirect()->back()->with('success', 'Status updated');
    }

    public function assign(Request $request, Lead $lead)
    {
        $validated = $request->validate([
            'assigned_to' => 'required|exists:users,id',
        ]);

        $this->service->assignLead($lead, $validated['assigned_to']);

        return redirect()->back()->with('success', 'Lead assigned');
    }

    public function bulkAction(Request $request)
    {
        $action = $request->input('action');
        $ids = $request->input('ids', []);

        $leads = Lead::whereIn('id', $ids)->get();

        foreach ($leads as $lead) {
            match ($action) {
                'convert' => $this->service->convertToCustomer($lead),
                'delete' => $this->service->deleteLead($lead),
                default => null,
            };
        }

        return redirect()->back()->with('success', "Action completed for " . count($leads) . " leads");
    }

    public function export()
    {
        $leads = Lead::all();
        $csv = "First Name,Last Name,Email,Phone,Source,Status\n";

        foreach ($leads as $lead) {
            $csv .= "\"{$lead->first_name}\",\"{$lead->last_name}\",\"{$lead->email}\",\"{$lead->phone}\",\"{$lead->source}\",\"{$lead->status}\"\n";
        }

        return response($csv, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="leads.csv"',
        ]);
    }
}
