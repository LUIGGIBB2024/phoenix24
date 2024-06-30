 {{-- @extends('layouts.appnew')--}}
 @extends('layouts.menu02')

@section('content')


	<div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="lnr-user icon-gradient bg-warm-flame"></i>
                    {{-- <img src="{{Auth::user()->avatar()}}"> --}}
                </div>

            </div>
        </div>
    </div>

    <div class="p-large">
        <div class="content">
            <div class="desarrollo">
                <img src="{{asset('img/bannercan.png')}}">
            </div>
        </div>
    </div>


@endsection

