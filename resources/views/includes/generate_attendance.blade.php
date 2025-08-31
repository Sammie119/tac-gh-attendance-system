<!-- Add -->
<div class="modal fade" id="addnew" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Log on to codeastro.com for more projects! -->

            <div class="modal-header">
                <h5 class="modal-title"><b>Select Date Range</b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>


            <div class="modal-body">
                <!-- Log on to codeastro.com for more projects! -->

                <div class="card-body text-left">

                    <form>
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

                            <div class="col-12">
                                <div class="form-group">
                                    <label for="staff_name">Staff Name</label>
                                    <input type="text" list="staffList" class="form-control mb-3" name="staff_name" required>

                                    <datalist id="staffList">
                                        <option selected value="ALL">
                                        @foreach (\App\Models\Employee::orderBy('name')->get() as $staff)
                                            <option value="{{ $staff->name }}">
                                        @endforeach
                                    </datalist>
                                </div>
                            </div>
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

<!-- Sheet -->
<div class="modal fade" id="attendance_sheet" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Log on to codeastro.com for more projects! -->

            <div class="modal-header">
                <h5 class="modal-title"><b>Select Month and Year</b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>


            <div class="modal-body">
                <!-- Log on to codeastro.com for more projects! -->

                <div class="card-body text-left">

                    <form>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="date_from">Month</label>
                                    <select class="form-control" name="month" required>
                                        <option value="" selected disabled>--Select Month--</option>
                                        <option {{ (date('m') === '01') ? 'selected' : null }} value="01">January</option>
                                        <option {{ (date('m') === '02') ? 'selected' : null }} value="02">February</option>
                                        <option {{ (date('m') === '03') ? 'selected' : null }} value="03">March</option>
                                        <option {{ (date('m') === '04') ? 'selected' : null }} value="04">April</option>
                                        <option {{ (date('m') === '05') ? 'selected' : null }} value="05">May</option>
                                        <option {{ (date('m') === '06') ? 'selected' : null }} value="06">June</option>
                                        <option {{ (date('m') === '07') ? 'selected' : null }} value="07">July</option>
                                        <option {{ (date('m') === '08') ? 'selected' : null }} value="08">August</option>
                                        <option {{ (date('m') === '09') ? 'selected' : null }} value="09">September</option>
                                        <option {{ (date('m') === '10') ? 'selected' : null }} value="10">October</option>
                                        <option {{ (date('m') === '11') ? 'selected' : null }} value="11">November</option>
                                        <option {{ (date('m') === '12') ? 'selected' : null }} value="12">December</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="date_to">Year</label>
                                    <select class="form-control" name="year" required>
                                        <option value="" selected disabled>--Select Year--</option>
                                        <?php
                                        for($i = 2025 ; $i <= date('Y'); $i++){
                                                $thisYear = (date('Y') == $i) ? 'selected' : null;
                                            echo "<option ". $thisYear .">$i</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="staff_name">Staff Name</label>
                                    <input type="text" list="staffList" class="form-control mb-3" name="staff_name" required>

                                    <datalist id="staffList">
                                        <option selected value="ALL">
                                        @foreach (\App\Models\Employee::orderBy('name')->get() as $staff)
                                            <option value="{{ $staff->name }}">
                                        @endforeach
                                    </datalist>
                                </div>
                            </div>
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

