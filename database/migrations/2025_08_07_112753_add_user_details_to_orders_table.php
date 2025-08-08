<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('trip_name')->nullable();
            $table->decimal('trip_price', 8, 2)->nullable();
            $table->renameColumn('message', 'notes'); // إعادة تسمية message إلى notes (اختياري ولكن لتوحيد التسمية)
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['name', 'email', 'phone', 'trip_name', 'trip_price']);
            $table->renameColumn('notes', 'message'); // إعادة التسمية الأصلية في حالة rollback
        });
    }
};
