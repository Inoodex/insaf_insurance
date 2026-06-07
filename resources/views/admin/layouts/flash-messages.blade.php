@php
    $flashMessages = [
        'success' => [
            'class' => 'border-success bg-success-light text-success',
            'icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z',
        ],
        'error' => [
            'class' => 'border-danger bg-danger-light text-danger',
            'icon' => 'M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z',
        ],
        'warning' => [
            'class' => 'border-warning bg-warning-light text-warning',
            'icon' => 'M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z',
        ],
        'info' => [
            'class' => 'border-info bg-info-light text-info',
            'icon' => 'M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z',
        ],
    ];
@endphp

@foreach ($flashMessages as $type => $message)
    @if (session($type))
        <div class="admin-flash-message mb-5 flex items-start gap-3 rounded border p-4 transition-all duration-300 {{ $message['class'] }}">
            <svg class="mt-0.5 h-5 w-5 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="{{ $message['icon'] }}" />
            </svg>
            <div class="font-medium">
                {{ session($type) }}
            </div>
        </div>
    @endif
@endforeach

@if ($errors->any())
    <div class="admin-flash-message mb-5 flex items-start gap-3 rounded border border-danger bg-danger-light p-4 text-danger transition-all duration-300">
        <svg class="mt-0.5 h-5 w-5 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <div>
            <p class="font-semibold">Please correct the following errors:</p>
            <ul class="mt-2 list-disc space-y-1 pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif
