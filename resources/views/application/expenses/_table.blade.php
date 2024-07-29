<style>
    html,
    body {
        margin: 0;
        padding: 0;
        width: 100%;
        height: 100%;
        -webkit-text-size-adjust: 100%;
        -ms-text-size-adjust: 100%;
        overflow-x: hidden;
        scroll-behavior: smooth;
        text-align: center;
    }
    .custom-navbar {
        position: -webkit-sticky;
        position: sticky;
        top: -1px;
        width: 100%;
        height: auto;
        padding: 0px 10px;
        z-index: 9;
        background-color: transparent;
    }
    .custom-navbar li{
        text-decoration: none;
        list-style: none;
        padding: 12px 0px;
        display:inline-block;
        list-style-type: none;
        letter-spacing: 1.2px;
    }
    .custom-navbar li a{
        color: #000;
        font-size: 14px;
        padding: 9px 5px;
        border-radius: 4px 4px;
    }
    .custom-navbar li a:hover{
        color: #404040;
        text-decoration: none;
        cursor: pointer;
        background-color: rgba(0,0,0,0.1111);
        -webkit-box-shadow: 0px 0px 5px -1px rgba(0,0,0,0.75);
        -moz-box-shadow: 0px 0px 5px -1px rgba(0,0,0,0.75);
        box-shadow: 0px 0px 5px -1px rgba(0,0,0,0.75);
    }
    .custom-navbar li a:focus, .custom-navbar li a.focus, .custom-navbar li a.active, .custom-navbar li a:active{
        color: #E4E4E4;
        text-decoration: none;
        cursor: pointer;
        background-color: rgba(0,0,0,0.8);
        -webkit-box-shadow: 0px 0px 5px -1px rgba(0,0,0,0.75);
        -moz-box-shadow: 0px 0px 5px -1px rgba(0,0,0,0.75);
        box-shadow: 0px 0px 5px -1px rgba(0,0,0,0.75);
    }
    .custom-navbar li img{
        width: 30px;
        height: 30px;
    }

    .titletip {
    position: relative;
    display: inline-block;
    }

    .titletip .textTop {
    visibility: hidden;
    min-width: 120px;
    max-width: 150px;
    background-color: #555;
    color: #fff;
    text-align: center;
    border-radius: 6px;
    padding: 5px 5px;
    position: absolute;
    z-index: 1;
    bottom: 125%;
    left: 50%;
    margin-left: -60px;
    opacity: 0;
    transition: opacity 0.3s;
    }

    .titletip .textTop::after {
    content: "";
    position: absolute;
    top: 100%;
    left: 50%;
    margin-left: -5px;
    border-width: 5px;
    border-style: solid;
    border-color: #555 transparent transparent transparent;
    }

    .titletip .textBottom {
    visibility: hidden;
    min-width: 120px;
    max-width: 150px;
    background-color: #555;
    color: #fff;
    text-align: center;
    border-radius: 6px;
    padding: 5px 5px;
    position: absolute;
    z-index: 1;
    top: 125%;
    left: 50%;
    margin-left: -60px;
    opacity: 0;
    transition: opacity 0.3s;
    }

    .titletip .textBottom::after {
    content: " ";
    position: absolute;
    bottom: 100%;  /* At the top of the tooltip */
    left: 50%;
    margin-left: -5px;
    border-width: 5px;
    border-style: solid;
    border-color: transparent transparent black transparent;
    }

    .titletip:hover .textTop, .titletip:hover .textBottom {
    visibility: visible;
    opacity: 0.85;
    }
    /* Blink for Webkit and others
    (Chrome, Safari, Firefox, IE, ...)
    */

    @-webkit-keyframes blinker {
    from {opacity: 1.0;}
    to {opacity: 0.0;}
    }
    .blink{
        text-decoration: blink;
        -webkit-animation-name: blinker;
        -webkit-animation-duration: 0.8s;
        -webkit-animation-iteration-count:infinite;
        -webkit-animation-timing-function:ease-in-out;
        -webkit-animation-direction: alternate;
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
</style>
    <div class="table-responsive">
        <table class="table table-xl mb-0 thead-border-top-0 table-striped">
            <thead>
                <tr>
                    <th class="text-center w-30px">ID</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Status/Details</th>
                    <th><i class="material-icons icon-16pt mr-1 text-muted">add_circle</i>Debit Amount</th>
                    <th><i class="material-icons icon-16pt mr-1 text-muted">remove_circle</i>Credit Amount</th>
                    <th><i class="material-icons icon-16pt mr-1 text-muted">account_balance_wallet</i>Balance Amount</th>
                    <th>Remarks</th>
                </tr>
            </thead>
            <tbody class="list" id="expenses">
                    <tr>
                        <td class="p text-center w-30px">
                            <a>
                                1
                            </a>
                        </td>
                        <td class="p">
                                25/10/2020
                        </td>
                        <td class="p">
                                4:00pm
                        </td>
                        <td class="p">
                        Others (Detail from input credit)
                        </td>
                        <td class="p">
                        -
                        </td>
                        <td class="p">
                        50
                        </td>
                        <td class="p">
                        650
                        </td>
                        
                        <td class="p">
                            none
                        </td>
                    </tr>
                    <tr>
                        <td class="p text-center w-30px">
                            <a>
                                1
                            </a>
                        </td>
                        <td class="p">
                                25/10/2020
                        </td>
                        <td class="p">
                                4:00pm
                        </td>
                        <td class="p">
                        Others (Detail from input debit)
                        </td>
                        <td class="p">
                        20
                        </td>
                        <td class="p">
                        -
                        </td>
                        <td class="p">
                        650
                        </td>
                        
                        <td class="p">
                            none
                        </td>
                    </tr>
                    <tr>
                        <td class="p text-center w-30px">
                            <a>
                                2
                            </a>
                        </td>
                        <td class="p">
                                21/10/2020
                        </td>
                        <td class="p">
                            2:00pm
                        </td>
                        <td class="p">
                        Sales Cash
                        </td>
                        <td class="p">
                        200
                        </td>
                        <td class="p">
                        -
                        </td>
                        <td class="p">
                        700
                        </td>
                        
                        <td class="p">
                            none
                        </td>
                    </tr>
                    <tr>
                        <td class="p text-center w-30px">
                            <a>
                                2
                            </a>
                        </td>
                        <td class="p">
                                21/10/2020
                        </td>
                        <td class="p">
                            2:00pm
                        </td>
                        <td class="p">
                        Top up from HQ Account
                        </td>
                        <td class="p">
                        200
                        </td>
                        <td class="p">
                        -
                        </td>
                        <td class="p">
                        700
                        </td>
                        
                        <td class="p">
                            none
                        </td>
                    </tr>
                    <tr>
                        <td class="p text-center w-30px">
                            <a>
                                2
                            </a>
                        </td>
                        <td class="p">
                                21/10/2020
                        </td>
                        <td class="p">
                            2:00pm
                        </td>
                        <td class="p">
                        CDM to HQ Account
                        </td>
                        <td class="p">
                        -
                        </td>
                        <td class="p">
                        200
                        </td>
                        <td class="p">
                        700
                        </td>
                        
                        <td class="p">
                            none
                        </td>
                    </tr>
                    <tr>
                        <td class="p text-center w-30px">
                            <a>
                                3
                            </a>
                        </td>
                        <td class="p">
                                20/10/2020
                        </td>
                        <td class="p">
                                2:58pm
                        </td>
                        <td class="p">
                        Sales Contract
                        </td>
                        <td class="p">
                        500
                        </td>
                        <td class="p">
                        -
                        </td>
                        <td class="p">
                        500
                        </td>
                        
                        <td class="p">
                            none
                        </td>
                    </tr>
                
            </tbody>
        </table>
    </div>
    <div class="row card-body pagination-light justify-content-center text-center">
    </div>

    
    

