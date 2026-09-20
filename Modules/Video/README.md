# Video

Video attachments on a listing, with background processing.

- `Video` tracks upload state through a `VideoStatus` enum (pending → processing → ready/failed), the source upload path, and the final playable path once processed.
- `ProcessVideo` is the queued job that transforms an uploaded video into its final playable form; `Video`'s model lifecycle hooks keep `Listing`'s denormalized video counts in sync.
- `Filament/Admin/Resources/VideoResource` lets staff review and moderate uploaded videos.

A listing can have several videos (`sort_order`-ordered); the public listing detail page plays only `ready`, active videos.
