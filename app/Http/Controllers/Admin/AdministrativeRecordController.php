<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdministrativeRecord;

use PDF;

use Illuminate\Http\Request;

class AdministrativeRecordController extends Controller
{
    public function __construct(){
        $this->middleware('can:admin.administrative_records.index')->only('index');
        $this->middleware('can:admin.administrative_records.edit')->only('edit');
        $this->middleware('can:admin.administrative_records.show')->only('show');
        $this->middleware('can:admin.administrative_records.create')->only('create');
        $this->middleware('can:admin.administrative_records.destroy')->only('destroy');
        $this->middleware('can:admin.administrative_records.pdfs')->only('pdf');
    }

    public function index()
    {
        return view('admin.administrative_records.index');
    }

    public function create()
    {
        return view('admin.administrative_records.create');
    }

    public function show(AdministrativeRecord $administrative_record)
    {
        return view('admin.administrative_records.show', compact('administrative_record'));
    }

    public function edit(AdministrativeRecord $administrative_record)
    {
        return view('admin.administrative_records.edit', compact('administrative_record'));
    }

    public function destroy(AdministrativeRecord $administrative_record)
    {
        $administrative_record->delete();

        return redirect()->route('admin.administrative_records.index')->with('eliminar', 'ok');
    }

    public function pdf(AdministrativeRecord $administrative_record){

        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView("pdfs/admin/administrativeRecord", [
            'administrative_record' => $administrative_record
        ]);

        return $pdf->stream("administrative-record.pdf");
    }
}
