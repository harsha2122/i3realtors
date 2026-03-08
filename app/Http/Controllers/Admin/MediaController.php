<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\SettingsService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MediaController extends Controller
{
    public function __construct(private SettingsService $settingsService) {}

    /**
     * Delete a media file (logo, favicon, etc.) tied to a setting key.
     */
    public function destroy(Request $request): JsonResponse
    {
        $request->validate(['key' => 'required|string']);

        $deleted = $this->settingsService->deleteMedia($request->input('key'));

        if ($deleted) {
            return response()->json(['success' => true, 'message' => 'Media removed successfully.']);
        }

        return response()->json(['success' => false, 'message' => 'No media found for this key.'], 404);
    }
}
