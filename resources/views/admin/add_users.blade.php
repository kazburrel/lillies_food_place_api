@extends('admin.layouts.index')

@section('content')
<div class="modal-dialog modal-dialog-centered w-100">
    <!--begin::Modal content-->
    <div class="modal-content rounded">
        <!--begin::Modal header-->
        <div class="modal-header pb-0 border-0 justify-content-end">
        </div>
        <!--begin::Modal header-->
        <!--begin::Modal body-->
        <div class="modal-body scroll-y px-10 px-lg-15 pt-0 pb-15">
            <!--begin:Form-->
            <form id="kt_modal_new_target_form" class="form" action="/admin/add_users" method="POST"
                enctype="multipart/form-data">
                @csrf
                <!--begin::Heading-->
                <div class="mb-13 text-center">
                    <!--begin::Title-->
                    <h1 class="mb-3">Add a New User</h1>
                    <!--end::Title-->
                </div>
                <!--end::Heading-->
                <!--begin::Input group-->
                <div class="d-flex flex-column mb-8 fv-row">
                    <!--begin::Label-->
                    <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                        <span class="required">Name</span>
                        <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                            title="Specify a target name for future usage and reference"></i>
                    </label>
                    <!--end::Label-->
                    <input type="text" class="form-control form-control-solid" placeholder="Enter Name"
                        name="name" value="{{ old('name') }}" />
                    @error('name')
                        <p class="text-danger">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <div class="d-flex flex-column mb-8 fv-row">
                    <!--begin::Label-->
                    <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                        <span class="required">Email</span>
                        <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                            title="Specify a target name for future usage and reference"></i>
                    </label>
                    <!--end::Label-->
                    <input type="email" class="form-control form-control-solid" placeholder="Enter Email"
                        name="email" value="{{ old('email') }}" />
                    @error('email')
                        <p class="text-danger">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
            
                <div class="d-flex flex-column mb-8 fv-row">
                    <!--begin::Label-->
                    <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                        <span class="required">Mobile No</span>
                        <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                            title="Specify a target name for future usage and reference"></i>
                    </label>
                    <!--end::Label-->
                    <input type="number" class="form-control form-control-solid" placeholder="Enter Mobile No"
                        name="mobile" value="{{ old('mobile') }}" />
                    @error('mobile')
                        <p class="text-danger">
                            {{ $message }}
                        </p>
                    @enderror
                </div>    
                
                <div class="d-flex flex-column mb-8 fv-row">
                    <!--begin::Label-->
                    <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                        <span class="required">Password</span>
                        <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                            title="Specify a target name for future usage and reference"></i>
                    </label>
                    <!--end::Label-->
                    <input type="password" class="form-control form-control-solid" placeholder="Enter password"
                        name="password" value="{{ old('password') }}" />
                    @error('password')
                        <p class="text-danger">
                            {{ $message }}
                        </p>
                    @enderror
                </div>     <div class="d-flex flex-column mb-8 fv-row">
                    <!--begin::Label-->
                    <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                        <span class="required">Confirm Password</span>
                        <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                            title="Specify a target name for future usage and reference"></i>
                    </label>
                    <!--end::Label-->
                    <input type="password" class="form-control form-control-solid" placeholder="Enter password confirmation"
                        name="password_confirmation" value="{{ old('password') }}" />
                    @error('mobile')
                        <p class="text-danger">
                            {{ $message }}
                        </p>
                    @enderror
                </div> 
                 <div class="d-flex flex-column mb-8 fv-row">
                    <!--begin::Label-->
                    <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                        <span class="required">Address</span>
                        <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                            title="Specify a target name for future usage and reference"></i>
                    </label>
                    <!--end::Label-->
                    <input type="text" class="form-control form-control-solid" placeholder="Enter Address"
                        name="address" value="{{ old('address') }}" />
                    @error('address')
                        <p class="text-danger">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="d-flex flex-column mb-8 fv-row">
                    <!--begin::Label-->
                    <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                        <span class="required">Profile Picture</span>
                        <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                            title="Upload Profile Picture"></i>
                    </label>
                    <!--end::Label-->
                    <input type="file" class="form-control form-control-solid" placeholder="" name="user_avatar"
                        value="{{ old('user_avatar') }}" />
                    @error('user_avatar')
                        <p class="text-danger">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                
                <!--begin::Actions-->
                <div class="text-center">
                    {{-- <button type="reset" id="kt_modal_new_target_cancel" class="btn btn-light me-3">Cancel</button> --}}
                    <button type="submit" id="kt_modal_new_target_submit" class="btn btn-primary">
                        <span class="indicator-label">Submit</span>
                    </button>
                </div>
                <!--end::Actions-->
            </form>
            <!--end:Form-->
        </div>
        <!--end::Modal body-->
    </div>
    <!--end::Modal content-->
</div>
@endsection
