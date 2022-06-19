@extends('layouts.app')

@section('content')
    <div class="container">
        <div>
            <h3>Create Account</h3>
        </div>


        <form class="row g-1 shadow p-3 mb-5 bg-body rounded" method="POST" action="{{ route('users.store', $user->id) }}">

            @csrf
           
 
            
            <div class="shadow p-3 mb-5 bg-body rounded">
                <h4 class="fw-bolder">Authentication</h4>
                <div class="row">
                    <div class="col">

                        <x-text-field field-id="name" label="Name" help-text="Your User Name" type="text"
                            :model="$user" /><!--Compiler refering to text-field template-->
                    </div>

                    <div class="col">
                        <x-text-field field-id="email" label="Email" help-text="Enter Your Email" type="email"
                        :model="$user" />

                </div>

                <div class="row">
                    <div class="col">
                        <label for="role" class="form-label" >User Role</label>
                        <select id="role" class="form-select  @error('role') is-invalid @enderror" name="role">
                            <option value="">Select the User Role</option>
                            <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="customer" {{ $user->role == 'customer' ? 'selected' : '' }}>Customer</option>
                        </select>
                            <!--Displaying the error message if email is invalid-->
                            @error('role')
                            <div class="invalid-feedback">
                               {{$message}}
                            </div>
                             @enderror
   
                    </div>

                    <div class="col">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror"" id="password" placeholder="Enter your Password"
                            name="password">

                            <!--Displaying the error message if email is invalid-->
                            @error('password')
                            <div class="invalid-feedback">
                               {{$message}}
                            </div>
                             @enderror
                    </div>

                    <div class="col">
                        <label for="password_confirmation " class="form-label">Confirm Password</label>
                        <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror"" id="password_confirmation" placeholder="Confirm Your Password"
                            name="password_confirmation">

                            <!--Displaying the error message if email is invalid-->
                            @error('password_confirmation')
                            <div class="invalid-feedback">
                               {{$message}}
                            </div>
                             @enderror
                    </div>


                </div>
            </div>
        

            <div class="shadow p-3 mb-5 bg-body rounded">

                <h4 class="fw-bolder">Personal Information</h4>

                <div class="col-md-9">
                    <label for="title" class="form-label">Title</label>
                    <select id="title" class="form-select  @error('title') is-invalid @enderror" name="title">

                        <option value="">Choose Title</option>
                        @foreach (['mr', 'mrs', 'miss', 'dr', 'prof'] as $title)
                            <option value="{{ $title }}" {{ old('title',$user->title) == $title ? 'selected' : '' }}>
                                {{ ucfirst($title) }}.</option>
                        @endforeach
                    </select>
                       <!--Displaying the error message if title is not selected-->
                       @error('title')
                       <div class="invalid-feedback">
                          Please select a title!
                       </div>
                        @enderror
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label for="first_name" class="form-label  @error('first_name') is-invalid @enderror">First Name </label>
                        <input type="text" class="form-control" id="first_name" placeholder="Enter your First Name"
                            name="first_name" value="{{ old('first_name', $user->first_name) }}">
                             <!--Displaying the error message if first name is not given-->
                       @error('first_name')
                       <div class="invalid-feedback">
                          Please enter your First Name!
                       </div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="last_name" class="form-label @error('last_name') is-invalid @enderror">Last Name</label>
                        <input type="text" class="form-control" id="last_name" placeholder="Enter your Last Name" name="last_name"
                            value="{{ old('last_name', $user->last_name) }}">
                             <!--Displaying the error message if Last Name is not given-->
                       @error('last_name')
                       <div class="invalid-feedback">
                          Please Enter your Last Name!
                       </div>
                        @enderror
                    </div>
                </div>


                <fieldset class="row mb-3 p-2">
                    <legend class="col-form-label col-sm-2 pt-0">Gender</legend>
                    <div class="col-sm-10">
                        <div class="form-check">
                            <input class="form-check-input @error('gender') is-invalid @enderror" type="radio" name="gender" id="male" value="male"
                                {{ old('gender',$user->gender) == 'male' ? 'checked' : '' }}>
                            <label class="form-check-label" for="male">
                                Male
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input @error('gender') is-invalid @enderror" type="radio" name="gender" id="female" value="female"
                                {{old('gender',$user->gender) == 'female' ? 'checked' : '' }}>
                            <label class="form-check-label" for="female">
                                Female
                            </label>
                            <!--Check whether the gender field is selected-->
                            @error('gender')
                            <div class="invalid-feedback">
                              Select Your Gender!!!
                            </div>
                             @enderror
                        </div>
                       
                    </div>
                   
                     
                </fieldset>

                <div class="col-4"> 
                    <label for="date_of_birth" class="form-label @error('date_of_birth') is-invalid @enderror">Date Of Birth</label>
                    <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" value="{{ old('date_of_birth', $user->date_of_birth) }}">
               <!--Check whether the date of birth is selected-->
               @error('date_of_birth')
               <div class="invalid-feedback">
                 Select Your Date Of Birth
               </div>
                @enderror
                </div>
                 
            </div>


            <div class="shadow p-3 mb-5 bg-body rounded">
                <h4 class="fw-bolder">Address</h4>
                <div class="col-12">
                    <label for="address_1" class="form-label">Address 1</label>
                    <input type="text" class="form-control @error('address_1') is-invalid @enderror" id="address_1" placeholder="Address 1" name="address_1"
                        value="{{ old('address_1', $user->address_1) }}">
                        <!--Check whether the Address 1 is entered-->
                 @error('address_1')
                 <div class="invalid-feedback">
                   Please enter your Address 1
                 </div>
                  @enderror
                </div>
                <div class="col-12">
                    <label for="address_2" class="form-label">Address 2</label>
                    <input type="text" class="form-control @error('address_2') is-invalid @enderror" id="address_2" placeholder="Address 2" name="address_2"
                        value="{{ old('address_2', $user->address_2) }}">
                        <!--Check whether the address 2 is entered-->
                 @error('address_2')
                 <div class="invalid-feedback">
                    Please enter your Address 2
                 </div>
                  @enderror
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label for="city" class="form-label">City</label>
                        <input type="text" class="form-control @error('city') is-invalid @enderror" id="city" placeholder="Enter the city" name="city"
                            value="{{ old('city', $user->city) }}">
                                  <!--Check whether the city is entered-->
                 @error('city')
                 <div class="invalid-feedback">
                    Please enter your City
                 </div>
                  @enderror
                    </div>


                    <div class="col-md-4">
                        <label for="postcode" class="form-label">Post Code</label>
                        <input type="text" class="form-control @error('postcode') is-invalid @enderror" id="postcode" placeholder="Postal Code" name="postcode"
                            value="{{ old('postcode', $user->postcode) }}">
                                  <!--Check whether the post code is entered-->
                 @error('postcode')
                 <div class="invalid-feedback">
                    Please enter your Post Code
                 </div>
                  @enderror
                    </div>
                </div>
            </div>
            <div class="shadow p-3 mb-5 bg-body rounded">
                <h4 class="fw-bolder">Contact Details</h4>
                <div class="row">
                    <div class="col-5">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" placeholder="Enter Phone Number" name="phone"
                            value="{{ old('phone', $user->phone) }}">
                                  <!--Check whether the phone number is entered-->
                 @error('phone')
                 <div class="invalid-feedback">
                    Please enter your Phone Number
                 </div>
                  @enderror
                    </div>

                    <div class="col-5">
                        <label for="mobile" class="form-label">Mobile</label>
                        <input type="text" class="form-control @error('mobile') is-invalid @enderror" id="mobile" placeholder="Enter Mobile Number"
                            name="mobile" value="{{ old('mobile', $user->mobile) }}">
                    <!--Check whether the mobile number is entered-->
                 @error('mobile')
                 <div class="invalid-feedback">
                    Please enter Mobile Number
                 </div>
                  @enderror
                    </div>
                </div>
            </div>

            <div class="col-12">
                <button type="submit" class="btn btn-primary" name="submit">Create Account</button>
            </div>
        </form>


        @endsection
