<style>
    #event-transaction-table_filter {
        width: 42%;
        float: right;
    }

    #artist-transaction-table_filter {
        width: 42%;
        float: right;
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

    <div class="container">
        <div class="row">
            <div class="col-12 ">
                <nav>
                    <div class="nav nav-tabs nav-tabs-line nav-tabs-bold nav-tabs-line-3x nav-tabs-line-danger"
                         id="nav-tab" role="tablist">
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
                        <table class="table table-striped table-hover" id="artist-transaction-table">
                            <thead>
                            <tr>
                                <th style="">REFERENCE NO.</th>
                                <th style="">NAME</th>
                                <th style="">TRANSACTION TYPE</th>
                                <th style="">VAT</th>
                                <th style="">AMOUNT(dhs)</th>
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
                        <table class="table table-striped table-hover" id="event-transaction-table">
                            <thead>
                            <tr>
                                <th style="">REFERENCE NO.</th>
                                <th style="">NAME</th>
                                <th style="">TRANSACTION TYPE</th>
                                <th style="">VAT</th>
                                <th style="">AMOUNT(dhs)</th>
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

