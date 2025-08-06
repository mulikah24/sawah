@extends('layouts.app')

@section('title', 'تواصل معنا')

@section('content')
<div class="container">
  <h1 class="text-2xl font-bold mb-4">تواصل معنا</h1>
  <form class="bg-white p-6 rounded-lg shadow-md">
    <div class="mb-4">
      <label class="block text-sm font-semibold mb-2" for="name">الاسم</label>
      <input class="w-full border rounded p-2" type="text" id="name" placeholder="ادخل اسمك">
    </div>
    <div class="mb-4">
      <label class="block text-sm font-semibold mb-2" for="email">البريد الإلكتروني</label>
      <input class="w-full border rounded p-2" type="email" id="email" placeholder="ادخل بريدك">
    </div>
    <div class="mb-4">
      <label class="block text-sm font-semibold mb-2" for="message">الرسالة</label>
      <textarea class="w-full border rounded p-2" id="message" rows="4" placeholder="اكتب رسالتك هنا..."></textarea>
    </div>
    <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">إرسال</button>
  </form>
</div>
@endsection
