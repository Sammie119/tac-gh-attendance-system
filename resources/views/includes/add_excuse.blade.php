<!-- Add -->
<div class="modal fade" id="addnew" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
			<!-- Log on to codeastro.com for more projects! -->

            <div class="modal-header">
            <h5 class="modal-title"><b>Add New Excuse</b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>

            </div>


            <div class="modal-body">
			<!-- Log on to codeastro.com for more projects! -->

                <div class="card-body text-left">

                    <form method="POST" action="{{ route('excuses.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="staff_name">Staff Name</label>
                            <input type="text" list="staffList" placeholder="Select Employee Name" class="form-control mb-3" name="staff_name" required>

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
                                <option value="Official-Duty">Official Duty</option>
                                <option value="Leave">Leave</option>
                                <option value="Sick">Sick</option>
                                <option value="Others">Others</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" placeholder="Enter Excuse Description" rows="5" id="description" name="description" required></textarea>
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="date_from">Date From</label>
                                    <input type="date" class="form-control" id="date_from" name="date_from" required />
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="date_to">Date To</label>
                                    <input type="date" class="form-control" id="date_to" name="date_to" required />
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="approved_by_name">Approved By</label>
                            <input type="text" list="staffList" placeholder="Excuse Approved By" class="form-control mb-3" name="approved_by_name" required>
                        </div>

                        <div class="form-group">
                            <div>
                                <button type="submit" class="btn btn-success waves-effect waves-light">
                                    Submit
                                </button>
                                <button type="reset" class="btn btn-danger waves-effect m-l-5" data-dismiss="modal">
                                    Cancel
                                </button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
			<!-- Log on to codeastro.com for more projects! -->

        </div>

    </div>
</div>
</div>
