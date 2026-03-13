<?php

namespace Modules\Panel\App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreVideoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'listing_id' => ['required', 'integer', 'exists:listings,id'],
            'title' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:2000'],
            'video_file' => ['required', 'file', 'mimes:mp4,mov,webm,m4v', 'max:256000'],
        ];
    }

    public function messages(): array
    {
        return [
            'listing_id.required' => 'Choose a listing for the video.',
            'listing_id.exists' => 'Choose a valid listing for the video.',
            'video_file.required' => 'A video file is required.',
            'video_file.mimes' => 'Video must be an mp4, mov, webm, or m4v file.',
        ];
    }
}
