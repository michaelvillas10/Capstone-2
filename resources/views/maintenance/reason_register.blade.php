@extends('master')
@extends('layout/side-nav')
@extends('layout/header-main')  
@section('content')
<br><br>
<section id="middle">
<div class="container">
      <!-- Modal Header -->
      <header><br>
        <h4>Add Reason</h4>
      </header>

      <!-- Modal Body -->
      <form action="{{ url('reason/register') }}" method="POST">
      {{ csrf_field() }}
      	<div class="row">
			<div class="form-group">
				<div class="col-md-4">
					<label>Name *</label>
					<input type="text" name="name" value="" class="form-control required">
				</div>
       
				
			</div>
		</div>

 
      

      <!-- Modal Footer -->
      <footer>
        <button type="button" class="btn btn-default" data-dismiss="modal">Back</button>
        <button type="submit" class="btn btn-green">Submit</button>
      </footer>

    </div>
  </div>
</div>
</form>
</div>
</section> 
@stop