<?php 
    if(empty($_GET)){
        $name = null;
    }else{
        $name = $_GET ['contractname'];
    }
?>
@if($name != null)
<div style=" margin: 10px; margin-left:30px">
<form class="form-inline" method="GET" action="{{ $action}}">
    <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Month</label>
    <select class="custom-select my-1 mr-sm-2" name="month" id="month">
      <option value="" selected>Choose Date..</option>
      <option value="1">January</option>  
      <option value="2">February</option>  
      <option value="3">March</option>  
      <option value="4">April</option>  
      <option value="5">May</option>  
      <option value="6">June</option>  
      <option value="7">July</option>  
      <option value="8">August</option>  
      <option value="9">September</option>  
      <option value="10">Oktober</option>  
      <option value="11">November</option>  
      <option value="12">December</option>   
    </select>
    <input type="hidden" value="{{$name}}" id='contractname' name="contractname">
    <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Year</label>
    <select class="custom-select my-1 mr-sm-2" id="year" name="year">
      <option value="" selected>Choose Date..</option>
      @foreach($month_year as $key => $val)
      <option value="{{$val->year}}">{{$val->year}}</option>  
      @endforeach
    </select>
    <button type="submit" id="submit" class="btn btn-primary my-1">Export to PDF</button>
 </form>   
</div> 
@else
    
@endif
