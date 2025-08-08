@extends('layouts.app')

@section('title', 'تواصل معنا')

@section('content')
<div class="container mx-auto p-6">
  <h1 class="text-2xl font-bold mb-4">تواصل معنا</h1>

  {{-- عرض رسالة نجاح إن وجدت --}}
  @if(session('success'))
    <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
      {{ session('success') }}
    </div>
  @endif

  <form method="POST" action="{{ route('contact.send') }}" class="bg-white p-6 rounded-lg shadow-md">
    @csrf

    <div class="mb-4">
      <label class="block text-sm font-semibold mb-2" for="name">الاسم</label>
      <input class="w-full border rounded p-2" type="text" id="name" name="name" placeholder="ادخل اسمك" required>
    </div>

    <div class="mb-4">
      <label class="block text-sm font-semibold mb-2" for="email">البريد الإلكتروني</label>
      <input class="w-full border rounded p-2" type="email" id="email" name="email" placeholder="ادخل بريدك" required>
    </div>

    <div class="mb-4">
      <label class="block text-sm font-semibold mb-2" for="subject">الموضوع</label>
      <input class="w-full border rounded p-2" type="text" id="subject" name="subject" placeholder="الموضوع (اختياري)">
    </div>

    <div class="mb-4">
      <label class="block text-sm font-semibold mb-2" for="message">الرسالة</label>
      <textarea class="w-full border rounded p-2" id="message" name="message" rows="4" placeholder="اكتب رسالتك هنا..." required></textarea>
    </div>

    <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">إرسال</button>
  </form>
</div>
@endsection