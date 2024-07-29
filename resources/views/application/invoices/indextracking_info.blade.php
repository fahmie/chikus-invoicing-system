<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<style>
    .pt-100{
        padding-top:100px;
    }
    .pb-100{
        padding-bottom:100px;
    }
    .section-title {
    margin-bottom: 60px;
    }
    .section-title p {
        color: #777;
        font-size: 16px;
    }
    .section-title h4 {
        text-transform: capitalize;
        font-size: 40px;
        position: relative;
        padding-bottom: 0;
        margin-bottom: 20px;
        font-weight: 600;
    }
    ul.timeline-list {
        position: relative;
        margin: 0;
        padding: 0
    }
    ul.timeline-list:before {
        position: absolute;
        content: "";
        width: 2px;
        height: 100%;
        background-color: #3b5998;
        left: 50%;
        top: 0;
        -webkit-transform: translateX(-50%);
                transform: translateX(-50%);
    }
    ul.timeline-list li {
        position: relative;
        clear: both;
        display: inherit;
    }
    .timeline_content {
        
        background-color:#fff
    }
    ul.timeline-list li .timeline_content {
        width: 45%;
        color: #333;
        padding: 15px;
        float: left;
        text-align: right;
        box-shadow: 0 10px 25px 0 rgba(50, 50, 93, 0.07), 0 5px 15px 0 rgba(0, 0, 0, 0.07);
    }
    ul.timeline-list li:nth-child(2n) .timeline_content {
        float: right;
        text-align: left;
    }
    .timeline_content h4 {
        font-size: 22px;
        font-weight: 600;
        margin: 10px 0;
    }
    ul.timeline-list li:before {
        position: absolute;
        content: "";
        width: 15px;
        height: 15px;
        background-color: #3b5998;
        left: 50%;
        top: 50%;
        -webkit-transform: translate(-50%, -50%);
                transform: translate(-50%, -50%);
        border-radius: 50%;
    }
    .timeline_content span {
        font-size: 18px;
        font-weight: 500;
        font-family: poppins;
        color: #3b5998;
    }
    .modal {
    text-align: center;
    }

    @media screen and (min-width: 768px) { 
    .modal:before {
        display: inline-block;
        vertical-align: middle;
        content: " ";
        height: 100%;
    }
    }

    .modal-dialog {
    display: inline-block;
    text-align: left;
    vertical-align: middle;
    }
    @import url(https://fonts.googleapis.com/css?family=Open+Sans);





    .boxes {
        margin: auto;
        padding: 12px;
        background: transparent;
    }

    /*Checkboxes styles*/
    input[type="checkbox"] { display: none; }

    input[type="checkbox"] + label {
    display: block;
    position: relative;
    padding-left: 35px;
    margin-bottom: 20px;
    font: 14px/20px 'Open Sans', Arial, sans-serif;
    color: #000;
    cursor: pointer;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    }

    input[type="checkbox"] + label:last-child { margin-bottom: 0; }

    input[type="checkbox"] + label:before {
    content: '';
    display: block;
    width: 20px;
    height: 20px;
    border: 1px solid #6cc0e5;
    position: absolute;
    left: 0;
    top: 0;
    opacity: .6;
    -webkit-transition: all .12s, border-color .08s;
    transition: all .12s, border-color .08s;
    }

    input[type="checkbox"]:checked + label:before {
    width: 10px;
    top: -5px;
    left: 5px;
    border-radius: 0;
    opacity: 1;
    border-top-color: transparent;
    border-left-color: transparent;
    -webkit-transform: rotate(45deg);
    transform: rotate(45deg);
    }
    body{
        background-color: #f3f3f3;
    
        margin: 0;
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
        font-size: 1rem;
        font-weight: 400;
        line-height: 1.5;
        color: #000;

    }
    p {
        font-size: 0.875rem;
        margin-bottom: .5rem;
        line-height: 1.3rem;
    }


    .card {
        position: relative;
        display: flex;
        flex-direction: column;
        min-width: 0;
        word-wrap: break-word;
        background-color: #fff;
        background-clip: border-box;
        border: 1px solid #e7eaed;
        border-radius: 0;
    }
    .card .card-description {
        margin-bottom: .875rem;
        font-weight: 400;
        color: #76838f;
    }






    .profile-header {
        height: 150px;
        width: 100%;
        position: relative;
    }

    .cover-image {
        height: 150px;
        width: 100%;
        overflow: hidden;
    }



    .user-image {
        position: absolute;
        height: 80px;
        width: 80px;
        border-radius: 50%;
        bottom: -50%;
        left: 50%;
        /* top: 50%; */
        transform: translate(-50%, -50%);
        z-index: 5;
    }

    .user-image img {
        height: 80px;
        width: 80px;
        border-radius: 50%;
        top: -40px;
        border: 5px solid #777;
    }

    .profile-card .profile-content {
        padding: 50px 20px 30px 20px;
    }



    .profile-card .profile-name {
        font-size: 1.2rem;
        color: #3249b9;
        font-weight: 600;
        text-align: center;
    }

    .profile-card .profile-designation {
        font-size: 13px;
        color: #777;
        text-align: center;
    }

    .profile-card .profile-description {
        padding: 10px;
        font-size: 13px;
        color: #777;
        margin: 5px 0px;
        background-color: #F1F2F3;
        border-radius: 5px;
    }

    .profile-card ul.profile-info-list {
        padding: 0;
        margin: 10px 0;
        list-style: none;
        font-size: 1rem;
        font-weight: 500;
        color: #777;
    }




    .profile-card ul.profile-info-list a {
        text-decoration: none;
        color:inherit;
    }



    .profile-card a.profile-info-list-item {
        margin: 10px 0;
        padding:15px;
        background-color: #F1F2F3;
        display: block;
        -webkit-transition: all .5s ease-in-out;
        -o-transition: all .5s ease-in-out;
        transition: all .5s ease-in-out;

    }

    .profile-card a.profile-info-list-item:hover {
        background-color: #9E9E9E;
        color: white;
        -webkit-transition: all .5s ease-in-out;
        -o-transition: all .5s ease-in-out;
        transition: all .5s ease-in-out;
        
    }


    .profile-card a.profile-info-list-item  i {
        padding: 10px;
        
    }

    ul.about {
        list-style: none;
        color: black;
        padding: 0;
    }
    li.about-items {
        margin: 10px;
        font-size: 0.9rem;
        /* font-family: sans-serif; */
        /* font-weight: 400; */
    }



    li.about-items i {
    color:#607d8b;
    }

    span.about-item-name {
        width: 100px;
        display: inline-flex;
            margin-left: 10px;
    }


    span.about-item-detail {
        display: inline-flex;
        width: calc(100% - 160px);
    }
    span.about-item-detail > button{
    margin-right: 10px;
    }

    .btn.btn-icon {
        width: 40px;
        height: 40px;
        padding: 0;
    }
    .btn.btn-rounded {
        border-radius: 50px;
    }

    a.about-item-edit {
        float: right;
    }
    ul.timeline {
        list-style-type: none;
        position: relative;
    }
    ul.timeline:before {
        content: ' ';
        background: #d4d9df;
        display: inline-block;
        position: absolute;
        left: 29px;
        width: 2px;
        height: 100%;
        z-index: 400;
    }
    ul.timeline > li {
        margin: 20px 0;
        padding-left: 20px;
    }
    ul.timeline > li:before {
        content: ' ';
        background: white;
        display: inline-block;
        position: absolute;
        border-radius: 50%;
        border: 3px solid #22c0e8;
        left: 20px;
        width: 20px;
        height: 20px;
        z-index: 400;
    }

</style>
@extends('layouts.app', ['page' => 'tracking'])

@section('title', "Tracking")
    
@section('page_header')
    <div class="page__heading d-flex align-items-center">
        <div class="flex">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="#"><i class="material-icons icon-20pt">home</i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Tracking Info</li>
                </ol>
            </nav>
            <h1 class="m-0">Tracking Info</h1>
        </div>
        
    </div>
@endsection

@section('content')

    @include('application.invoices._filters_transit')
        <!-- <div class="row">
            <div class="col-md-12 offset-md-3" style="margin-left: 0;">
                <div class="card">
                    <div class="card-body">
                        <ul class="timeline">
                            <li>
                                <a target="_blank" href="https://www.totoprayogo.com/#">Pick up by Ann Tan</a>
                                <a href="#" class="float-right">12/09/2020 12:00pm</a>
                                <p>INV-CT-28292/DO-CT-28292</p>
                            </li>
                            <li>
                                <a href="#">Arrival</a>
                                <a href="#" class="float-right">
                                        <button  type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                            Received
                                        </button>
                                </a>
                                <p>Not arrived yet</p>
                                        

                            </li>
                            <li>
                                <a href="#">Arrival</a>
                                <a href="#" class="float-right">12/09/2020 2:00pm</a>
                                <p>Arrived with accurate amout</p>
                            </li>
                            <li>
                                <a href="#">Receipt</a>
                                <a href="#" class="float-right">18/09/2020 1:30pm</a>
                                <p>REC-CT-1229289</p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>   
        </div> -->
        <div class="card">
                @include('application.invoices._table4')
        </div>
    

@endsection
    <!-- Modal accurate -->

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" style="max-width:380px;" role="document">
            <div class="modal-content">
            <div class="modal-header" style="background-color: #78B5E7;">
                <h6 class="modal-title" style="color: #fff;" id="exampleModalLabel">Are you sure this item has been delivered?</h6>
                <button type="button" style="color: #fff;" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
            <form id="postForm" name="postForm" class="form-horizontal">
            <div class="container">
                <div class="row">
                    <div class="boxes">
                        <div class="form-group">
                        <input type="hidden" id="invoice_id" name="invoice_id" value="">
                             <label><strong>Plate Number:</strong></label>
                            <input type="text" id="platenumber" class="form-control" readonly>
                        </div>
                        <div class="form-group">
                             <label><strong>Arrival Quantity (MT):</strong></label>
                            <input type="text" id="tonnage" class="form-control" readonly>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            <div class="modal-footer" style="margin: auto;">
                <button type="submit" id="btn-save" class="btn btn-primary" data-dismiss="modal">Confirm</button>
            </div>
            </form>
            </div>
        </div>
    </div>
    <!-- Modal inaccurate -->

    <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" style="max-width:400px;" role="document">
            <div class="modal-content">
            <div class="modal-header" style="background-color: #DC554C;">
                <h6 class="modal-title" style="color: #fff;" id="exampleModalLabel">Any issue with quantity (tonnage) delivered?</h6>
                <button type="button" style="color: #fff;" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
            <div class="container">
                <div class="row">
                    <div class="boxes">
                    
                        <div class="form-group">
                        <input type="hidden" id="invoice_id2" name="invoice_id" value="">
                             <label><strong>Plate Number:</strong></label>
                            <input type="text" id="platenumber2" class="form-control" readonly>
                        </div>
                        <div class="form-group">
                             <label><strong>Supposed Quantity (MT):</strong></label>
                            <input type="text" id="tonnage2" name="supposed_qty" class="form-control" readonly>
                        </div>
                        <div class="form-group required">
                            <label><strong>Arrival Quantity (MT):</strong></label>
                            <input type="text" class="form-control" id="remark" name="remark"  placeholder="Insert Quantity Arrived">
                        </div>
                    </div>
                </div>
            </div>
        </div>
            <div class="modal-footer" style="margin: auto;">
                <button type="submit" id="submit" class="btn btn-primary" data-dismiss="modal">Confirm</button>
            </div>
            </div>
        </div>
    </div>
    @section('page_body_scripts')
    <script>
        $(document).ready(function () {

        $.ajaxSetup({
            headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
        });

        $('body').on('click', '#accurate', function (event) {

            //console.log("here accurate");
            event.preventDefault();
            var id = $(this).data('id');
            //console.log(id)
            $.get('/tracking/'+ id +'/confirm', function (data) {
               console.log(data); 
              
               //data.data.forEach(element => console.log(element.quantity));
               const copy = [];
               data.data.forEach(function (item) { 
                    copy.push(item.quantity*1); 
                }); 
                var qun = copy.reduce(myFunc);
                function myFunc(total, num) {
                return total + num;
                }
                //console.log(qun);
                var qty = data.data[0].quantity;
                var qt = qty / 1;
                  console.log(data);
                $('#invoice_id').val(data.data[0].invoice_id);
                $('#platenumber').val(data.data[0].number_plate);
                $('#tonnage').val(qun);
            })
        });

            $('body').on('click', '#notaccurate', function (event) {

            //console.log("here accurate");
            event.preventDefault();
            var id = $(this).data('id');
            //console.log(id)
            $.get('/tracking/'+ id +'/confirm', function (data) {
               //console.log(data); 
                //alert(data.data[0].plate_number);
                const copy = [];
               data.data.forEach(function (item) { 
                    copy.push(item.quantity*1); 
                }); 
                var qun = copy.reduce(myFunc);
                function myFunc(total, num) {
                return total + num;
                }
                var qty = data.data[0].quantity;
                var qt = qty / 1;
                $('#invoice_id2').val(data.data[0].invoice_id);
                $('#platenumber2').val(data.data[0].number_plate);
                $('#tonnage2').val(qun);
            })
        });

        $('body').on('click', '#submit', function (event) {

            //console.log("here accurate");
            event.preventDefault();
            var id = $("#invoice_id2").val();
            var remark = $('#remark').val();
            var tonnage2 = $('#tonnage2').val();
           //console.log(tonnage2);
            $.ajax({
            url: '/tracking/'+ id +'/notaccsubmit',
            type: "GET",
            data: {
                id: id,
                remark: remark,
                tonnage2:tonnage2,
            },
            dataType: 'json',
            success: function (data) {
             //console.log(data);  
             window.location.reload(true);


            },
            error: function (data) {
                //console.log(data);  
                Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text:'Quantity received cannot be more than quantity loaded',
                })
                //console.log(data);
            }
        });
        });

        $('body').on('click', '#btn-save', function (event) {
            event.preventDefault()
            var id = $("#invoice_id").val();
            var tonnage = $("#tonnage").val();
        
            $.ajax({
            url: '/tracking/'+ id +'/submit',
            type: "GET",
            data: {
                id: id,
                tonnage: tonnage,
            },
            dataType: 'json',
            success: function (data) {
            window.location.reload(true);


            },            
            error: function (data) {
                //console.log(data.responseJSON.message);  
                Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: data.responseJSON.message,
                })
                //console.log(data);
            }
        });
        });

        }); 
    </script>
@endsection