<?php

namespace Tests\Unit;

use App\WeekendTracker;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Tests\TestCase;

class WeekendTrackerTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Storage::fake('public');
    }

    /** @test */
    public function it_correctly_determines_the_number_of_weekends_between_two_date()
    {
        $data = [
            'start_date' => '2020-10-01', // Thursday
            'end_date' => '2020-10-08' // Wednesday
        ];
       $tracker  = new WeekendTracker($data);
       $numberOfWeekends = $tracker->countWeekends();
       $this->assertEquals(2, $numberOfWeekends['weekendCount']);
    }

    /** @test */
    public function it_returns_zero_if_no_weekends_occur_between_the_dates()
    {

        $data = [
            'start_date' => '2020-10-05', // Monday
            'end_date' => '2020-10-09' // Friday
        ];
        $tracker  = new WeekendTracker($data);
        $numberOfWeekends = $tracker->countWeekends();
        $this->assertEquals(0, $numberOfWeekends['weekendCount']);

    }

    /** @test */
    public function it_returns_0_if_the_end_date_is_on_saturday()
    {

        $data = [
            'start_date' => '2020-10-05', // Monday
            'end_date' => '2020-10-10' // Saturday
        ];
        $tracker  = new WeekendTracker($data);
        $numberOfWeekends = $tracker->countWeekends();
        $this->assertEquals(1, $numberOfWeekends['weekendCount']);

    }
    /** @test */
    public function it_returns_2_if_the_start_date_is_on_sunday_and_end_date_is_on_saturday()
    {
        $data = [
            'start_date' => '2020-10-04', // Sunday
            'end_date' => '2020-10-10' // Saturday
        ];
        $tracker  = new WeekendTracker($data);
        $numberOfWeekends = $tracker->countWeekends();
        $this->assertEquals(2, $numberOfWeekends['weekendCount']);

    }

    /** @test */
    public function it_generates_a_report_on_file()
    {
        $data = [
            'start_date' => '2020-10-04', // Sunday
            'end_date' => '2020-10-10' // Saturday
        ];
        $tracker  = new WeekendTracker($data);
        $numberOfWeekends = $tracker->countWeekends();
        Storage::disk('public')->assertExists(Str::after($numberOfWeekends['path'], '/storage/'));

    }
}
