<html>
    <head>
        <title> Quote Document</title>
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap');
            / Define the margins of your page /
            @page {
                margin: 50px 0px 100px;
            }
            body { font-family: 'Roboto', sans-serif; }
            .h1, .h2, .h3, .h4, .h5, .h6, h1, h2, h3, h4, h5, h6 { font-family: 'Roboto', sans-serif; font-weight: 500; line-height: 1.2; color: inherit; }
            header {                / Extra personal styles /
            text-align: center; }
            footer { position: fixed; bottom: -60px; left: 0px; right: 0px; height: 50px;                / Extra personal styles / / background-color: #03a9f4; /
            color: black; text-align: center; line-height: 35px; }
            .page-break { page-break-after: always; }
            .last-page-break { page-break-after: never; }
            .ml-20 { margin-left: 20px !important; }
            .p-0 { padding: 0px !important; }
            .m-0 { margin: 0px !important; }
            .main { width: 100%; min-width: 100%; margin: 0 auto; }
            .mt-100 { margin-top: 100px !important; }
            .ml-10 { margin-left: 10px; }
            .center { width: 100%; text-align: center !important; }
            .textsize-25 { font-size: 25px; }
            .bg-dark { background-color: #343a40 !important; }
            .card { box-shadow: 0 0 1px rgb(0 0 0 / 13%), 0 1px 3px rgb(0 0 0 / 20%); margin-bottom: 1rem; }
            .p-2 { padding: .2rem !important; }
            .bg-dark,
            .bg-dark>a { color: #fff !important; }
            .text-center { text-align: center !important; }
            b,
            strong { font-weight: bolder; }
            .m-5 { margin: 3rem !important; }
            .mt-1 { margin-top: 1rem !important; }
            .p-3 { padding: 1rem !important; }
            .mb-0 { margin-bottom: 0 !important; }
            .mt-5 { margin-top: .5rem !important; }
            .mb-5 { margin-bottom: .5rem !important; }
            .p-5 { padding: 5rem !important; }
            .pr-2{padding-right: 2rem !important;}
            .vertical-align-top {vertical-align: top !important;}
            .pt-3 {padding-top: 3rem !important;}
            .display-block{display: block !important; width: 100%; }
            .row{display: block !important; width: 100%; }
            .css-none div{ margin: 0 !important; padding: 0 !important }
            .css-none p{ margin: 0 !important; padding: 0 !important }
</style>
    </head>
    <body>
        <!-- Define header and footer blocks before your content -->
        <header>
            <section class="logo">
                <div class="text-center">
                    <img src="{{ asset('images/logo.png') }}">
                </div>
            </section>
        </header>

        <!-- <footer>
            Copyright &copy; <?php echo date("Y");?> 
        </footer>
         -->
        <main class="main">
            <hr>
            <div class="page-break">
                <section class="pt-3">
                    <section class="heading ml-2">
                        <table cellpadding="0" cellspacing="0" bgcolor="#343a40" width="100%" class="bg-dark">
                            <tr>
                                <td height="5px;" style="height: 5px;">&nbsp;</td>
                            </tr>
                            <tr>
                                <td style="padding: 0 0 0 10px; ">
                                <h3 class="text-center" style="margin: 0;"><strong>{{ $startdate }}&nbsp;&nbsp; - &nbsp;&nbsp; {{$enddate}}</strong></h3>
                                </td>
                            </tr>
                            <tr>
                                <td height="5px;" style="height: 5px;">&nbsp;</td>
                            </tr>
                        </table>
                        <h2 class="text-center"><strong>{{$title}}</strong></h2>
                        <h3 class="text-center">{{$person_name}} - {{ $created_at }}</h3>
                        <hr>
                    </section>      
                   
                        
                    <section class="detail-section p-5">
                        <table cellspacing="0" cellspacing="0" style="margin: 0 auto;">
                        @foreach ($quote_details as $key => $qd)
                            <tr class="vertical-align-top">
                                <td class="pr-2">{{ Helper::document_date_format($key) }}</td>
                                <td>
                                @foreach ($qd as $key => $quote_del)
                                    <a href="#category1"> {{$quote_del->getCategory->name}}</a><br/>
                                @endforeach
                                </td>
                            </tr>
                            <tr>
                                <td height="15px" style="line-height: 15px; height: 15px;"> </td>
                            </tr>
                        @endforeach
                            
                        </table>
                    </section>

                     
                    @if($brand_about && !empty($brand_about))
                        <section class="about-brand ml-2">
                        <h4><strong>About Us:</strong></h4>
                        {!! $brand_about !!}
                        </section>
                    @endif
                </section>
            </div>


            <section class="textimage ml-2">
            @foreach ($quote_details as $key => $qd)
                    <table cellpadding="0" cellspacing="0" bgcolor="#343a40" width="100%" class="bg-dark">
                        <tr>
                            <td height="5px;" style="height: 5px;">&nbsp;</td>
                        </tr>
                        <tr>
                            <td style="padding: 0 0 0 10px; ">
                                <h3 style="margin: 0;"><strong>{{ Helper::document_date_format($key) }}</strong></h3>
                            </td>
                        </tr>
                        <tr>
                            <td height="5px;" style="height: 5px;">&nbsp;</td>
                        </tr>
                    </table>
                    @foreach ($qd as $key => $quote_del)
                    <table cellspacing="0" cellpadding="0">
                        <tr>
                            <td height="10px;" style="height: 10px;">&nbsp;</td>
                        </tr>
                        <tr>
                            <td><img src="{{ $quote_del->image }}" width="100%" /></td>
                        </tr>
                        <tr>
                            <td height="10px;" style="height: 10px;">&nbsp;</td>
                        </tr>
                        <tr>
                            <td><h3 style="margin: 0 ;">{{$quote_del->getCategory->name}} - {{$quote_del->product_id}}</h3></td>
                        </tr>
                        
                        <tr>
                            <td>
                                <h3 style="margin: 0 ;">No. of Night {{  Helper::date_difference(Helper::db_date_format($quote_del->date_of_service),Helper::db_date_format($quote_del->end_date_of_service))}}</h3>
                            </td>
                        </tr>
                        <tr>
                            <td height="2px;" style="height: 2px;">&nbsp;</td>
                        </tr>
                        <tr>
                            <td class="css-none">
                                {!! $quote_del->service_details !!}
                            </td>
                        </tr>
                        <tr>
                            <td height="10px;" style="height: 10px;   ">&nbsp;</td>
                        </tr>
                    </table>
                    @endforeach
            @endforeach
            </section>


            <section class="booking-condition">
                @if($storetexts != null)
                    @foreach ($storetexts as $text)

                        <h2 class="text-center">{{$text->page_title}}</h2>
                        <hr />
                        <div class="cont-reapeat">
                            {!! $text->description !!}
                        </div>
                    @endforeach
                @endif
            </section>
        </main>
    </body>
</html>