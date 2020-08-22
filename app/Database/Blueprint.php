<?php

declare(strict_types=1);

namespace App\Database;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Schema\Blueprint as BaseBlueprint;

class Blueprint extends BaseBlueprint
{
    /**
     * Add automatic creation and update dateTimes to the table.
     *
     * @param  int  $precision
     */
    public function dateTimes($precision = 0): void
    {
        $this->dateTime('created_at', $precision)->nullable();
        $this->dateTime('updated_at', $precision)->nullable();
    }
}
