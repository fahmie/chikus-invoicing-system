
<?php 
    if(empty($_GET)){
        $name = null;
    }else{
        $name = $_GET ['contractname'];
    }
?>

<form action="{{ route('receipts.filterbyclient') }}" method="GET">
    <div class="card card-form d-flex flex-column flex-sm-row" style="margin-bottom: 0!important;box-shadow: none;">
        <div class="float-right card-form__body card-body" style="padding-bottom: 0">
            <div class="row">
                <div class="col-md-10" style="padding-right: 0">
                    <div class="form-group required">
                        <label for="contractname">Client/Contract Name</label>
                        <select id="contractname" name="contractname" data-toggle="select" >
                            <option disabled selected>Select Contract</option>
                            @foreach ($client as $client)
                            <option value="{{ $client->id}}" @if(isset($name) && $client->id == $name) selected @endif>{{$client->company_name}}</option>
                            @endforeach                             
                        </select>
                    </div>
                </div>
                <div class="col-md-2" style="margin-top: 30px">
                    <button type="submit" class="btn btn-outline-primary">
                            <i class="material-icons icon-20pt">search</i>
                            Search
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>
