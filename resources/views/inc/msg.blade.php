	  @if(session('success'))
			<div class="alert alert-success alert-dismissible" style="position:fixed; top:10px; right:10px; z-index:10000">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			{{session('success')}}
			</div>
			@endif
      @if(session('error'))
      <div class="alert alert-danger alert-dismissible" style="position:fixed; top:10px; right:10px; z-index:100000">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
       {{session('error')}}
      </div>
            @endif