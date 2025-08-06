<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!Auth::check()) {
            // إذا المستخدم غير مسجل دخول، رجّعه لصفحة تسجيل الدخول
            return redirect('/login');
        }

        // إذا لم يكن للمستخدم أحد الأدوار المطلوبة
        if (!in_array(Auth::user()->role, $roles)) {
            abort(403, 'ليس لديك صلاحية الوصول لهذه الصفحة.');
        }

        return $next($request);
    }
}
