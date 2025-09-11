<div class="wrapper-md errorBlock" id="errorBlock" >
   <div class="row">
      <div class="col-lg-12" style="">
         @if(Session::has('success'))
            <div class = "alert alert-success">
                  {{-- <ul> --}}
                     {{ Session::get('success') }}
                  {{-- </ul> --}}
            </div>
         @endif
         @if(Session::has('error'))
            <div class = "alert alert-danger">
                  {{-- <ul> --}}
                     {{ Session::get('error') }}
                  {{-- </ul> --}}
            </div>
         @endif
      </div>
   </div>
</div>