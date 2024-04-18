@extends('layouts.app')
@section('title','Edit Employee')

@section('page-style')

@stop
@section('content')
<h2>Add Employee</h2>
<div class="card p-3">
	<form method="post" action="{{route('employee.store')}}" enctype="multipart/form-data">
	 {{ csrf_field() }}
	 	<div class="row clearfix">
	 		<div class="col-md-6">
	 			<div class="form-group">
					<label>First Name <span style="color:red;">*</span></label><br>
					<input type="text" name="first_name" value="{{old('first_name')}}"  class="form-control w-100" placeholder="First Name">
					@error('first_name')
		            <div class="text-danger">{{ $message }}</div>
		            @enderror
				</div>
	 		</div>
	 		<div class="col-md-6">
	 			<div class="form-group">
					<label>Last Name</label><br>
					<input type="text" name="last_name" value="{{old('last_name')}}" class="form-control w-100" placeholder="Last Name">
					@error('last_name')
		            <div class="text-danger">{{ $message }}</div> 
		            @enderror
				</div>
	 		</div>
	 	</div>
	 	<div class="row clearfix">
	 		<div class="col-md-6">
	 			<div class="form-group">
					<label>Email <span style="color:red;">*</span></label><br>
					<input type="email" name="email" value="{{old('email')}}" class="form-control w-100" placeholder="Email">	@error('email')
		            <div class="text-danger">{{ $message }}</div> 
		            @enderror
				</div>
	 		</div>
	 		<div class="col-md-6">
	 			<div class="form-group">
				 	<label for="country_code">Phone Number <span style="color:red;">*</span></label>
					<div class="input-group">
						<span class="input-group-addon col-md-4 pl-0">
							<select name="country_code" id="country_code" class="form-control show-tick ms" data-placeholder="{{__('messages.select')}}">
								<option value="">Select</option>
								@foreach ($countries as $country)
									<option value="{{ $country->id }}" {{ old('country_code') == $country->id ? 'selected' : '' }}>{{ $country->name.'('.$country->dialcode.')' }}</option>
								@endforeach   
							</select>
						</span>
						<input type="text" name="phone" id="phone" class="form-control col-md-8" placeholder="Phone" value="{{ old('phone') }}">
					</div>
				</div>
				@if($errors->has('phone'))
					<div class="text-danger">{{ $errors->first('phone') }}</div>
				@endif
	 		</div>
	 	</div>
		<div class="row clearfix">
			<div class="col-md-6">
				<label for="gender">Gender <span style="color:red;">*</span></label>
				<div class="form-group">
					<div class="form-check form-check-inline">
						<input class="form-check-input" type="radio" name="gender" id="male" value="male">
						<label class="form-check-label" for="male">
							Male
						</label>
					</div>
					<div class="form-check form-check-inline">
						<input class="form-check-input" type="radio" name="gender" id="female" value="female">
						<label class="form-check-label" for="female">
							Female
						</label>
					</div>
					<div class="form-check form-check-inline">
						<input class="form-check-input" type="radio" name="gender" id="other" value="other">
						<label class="form-check-label" for="other">
							Other
						</label>
					</div>
				</div>
				@if($errors->has('gender'))
					<div class="text-danger">{{ $errors->first('gender') }}</div>
				@endif
			</div>
			<div class="col-md-6">
				<label for="hobby">Hobby</label>
				<div class="form-group">
					<div class="form-check form-check-inline">
						<input class="form-check-input" name="hobby[]" type="checkbox" value="cricket" id="cricket">
						<label class="form-check-label" for="cricket">
							Cricket
						</label>
					</div>
					<div class="form-check form-check-inline">
						<input class="form-check-input" name="hobby[]" type="checkbox" value="singing" id="singing">
						<label class="form-check-label" for="singing">
							Singing
						</label>
					</div>
					<div class="form-check form-check-inline">
						<input class="form-check-input" name="hobby[]" type="checkbox" value="dance" id="dance">
						<label class="form-check-label" for="dance">
							Dance
						</label>
					</div>
					<div class="form-check form-check-inline">
						<input class="form-check-input" name="hobby[]" type="checkbox" value="travelling" id="travelling">
						<label class="form-check-label" for="travelling">
							Travelling
						</label>
					</div>
				</div>
				@if($errors->has('is_trainee'))
					<div class="error" style="color: red;">{{ $errors->first('is_trainee') }}</div>
				@endif
			</div>
		</div>
		<div class="row clearfix">
			<div class="col-md-6">
				<label for="address">Address <span style="color:red;">*</span></label>
				<div class="form-group">
					<textarea id="address" rows="2" name="address" class="form-control">{{Request::old('address')}}</textarea> 
				</div>
				@if($errors->has('address'))
					<div class="text-danger">{{ $errors->first('address') }}</div>
				@endif
			</div>
			<div class="col-md-6">
				<label for="employee_photo">Employee Photo</label>
				<div class="form-group">
					<input type="file" name="employee_photo" id="employee_photo" data-default-file="" value="{{ old('employee_photo') }}" data-max-file-size="1M" data-allowed-file-extensions='["jpeg", "jpg"]'>
				</div>                        
				@if($errors->has('employee_photo'))
					<div class="text-danger">{{ $errors->first('employee_photo') }}</div>
				@endif
			</div>
		</div>

		<div class="row clearfix">
			<button type="submit" name="submit" class="btn btn-primary rounded-0" style="margin-left: 50%;">Save</button>
		</div>
	</form>
</div>
@stop
@section('page-script')
<script type="text/javascript">
	$(document).ready(function () {
		
    });
</script>

@stop