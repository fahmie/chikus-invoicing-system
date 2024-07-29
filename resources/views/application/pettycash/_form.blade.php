<style>
/* Chrome, Safari, Edge, Opera */
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
    }

/* Firefox */
    input[type=number] {
    -moz-appearance: textfield;
    }
</style>
<div class="row">
    <div class="col-md-12 offset-md-3" style="margin-left: 0;">
        <div class="card card-form">
            <div class="row no-gutters">
                <div class="col-lg-4 card-body">
                    <h6><strong class="headings-color">Debit Details</strong></h6>
                    <p class="text-muted">Transaction to add on petty cash amount at operation site</p>
                </div>
                <div class="col-lg-8 card-form__body card-body">
                <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <div>
                                    <label for="phone">Details <span class="required" style="color:#dc3545">* </span></label>
                                </div>
                                  <div class="form-check">
                                    <input type="radio" class="form-check-input" id="materialChecked1" name="detail" value="Topup from HQ Account" checked>
                                    <label class="form-check-label" for="materialChecked">Topup from HQ Account</label>
                                  </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group mt-4">
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" id="materialUnchecked" name="detail">
                                    <label class="form-check-label" for="materialUnchecked">Others <span style="font-size: 12px; font-style: italic; text-transform: none;">(if choose others please specify)</span></label>
                                  </div>
                                  <div class="form-check" id="main_item" style="display: none;">
                                    <input type="text" class="form-control" name="other" value="" placeholder="Please write the revenue source">
                                  </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group required">
                                <label for="display_name">Date</label>
                                <!-- <input type="date" class="form-control" name="date" value="2011/08/19" id="example-date-input" required> -->
                                <input name="date" readonly="readonly" type="text" maxlength="6" class="form-control form-control-prepended"  value="<?php echo date("Y/m/d") ?>">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group required">
                                <label for="contact_name">Time</label>
                                <input type="time" name="time" class="form-control" value="13:45:00" id="example-time-input" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group required">
                                <label for="phone">Amount (RM)</label>
                                <input type="number" pattern="[0-9]+([\.][0-9]+)?" step="0.01" class="form-control" name="debit" value="" placeholder="" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group required">
                                <label for="site">{{ __('Sites') }}</label>
                                <select name="sites_id"  class="form-control" required>
                                @foreach ($sites as $site)
                                <option value="{{ $site->id}}" @if(isset($member) && $member->sites_id == $site->id) selected @endif>{{$site->name}}</option>
                                @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                   
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="description">Remarks</label>
                                <textarea class="form-control {{ $errors->has('description')? 'is-invalid': ''}}" name="remark" cols="30" rows="3"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-group text-center mt-5">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                </div>
            </div>
        </div>
    </div>   
</div>
<script>
    n =  new Date();
    y = n.getFullYear();
    m = n.getMonth() + 1;
    d = n.getDate();
    document.getElementById("date").innerHTML = d + "/" + m + "/" + y;
</script>