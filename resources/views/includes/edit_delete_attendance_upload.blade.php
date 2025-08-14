<!-- Edit -->
<div class="modal fade" id="edit{{ $record->id }}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><b>Edit Attendance Details</b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>

            </div>
            <div class="modal-body text-left">
                <form class="form-horizontal" method="POST" action="{{ route('update_attendance', $record->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="description">Description</label>
                        <input type="text" class="form-control" placeholder="Enter a Description" id="description"
                            name="description" value="{{ $record->description }}" required />
                    </div>
                    <div class="form-group">
                        <label for="att_date">Date</label>
                        <input type="date" class="form-control" id="att_date" name="upload_date"
                            value="{{ $record->upload_date }}" required />
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i
                                class="fa fa-close"></i> Close</button>
                        <button type="submit" class="btn btn-success btn-flat" name="edit"><i
                                class="fa fa-check-square-o"></i>
                            Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Delete -->
<div class="modal fade" id="delete{{ $record->id }}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header " style="align-items: center">

                <h4 class="modal-title "><span class="employee_id">Delete Attendance Upload</span></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="POST" action="{{ route('attendance_records_delete', $record->for_sorting) }}">
                    @csrf
                    {{ method_field('DELETE') }}
                    <div class="text-center">
                        <h6>Are you sure you want to delete:</h6>
                        <h2 class="bold del_employee_name">{{ $record->description }}</h2>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i
                        class="fa fa-close"></i> Close</button>
                <button type="submit" class="btn btn-danger btn-flat"><i class="fa fa-trash"></i> Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- View -->
<div class="modal fade" id="view{{ $record->id }}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><b>Edit Attendance Details</b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>

            </div>
            <div class="modal-body text-left">
                <table id="datatable-buttons" class="table table-striped table-hover table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">

                        <thead class="thead-dark">
                            <tr>
                                <th>#</th>
                                <th data-priority="1">ID</th>
                                <th data-priority="2">Name</th>
                                <th data-priority="3">Location</th>
                                <th data-priority="4">Attendance Date</th>
                                <th data-priority="5">Attendance Weekday</th>
                                <th data-priority="6">Check-in Time</th>
                                <th data-priority="7">Check-out Time</th>
                                <th data-priority="8">Total Hours</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $attendance = \App\Models\AttendanceRecord::where('for_sorting', $record->for_sorting)->orderByDesc('att_date')->get();
                            @endphp
                            @foreach( $attendance as $key => $att)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>{{$att->employee->staff_id}}</td>
                                    <td>{{$att->employee->name}}</td>
                                    <td>{{$att->location}}</td>
                                    <td>{{$att->att_date}}</td>
                                    <td>{{$att->att_weekday}}</td>
                                    <td>{{$att->check_in_time}}</td>
                                    <td>{{$att->check_out_time}}</td>
                                    <td>{{$att->total_hours}}</td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
            </div>
        </div>
    </div>
</div>
