<!-- Edit -->
<div class="modal fade" id="edit{{ $employee->id }}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title"><b>Edit Employee Details</b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>

            </div>
            <div class="modal-body text-left">
                <form class="form-horizontal" method="POST" action="{{ route('employees.update', $employee->name) }}">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                            <label for="staff_id">Staff ID</label>
                            <input type="text" class="form-control" placeholder="Enter a Employee Staff ID" value="{{ $employee->staff_id }}" id="staff_id" name="staff_id"
                                required />
                        </div>
                    <div class="form-group">
                        <label for="name" class="col-sm-3 control-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $employee->name }}"
                            required>

                    </div>
                    <div class="form-group">
                        <label for="name" class="col-sm-3 control-label">Position</label>


                        <input type="text" class="form-control" id="position" name="position" value="{{ $employee->position }}"
                            required>

                    </div>

                    <div class="form-group">
                        <label for="schedule" class="col-sm-3 control-label">Schedule</label>


                        <select class="form-control" id="schedule" name="schedule" required>
                            <option value="" selected>- Select -</option>
                            @foreach ($schedules as $schedule)
                                <option @if($schedule->slug == $employee->schedules->first()->slug ) selected @endif value="{{ $schedule->slug }}">{{ $schedule->slug }} -> from
                                    {{ $schedule->time_in }} to {{ $schedule->time_out }} </option>
                            @endforeach

                        </select>

                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i
                        class="fa fa-close"></i> Close</button>
                <button type="submit" class="btn btn-success btn-flat" name="edit"><i class="fa fa-check-square-o"></i>
                    Update</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Delete -->
<div class="modal fade" id="delete{{ $employee->id }}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header " style="align-items: center">

              <h4 class="modal-title "><span class="employee_id">Delete Employee</span></h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="POST" action="{{ route('employees.destroy', $employee->name) }}">
                    @csrf
                    {{ method_field('DELETE') }}
                    <div class="text-center">
                        <h6>Are you sure you want to delete:</h6>
                        <h2 class="bold del_employee_name">{{$employee->name}}</h2>
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
