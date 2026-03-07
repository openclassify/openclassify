<?php

namespace Modules\Video\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Str;
use Modules\Video\Models\Video;
use Modules\Video\Support\VideoTranscoder;
use Throwable;

class ProcessVideo implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    public int $timeout;

    public function __construct(public int $videoId)
    {
        $this->timeout = (int) config('video.timeout', 1800);
    }

    public function handle(VideoTranscoder $transcoder): void
    {
        $video = Video::query()->find($this->videoId);

        if (! $video || blank($video->upload_path)) {
            return;
        }

        $video->markAsProcessing();

        try {
            $video->markAsProcessed($transcoder->transcode($video));
        } catch (Throwable $exception) {
            report($exception);

            $video->markAsFailed(Str::limit(trim($exception->getMessage()), 500));
        }
    }
}
