@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="text-2xl font-bold mb-4">الرسائل المستلمة من "تواصل معنا"</h2>

    @foreach ($messages as $msg)
        <div class="bg-white p-4 rounded shadow mb-4">
            <p><strong>الاسم:</strong> {{ $msg->name }}</p>
            <p><strong>البريد:</strong> {{ $msg->email }}</p>
            <p><strong>الموضوع:</strong> {{ $msg->subject }}</p>
            <p><strong>الرسالة:</strong> {{ $msg->message }}</p>
            <form action="{{ route('admin.contacts.destroy', $msg->id) }}" method="POST" onsubmit="return confirm('هل أنت متأكد؟')">
                @csrf
                @method('DELETE')
                <button class="bg-red-500 text-white px-3 py-1 rounded mt-2">حذف</button>
            </form>
        </div>
    @endforeach

    {{ $messages->links() }}
</div>
@endsection