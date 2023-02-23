<div class="pt-4">
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
    <div class="card">
        <div class="card-header bg-primary">
            <h5 class="text-center my-2"><i class="fa-regular fa-calendar-days"></i> Calendario</h5>
        </div>
        <div class="card-body table-responsive">
            <div>
                <div id='calendar' wire:ignore></div>
            </div>
        </div>
    </div>
    {{-- LIST --}}
    <div class="card">
        <div class="card-header bg-primary">
            <h5 class="text-center my-2"><i class="fa-solid fa-list"></i> Todas los días no laborales <span class="badge badge-light"> {{$all_no_working_days}}</span></h5>
        </div>
        <div class="card-header">
            <div class="row">
                <div class="col-xl-8 col-lg-7 col-md-7 col-sm-7">
                    <div class="input-group my-2">
                        <div class="input-group-prepend">
                          <div class="input-group-text"><i class="fa-solid fa-magnifying-glass"></i></div>
                        </div>
                        <input type="date" wire:model="date" class="form-control">
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group my-2" wire:model="order">
                        <select class="form-control" id="orderFormControlSelect">
                        <option value="1">Ordernar por más reciente</option>
                        <option value="2">Ordernar por más antiguo</option>
                        </select>
                    </div>
                </div>
                <div class="col-xl-1 col-lg-2 col-md-2 col-sm-2">
                    <a class="btn btn-success btn-block  my-2 @cannot('admin.calendars.create') disabled @endcannot" href="{{ route('admin.calendars.create') }}"><i class="fa-solid fa-plus"></i></a>
                </div>
            </div>
        </div>
        <div class="card-body p-0 table-responsive">
            @if ($no_working_days->count())
                <table class="table table-hover text-center">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Fecha</th>
                            @can('admin.no_working_days.show')
                                <th></th>
                            @endcan
                            @can('admin.no_working_days.edit')
                                <th></th>
                            @endcan
                            @can('admin.no_working_days.destroy')
                                <th></th>
                            @endcan
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($no_working_days as $no_working_day)
                            <tr>
                                <td>{{$no_working_day->id}}</td>
                                <td>
                                    @isset($no_working_day->fecha)
                                        {{$no_working_day->fecha}}
                                    @else
                                        N/A
                                    @endisset
                                </td>
                                @can('admin.no_working_days.edit')
                                    <td width="10px"><a class="btn btn-default btn-sm" href="{{route('admin.calendars.edit', $no_working_day)}}"><i class="fas fa-edit"></i></a></td>
                                @endcan
                                @can('admin.no_working_days.destroy')
                                    <td width="10px">
                                        <form action="{{ route('admin.calendars.destroy', $no_working_day) }}" method="POST" class="alert-delete">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="delete()"><i class="fas fa-trash-alt"></i></button>
                                        </form>
                                    </td>
                                @endcan
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="my-5">
                    <p class="text-center text-danger"><strong>Sin registro</strong></p>
                </div>
            @endif
        </div>
        <div class="card-footer">
            {{$no_working_days->links()}}
        </div>
    </div>
</div>

@push('js')

    {{--<script src="{{ asset('js/calendar.js') }}"></script>--}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            locale: 'es',
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
        },
            initialDate: {!! json_encode($hoy) !!},
            navLinks: true, // can click day/week names to navigate views
            editable: false,
            selectable: false,
            dayMaxEvents: false, // allow "more" link when too many events
            events: {!! json_encode($json_dias) !!}
        });
        calendar.render();
        });
    </script>
@endpush
