<?php

use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up()
    {
        // This migration ensures the admin middleware is registered
        // The actual registration is done in bootstrap/app.php
    }

    public function down()
    {
        // Nothing to rollback
    }
};
