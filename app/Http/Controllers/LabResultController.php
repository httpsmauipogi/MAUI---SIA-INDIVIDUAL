<?php

namespace App\Http\Controllers;

use App\Models\LabOrder;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class LabResultController extends Controller
{
    /**
     * Stream a lab result from the private disk to an authenticated staff member.
     */
    public function show(LabOrder $labOrder): StreamedResponse
    {
        abort_unless($labOrder->result_file, 404);

        $disk = Storage::disk('private');

        abort_unless($disk->exists($labOrder->result_file), 404);

        return $disk->response(
            $labOrder->result_file,
            basename($labOrder->result_file),
            ['Content-Type' => $disk->mimeType($labOrder->result_file) ?: 'application/octet-stream']
        );
    }
}
