@extends('panel::layouts.panel', ['panelSection' => 'listings'])

@section('title', __('panel::messages.edit'))

@section('panel_content')
<header class="panel-head">
    <div class="panel-head__text">
        <h1 class="title-page">{{ __('panel::messages.edit') }}</h1>
        <p class="text-muted text-clamp-1">{{ $listing->getAttribute('title') }}</p>
    </div>
    <a href="{{ route('panel.listings.index') }}" class="button button--ghost">
        <x-ui.icon name="arrow-left"/>
        <span>{{ __('panel::messages.back_to_listings') }}</span>
    </a>
</header>

<form method="POST" action="{{ route('panel.listings.update', $listing) }}" class="grid grid--split">
    @csrf
    @method('PUT')

    <div class="stack stack--loose">
        <section class="card">
            <div class="card__head"><h2 class="card__title">{{ __('site::messages.details') }}</h2></div>
            <div class="card__body">
                <div class="field">
                    <label class="field__label" for="title">{{ __('panel::messages.title') }}</label>
                    <input id="title" type="text" name="title" value="{{ old('title', $listing->getAttribute('title')) }}" class="input" maxlength="150" required
                           aria-invalid="{{ $errors->has('title') ? 'true' : 'false' }}">
                    <span class="field__hint" data-counter-for="title"></span>
                    @error('title')<p class="field__error">{{ $message }}</p>@enderror
                </div>

                <div class="field">
                    <label class="field__label" for="description">{{ __('panel::messages.description') }}</label>
                    <textarea id="description" name="description" rows="8" class="textarea" maxlength="4000">{{ old('description', $listing->getAttribute('description')) }}</textarea>
                    <span class="field__hint" data-counter-for="description"></span>
                    @error('description')<p class="field__error">{{ $message }}</p>@enderror
                </div>

                <div class="field__row field__row--two">
                    <div class="field">
                        <label class="field__label" for="price">{{ __('panel::messages.price') }}</label>
                        <span class="input-affix">
                            <input id="price" type="number" step="0.01" min="0" name="price" value="{{ old('price', $listing->getAttribute('price')) }}" class="input">
                            <span class="input-affix__suffix">{{ $listing->getAttribute('currency') }}</span>
                        </span>
                        @error('price')<p class="field__error">{{ $message }}</p>@enderror
                    </div>

                    <div class="field">
                        <label class="field__label" for="status">{{ __('panel::messages.status') }}</label>
                        <select id="status" name="status" class="select">
                            @foreach($statusOptions as $value => $label)
                                <option value="{{ $value }}" @selected(old('status', $listing->statusValue()) === $value)>{{ $label }}</option>
                            @endforeach
                        </select>
                        @error('status')<p class="field__error">{{ $message }}</p>@enderror
                    </div>
                </div>
            </div>
        </section>

        @if(! empty($customFieldValues))
            <section class="card">
                <div class="card__head"><h2 class="card__title">{{ __('site::messages.details') }}</h2></div>
                <div class="card__body">
                    <dl class="spec-list">
                        @foreach($customFieldValues as $field)
                            <div class="spec-list__row">
                                <dt class="spec-list__label">{{ $field['label'] }}</dt>
                                <dd class="spec-list__value">{{ $field['value'] }}</dd>
                            </div>
                        @endforeach
                    </dl>
                </div>
            </section>
        @endif
    </div>

    <aside class="stack stack--loose">
        <section class="card">
            <div class="card__head"><h2 class="card__title">{{ __('panel::messages.location') }}</h2></div>
            <div class="card__body">
                <div class="field">
                    <label class="field__label" for="country">{{ __('site::messages.country') }}</label>
                    <input id="country" type="text" name="country" value="{{ old('country', $listing->getAttribute('country')) }}" class="input">
                </div>
                <div class="field">
                    <label class="field__label" for="city">{{ __('site::messages.city') }}</label>
                    <input id="city" type="text" name="city" value="{{ old('city', $listing->getAttribute('city')) }}" class="input">
                </div>
            </div>
        </section>

        <section class="card">
            <div class="card__head"><h2 class="card__title">{{ __('panel::messages.contact_phone') }}</h2></div>
            <div class="card__body">
                <div class="field">
                    <label class="field__label" for="contact_phone">{{ __('panel::messages.contact_phone') }}</label>
                    <input id="contact_phone" type="tel" name="contact_phone" value="{{ old('contact_phone', $listing->getAttribute('contact_phone')) }}" class="input">
                    @error('contact_phone')<p class="field__error">{{ $message }}</p>@enderror
                </div>
                <div class="field">
                    <label class="field__label" for="contact_email">{{ __('panel::messages.contact_email') }}</label>
                    <input id="contact_email" type="email" name="contact_email" value="{{ old('contact_email', $listing->getAttribute('contact_email')) }}" class="input">
                    @error('contact_email')<p class="field__error">{{ $message }}</p>@enderror
                </div>
            </div>
        </section>

        <div class="card">
            <div class="card__body card__body--tight">
                <button type="submit" class="button button--primary button--block button--large">{{ __('panel::messages.save') }}</button>
                <a href="{{ route('listings.show', $listing) }}" class="button button--ghost button--block">{{ __('panel::messages.view') }}</a>
            </div>
        </div>
    </aside>
</form>
@endsection
