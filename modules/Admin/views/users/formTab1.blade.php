<div class="tab-pane active" id="tab_1_1"> 
<div class="portlet light bordered">
 <div class="portlet-title">
            <div class="caption">
                <i class="icon-social-dribbble font-green"></i>
                <span class="caption-subject font-green bold uppercase">Personel Info
                </span>
            </div> 
        </div>
   

    
    <div class="form-group {{ $errors->first('name', ' has-error') }}" >
        <label class="control-label">Full Name</label>
        <input type="text" placeholder="Name" class="form-control" name="name" value="{{ ($user->name)?$user->name:old('name')}}">  
    </div>
     <div class="form-group {{ $errors->first('email', ' has-error') }}">
        <label class="control-label ">Email</label>
        <input type="email" placeholder="Email" class="form-control" name="email" value="{{ ($user->email)?$user->email:old('email')}}"> 
    </div>
    <div class="form-group {{ $errors->first('password', ' has-error') }}">
        <label class="control-label">Password</label>
        <input type="password" placeholder="******" class="form-control" name="password"> 
    </div>

    @if($user->role_type==3)
     <div class="form-group {{ $errors->first('password', ' has-error') }}">
        <label class="control-label">Role Type</label>
          <select name="role_type" class="form-control select2me">
               <option value="">Select Roles...</option>
                 <option value="3" selected="selected">Customer</option>
                
                </select>
                <span class="help-block">{{ $errors->first('role_type', ':message') }}</span>
    </div>

    @else
     <div class="form-group {{ $errors->first('role_type', ' has-error') }}">
        <label class="control-label">Role Type</label>
          <select name="role_type" class="form-control select2me">
               <option value="">Select Roles...</option>
                @foreach($roles as $key=>$value)
                
                <option value="{{$value->id}}" {{($value->id ==$role_id)?"selected":"selected"}}>{{ $value->name }}</option>
                @endforeach
                </select>
                <span class="help-block">{{ $errors->first('role_type', ':message') }}</span>
    </div>

    @endif 
   
     <div class="form-group {{ $errors->first('mobile_number', ' has-error') }}">
        <label class="control-label">Mobile Number</label>
        <input type="text" placeholder="Mobile or Phone" class="form-control phone" name="mobile_number"  value="{{ ($user->mobile_number)?$user->mobile_number:old('mobile_number')}}"> </div>

        <div class="form-group {{ $errors->first('referal_code', ' has-error') }}">
        <label class="control-label">User Referral Code</label>
        <input type="text" placeholder="Referral Code" class="form-control " name="referal_code"  value="{{ ($user->referal_code)?$user->referal_code:old('referal_code')}}"> </div>

        <div class="form-group {{ $errors->first('reference_code', ' has-error') }}">
        <label class="control-label">User Reference Code</label>
        <input type="text" placeholder="reference code" class="form-control" name="reference_code"  value="{{ ($user->reference_code)?$user->reference_code:old('reference_code')}}"> </div>

       <!--  <div class="form-group {{ $errors->first('device_id', ' has-error') }}">
        <label class="control-label">Device ID</label>
        <input type="text" placeholder="" class="form-control phone" name="device_id"  value="{{ ($user->device_id)?$user->device_id:old('device_id')}}"> </div> -->

        <div class="form-group {{ $errors->first('user_name', ' has-error') }}">
        <label class="control-label">User Name</label>
        <input type="text" placeholder="" class="form-control phone" name="user_name"  value="{{ ($user->user_name)?$user->user_name:old('user_name')}}"> </div>
    
    
      @if($user->role_type==3)
      
@endif
    @if($user->role_type==3)
     
 
    @endif
     <div class="margin-top-10">

                <button type="submit" class="btn green" value="personelInfo" name="submit"> Save </button>
                 <a href="{{url(URL::previous())}}">
{!! Form::button('Cancel', ['class'=>'btn btn-warning text-white']) !!} </a>
            </div>  
</div>
</div>