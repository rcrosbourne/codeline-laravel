<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class WeekendTracker extends Model
{

    protected  $fillable = ['start_date', 'end_date'];

    protected $casts = ['start_date' => 'date', 'end_date' => 'date'];

    /**
     * Returns the number of weekends between start_date and end_date
     * @return mixed
     */
    public function countWeekends() : array
    {
        $weekendCount = $this->start_date->diffInDaysFiltered(fn(Carbon $date) => $date->isWeekend(), $this->end_date->addDay());
        $message = "Number of weekends between {$this->start_date->toDateString()} and {$this->end_date->toDateString()} inclusive is {$weekendCount}";
        $filePath = "weekend_report_" . Str::random(40). ".txt";
        Storage::disk('public')->put($filePath, $message);
        return ['path' => Storage::url($filePath), 'message' => $message, 'weekendCount' => $weekendCount];
    }
}
