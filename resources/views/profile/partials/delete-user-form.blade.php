<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900">حذف الحساب</h2>
        <p class="mt-1 text-sm text-gray-600">
            بمجرد حذف حسابك، سيتم حذف جميع بياناتك نهائيًا. قبل الحذف تأكد من أنك متأكد.
        </p>
    </header>

    <form method="post" action="{{ route('profile.destroy') }}" class="mt-6 space-y-6">
        @csrf
        @method('delete')

        <div>
            <label for="password" class="sr-only">كلمة المرور</label>
            <input id="password" name="password" type="password" class="mt-1 block w-full" placeholder="أدخل كلمة المرور للتأكيد" required />
        </div>

        <div class="flex items-center gap-4">
            <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded">حذف الحساب</button>
        </div>
    </form>
</section>