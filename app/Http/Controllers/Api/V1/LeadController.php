<?php

namespace App\Http\Controllers\Api\V1;

use App\Domains\Leads\Models\Form;
use App\Domains\Leads\Services\FormService;
use App\Domains\Leads\Services\LeadService;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LeadController extends Controller
{
    public function __construct(
        private FormService $formService,
        private LeadService $leadService,
    ) {}

    public function submitContactForm(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'nullable|string',
            'message' => 'required|string',
            'g-recaptcha-response' => 'nullable|string',
        ]);

        $lead = $this->leadService->createLead([
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
            'source' => 'contact_form',
            'notes' => $validated['message'],
        ]);

        return response()->json([
            'message' => 'Your message has been sent successfully',
            'lead_id' => $lead->id,
        ], 201);
    }

    public function submitPropertyInquiry(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'nullable|string',
            'inquiry_type' => 'required|string',
            'message' => 'nullable|string',
            'property_id' => 'required|exists:properties,id',
        ]);

        $lead = $this->leadService->createLead([
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
            'source' => 'property_inquiry',
            'property_id' => $validated['property_id'],
            'notes' => "Inquiry Type: {$validated['inquiry_type']}\n\n{$validated['message']}",
        ]);

        return response()->json([
            'message' => 'Your inquiry has been received',
            'lead_id' => $lead->id,
        ], 201);
    }

    public function submitForm(Request $request, Form $form): JsonResponse
    {
        if (!$form->is_active) {
            return response()->json(['error' => 'Form is not available'], 404);
        }

        $rules = $this->formService->validateFormSubmission($form, $request->all());
        $validated = $request->validate($rules);

        $submission = $this->formService->submitForm($form, $validated);

        return response()->json([
            'message' => $form->success_message ?? 'Thank you for your submission!',
            'redirect_url' => $form->redirect_url,
        ], 201);
    }

    public function newsletterSubscribe(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'email' => 'required|email',
        ]);

        $existing = \App\Models\NewsletterSubscriber::where('email', $validated['email'])->first();

        if ($existing) {
            return response()->json(['message' => 'You are already subscribed'], 200);
        }

        \App\Models\NewsletterSubscriber::create([
            'email' => $validated['email'],
            'verified_at' => now(),
        ]);

        return response()->json([
            'message' => 'You have been subscribed to our newsletter',
        ], 201);
    }
}
