<style>
    #event-transaction-table_filter {
        width: 42%;
        float: right;
    }

    #artist-transaction-table_filter {
        width: 42%;
        float: right;
    }
    .button_date{
        width: 100%;
        height: 26px;
        border-radius: 3px;
        font-size: 11px;
        line-height: 2px;
       }

    #artist-transaction-table_wrapper .dt-buttons {
        background-color: #f7f8fa;
    }

    .dt-button-collection .button-page-length {

    }
</style>
<section id="tabs">
    <?php
    $artistAmount = \App\ArtistPermitTransaction::get()->sum('amount');
    $eventamount = \App\EventTransaction::get()->sum('amount');
    $totalAmountReceived = $artistAmount + $eventamount;
    ?>
    <div class="row">
        <div class="col">
         <span style="float: right">Total Amount Received :
         <span style="
         background-color: #565656;
         padding: 5px;
         border: none;
         border-radius: 3px;
         color: white;
         font-size: 11px;
         box-shadow: 1px 4px 5px -2px #7b7b7b;">AED {{number_format($totalAmountReceived)}}</span></span>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12 ">
                <nav>
                    <div class="nav nav-tabs nav-tabs-line nav-tabs-bold nav-tabs-line-3x nav-tabs-line-danger"
                         id="nav-tab" role="tablist" style="width: 102%;margin-top: -30px;margin-left: -10px">
                        <a class="nav-item nav-link active artist_transaction_tab"
                           style="font-weight: 500;font-size: 11px"
                           id="artist-transaction-tab" data-toggle="tab"
                           href="#artist-transaction-report" role="tab" aria-controls="artist-transaction-report"
                           aria-selected="true">{{__('ARTIST TRANSACTIONS')}}</a>
                        <a class="nav-item nav-link" id="event-transaction-tab" style="font-size: 11px;font-weight: 500"
                           data-toggle="tab"
                           href="#event-transaction-report" role="tab" aria-controls="event-transaction-report"
                           aria-selected="false">{{__('EVENT TRANSACTIONS')}}</a>
                    </div>
                </nav>
                <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="artist-transaction-report" role="tabpanel"
                         aria-labelledby="artist-transaction-tab">
                        <div class="row"  style="margin-bottom: 10px;margin-top: -20px;">
                            <div class="col-2">
                                <button class="btn btn-outline-dark btn-sm button_date" id="seven_days_artist_transaction">Last 7 Days</button>
                            </div>
                            <div class="col-2">
                                <button class="btn btn-outline-dark btn-sm button_date" id="thirty_days_artist_transaction">Last 30 Days</button>
                            </div>
                            <div class="col-2">
                                <button type="button" class="btn btn-outline-dark btn-sm button_date" id="custom_days_artist_transaction" data-toggle="modal" data-target="#artist-transaction-modal">
                                    Custom Date
                                </button>
                                <div class="modal fade" id="artist-transaction-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel" style="margin-left: 35%;">Select Date Range</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <input style="font-family: monospace;font-size: 11px" type="date" class="form-control" id="artist_transaction_start_date">
                                                    </div>
                                                    <div class="col-6">
                                                        <input style="font-family: monospace;font-size: 11px" type="date" class="form-control" id="artist_transaction_end_date">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                                                <button type="button" id="artist_transaction_submit" data-dismiss="modal"  class="btn btn-primary btn-sm">Submit</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <table class="table table-striped table-hover" id="artist-transaction-table">
                            <thead>
                            <tr>
                                <th style="">TRANSACTION ID</th>
                                <th style="">ARTIST NAME</th>
                                <th style="">TRANSACTION TYPE</th>
                                <th style="">VAT</th>
                                <th style="">AMOUNT(AED)</th>
                                <th style="">TRANSACTION DATE</th>
                                <th style="">COMPANY</th>
                                <th style="">PERMIT NUMBER</th>
                                <th style="">PERMIT STATUS</th>
                                <th style="">NATIONALITY</th>
                                <th style="">PROFESSION</th>
                                <th style="">MOBILE NUMBER</th>
                                <th style="">PASSPORT NUMBER</th>
                                <th style="">PASSPORT EXPIRE DATE</th>
                                <th style="">UID NUMBER</th>
                                <th style="">UID EXPIRE DATE</th>


                            </tr>
                            </thead>
                        </table>
                    </div>
                    <div class="tab-pane fade" id="event-transaction-report" role="tabpanel"
                         aria-labelledby="event-transaction-tab">
                        <div class="row"  style="margin-bottom: 10px;margin-top: -20px;">
                            <div class="col-2">
                                <button class="btn btn-outline-dark btn-sm button_date" id="seven_days_event_transaction">Last 7 Days</button>
                            </div>
                            <div class="col-2">
                                <button class="btn btn-outline-dark btn-sm button_date" id="thirty_days_event_transaction">Last 30 Days</button>
                            </div>
                            <div class="col-2">
                                <button type="button" class="btn btn-outline-dark btn-sm button_date" id="custom_days_event_transaction" data-toggle="modal" data-target="#event-transaction-modal">
                                    Custom Date
                                </button>
                                <div class="modal fade" id="event-transaction-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel" style="margin-left: 35%;">Select Date Range</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <input style="font-family: monospace;font-size: 11px" type="date" class="form-control" id="event_transaction_start_date">
                                                    </div>
                                                    <div class="col-6">
                                                        <input style="font-family: monospace;font-size: 11px" type="date" class="form-control" id="event_transaction_end_date">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                                                <button type="button"  id="event_transaction_submit" data-dismiss="modal"  class="btn btn-primary btn-sm">Submit</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <table class="table table-striped table-hover" id="event-transaction-table">
                            <thead>
                            <tr>
                                <th style="">TRANSACTION ID</th>
                                <th style="">EVENT NAME</th>
                                <th style="">TRANSACTION TYPE</th>
                                <th style="">VAT</th>
                                <th style="">AMOUNT(AED)</th>
                                <th style="">TRANSACTION DATE</th>
                                <th style="">COMPANY</th>
                                <th style="">EVENT VENUE</th>
                                <th style="">EVENT DESCRIPTION</th>
                                <th style="">EVENT OWNER NAME</th>
                                <th style="">FULL ADDRESS</th>
                                <th style="">EVENT ISSUE DATE</th>
                                <th style="">EVENT EXPIRE DATE</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

