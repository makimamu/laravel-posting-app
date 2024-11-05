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
//このうちid、created_at、updated_atカラムはすでに設定されているので、user_id、title、contentカラムを追加します。
//外部キーにcascadeOnDelete()メソッドをつなげた場合、参照先のデータ（今回の場合はusersテーブルのデータ）が削除されると参照元のデータ（今回の場合はpostsテーブルのデータ）も同時に削除されるようになります。
//あるユーザーが削除される（退会する）と、そのユーザーに紐づく投稿もすべて削除される.
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('title');
            $table->text('content');
            $table->timestamps();//投稿の更新日時を表示
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
