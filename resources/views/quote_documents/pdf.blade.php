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
        </style>
    </head>
    <body>
        <!-- Define header and footer blocks before your content -->
        <header>
            <img src="{{ asset('img/logo1.png') }}" width="200px" height="70px" >
        </header>

        <footer>
            Copyright &copy; <?php echo date("Y");?> 
        </footer>

        <main>
            <p class="page-break">
                Content Page 1

                @foreach ($quote_detials as $key => $quote_detials)
                    <div>
                        {{ Helper::document_date_format($key) }}

                        @foreach ($quote_detials as $key => $quote_detial)

                            <p>Category : {{$quote_detial->getCategory->name}} </p>
                            <p>Product : {{$quote_detial->product_id}} </p>
                            <p>
                                @php

                                $start_date = $quote_detial->date_of_service;
                                $end_date = $quote_detial->end_date_of_service;
                             
                                @endphp
                         
                                No. of Nights: <span>  {{  Helper::date_difference(Helper::db_date_format($start_date),Helper::db_date_format($end_date))}}      </span>
                            </p>
                        @endforeach
                    </div>

                    
                @endforeach
            </p>
            <p class="last-page-break">
                Content Page 2
            </p>
        </main>
    </body>
</html>