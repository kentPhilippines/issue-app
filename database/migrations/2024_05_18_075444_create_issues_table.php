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
        Schema::create('issues', function (Blueprint $table) {
            $table->id()->index();
            $table->string('title')->common('文章标题');
            $table->longText('content')->common('文章内容或问题');
            # $table->int('tag');//标签       
            # $table->int('comment');//回答         
            # $table->int('invite');//邀请           
            $table->bigInteger('announcer')->common('发布者');        
            $table->bigInteger('status')->common('状态');       
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('issues');
    }
};
