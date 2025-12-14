<div class="x_panel" style="margin-top: 40px;">
    <div class="x_title">
        <h2>Add Membership Type</h2>

        <div class="clearfix"></div>
    </div>
    <div class="x_content" style="margin-top: 40px;">
        <div id="mainContent" style="display: block;">
            <form name="mainForm" id="mainForm" class="simbio_form_maker" method="post" action="<?= base_url('membership/savetype') ?>" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="memberTypeName" class="control-label col-md-3">Membership Type*</label>
                            <input type="text" name="member_type_name" id="memberTypeName" class="form-control" value="" style="width: 100%;" maxlength="256">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="loanLimit" class="control-label col-md-3">Loan Amount</label>
                            <input type="text" name="loan_limit" id="loanLimit" class="form-control" value="" size="5" maxlength="256">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="loanPeriode" class="control-label col-md-4">Loan Duration (In Days)</label>
                            <input type="text" name="loan_periode" id="loanPeriode" class="form-control" value="" size="5" maxlength="256">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="enableReserve" class="control-label col-md-3">Reservation</label>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div>
                                    <input type="radio" name="enable_reserve" id="enableReserve" value="1"> Possible
                                </div>
                                <div>
                                    <input type="radio" name="enable_reserve" id="enableReserve" value="0"> Impossible
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="memberPeriode" class="control-label col-md-4">Membership Duration (In Days)</label>
                            <input type="text" name="member_periode" id="memberPeriode" class="form-control" value="" size="5" maxlength="256">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="reserveLimit" class="control-label col-md-3">Reservation Mount</label>
                            <input type="text" name="reserve_limit" id="reserveLimit" class="form-control" value="" size="5" maxlength="256">
                        </div>
                    </div>
                </div>
                <div class="row">

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="reborrowLimit" class="control-label col-md-3">Number of Renewals</label>
                            <input type="text" name="reborrow_limit" id="reborrowLimit" class="form-control" value="" size="5" maxlength="256">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="fineEachDay" class="control-label col-md-3">Daily Fine</label>
                            <input type="text" name="fine_each_day" id="fineEachDay" class="form-control" value="" maxlength="256">
                        </div>
                    </div>
                </div>
                <div class="row">

                    <div class="col-md-6"></div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="gracePeriode" class="control-label col-md-3">Late Tolerance</label>
                            <input type="text" name="grace_periode" id="gracePeriode" class="form-control" value="" maxlength="256">
                        </div>
                    </div>
                </div>
                <div class="form-group text-right">
                    <input type="submit" class="btn btn-success text-right" name="saveData" value="Save">
                </div>
            </form>
        </div>
    </div>
</div>