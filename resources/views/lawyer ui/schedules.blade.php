@extends('lawyer ui/lawyer ui')
@extends('lawyer ui/lawyer side-nav')
@extends('lawyer ui/lawyer header-main')
@section('contents')

<section id="middle">


				<!-- page title -->
				<header id="page-header">
					<h1>Schedule</h1>
					<ol class="breadcrumb">
						<li><a href="#">Tables</a></li>
						<li class="active">Schedule </li>
						
					</ol>
				</header>
				<!-- /page title -->

				<div id="content" class="padding-20">

					<!-- 
						PANEL CLASSES:
							panel-default
							panel-danger
							panel-warning
							panel-info
							panel-success

						INFO: 	panel collapse - stored on user localStorage (handled by app.js _panels() function).
								All pannels should have an unique ID or the panel collapse status will not be stored!
					-->
					<div id="panel-1" class="panel panel-default">
						<div class="panel-heading">
							<span class="title elipsis">
								<strong>Schedule</strong> <!-- panel title -->
							</span>

							<!-- right options -->
							<ul class="options pull-right list-inline">
								<li><a href="#" class="opt panel_colapse" data-toggle="tooltip" title="Colapse" data-placement="bottom"></a></li>
								<li><a href="#" class="opt panel_fullscreen hidden-xs" data-toggle="tooltip" title="Fullscreen" data-placement="bottom"><i class="fa fa-expand"></i></a></li>
								<li><a href="#" class="opt panel_close" data-confirm-title="Confirm" data-confirm-message="Are you sure you want to remove this panel?" data-toggle="tooltip" title="Close" data-placement="bottom"><i class="fa fa-times"></i></a></li>
							</ul>
							<!-- /right options -->

						</div>
						<!--<div class="row">
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<div class="pull-right">
									<a href="#createprojects" class="btn btn-sm btn-green" data-toggle="modal"><i class="fa fa-plus"></i> New Request</a>
									
								</div>
							</div>
							
						</div>
						 panel content -->
						<div class="panel-body">
							<table class="table table-striped table-hover table-bordered" id="sample_editable_1">
								<thead>
									<tr>
										<th>Lawyer Name</th>
										<th>Name</th>
										<th>Start date and time</th>
										<th>End date and time</th>
										<th>Edit</th>
										<th>Delete</th>
									</tr>
								</thead>
<tbody>
								@foreach ($schedules as $schedule)
									<tr>
										<td>{{$schedule->efname}} {{$schedule->emname}} {{$schedule->elname}}</td>
										@foreach($schedule->schedules as $employeesched )
										<td>
											 {{$employeesched->name}}
										</td>
										<td>
											 {{$employeesched->start}}
										</td>
										<td>
											 {{$employeesched->end}}
										</td>
									    @endforeach
										<td>
											  <button type="submit" data-target=".bs-example-modal-update{{ $schedule->id }}" class="btn btn-sm btn-warning update-button" data-toggle="modal" ><i class="fa fa-pencil"></i> Edit</a>
										</td>
										<td>
											<form action="{{ route('deletesched',$schedule->id) }}" method = "post">
												{{ csrf_field() }}
        {{ method_field('DELETE') }}
											<button type ="submit" class="btn btn-danger delete-user" onclick="return confirm('Are you sure?')" href="{{ route('deletesched',$schedule->id) }}"><i class="fa fa-trash"></i>
											Delete </button>
										</form>
										</td>
<div class="modal fade bs-example-modal-update{{ $schedule->id }}" id =".bs-example-modal-update" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-full">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Edit Schedule</h4>
      </div>

      <!-- Modal Body -->
      <form id="update-language-form" action="{{ route('schededit',$schedule->id) }}" method="post">
      {{ csrf_field() }}
       <input type="hidden" name="_method" value="PUT">
      <div class="modal-body">
      	<div class="row">
			<div class="form-group">
				<div class="col-md-4">
					<label>Name *</label>
					<input type="text" name="name" value="{{$schedule->name}}" class="form-control ">
				</div>
				
			</div>
		</div>

 
      </div>

      <!-- Modal Footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Back</button>
        <button type="submit" class="btn btn-green">Save changes</button>
      </div>

    </div>
  </div>
</div>
</form>
									</tr>
									@endforeach	
								</tbody>
							</table>

						</div>
						<!-- /panel content -->

						<!-- panel footer -->

					</div>
					<!-- /PANEL -->

				</div>
			</section>
@stop