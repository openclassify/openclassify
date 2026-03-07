<?php

namespace Modules\Video\Support;

use Illuminate\Support\Facades\Storage;
use Modules\Video\Models\Video;
use RuntimeException;
use Symfony\Component\Process\Process;

class VideoTranscoder
{
    public function transcode(Video $video): array
    {
        $disk = (string) config('video.disk', 'public');
        $inputDisk = Storage::disk((string) ($video->upload_disk ?: $disk));
        $outputDisk = Storage::disk($disk);
        $inputPath = $inputDisk->path((string) $video->upload_path);
        $outputRelativePath = $video->mobileOutputPath();
        $outputPath = $outputDisk->path($outputRelativePath);
        $outputDirectory = dirname($outputPath);

        if (! is_dir($outputDirectory)) {
            mkdir($outputDirectory, 0775, true);
        }

        $process = new Process([
            (string) config('video.ffmpeg', 'ffmpeg'),
            '-y',
            '-i',
            $inputPath,
            '-map',
            '0:v:0',
            '-map',
            '0:a:0?',
            '-vf',
            'scale=min('.(int) config('video.mobile_width', 854).'\\,iw):-2',
            '-c:v',
            'libx264',
            '-preset',
            'veryfast',
            '-crf',
            (string) config('video.mobile_crf', 31),
            '-maxrate',
            (string) config('video.mobile_video_bitrate', '900k'),
            '-bufsize',
            '1800k',
            '-movflags',
            '+faststart',
            '-pix_fmt',
            'yuv420p',
            '-c:a',
            'aac',
            '-b:a',
            (string) config('video.mobile_audio_bitrate', '96k'),
            '-ac',
            '2',
            $outputPath,
        ]);

        $process->setTimeout((int) config('video.timeout', 1800));
        $process->run();

        if (! $process->isSuccessful()) {
            throw new RuntimeException(trim($process->getErrorOutput()) ?: 'Video transcoding failed.');
        }

        $probe = new Process([
            (string) config('video.ffprobe', 'ffprobe'),
            '-v',
            'error',
            '-select_streams',
            'v:0',
            '-show_entries',
            'stream=width,height:format=duration',
            '-of',
            'json',
            $outputPath,
        ]);

        $probe->setTimeout(30);
        $probe->run();

        $metadata = json_decode($probe->getOutput(), true);
        $stream = $metadata['streams'][0] ?? [];
        $format = $metadata['format'] ?? [];

        return [
            'disk' => $disk,
            'path' => $outputRelativePath,
            'mime_type' => $outputDisk->mimeType($outputRelativePath) ?: 'video/mp4',
            'size' => $outputDisk->size($outputRelativePath),
            'width' => isset($stream['width']) ? (int) $stream['width'] : null,
            'height' => isset($stream['height']) ? (int) $stream['height'] : null,
            'duration_seconds' => isset($format['duration']) ? (int) round((float) $format['duration']) : null,
        ];
    }
}
