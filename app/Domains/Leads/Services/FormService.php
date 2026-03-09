<?php

namespace App\Domains\Leads\Services;

use App\Domains\Leads\Models\Form;
use App\Domains\Leads\Models\FormField;
use App\Domains\Leads\Models\FormSubmission;

class FormService
{
    public function createForm(array $data): Form
    {
        return Form::create($data);
    }

    public function updateForm(Form $form, array $data): Form
    {
        $form->update($data);
        return $form->fresh();
    }

    public function deleteForm(Form $form): bool
    {
        return $form->delete();
    }

    public function addField(Form $form, array $fieldData): FormField
    {
        $fieldData['order'] = $form->fields()->count() + 1;
        return $form->fields()->create($fieldData);
    }

    public function updateField(FormField $field, array $data): FormField
    {
        $field->update($data);
        return $field->fresh();
    }

    public function deleteField(FormField $field): bool
    {
        return $field->delete();
    }

    public function reorderFields(Form $form, array $fieldOrders): void
    {
        foreach ($fieldOrders as $order => $fieldId) {
            FormField::find($fieldId)?->update(['order' => $order + 1]);
        }
    }

    public function submitForm(Form $form, array $data): FormSubmission
    {
        return $form->submissions()->create([
            'data' => $data,
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);
    }

    public function validateFormSubmission(Form $form, array $data): array
    {
        $rules = [];
        foreach ($form->fields as $field) {
            $fieldRules = [];
            if ($field->required) {
                $fieldRules[] = 'required';
            }

            if ($field->type === 'email') {
                $fieldRules[] = 'email';
            } elseif ($field->type === 'phone') {
                $fieldRules[] = 'regex:/^[0-9\s\-\+\(\)]+$/';
            } elseif ($field->type === 'date') {
                $fieldRules[] = 'date';
            }

            if ($field->validation_rules) {
                $fieldRules = array_merge($fieldRules, $field->validation_rules);
            }

            if (!empty($fieldRules)) {
                $rules[$field->name] = $fieldRules;
            }
        }

        return $rules;
    }

    public function getFormData(Form $form): array
    {
        return [
            'form' => $form,
            'fields' => $form->fields()->orderBy('order')->get(),
        ];
    }
}
