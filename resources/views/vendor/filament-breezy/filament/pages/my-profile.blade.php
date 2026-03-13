<x-filament::page>
    <style>
        .fi-breezy-my-profile {
            width: min(100%, 76rem);
            margin-inline: auto;
        }

        .fi-breezy-my-profile-stack {
            display: grid;
        }

        .fi-breezy-my-profile-stack > * + * {
            margin-top: 1rem;
            padding-top: 1rem;
            border-top: 1px solid rgba(15, 23, 42, 0.08);
        }

        .dark .fi-breezy-my-profile-stack > * + * {
            border-top-color: rgba(255, 255, 255, 0.1);
        }

        .fi-breezy-my-profile .fi-section.fi-aside {
            gap: 1rem 1.25rem;
        }

        .fi-breezy-my-profile .fi-section > .fi-section-header {
            gap: 0.75rem;
        }

        .fi-breezy-my-profile .fi-section .fi-section-header-description {
            max-width: 18rem;
            line-height: 1.6;
        }

        .fi-breezy-my-profile .fi-section > .fi-section-content-ctn > .fi-section-content {
            padding: 1.25rem;
        }

        @media (min-width: 48rem) {
            .fi-breezy-my-profile .fi-section.fi-aside {
                grid-template-columns: minmax(0, 16.5rem) minmax(0, 1fr);
            }

            .fi-breezy-my-profile .fi-section.fi-aside > .fi-section-content-ctn {
                grid-column: span 1 / span 1;
            }
        }
    </style>

    <div class="fi-breezy-my-profile">
        <div class="fi-breezy-my-profile-stack">
            @foreach ($this->getRegisteredMyProfileComponents() as $component)
                @unless (is_null($component))
                    @livewire($component)
                @endunless
            @endforeach
        </div>
    </div>
</x-filament::page>
