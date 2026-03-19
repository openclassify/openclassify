<?php

namespace Modules\Video\Support;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Modules\Site\App\Support\LocalMedia;
use Modules\Video\Models\Video;
use RuntimeException;
use Symfony\Component\Process\Process;

class VideoTranscoder
{
    public function transcode(Video $video): array
    {
        $disk = (string) config('video.disk', LocalMedia::disk());
        $inputDisk = Storage::disk((string) ($video->upload_disk ?: $disk));
        $outputDisk = Storage::disk($disk);
        $workspace = storage_path('app/private/video-processing/'.Str::uuid());
        $inputExtension = pathinfo((string) $video->upload_path, PATHINFO_EXTENSION) ?: 'mp4';
        $inputPath = $workspace.'/input.'.$inputExtension;
        $outputPath = $workspace.'/output.mp4';
        $outputRelativePath = $video->mobileOutputPath();
        $inputStream = null;
        $outputStream = null;

        if (! is_dir($workspace) && ! mkdir($workspace, 0775, true) && ! is_dir($workspace)) {
            throw new RuntimeException('Video processing workspace could not be created.');
        }

        try {
            $inputStream = $inputDisk->readStream((string) $video->upload_path);

            if (! is_resource($inputStream)) {
                throw new RuntimeException('Source video could not be read.');
            }

            $localInputStream = fopen($inputPath, 'wb');

            if (! is_resource($localInputStream)) {
                throw new RuntimeException('Temporary input video could not be created.');
            }

            stream_copy_to_stream($inputStream, $localInputStream);
            fclose($localInputStream);

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

            $outputStream = fopen($outputPath, 'rb');

            if (! is_resource($outputStream)) {
                throw new RuntimeException('Processed video could not be opened.');
            }

            if (! $outputDisk->put($outputRelativePath, $outputStream, ['visibility' => 'public'])) {
                throw new RuntimeException('Processed video could not be stored.');
            }

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
        } finally {
            if (is_resource($inputStream)) {
                fclose($inputStream);
            }

            if (is_resource($outputStream)) {
                fclose($outputStream);
            }

            if (is_file($inputPath)) {
                unlink($inputPath);
            }

            if (is_file($outputPath)) {
                unlink($outputPath);
            }

            if (is_dir($workspace)) {
                rmdir($workspace);
            }
        }
    }
}
