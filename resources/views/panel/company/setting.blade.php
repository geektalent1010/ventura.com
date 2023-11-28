@extends('layouts.app', ['ACTIVE_TITLE' => 'PROFILE', 'ROUTES' => [
  ['ROUTE' => 'profile', 'ACTIVE' => 'profile', 'ACTIVE_ROUTE' => true],
  ['ROUTE' => 'profile.setting', 'ACTIVE' => 'setting', 'ACTIVE_ROUTE' => true]
], 'ACTIVE_PAGE' => 'setting'])

@section('title', __('- Setting'))

@section('PAGE_LEVEL_STYLES')
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
@endsection

@section('PAGE_START')
@endsection

@section('PAGE_CONTENT')

@php
    $main_interests = explode(",", $user->profile->main_interests);
@endphp
<div class="main-bg">
    <div class="container-fluid pt-4 px-0">
        <div class="page-content mx-auto px-3">
            <div class="page-subtitle">
                <span>SELECT 1 BUSINESS CATEGORY</span>
            </div>
        </div>
        <div class="row justify-content-center m-0 pb-4 w-100">
            <div class="col-md-6 p-0 accordion" id="category">
                <div class="card">
                    <div class="card-header" id="categoryhead1">
                        <div class="title business-category-check" attr-data="Automotive">Automotive</div>
                        <a href="#" class="btn-header-link collapsed collapse-Automotive {{ in_array('Automotive', $main_interests) ? 'active' : '' }}" data-toggle="collapse" data-target="#category1" aria-expanded="true" aria-controls="category1"></a>
                    </div>

                    <div id="category1" class="collapse collapse-Automotive {{ in_array('Automotive', $main_interests) ? 'active' : '' }}" aria-labelledby="categoryhead1" data-parent="#category">
                        <div class="card-body">
                            <p>Auto Accessories</p>
                            <p>Auto Dealers – New</p>
                            <p>Auto Dealers – Used</p>
                            <p>Detail & Carwash</p>
                            <p>Gas Stations</p>
                            <p>Motorcycle Sales & Repair</p>
                            <p>Rental & Leasing</p>
                            <p>Service, Repair & Parts</p>
                            <p>Towing</p>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="categoryhead2">
                        <div class="title business-category-check" attr-data="Business_Support">Business Support</div>
                        <a href="#" class="btn-header-link collapsed collapse-Business_Support {{ in_array('Business_Support', $main_interests) ? 'active' : '' }}" data-toggle="collapse" data-target="#category2" aria-expanded="true" aria-controls="category2"></a>
                    </div>

                    <div id="category2" class="collapse collapse-Business_Support {{ in_array('Business_Support', $main_interests) ? 'active' : '' }}" aria-labelledby="categoryhead2" data-parent="#category">
                        <div class="card-body">
                            <p>Consultants</p>
                            <p>Employment Agency</p>
                            <p>Marketing & Communications</p>
                            <p>Office Supplies</p>
                            <p>Printing & Publishing</p>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="categoryhead3">
                        <div class="title business-category-check" attr-data="Computers_Electronics">Computers & Electronics</div>
                        <a href="#" class="btn-header-link collapsed collapse-Computers_Electronics {{ in_array('Computers_Electronics', $main_interests) ? 'active' : '' }}" data-toggle="collapse" data-target="#category3" aria-expanded="true" aria-controls="category3"></a>
                    </div>

                    <div id="category3" class="collapse collapse-Computers_Electronics {{ in_array('Computers_Electronics', $main_interests) ? 'active' : '' }}" aria-labelledby="categoryhead3" data-parent="#category">
                        <div class="card-body">
                            <p>Computer Programming & Support</p>
                            <p>Consumer Electronics & Accessories</p>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="categoryhead4">
                        <div class="title business-category-check" attr-data="Construction_Contractors">Construction & Contractors</div>
                        <a href="#" class="btn-header-link collapsed collapse-Construction_Contractors {{ in_array('Construction_Contractors', $main_interests) ? 'active' : '' }}" data-toggle="collapse" data-target="#category4" aria-expanded="true" aria-controls="category4"></a>
                    </div>

                    <div id="category4" class="collapse collapse-Construction_Contractors {{ in_array('Construction_Contractors', $main_interests) ? 'active' : '' }}" aria-labelledby="categoryhead4" data-parent="#category">
                        <div class="card-body">
                            <p>Architects, Landscape Architects</p>
                            <p>Engineers & Surveyors</p>
                            <p>Blasting & Demolition</p>
                            <p>Building Materials & Supplies</p>
                            <p>Construction Companies</p>
                            <p>Electricians</p>
                            <p>Environmental Assessments</p>
                            <p>Inspectors</p>
                            <p>Plaster & Concrete</p>
                            <p>Plumbers</p>
                            <p>Roofers</p>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="categoryhead5">
                        <div class="title business-category-check" attr-data="Education">Education</div>
                        <a href="#" class="btn-header-link collapsed collapse-Education {{ in_array('Education', $main_interests) ? 'active' : '' }}" data-toggle="collapse" data-target="#category5" aria-expanded="true" aria-controls="category5"></a>
                    </div>

                    <div id="category5" class="collapse collapse-Education {{ in_array('Education', $main_interests) ? 'active' : '' }}" aria-labelledby="categoryhead5" data-parent="#category">
                        <div class="card-body">
                            <p>Adult & Continuing Education</p>
                            <p>Early Childhood Education</p>
                            <p>Educational Resources</p>
                            <p>Other Educational</p>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="categoryhead6">
                        <div class="title business-category-check" attr-data="Entertainment">Entertainment</div>
                        <a href="#" class="btn-header-link collapsed collapse-Entertainment {{ in_array('Entertainment', $main_interests) ? 'active' : '' }}" data-toggle="collapse" data-target="#category6" aria-expanded="true" aria-controls="category6"></a>
                    </div>

                    <div id="category6" class="collapse collapse-Entertainment {{ in_array('Entertainment', $main_interests) ? 'active' : '' }}" aria-labelledby="categoryhead6" data-parent="#category">
                        <div class="card-body">
                            <p>Artists, Writers</p>
                            <p>Event Planners & Supplies</p>
                            <p>Golf Courses</p>
                            <p>Movies</p>
                            <p>Productions</p>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="categoryhead7">
                        <div class="title business-category-check" attr-data="Food_Dining">Food & Dining</div>
                        <a href="#" class="btn-header-link collapsed collapse-Food_Dining {{ in_array('Food_Dining', $main_interests) ? 'active' : '' }}" data-toggle="collapse" data-target="#category7" aria-expanded="true" aria-controls="category7"></a>
                    </div>

                    <div id="category7" class="collapse collapse-Food_Dining {{ in_array('Food_Dining', $main_interests) ? 'active' : '' }}" aria-labelledby="categoryhead7" data-parent="#category">
                        <div class="card-body">
                            <p>Desserts, Catering & Supplies</p>
                            <p>Fast Food & Carry Out</p>
                            <p>Grocery, Beverage & Tobacco</p>
                            <p>Restaurants</p>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="categoryhead8">
                        <div class="title business-category-check" attr-data="Health_Medicine">Health & Medicine</div>
                        <a href="#" class="btn-header-link collapsed collapse-Health_Medicine {{ in_array('Health_Medicine', $main_interests) ? 'active' : '' }}" data-toggle="collapse" data-target="#category8" aria-expanded="true" aria-controls="category8"></a>
                    </div>

                    <div id="category8" class="collapse collapse-Health_Medicine {{ in_array('Health_Medicine', $main_interests) ? 'active' : '' }}" aria-labelledby="categoryhead8" data-parent="#category">
                        <div class="card-body">
                            <p>Acupuncture</p>
                            <p>Assisted Living & Home Health Care</p>
                            <p>Audiologist</p>
                            <p>Chiropractic</p>
                            <p>Clinics & Medical Centers</p>
                            <p>Dental</p>
                            <p>Diet & Nutrition</p>
                            <p>Laboratory, Imaging & Diagnostic</p>
                            <p>Massage Therapy</p>
                            <p>Mental Health</p>
                            <p>Nurse</p>
                            <p>Optical</p>
                            <p>Pharmacy, Drug & Vitamin Stores</p>
                            <p>Physical Therapy</p>
                            <p>Physicians & Assistants</p>
                            <p>Podiatry</p>
                            <p>Social Worker</p>
                            <p>Animal Hospital</p>
                            <p>Veterinary & Animal Surgeons</p>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="categoryhead9">
                        <div class="title business-category-check" attr-data="Home_Garden">Home & Garden</div>
                        <a href="#" class="btn-header-link collapsed collapse-Home_Garden {{ in_array('Home_Garden', $main_interests) ? 'active' : '' }}" data-toggle="collapse" data-target="#category9" aria-expanded="true" aria-controls="category9"></a>
                    </div>

                    <div id="category9" class="collapse collapse-Home_Garden {{ in_array('Home_Garden', $main_interests) ? 'active' : '' }}" aria-labelledby="categoryhead9" data-parent="#category">
                        <div class="card-body">
                            <p>Antiques & Collectibles</p>
                            <p>Cleaning</p>
                            <p>Crafts, Hobbies & Sports</p>
                            <p>Flower Shops</p>
                            <p>Home Furnishings</p>
                            <p>Home Goods</p>
                            <p>Home Improvements & Repairs</p>
                            <p>Landscape & Lawn Service</p>
                            <p>Pest Control</p>
                            <p>Pool Supplies & Service</p>
                            <p>Security System & Services</p>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="categoryhead10">
                        <div class="title business-category-check" attr-data="Legal_Financial">Legal & Financial</div>
                        <a href="#" class="btn-header-link collapsed collapse-Legal_Financial {{ in_array('Legal_Financial', $main_interests) ? 'active' : '' }}" data-toggle="collapse" data-target="#category10" aria-expanded="true" aria-controls="category10"></a>
                    </div>

                    <div id="category10" class="collapse collapse-Legal_Financial {{ in_array('Legal_Financial', $main_interests) ? 'active' : '' }}" aria-labelledby="categoryhead10" data-parent="#category">
                        <div class="card-body">
                            <p>Accountants</p>
                            <p>Attorneys</p>
                            <p>Financial Institutions</p>
                            <p>Financial Services</p>
                            <p>Insurance</p>
                            <p>Other Legal</p>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="categoryhead11">
                        <div class="title business-category-check" attr-data="Manufacturing_Wholesale_Distribution">Manufacturing, Wholesale, Distribution</div>
                        <a href="#" class="btn-header-link collapsed collapse-Manufacturing_Wholesale_Distribution {{ in_array('Manufacturing_Wholesale_Distribution', $main_interests) ? 'active' : '' }}" data-toggle="collapse" data-target="#category11" aria-expanded="true" aria-controls="category11"></a>
                    </div>

                    <div id="category11" class="collapse collapse-Manufacturing_Wholesale_Distribution {{ in_array('Manufacturing_Wholesale_Distribution', $main_interests) ? 'active' : '' }}" aria-labelledby="categoryhead11" data-parent="#category">
                        <div class="card-body">
                            <p>Distribution</p>
                            <p>Import/Export</p>
                            <p>Manufacturing</p>
                            <p>Wholesale</p>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="categoryhead12">
                        <div class="title business-category-check" attr-data="Merchants_Retail">Merchants, Retail</div>
                        <a href="#" class="btn-header-link collapsed collapse-Merchants_Retail {{ in_array('Merchants_Retail', $main_interests) ? 'active' : '' }}" data-toggle="collapse" data-target="#category12" aria-expanded="true" aria-controls="category12"></a>
                    </div>

                    <div id="category12" class="collapse collapse-Merchants_Retail {{ in_array('Merchants_Retail', $main_interests) ? 'active' : '' }}" aria-labelledby="categoryhead12" data-parent="#category">
                        <div class="card-body">
                            <p>Cards & Gifts</p>
                            <p>Clothing & Accessories</p>
                            <p>Department Stores</p>
                            <p>Sporting Goods</p>
                            <p>General</p>
                            <p>Jewelry</p>
                            <p>Shoes</p>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="categoryhead13">
                        <div class="title business-category-check" attr-data="Miscellaneous">Miscellaneous</div>
                        <a href="#" class="btn-header-link collapsed collapse-Miscellaneous {{ in_array('Miscellaneous', $main_interests) ? 'active' : '' }}" data-toggle="collapse" data-target="#category13" aria-expanded="true" aria-controls="category13"></a>
                    </div>

                    <div id="category13" class="collapse collapse-Miscellaneous {{ in_array('Miscellaneous', $main_interests) ? 'active' : '' }}" aria-labelledby="categoryhead13" data-parent="#category">
                        <div class="card-body">
                            <p>Civic Groups</p>
                            <p>Funeral Service Providers & Cemetaries</p>
                            <p>Miscellaneous</p>
                            <p>Utility Companies</p>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="categoryhead14">
                        <div class="title business-category-check" attr-data="Personal_Care_Services">Personal Care & Services</div>
                        <a href="#" class="btn-header-link collapsed collapse-Personal_Care_Services {{ in_array('Personal_Care_Services', $main_interests) ? 'active' : '' }}" data-toggle="collapse" data-target="#category14" aria-expanded="true" aria-controls="category14"></a>
                    </div>

                    <div id="category14" class="collapse collapse-Personal_Care_Services {{ in_array('Personal_Care_Services', $main_interests) ? 'active' : '' }}" aria-labelledby="categoryhead14" data-parent="#category">
                        <div class="card-body">
                            <p>Animal Care & Supplies</p>
                            <p>Barber & Beauty Salons</p>
                            <p>Beauty Supplies</p>
                            <p>Dry Cleaners & Laundromats</p>
                            <p>Exercise & Fitness</p>
                            <p>Massage & Body Works</p>
                            <p>Nail Salons</p>
                            <p>Shoe Repairs</p>
                            <p>Tailors</p>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="categoryhead15">
                        <div class="title business-category-check" attr-data="Real_Estate">Real Estate</div>
                        <a href="#" class="btn-header-link collapsed collapse-Real_Estate {{ in_array('Real_Estate', $main_interests) ? 'active' : '' }}" data-toggle="collapse" data-target="#category15" aria-expanded="true" aria-controls="category15"></a>
                    </div>

                    <div id="category15" class="collapse collapse-Real_Estate {{ in_array('Real_Estate', $main_interests) ? 'active' : '' }}" aria-labelledby="categoryhead15" data-parent="#category">
                        <div class="card-body">
                            <p>Agencies & Brokerage</p>
                            <p>Agents & Brokers</p>
                            <p>Apartment & Home Rental</p>
                            <p>Mortgage Broker & Lender</p>
                            <p>Property Management</p>
                            <p>Title Company</p>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="categoryhead16">
                        <div class="title business-category-check" attr-data="Travel_Transportation">Travel & Transportation</div>
                        <a href="#" class="btn-header-link collapsed collapse-Travel_Transportation {{ in_array('Travel_Transportation', $main_interests) ? 'active' : '' }}" data-toggle="collapse" data-target="#category16" aria-expanded="true" aria-controls="category16"></a>
                    </div>

                    <div id="category16" class="collapse collapse-Travel_Transportation {{ in_array('Travel_Transportation', $main_interests) ? 'active' : '' }}" aria-labelledby="categoryhead16" data-parent="#category">
                        <div class="card-body">
                            <p>Hotel, Motel & Extended Stay</p>
                            <p>Moving & Storage</p>
                            <p>Packaging & Shipping</p>
                            <p>Transportation</p>
                            <p>Travel & Tourism</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-content mx-auto px-3">
            <div class="row mx-0 justify-content-center mb-5">
                <div class="content-card">
                    <div class="change-data-input-section">
                        <button class="btn btn-primary update-button business-category-update">
                            {{ __('Update') }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@section('PAGE_END')
@endsection

@section('PAGE_LEVEL_SCRIPTS')
<script>
    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var business_categories = '{{ $user->profile->main_interests }}' ? '{{ $user->profile->main_interests }}'.split(',') : [];

    $('.business-category-check').on('click', function() {
        var category = $(this).attr('attr-data');
        var className = '.collapse-' + category;
        if (business_categories.indexOf(category) < 0) {
            if (business_categories.length > 0) {
                toastr['error']('You can select only one.', 'Alert');
                return;
            }
            business_categories.push(category);
            if (!$(className).hasClass('active')) {
                $(className).addClass('active');
            }
        } else {
            business_categories.splice(business_categories.indexOf(category), 1);
            if ($(className).hasClass('active')) {
                $(className).removeClass('active');
            }
        }
    })

    $('.business-category-update').on('click', function() {
        var send_data = {};
        send_data['id'] = '{{ $user->profile->id }}';
        send_data['main_interests'] = business_categories.join(',');
        $.ajax({
          type: 'PUT',
          url: '{{ route('setting.main.interested') }}',
          data: send_data,
          success: function(data) {
            toastr['success'](data.success, 'Success');
          },
          error:function(data){
            console.log(data);
          }
        })
    })
</script>
@endsection