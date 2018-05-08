@extends('layouts.main')

@section('title', 'List of Borrows')

@section('content-header', 'Borrowss')

@section('content-header-sm', 'List of Borrows')

@section('content-header-fa', 'shopping-cart')

@section('content-header-fa-sm', 'th-list')

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="box box-danger">
			<div class="box-header">
      			<h3 class="box-title">Filter by book</h3>
    		</div>
			<div class="box-body">
				{!! Form::open(['route' => 'borrows', 'method' => 'GET']) !!}
					<div class="form-group col-md-6">
						{!! Form::label('filter', 'Select book:') !!}
						<div class="input-group">
							<div class="input-group-addon"><i class="fa fa-book"></i></div>
							{!! Form::select('filter', ['borrow' => 'Books are borrowed', 'pay' => 'Book were paid'], null, ['class' => 'form-control', 'placeholder' => '--- Select book ---']) !!}
						</div>
					</div>
					<div class="form-group col-md-6" style="padding-top: 25px;">
						{!! Form::submit('Filter', ['class' => 'btn btn-danger']) !!}
						<a href="{{ asset('borrows') }}" class="btn btn-success">Reload</a>
					</div>
				{!! Form::close() !!}
			</div>
		</div>
	</div>
</div>

<div class="row">
  	<div class="col-md-12">
   		<div class="box box-danger">
     		<div class="box-header">
      			<h3 class="box-title">List of Borrows</h3>
    		</div>
    		<div class="box-body">
      			<div class="table-responsive" style="margin-top: 15px;">
       				<table class="table table-bordered table-hover">
        				<thead style="background-color: #212529; border-color: #32383e; color: #fff;">
         					<th class="text-center" width="5%">No.</th>
         					<th width="20%">Borrower</th>
         					<th width="35%">Book</th>
         					<th width="20%">Date borrow</th>
         					<th width="20%">Date pay</th>
       					</thead>
       					<tbody>
        				@if (empty($borrows))
	          				<tr>
	            				<td colspan="7"><span style="color: red;"><b><i class="fa fa-exclamation-triangle"></i> Not data</b></span></td>
	          				</tr>
        				@else 
	          				<?php $no = 1;?>
	          				@foreach ($borrows as $borrow)
	          					<tr style="line-height: 30px;">
	           						<td class="text-center">{{ $no }}</td>
	           						<td>{{ $borrow->user_name }}</td>
	           						<td>{{ $borrow->book_title }}</td>
	           						<td>{{ $borrow->date_borrow }}</td>
	           						<td>{{ $borrow->date_pay}}</td>
	        					</tr>
	        					<?php $no ++; ?>
	        				@endforeach
      					@endif
    					</tbody>
  					</table>
				</div>
				{{ $borrows->appends(Request::except('page'))->render() }}
			</div>
		</div>
	</div>
</div>

@endsection