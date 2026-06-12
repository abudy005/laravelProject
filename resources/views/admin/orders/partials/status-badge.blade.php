{{-- Maps an order status to a coloured Bootstrap badge. $status is passed in. --}}
@php
    $map = [
        'New'        => 'bg-primary',
        'Accepted'   => 'bg-info',
        'Cancelled'  => 'bg-danger',
        'Onshipping' => 'bg-warning',
        'Completed'  => 'bg-success',
    ];
    $class = $map[$status] ?? 'bg-secondary';
@endphp
<span class="badge {{ $class }}">{{ $status }}</span>
