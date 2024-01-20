<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class DropFailedJobsTable extends Migration
{
    public function up()
    {
        Schema::dropIfExists('failed_jobs');
    }

    public function down()
    {
        // If you ever need to revert the drop operation, you can define the logic here.
        // This method is optional for dropping tables.
    }
}

