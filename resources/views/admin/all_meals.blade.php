@extends('admin.layouts.index')

@section('content')
    <div class="p-3">
        <div class="col-xl-12">
            <!--begin::Table Widget 4-->
            <div class="card card-flush h-xl-100">
                <!--begin::Card header-->
                <div class="card-header pt-7">
                    <!--begin::Title-->
                    <h3 class="card-title align-items-center flex-column">
                        <span class="card-label fw-bolder text-gray-800">ALL MEALS</span>
                        {{-- <span class="text-gray-400 mt-1 fw-bold fs-6">Avg. 57 orders per day</span> --}}
                    </h3>
                    <!--end::Title-->
                    <!--begin::Actions-->
                    <div class="card-toolbar">
                        <!--begin::Filters-->
                        <div class="d-flex flex-stack flex-wrap gap-4">
                            <!--begin::Search-->
                            <form action="/admin/all_meals" class="d-flex align-items-center">
                                <div class="position-relative w-md-400px me-md-2">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                                    <span
                                        class="svg-icon svg-icon-3 svg-icon-gray-500 position-absolute top-50 translate-middle ms-6">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none">
                                            <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546"
                                                height="2" rx="1" transform="rotate(45 17.0365 15.1223)"
                                                fill="currentColor" />
                                            <path
                                                d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"
                                                fill="currentColor" />
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                    <input type="text" class="form-control form-control-solid ps-10" name="search"
                                        value="" placeholder="Search" />
                                </div>
                                <!--end::Input group-->
                                <!--begin:Action-->
                                <div class="d-flex align-items-center">
                                    <button type="submit" class="btn btn-primary me-5">Search</button>
                                    {{-- <a id="kt_horizontal_search_advanced_link" class="btn btn-link" data-bs-toggle="collapse" href="#kt_advanced_search_form">Advanced Search</a> --}}
                                </div>
                                <!--end:Action-->
                            </form>
                            <!--end::Search-->
                        </div>
                        <!--begin::Filters-->
                    </div>
                    <!--end::Actions-->
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body pt-2">
                    <!--begin::Table-->
                    <table class="table align-middle table-row-dashed fs-6 gy-3">
                        <!--begin::Table head-->
                        <thead>
                            <!--begin::Table row-->
                            <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0 ">
                                <th class="text-center min-w-50px">S/N</th>
                                <th class="text-center min-w-100px">MEAL ID</th>
                                <th class="text-center min-w-125px">VENDOR NAME</th>
                                <th class="text-center min-w-125px">MEAL NAME</th>
                                <th class="text-center min-w-125px">STATUS</th>
                                <th class="text-center min-w-125px">CREATED DATE</th>
                                <th class="text-center min-w-100px">ACTION</th>
                            </tr>
                            <!--end::Table row-->
                        </thead>
                        <!--end::Table head-->
                        <!--begin::Table body-->
                        @php
                            $sn = 1;
                        @endphp
                        @forelse ($meals as $meal)
                            <tbody class="fw-bolder text-gray-600">
                                <tr class="mb-3">
                                    <td class=" text-center border border-2">
                                        <span>{{ $sn++ }}</span>
                                    </td>
                                    <td class="text-center border border-2">
                                        <span>{{ $meal->unique_id }}</span>
                                    </td>
                                    <td class="text-center border border-2">
                                        <span>{{ $meal->vendordets !== null ? $meal->vendordets->name : '' }}</span>
                                        {{-- {{ $course->max_student > 200 ? '200+' : $course->max_student }} --}}
                                    </td>
                                    <td class="text-center border border-2">
                                        <span>{{ $meal->meal_name }}</span>
                                        {{-- {{ $course->max_student > 200 ? '200+' : $course->max_student }} --}}
                                    </td>
                                  
                                    <td class="text-center border border-2">
                                        <span
                                            class=" fw-bolder  d-block fs-7 p-1 px-2 {{ $meal->status == true ? 'btn btn-light-success' : 'btn btn-light-danger' }}">{{ $meal->status == true ? 'In-Stock' : 'Out-Of-Stock' }}</span>
                                    </td>
                                    <td class="text-center border border-2">
                                        <span>{{ Date::parse($meal->created_at)->format('jS, F Y') }}</span>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-end flex-shrink-0">
                                            <div class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1"
                                                data-bs-toggle="modal"
                                                data-bs-target="#kt_modal_add_meal-{{ $meal->unique_id }}">
                                                <!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
                                                <span class="svg-icon svg-icon-3 svg-icon-primary">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none">
                                                        <path opacity="0.3"
                                                            d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z"
                                                            fill="currentColor" />
                                                        <path
                                                            d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z"
                                                            fill="currentColor" />
                                                    </svg>
                                                </span>
                                                <!--end::Svg Icon-->
                                            </div>
                                            <div class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1"
                                                data-bs-toggle="modal"
                                                data-bs-target="#kt_modal_status_meal{{ $meal->unique_id }}">
                                                <!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
                                                <span class="svg-icon svg-icon-3 svg-icon-warning">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-key" viewBox="0 0 16 16">
                                                        <path
                                                            d="M0 8a4 4 0 0 1 7.465-2H14a.5.5 0 0 1 .354.146l1.5 1.5a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0L13 9.207l-.646.647a.5.5 0 0 1-.708 0L11 9.207l-.646.647a.5.5 0 0 1-.708 0L9 9.207l-.646.647A.5.5 0 0 1 8 10h-.535A4 4 0 0 1 0 8zm4-3a3 3 0 1 0 2.712 4.285A.5.5 0 0 1 7.163 9h.63l.853-.854a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.793-.793-1-1h-6.63a.5.5 0 0 1-.451-.285A3 3 0 0 0 4 5z" />
                                                        <path d="M4 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0z" />
                                                    </svg>
                                                </span>
                                                <!--end::Svg Icon-->
                                            </div>
                                            <a href="#" class="btn btn-icon btn-bg-light btn-sm"
                                                data-bs-toggle="modal" data-bs-target="#kt_modal_1{{ $meal->unique_id }}"
                                                data-kt-users-table-filter="delete_row">
                                                <!--begin::Svg Icon | path: icons/duotune/general/gen027.svg-->
                                                <span class="svg-icon svg-icon-3 svg-icon-danger">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none">
                                                        <path
                                                            d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z"
                                                            fill="currentColor" />
                                                        <path opacity="0.5"
                                                            d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z"
                                                            fill="currentColor" />
                                                        <path opacity="0.5"
                                                            d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z"
                                                            fill="currentColor" />
                                                    </svg>
                                                </span>
                                                <!--end::Svg Icon-->
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <div class="modal fade" tabindex="-1" id="kt_modal_status_meal{{ $meal->unique_id }}">
                                    <div class="modal-dialog">
                                        <div class="modal-content text-center">
                                            <div class="modal-header">
                                                <h5 class="modal-title"></h5>

                                                <!--begin::Close-->
                                                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2"
                                                    data-bs-dismiss="modal" aria-label="Close">
                                                    <span class="svg-icon svg-icon-2x">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                            height="24" viewBox="0 0 24 24" fill="none">
                                                            <rect opacity="0.5" x="6" y="17.3137"
                                                                width="16" height="2" rx="1"
                                                                transform="rotate(-45 6 17.3137)" fill="currentColor" />
                                                            <rect x="7.41422" y="6" width="16"
                                                                height="2" rx="1"
                                                                transform="rotate(45 7.41422 6)" fill="currentColor" />
                                                        </svg>
                                                    </span>
                                                </div>
                                                <!--end::Close-->
                                            </div>

                                            <div class="modal-body">
                                                <p>Are you sure you want to
                                                    {{ $meal->status == true ? 'Take Out Of Stock' : 'Put Back In Stock' }}
                                                    meal?</p>
                                            </div>

                                            <div class="modal-footer d-flex justify-content-center">
                                                <button type="button" class="btn btn-light"
                                                    data-bs-dismiss="modal">Close</button>
                                                {{-- <x-block href="/admin/all_meals/{{ $meal->unique_id }}"
                                                    :status="$meal->status" /> --}}
                                                     <form action="/admin/all_meals/{{ $meal->unique_id }}" method="GET">
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger">{{$meal->status == true ? 'Out-Of-Stock' : 'In-Stock'}}</button>
                                                    </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade" tabindex="-1" id="kt_modal_1{{ $meal->unique_id }}">
                                    <div class="modal-dialog">
                                        <div class="modal-content text-center">
                                            <div class="modal-header">
                                                <h5 class="modal-title"></h5>

                                                <!--begin::Close-->
                                                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2"
                                                    data-bs-dismiss="modal" aria-label="Close">
                                                    <span class="svg-icon svg-icon-2x">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                            height="24" viewBox="0 0 24 24" fill="none">
                                                            <rect opacity="0.5" x="6" y="17.3137"
                                                                width="16" height="2" rx="1"
                                                                transform="rotate(-45 6 17.3137)" fill="currentColor" />
                                                            <rect x="7.41422" y="6" width="16"
                                                                height="2" rx="1"
                                                                transform="rotate(45 7.41422 6)" fill="currentColor" />
                                                        </svg>
                                                    </span>
                                                </div>
                                                <!--end::Close-->
                                            </div>

                                            <div class="modal-body">
                                                <p>Are you sure you want to delete?</p>
                                            </div>

                                            <div class="modal-footer d-flex justify-content-center">
                                                <button type="button" class="btn btn-light"
                                                    data-bs-dismiss="modal">Close</button>
                                                <x-delete href="/admin/all_meals/{{ $meal->unique_id }}" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade" id="kt_modal_add_meal-{{ $meal->unique_id }}"
                                    aria-hidden="true">
                                    <!--begin::Modal dialog-->
                                    <div class="modal-dialog modal-dialog-centered mw-650px">
                                        <!--begin::Modal content-->
                                        <div class="modal-content rounded">
                                            <!--begin::Modal header-->
                                            <div class="modal-header pb-0 border-0 justify-content-end">
                                                <!--begin::Close-->
                                                <div class="btn btn-sm btn-icon btn-active-color-primary"
                                                    data-bs-dismiss="modal">
                                                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                                                    <span class="svg-icon svg-icon-1">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                            height="24" viewBox="0 0 24 24" fill="none">
                                                            <rect opacity="0.5" x="6" y="17.3137"
                                                                width="16" height="2" rx="1"
                                                                transform="rotate(-45 6 17.3137)" fill="currentColor" />
                                                            <rect x="7.41422" y="6" width="16"
                                                                height="2" rx="1"
                                                                transform="rotate(45 7.41422 6)" fill="currentColor" />
                                                        </svg>
                                                    </span>
                                                    <!--end::Svg Icon-->
                                                </div>
                                                <!--end::Close-->
                                            </div>
                                            <!--begin::Modal header-->
                                            <!--begin::Modal body-->
                                            <div class="modal-body scroll-y px-10 px-lg-15 pt-0 pb-15">
                                                <!--begin:Form-->
                                                <form id="kt_modal_new_target_form" class="form"
                                                    action="/admin/all_meals/{{ $meal->unique_id }}" method="POST"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')
                                                    <!--begin::Heading-->
                                                    <div class="mb-13 text-center">
                                                        <!--begin::Title-->
                                                        <h1 class="mb-3">Update {{ $meal->name }}
                                                            Details</h1>
                                                        <!--end::Title-->
                                                    </div>
                                                    <!--end::Heading-->
                                                    <!--begin::Input group-->
                                                    <div class="d-flex flex-column mb-8 fv-row">
                                                        <!--begin::Label-->
                                                        <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                                            <span class="required">Name</span>
                                                            <i class="fas fa-exclamation-circle ms-2 fs-7"
                                                                data-bs-toggle="tooltip"
                                                                title="Specify a target name for future usage and reference"></i>
                                                        </label>
                                                        <!--end::Label-->
                                                        <input type="text" class="form-control form-control-solid"
                                                            placeholder="Enter  Name" name="name"
                                                            value="{{ old('name') ?? $meal->name }}" />
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
                                                            <i class="fas fa-exclamation-circle ms-2 fs-7"
                                                                data-bs-toggle="tooltip"
                                                                title="Specify a target name for future usage and reference"></i>
                                                        </label>
                                                        <!--end::Label-->
                                                        <input type="email" class="form-control form-control-solid"
                                                            placeholder="Enter Department Name" name="email"
                                                            value="{{ old('email') ?? $meal->email }}" />
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
                                                            <i class="fas fa-exclamation-circle ms-2 fs-7"
                                                                data-bs-toggle="tooltip"
                                                                title="Specify a target name for future usage and reference"></i>
                                                        </label>
                                                        <!--end::Label-->
                                                        <input type="number" class="form-control form-control-solid"
                                                            placeholder="Enter Mobile No" name="mobile"
                                                            value="{{ old('mobile') ?? $meal->mobile }}" />
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
                                                            <i class="fas fa-exclamation-circle ms-2 fs-7"
                                                                data-bs-toggle="tooltip"
                                                                title="Specify a target name for future usage and reference"></i>
                                                        </label>
                                                        <!--end::Label-->
                                                        <input type="text" class="form-control form-control-solid"
                                                            placeholder="Enter Address" name="address"
                                                            value="{{ old('address') ?? $meal->address }}" />
                                                        @error('address')
                                                            <p class="text-danger">
                                                                {{ $message }}
                                                            </p>
                                                        @enderror
                                                    </div>

                                                    <!--end::Input group-->
                                                    <!--begin::Actions-->
                                                    <div class="text-center">
                                                        {{-- <button type="reset" id="kt_modal_new_target_cancel" class="btn btn-light me-3">Cancel</button> --}}
                                                        <button type="submit" id="kt_modal_new_target_submit"
                                                            class="btn btn-primary">
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
                                    <!--end::Modal dialog-->
                                </div>
                            </tbody>
                        @empty
                        @endforelse
                        <!--end::Table body-->
                    </table>
                    <!--end::Table-->
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Table Widget 4-->
        </div>
    </div>
@endsection
