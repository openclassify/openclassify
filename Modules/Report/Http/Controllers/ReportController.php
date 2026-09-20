<?php

declare(strict_types=1);

namespace Modules\Report\Http\Controllers;

use App\Support\ListingDirectory;
use App\Support\UserDirectory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Validation\Rule;
use Modules\Report\Models\Report;

class ReportController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'subject_type' => ['required', Rule::in([Report::SUBJECT_LISTING, Report::SUBJECT_USER])],
            'subject_id' => ['required', 'integer', 'min:1'],
            'reason' => ['required', Rule::in(Report::reasons())],
            'details' => ['nullable', 'string', 'max:1000'],
        ]);

        $subjectType = (string) $validated['subject_type'];
        $subjectId = (int) $validated['subject_id'];

        $exists = $subjectType === Report::SUBJECT_LISTING
            ? ListingDirectory::exists($subjectId)
            : UserDirectory::exists($subjectId);

        abort_unless($exists, 404);

        $reporterId = $request->user() === null ? null : (int) $request->user()->getKey();

        if (Report::alreadyFiledBy($reporterId, $subjectType, $subjectId)) {
            return back()->with('error', __('report::messages.already_reported'));
        }

        Report::file($subjectType, $subjectId, $reporterId, (string) $validated['reason'], $validated['details'] ?? null);

        return back()->with('success', __('report::messages.received'));
    }
}
