<?php

namespace App\Http\Controllers\Admin;

use App\Domains\Leads\Models\Form;
use App\Domains\Leads\Models\FormField;
use App\Domains\Leads\Services\FormService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FormController extends Controller
{
    public function __construct(
        private FormService $service,
    ) {}

    public function index()
    {
        $forms = Form::with('fields')->latest()->paginate(15);

        return view('admin.forms.index', compact('forms'));
    }

    public function create()
    {
        return view('admin.forms.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|unique:forms|max:255',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'success_message' => 'nullable|string',
            'redirect_url' => 'nullable|url',
            'notification_email' => 'nullable|email',
        ]);

        $form = $this->service->createForm($validated);

        return redirect()->route('admin.forms.edit', $form)
            ->with('success', 'Form created successfully');
    }

    public function edit(Form $form)
    {
        $form->load('fields');

        return view('admin.forms.edit', compact('form'));
    }

    public function update(Request $request, Form $form)
    {
        $validated = $request->validate([
            'name' => 'required|string|unique:forms,name,' . $form->id . '|max:255',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'success_message' => 'nullable|string',
            'redirect_url' => 'nullable|url',
            'notification_email' => 'nullable|email',
            'is_active' => 'nullable|boolean',
        ]);

        $this->service->updateForm($form, $validated);

        return redirect()->back()->with('success', 'Form updated successfully');
    }

    public function destroy(Form $form)
    {
        $this->service->deleteForm($form);

        return redirect()->route('admin.forms.index')
            ->with('success', 'Form deleted successfully');
    }

    public function addField(Request $request, Form $form)
    {
        $validated = $request->validate([
            'label' => 'required|string',
            'name' => 'required|string',
            'type' => 'required|in:text,email,phone,textarea,select,checkbox,radio,date',
            'placeholder' => 'nullable|string',
            'required' => 'nullable|boolean',
            'options' => 'nullable|json',
        ]);

        $this->service->addField($form, $validated);

        return redirect()->back()->with('success', 'Field added successfully');
    }

    public function updateField(Request $request, FormField $field)
    {
        $validated = $request->validate([
            'label' => 'required|string',
            'name' => 'required|string',
            'type' => 'required|in:text,email,phone,textarea,select,checkbox,radio,date',
            'placeholder' => 'nullable|string',
            'required' => 'nullable|boolean',
            'options' => 'nullable|json',
        ]);

        $this->service->updateField($field, $validated);

        return redirect()->back()->with('success', 'Field updated successfully');
    }

    public function deleteField(FormField $field)
    {
        $form = $field->form;
        $this->service->deleteField($field);

        return redirect()->back()->with('success', 'Field deleted successfully');
    }

    public function reorder(Request $request, Form $form)
    {
        $this->service->reorderFields($form, $request->input('order', []));

        return response()->json(['success' => true]);
    }

    public function submissions(Form $form)
    {
        $submissions = $form->submissions()->latest()->paginate(15);

        return view('admin.forms.submissions', compact('form', 'submissions'));
    }

    public function exportSubmissions(Form $form)
    {
        $submissions = $form->submissions()->get();
        $fields = $form->fields()->orderBy('order')->pluck('name')->toArray();

        $csv = implode(',', $fields) . "\n";

        foreach ($submissions as $submission) {
            $row = [];
            foreach ($fields as $field) {
                $row[] = '"' . ($submission->data[$field] ?? '') . '"';
            }
            $csv .= implode(',', $row) . "\n";
        }

        return response($csv, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $form->name . '_submissions.csv"',
        ]);
    }
}
