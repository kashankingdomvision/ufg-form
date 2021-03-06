<section class="content">
    <form method="get" action="{{ $route }}">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">

      
                    <div class="card card-default {{ (count(request()->all()) > 0) ? '' : 'collapsed-card' }}">
                            <button type="button" class="btn btn-tool m-0 text-dark " data-card-widget="collapse">
                                <div class="card-header">
                                <h3 class="card-title"><b> <i class="fas fa-filter" aria-hidden="true"></i>  Filters &nbsp;<i class="fa fa-angle-down"></i></b></h3>
                                </div>
                            </button>
                        <div class="card-body">
                            {{ $slot }} 
                            <div class="row mt-1">
                                <div class="col-md-12">
                                    <div class="d-flex justify-content-end">
                                        <button type="submit" class="btn btn-success btn-md mr-2" style="width: 10rem;"><i class="fa fa-search fa-lg" aria-hidden="true"></i>&nbsp;Search</button>
                                        <a href="{{ $route }}" class="btn btn-default">Reset<span class="fa fa-repeats"></span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</section>
    