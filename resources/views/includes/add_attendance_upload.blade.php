<!-- Add -->
<div class="modal fade" id="addnew" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Log on to codeastro.com for more projects! -->

            <div class="modal-header">
                <h5 class="modal-title"><b>Add New Attendance Upload</b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>


            <div class="modal-body">
                <!-- Log on to codeastro.com for more projects! -->

                <div class="card-body text-left">

                    <form method="POST" action="{{ route('upload_attendance') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="description">Description</label>
                            <input type="text" class="form-control" placeholder="Enter a Description" id="description" name="description" required />
                        </div>
                        <div class="form-group">
                            <label for="att_date">Date</label>
                            <input type="date" class="form-control" id="att_date" name="upload_date" required />
                        </div>

                        <div class="form-group">
                            <label for="file">Attendance File <i>(Excel file only)</i></label>
                            <input type="file" class="form-control" id="file" name="file" required />
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
