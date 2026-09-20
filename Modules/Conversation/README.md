# Conversation

Realtime buyer/seller messaging tied to a listing.

- `Conversation` (one per listing/buyer pair) and `ConversationMessage` models hold the inbox and read-state logic.
- Messages broadcast over Laravel Reverb/Echo on a private `users.{id}.inbox` channel via the `InboxMessageCreated` and `ConversationReadUpdated` events.
- The inbox UI (list pane + thread pane) lives under `resources/views`, backed by `resources/assets/js/conversation.js` for live updates.

A conversation is started from a listing's detail page and always links back to the `Listing` and `User` models by relationship, never by cross-module query.
