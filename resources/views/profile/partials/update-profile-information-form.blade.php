<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">معلومات الحساب</h2>
    </header>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <label for="name">الاسم</label>
            <input id="name" name="name" type="text" class="mt-1 block w-full" value="{{ old('name', auth()->user()->name) }}" required autofocus />
        </div>

        <div>
            <label for="email">البريد الإلكتروني</label>
            <input id="email" name="email" type="email" class="mt-1 block w-full" value="{{ old('email', auth()->user()->email) }}" required />
        </div>

        <div class="flex items-center gap-4">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">حفظ</button>
        </div>
    </form>
</section>