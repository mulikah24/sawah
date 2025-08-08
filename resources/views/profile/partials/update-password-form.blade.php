<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">تغيير كلمة المرور</h2>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div>
            <label for="current_password">كلمة المرور الحالية</label>
            <input id="current_password" name="current_password" type="password" class="mt-1 block w-full" required />
        </div>

        <div>
            <label for="password">كلمة المرور الجديدة</label>
            <input id="password" name="password" type="password" class="mt-1 block w-full" required />
        </div>

        <div>
            <label for="password_confirmation">تأكيد كلمة المرور</label>
            <input id="password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full" required />
        </div>

        <div class="flex items-center gap-4">
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">تحديث كلمة المرور</button>
        </div>
    </form>
</section>