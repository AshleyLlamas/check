<?php

namespace App\Exports;

use App\Models\Assistance;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class AssistanceExport implements FromView
{
    protected $date;

    function __construct($date) {
        $this->date = $date;
    }

    public function view(): View
    {
        return view('exports.assistances', [
            'assistances' => Assistance::whereDate('created_at', '=' , Carbon::parse($this->date))->where('user_id', '!=', null)->get()
        ]);
    }
}
