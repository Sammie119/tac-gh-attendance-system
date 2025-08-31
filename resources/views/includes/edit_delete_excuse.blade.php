<!-- Edit -->
<div class="modal fade" id="edit{{ $excuse->id }}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title"><b>Edit Employee Details</b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>

            </div>
            <div class="modal-body text-left">
                <form class="form-horizontal" method="POST" action="{{ route('excuses.update', $excuse->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="staff_name">Staff Name</label>
                        <input type="text" list="staffList" placeholder="Select Employee Name" value="{{ \App\Models\Employee::find($excuse->emp_id)->name }}" class="form-control mb-3" name="staff_name" required>

                        <datalist id="staffList">
                            @foreach (\App\Models\Employee::orderBy('name')->get() as $staff)
                                <option value="{{ $staff->name }}">
                            @endforeach
                        </datalist>
                    </div>

                    <div class="form-group">
                        <label for="excuse_type">Excuse Type</label>
                        <select class="form-control" name="excuse_type" id="excuse_type" required>
                            <option selected disabled value="">--Select--</option>
                            <option @if($excuse->excuse_type == 'Official-Duty') selected @endif value="Official-Duty">Official Duty</option>
                            <option @if($excuse->excuse_type == 'Leave') selected @endif value="Leave">Leave</option>
                            <option @if($excuse->excuse_type == 'Sick') selected @endif value="Sick">Sick</option>
                            <option @if($excuse->excuse_type == 'Others') selected @endif value="Others">Others</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" placeholder="Enter Excuse Description" rows="5" id="description" name="description" required>{{ $excuse->excuse_description }}</textarea>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="date_from">Date From</label>
                                <input type="date" class="form-control" value="{{ $excuse->from_date }}" id="date_from" name="date_from" required />
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="date_to">Date To</label>
                                <input type="date" class="form-control" value="{{ $excuse->to_date }}" id="date_to" name="date_to" required />
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="approved_by_name">Approved By</label>
                        <input type="text" list="staffList" placeholder="Excuse Approved By" value="{{ \App\Models\Employee::find($excuse->approved_by_id)->name }}" class="form-control mb-3" name="approved_by_name" required>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i
                                class="fa fa-close"></i> Close</button>
                        <button type="submit" class="btn btn-success btn-flat" name="edit"><i class="fa fa-check-square-o"></i>
                            Update</button>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Delete -->
<div class="modal fade" id="delete{{ $excuse->id }}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header " style="align-items: center">

              <h4 class="modal-title "><span class="employee_id">Delete Excuse</span></h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="POST" action="{{ route('excuses.destroy', $excuse) }}">
                    @csrf
                    {{ method_field('DELETE') }}
                    <div class="text-center">
                        <h6>Are you sure you want to delete:</h6>
                        <h2 class="bold del_employee_name">{{$excuse->employee->name}}</h2>
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
<div class="modal fade" id="view{{ $excuse->id }}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header " style="align-items: center">
              <h5 class="modal-title "><b class="employee_id">View Excuse</b></h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body text-left">
                <div class="form-group">
                    <label for="staff_name">Staff Name</label>
                    <input type="text" placeholder="Select Employee Name" value="{{ \App\Models\Employee::find($excuse->emp_id)->name }}" class="form-control mb-3" readonly>
                </div>

                <div class="form-group">
                    <label for="excuse_type">Excuse Type</label>
                    <input type="text" placeholder="Select Employee Name" value="{{ $excuse->excuse_type }}" class="form-control mb-3" readonly>
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" placeholder="Enter Excuse Description" rows="5" id="description" name="description" readonly>{{ $excuse->excuse_description }}</textarea>
                </div>

                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="date_from">Date From</label>
                            <input type="date" class="form-control" value="{{ $excuse->from_date }}" id="date_from" name="date_from" readonly />
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="date_to">Date To</label>
                            <input type="date" class="form-control" value="{{ $excuse->to_date }}" id="date_to" name="date_to" readonly />
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="approved_by_name">Approved By</label>
                    <input type="text" placeholder="Excuse Approved By" value="{{ \App\Models\Employee::find($excuse->approved_by_id)->name }}" class="form-control mb-3" readonly>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            </div>
        </div>
    </div>
</div>
