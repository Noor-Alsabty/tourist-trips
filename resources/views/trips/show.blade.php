@extends('layout.app')

@section('content')
<div class="container">
    <h2 class="mb-4">📍 تفاصيل الرحلة</h2>

    <div class="card mb-4">
        <div class="card-header">{{ $trip->name }}</div>
        <div class="card-body">
            <p><strong>الوصف:</strong> {{ $trip->description }}</p>
            <p><strong>تاريخ البداية:</strong> {{ $trip->start_date }}</p>
            <p><strong>تاريخ النهاية:</strong> {{ $trip->end_date }}</p>
            <p><strong>السعر:</strong> {{ $trip->price }} $</p>
            <p><strong>المقاعد المتاحة:</strong> {{ $trip->available_seats }}</p>
            <p><strong>الفندق:</strong> {{ $trip->hotel->name ?? 'غير متوفر' }}</p>
            <p><strong>النوع:</strong> {{ $trip->type->name ?? 'غير محدد' }}</p>
            <a href="{{ route('trips.index') }}" class="btn btn-secondary">↩️ رجوع للقائمة</a>
        </div>
    </div>

    {{-- التقييمات --}}
    <h4>⭐ التقييمات</h4>
    <div class="mb-4">
        @forelse($trip->reviews as $review)
            <div class="border p-3 mb-2 rounded">
                <strong>{{ $review->user_name ?? 'مستخدم مجهول' }}</strong>
                <span class="text-muted">({{ $review->rating }}/5)</span>
                <p>{{ $review->comment }}</p>
            </div>
        @empty
            <p>لا توجد تقييمات لهذه الرحلة.</p>
        @endforelse
    </div>

    {{-- الحجوزات --}}
    <h4>📝 الحجوزات</h4>
    <div>
        @forelse($trip->bookings as $booking)
            <div class="border p-3 mb-2 rounded">
                <p><strong>المستخدم:</strong> {{ $booking->user_name ?? 'مجهول' }}</p>
                <p><strong>عدد المقاعد:</strong> {{ $booking->seats }}</p>
                <p><strong>الحالة:</strong> {{ $booking->status }}</p>
            </div>
        @empty
            <p>لا توجد حجوزات لهذه الرحلة.</p>
        @endforelse
    </div>
</div>
@endsection
