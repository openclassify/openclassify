@if(session('success'))
    <div class="alert alert--positive" role="status">
        <x-ui.icon name="check"/>
        <span>{{ session('success') }}</span>
    </div>
@endif

@if(session('error'))
    <div class="alert alert--critical" role="alert">
        <x-ui.icon name="shield"/>
        <span>{{ session('error') }}</span>
    </div>
@endif

@if($errors->any())
    <div class="alert alert--critical" role="alert">
        <x-ui.icon name="shield"/>
        <span>{{ $errors->first() }}</span>
    </div>
@endif
