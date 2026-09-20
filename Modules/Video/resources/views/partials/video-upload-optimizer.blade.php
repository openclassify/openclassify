<script>
    (() => {
        if (window.__videoUploadOptimizerLoaded) {
            return;
        }

        window.__videoUploadOptimizerLoaded = true;

        const selector = 'input[type="file"][data-video-upload-optimizer="true"]';
        const replaying = new WeakSet();
        const processing = new WeakSet();

        const waitForEvent = (target, eventName) => new Promise((resolve, reject) => {
            const cleanup = () => {
                target.removeEventListener(eventName, onResolve);
                target.removeEventListener('error', onReject);
            };

            const onResolve = () => {
                cleanup();
                resolve();
            };

            const onReject = () => {
                cleanup();
                reject(new Error(eventName + ' failed'));
            };

            target.addEventListener(eventName, onResolve, { once: true });
            target.addEventListener('error', onReject, { once: true });
        });

        const preferredMimeType = () => {
            const supported = [
                'video/webm;codecs=vp9,opus',
                'video/webm;codecs=vp8,opus',
                'video/webm',
            ];

            return supported.find((mimeType) => window.MediaRecorder?.isTypeSupported?.(mimeType)) || null;
        };

        const even = (value) => Math.max(2, Math.round(value / 2) * 2);

        const optimizeFile = async (file, input) => {
            if (
                ! file.type.startsWith('video/')
                || ! window.MediaRecorder
                || ! window.DataTransfer
                || ! HTMLCanvasElement.prototype.captureStream
                || file.size < Number(input.dataset.videoOptimizeMinBytes || 0)
            ) {
                return file;
            }

            const mimeType = preferredMimeType();

            if (! mimeType) {
                return file;
            }

            const objectUrl = URL.createObjectURL(file);

            try {
                const video = document.createElement('video');
                video.preload = 'auto';
                video.muted = true;
                video.playsInline = true;
                video.src = objectUrl;

                await waitForEvent(video, 'loadedmetadata');

                const maxWidth = Number(input.dataset.videoOptimizeWidth || 854);
                const fps = Number(input.dataset.videoOptimizeFps || 24);
                const bitrate = Number(input.dataset.videoOptimizeBitrate || 900000);
                const scale = Math.min(1, maxWidth / (video.videoWidth || maxWidth));
                const width = even((video.videoWidth || maxWidth) * scale);
                const height = even((video.videoHeight || maxWidth) * scale);
                const canvas = document.createElement('canvas');
                const context = canvas.getContext('2d', { alpha: false });

                if (! context) {
                    return file;
                }

                canvas.width = width;
                canvas.height = height;

                const canvasStream = canvas.captureStream(fps);
                const sourceStream = typeof video.captureStream === 'function'
                    ? video.captureStream()
                    : (typeof video.mozCaptureStream === 'function' ? video.mozCaptureStream() : null);
                const stream = new MediaStream([
                    ...canvasStream.getVideoTracks(),
                    ...(sourceStream ? sourceStream.getAudioTracks() : []),
                ]);
                const chunks = [];
                const recorder = new MediaRecorder(stream, {
                    mimeType,
                    videoBitsPerSecond: bitrate,
                    audioBitsPerSecond: 96000,
                });

                recorder.addEventListener('dataavailable', (event) => {
                    if (event.data?.size) {
                        chunks.push(event.data);
                    }
                });

                const stopped = new Promise((resolve, reject) => {
                    recorder.addEventListener('stop', resolve, { once: true });
                    recorder.addEventListener('error', () => reject(new Error('recorder failed')), { once: true });
                });

                const draw = () => {
                    if (video.paused || video.ended) {
                        return;
                    }

                    context.drawImage(video, 0, 0, width, height);
                    requestAnimationFrame(draw);
                };

                recorder.start(250);
                await video.play();
                draw();
                await waitForEvent(video, 'ended');

                if (recorder.state !== 'inactive') {
                    recorder.stop();
                }

                await stopped;

                const blob = new Blob(chunks, { type: mimeType });

                if (! blob.size || blob.size >= file.size) {
                    return file;
                }

                const baseName = file.name.replace(/\.[^.]+$/, '');

                return new File(
                    [blob],
                    `${baseName}-mobile.webm`,
                    {
                        type: mimeType,
                        lastModified: Date.now(),
                    },
                );
            } catch {
                return file;
            } finally {
                URL.revokeObjectURL(objectUrl);
            }
        };

        document.addEventListener('change', async (event) => {
            const input = event.target;

            if (! (input instanceof HTMLInputElement) || ! input.matches(selector)) {
                return;
            }

            if (replaying.has(input)) {
                replaying.delete(input);

                return;
            }

            if (processing.has(input) || ! input.files?.length) {
                return;
            }

            processing.add(input);
            event.preventDefault();
            event.stopImmediatePropagation();

            try {
                const files = await Promise.all(
                    Array.from(input.files).map((file) => optimizeFile(file, input)),
                );
                const dataTransfer = new DataTransfer();

                files.forEach((file) => dataTransfer.items.add(file));

                input.files = dataTransfer.files;
                replaying.add(input);
                input.dispatchEvent(new Event('change', { bubbles: true }));
            } finally {
                processing.delete(input);
            }
        }, true);
    })();
</script>
