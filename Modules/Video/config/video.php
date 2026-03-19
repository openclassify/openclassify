<?php

return [
    'disk' => env('VIDEO_DISK', env('FILESYSTEM_DISK', 'public')),
    'upload_directory' => env('VIDEO_UPLOAD_DIRECTORY', 'videos/uploads'),
    'processed_directory' => env('VIDEO_PROCESSED_DIRECTORY', 'videos/mobile'),
    'queue' => env('VIDEO_QUEUE', 'videos'),
    'ffmpeg' => env('VIDEO_FFMPEG_PATH', 'ffmpeg'),
    'ffprobe' => env('VIDEO_FFPROBE_PATH', 'ffprobe'),
    'timeout' => (int) env('VIDEO_PROCESS_TIMEOUT', 1800),
    'max_upload_size_kb' => (int) env('VIDEO_MAX_UPLOAD_SIZE_KB', 102400),
    'max_listing_videos' => (int) env('VIDEO_MAX_LISTING_VIDEOS', 5),
    'mobile_width' => (int) env('VIDEO_MOBILE_WIDTH', 854),
    'mobile_crf' => (int) env('VIDEO_MOBILE_CRF', 31),
    'mobile_video_bitrate' => env('VIDEO_MOBILE_VIDEO_BITRATE', '900k'),
    'mobile_audio_bitrate' => env('VIDEO_MOBILE_AUDIO_BITRATE', '96k'),
    'client_side' => [
        'enabled' => (bool) env('VIDEO_CLIENT_SIDE_ENABLED', true),
        'max_width' => (int) env('VIDEO_CLIENT_SIDE_MAX_WIDTH', 854),
        'bitrate' => (int) env('VIDEO_CLIENT_SIDE_BITRATE', 900000),
        'fps' => (int) env('VIDEO_CLIENT_SIDE_FPS', 24),
        'min_size_bytes' => (int) env('VIDEO_CLIENT_SIDE_MIN_SIZE_BYTES', 1048576),
    ],
];
