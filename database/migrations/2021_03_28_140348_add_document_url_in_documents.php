<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDocumentUrlInDocuments extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('user_action_documents', function (Blueprint $table) {
            $table->text('document_url')->nullable()->after('document_title');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('user_action_documents', function (Blueprint $table) {
            $table->dropColumn('document_url');
        });
    }

}
