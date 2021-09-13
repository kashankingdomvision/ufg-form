<html>
    <head>
        <title> Quote Document</title>
        <style>
            /** Define the margins of your page **/
            @page {
                margin: 100px 25px;
            }

            header {
                position: fixed;
                top: -60px;
                left: 0px;
                right: 0px;
                height: 50px;

                /** Extra personal styles **/
       
                text-align: center;
                line-height: 35px;
            }

            footer {
                position: fixed; 
                bottom: -60px; 
                left: 0px; 
                right: 0px;
                height: 50px; 

                /** Extra personal styles **/
                /* background-color: #03a9f4; */
                color: black;
                text-align: center;
                line-height: 35px;
            }

            .page-break {
                page-break-after: always;
            }
            .last-page-break {
                page-break-after: never;
            }
            .ml-20{
                margin-left: 20px !important;
            }
            .p-0{
                padding: 0px !important;
            }
            .m-0{
                margin: 0px !important;
            }
            
            .main {
                width: 100%;
                margin-left:  100px;
                margin-right:  100px;
            }
            .mt-100{
                margin-top: 100px !important;
            }
            .ml-10{
                margin-left: 10px;
            }
            
            .center {
                width: 100%;
                text-align: center !important;
            }
            
            .textsize-25{
                font-size: 25px;
            }
            
        </style>
    </head>
    <body>
        <!-- Define header and footer blocks before your content -->
        <header>
            <img src="{{ asset('img/logo1.png') }}" width="300px" height="100px" >
        </header>

        <footer>
            Copyright &copy; <?php echo date("Y");?> 
        </footer>
        
        <main class="main">
            {{-- /// page 1  --}}
            <p style="margin-top: 300px">
                <div > 
                    <div class="center">
                        <h1>
                            <strong>
                                Signature Cruise Split to Dubrovnik
                            </strong> 
                        </h1>
                        <p class="textsize-25">26th July 2021</p>
                        <p class="textsize-25">Name </p>
                        <p class="textsize-25">TAS</p>
                        <br />
                        <h2></h2>
                    </div>
                </div>
            </p>
            {{-- /// page 1  --}}
            
            {{-- /// page 2 (about us) --}}
            <p class="page-break">
                <div class="mt-100">
                    <img src="{{ asset('img/doc-about.jpg') }}" width="600px" height="200px" >
                
                    <h3>
                        <strong>
                            About us
                        </strong>
                    </h3> 
                    <h4>Unforgettable Croatia </h4>
                    <p >
                        Welcome to Unforgettable Croatia, we are the largest luxury tour operator to Croatia with offices in San Francisco, New York, London and Split, Croatia. We are connoisseurs of unique travel experiences and truly unforgettable trips to this magnificent country.
                        We live and breathe Croatia, with the majority of our team of Croatian heritage. As Croatia’s leading travel specialists we have developed an enviable VIP list of contacts throughout the country, which we use to ensure our clients enjoy unparalleled levels of service at top hotels, restaurants and with our hand-picked private guides.
                        </p>
                </div>
            </p>
            {{-- /// page 2 (about us) --}}
            
            {{-- /// page   --}}
            <p class="page-break">
                {{-- Content Page 1 --}}
                
                <div class="mt-100">
                    @foreach ($quote_details as $key => $qd)
                        <h2>
                            <strong>
                                {{ Helper::document_date_format($key) }}
                            </strong>
                        </h2> 
                        
                        <div class="ml-20" >
                            @foreach ($qd as $key => $quote_detial)
                            <table>
                                <tr>
                                    <th align="left" >{{$quote_detial->getCategory->name}}:</th>
                                    <td></td>
                                    <td>{{$quote_detial->product_id}}</td>
                                </tr>
                                {{-- <tr>
                                    <th align="left" >Product:</th>
                                    <td></td>
                                    <td></td>
                                </tr> --}}
                                <tr>
                                    <th align="left" >No. of Nights:</th>
                                    <td></td>
                                    <td>{{  Helper::date_difference(Helper::db_date_format($quote_detial->date_of_service),Helper::db_date_format($quote_detial->end_date_of_service))}}</td>
                                </tr>
                                
                                <tr>
                                    <th align="left" >Service Detail:</th>
                                    <td></td>
                                    <td>{{ $quote_detial->service_details }}</td>
                                </tr>
                            </table>
                            <br />
                            @endforeach
                        </div>
                    @endforeach
                </div>
            </p>
            <p class="last-page-break">
                {{-- Content Page 2 --}}
            </p>
        </main>
    </body>
</html>