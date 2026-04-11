<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\CareerApplication;
use App\Models\CareerJob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CareersController extends Controller
{
    const HR_EMAIL = 'hr@i3realtors.com';

    public function index()
    {
        $jobs = CareerJob::active()->ordered()->get();
        return view('website.careers', compact('jobs'));
    }

    public function submit(Request $request)
    {
        $validated = $request->validate([
            'career_job_id'    => ['nullable', 'integer'],
            'job_title'        => ['required', 'string', 'max:255'],
            'full_name'        => ['required', 'string', 'max:100'],
            'email'            => ['required', 'email'],
            'phone'            => ['required', 'string', 'max:20'],
            'experience_years' => ['required', 'integer', 'min:0', 'max:50'],
            'cover_letter'     => ['nullable', 'string'],
            'resume'           => ['required', 'file', 'mimes:pdf', 'max:5120'],
        ]);

        // Store resume
        $resumePath    = null;
        $resumeAbsPath = null;
        if ($request->hasFile('resume')) {
            $file          = $request->file('resume');
            $filename      = time() . '_' . preg_replace('/[^a-z0-9]/i', '_', $validated['email']) . '.pdf';
            $resumePath    = Storage::disk('public')->putFileAs('resumes', $file, $filename);
            $resumeAbsPath = Storage::disk('public')->path($resumePath);
        }

        // Save to database
        CareerApplication::create([
            'career_job_id'    => $validated['career_job_id'] ?: null,
            'job_title'        => $validated['job_title'],
            'full_name'        => $validated['full_name'],
            'email'            => $validated['email'],
            'phone'            => $validated['phone'],
            'experience_years' => $validated['experience_years'],
            'cover_letter'     => $validated['cover_letter'] ?? null,
            'resume_path'      => $resumePath,
        ]);

        // Send email to HR
        $this->sendHrEmail($validated, $resumePath, $resumeAbsPath);

        return back()->with('success', 'Thank you for applying! We will review your application and get in touch.');
    }

    private function sendHrEmail(array $data, ?string $resumePath, ?string $resumeAbsPath): void
    {
        try {
            $to      = self::HR_EMAIL;
            $subject = 'New Career Application: ' . $data['job_title'] . ' — ' . $data['full_name'];

            $fromAddress = 'noreply@i3realtors.com';
            $fromName    = 'i3 Realtors Website';

            // ── Plain-text body ──────────────────────────────────────────
            $sep  = str_repeat('-', 52);
            $body = implode("\n", [
                "New career application received via i3realtors.com",
                $sep,
                "Position Applied : " . $data['job_title'],
                $sep,
                "Full Name        : " . $data['full_name'],
                "Email            : " . $data['email'],
                "Phone            : " . $data['phone'],
                "Experience       : " . $data['experience_years'] . " year(s)",
                $sep,
                "Cover Letter:",
                !empty($data['cover_letter']) ? $data['cover_letter'] : "(not provided)",
                $sep,
                "Resume: " . ($resumePath ? "Attached (see attachment)" : "Not uploaded"),
                $sep,
                "Submitted at: " . now()->format('d M Y, h:i A'),
            ]);

            // ── HTML body ────────────────────────────────────────────────
            $accent    = '#e05a00';
            $coverHtml = !empty($data['cover_letter'])
                ? nl2br(htmlspecialchars($data['cover_letter'], ENT_QUOTES, 'UTF-8'))
                : '<em style="color:#999;">Not provided</em>';

            $html = <<<HTML
<!DOCTYPE html>
<html>
<head><meta charset="UTF-8"></head>
<body style="margin:0;padding:0;background:#f4f4f4;font-family:Arial,sans-serif;">
<table width="100%" cellpadding="0" cellspacing="0" style="background:#f4f4f4;padding:30px 0;">
  <tr><td align="center">
    <table width="620" cellpadding="0" cellspacing="0" style="background:#ffffff;border-radius:10px;overflow:hidden;box-shadow:0 2px 8px rgba(0,0,0,0.08);">

      <!-- Header -->
      <tr><td style="background:{$accent};padding:28px 36px;">
        <h2 style="margin:0;color:#fff;font-size:22px;">New Career Application</h2>
        <p style="margin:6px 0 0;color:rgba(255,255,255,0.85);font-size:14px;">i3 Realtors — Careers Portal</p>
      </td></tr>

      <!-- Position banner -->
      <tr><td style="background:#fff8f5;padding:18px 36px;border-bottom:1px solid #f0e0d8;">
        <p style="margin:0;font-size:13px;color:#999;text-transform:uppercase;letter-spacing:1px;">Position Applied For</p>
        <p style="margin:4px 0 0;font-size:20px;font-weight:700;color:{$accent};">{$data['job_title']}</p>
      </td></tr>

      <!-- Details table -->
      <tr><td style="padding:28px 36px;">
        <table width="100%" cellpadding="8" cellspacing="0" style="border-collapse:collapse;font-size:14px;">
          <tr style="border-bottom:1px solid #f5f5f5;">
            <td style="width:38%;color:#888;font-weight:600;">Full Name</td>
            <td style="color:#222;">{$data['full_name']}</td>
          </tr>
          <tr style="border-bottom:1px solid #f5f5f5;">
            <td style="color:#888;font-weight:600;">Email</td>
            <td><a href="mailto:{$data['email']}" style="color:{$accent};">{$data['email']}</a></td>
          </tr>
          <tr style="border-bottom:1px solid #f5f5f5;">
            <td style="color:#888;font-weight:600;">Phone</td>
            <td style="color:#222;">{$data['phone']}</td>
          </tr>
          <tr style="border-bottom:1px solid #f5f5f5;">
            <td style="color:#888;font-weight:600;">Years of Experience</td>
            <td style="color:#222;">{$data['experience_years']} year(s)</td>
          </tr>
        </table>
      </td></tr>

      <!-- Cover Letter -->
      <tr><td style="padding:0 36px 28px;">
        <p style="margin:0 0 8px;font-weight:700;font-size:14px;color:#333;">Cover Letter</p>
        <div style="background:#f9f9f9;border-left:4px solid {$accent};border-radius:4px;padding:14px 18px;font-size:14px;color:#444;line-height:1.7;">{$coverHtml}</div>
      </td></tr>

      <!-- Resume note -->
      <tr><td style="padding:0 36px 28px;">
        <p style="margin:0;font-size:13px;color:#888;">
          <strong style="color:#333;">Resume:</strong>
          {$this->resumeNote($resumePath)}
        </p>
      </td></tr>

      <!-- Footer -->
      <tr><td style="background:#f9f9f9;padding:18px 36px;border-top:1px solid #eee;">
        <p style="margin:0;font-size:12px;color:#aaa;">This application was submitted on {$this->submittedAt()} via i3realtors.com. Log in to the admin panel to manage applications.</p>
      </td></tr>

    </table>
  </td></tr>
</table>
</body>
</html>
HTML;

            // ── Build headers & send ─────────────────────────────────────
            if ($resumeAbsPath && file_exists($resumeAbsPath)) {
                // Multipart/mixed with PDF attachment
                $boundary = 'i3r_boundary_' . md5(uniqid('', true));

                $headers  = "MIME-Version: 1.0\r\n";
                $headers .= "From: {$fromName} <{$fromAddress}>\r\n";
                $headers .= "Reply-To: {$data['full_name']} <{$data['email']}>\r\n";
                $headers .= "Content-Type: multipart/mixed; boundary=\"{$boundary}\"\r\n";
                $headers .= "X-Mailer: PHP/" . PHP_VERSION;

                $fileData   = chunk_split(base64_encode(file_get_contents($resumeAbsPath)));
                $safeName   = 'Resume_' . preg_replace('/[^A-Za-z0-9_-]/', '_', $data['full_name']) . '.pdf';
                $altBoundary = 'i3r_alt_' . md5(uniqid('', true));

                $mailBody  = "--{$boundary}\r\n";
                $mailBody .= "Content-Type: multipart/alternative; boundary=\"{$altBoundary}\"\r\n\r\n";

                $mailBody .= "--{$altBoundary}\r\n";
                $mailBody .= "Content-Type: text/plain; charset=UTF-8\r\n";
                $mailBody .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
                $mailBody .= $body . "\r\n";

                $mailBody .= "--{$altBoundary}\r\n";
                $mailBody .= "Content-Type: text/html; charset=UTF-8\r\n";
                $mailBody .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
                $mailBody .= $html . "\r\n";

                $mailBody .= "--{$altBoundary}--\r\n";

                $mailBody .= "--{$boundary}\r\n";
                $mailBody .= "Content-Type: application/pdf; name=\"{$safeName}\"\r\n";
                $mailBody .= "Content-Transfer-Encoding: base64\r\n";
                $mailBody .= "Content-Disposition: attachment; filename=\"{$safeName}\"\r\n\r\n";
                $mailBody .= $fileData . "\r\n";

                $mailBody .= "--{$boundary}--";

            } else {
                // No attachment — multipart/alternative only
                $boundary = 'i3r_alt_' . md5(uniqid('', true));

                $headers  = "MIME-Version: 1.0\r\n";
                $headers .= "From: {$fromName} <{$fromAddress}>\r\n";
                $headers .= "Reply-To: {$data['full_name']} <{$data['email']}>\r\n";
                $headers .= "Content-Type: multipart/alternative; boundary=\"{$boundary}\"\r\n";
                $headers .= "X-Mailer: PHP/" . PHP_VERSION;

                $mailBody  = "--{$boundary}\r\n";
                $mailBody .= "Content-Type: text/plain; charset=UTF-8\r\n";
                $mailBody .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
                $mailBody .= $body . "\r\n";

                $mailBody .= "--{$boundary}\r\n";
                $mailBody .= "Content-Type: text/html; charset=UTF-8\r\n";
                $mailBody .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
                $mailBody .= $html . "\r\n";

                $mailBody .= "--{$boundary}--";
            }

            mail($to, $subject, $mailBody, $headers);

        } catch (\Throwable $e) {
            logger()->error('Career HR email failed: ' . $e->getMessage());
        }
    }

    private function resumeNote(?string $path): string
    {
        return $path
            ? '<span style="color:#2e7d32;">✓ Attached to this email as PDF</span>'
            : '<span style="color:#999;">Not uploaded</span>';
    }

    private function submittedAt(): string
    {
        return now()->format('d M Y \a\t h:i A');
    }
}
