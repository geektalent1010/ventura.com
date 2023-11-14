
        <form class="filterForm">
            <div class="row">
                <div class="eachFilter operation col-md-3 col-sm-6">
                    <label>Username</label>
                    <input type="text" class="userFiller" name="filters[username]" placeholder="Enter Username"/>
                    <input type="hidden" name="filters[user_id]" id="user_id">
                </div>
                <div class="eachFilter operation col-md-3 col-sm-6">
                    <label>Country</label>
                    <select name="filters[country_id]" id="country_id" class="form-control" >
                        <option value="">Select Country</option>
                        @foreach($countries as $country)
                            <option value="{{ $country->id }}">{{ $country->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="eachFilter operation col-md-3 col-sm-6">
                    <label>Member ID</label>
                    <input type="text" class="memberIdFiller" placeholder="Enter Member ID"/>
                    <input type="hidden" name="filters[customer_id]" id="member_id"/>
                </div>
                <div class="eachFilter operation col-md-3 col-sm-6">
                    <label>Email</label>
                    <input type="text" name="filters[email]" placeholder="Enter Email"/>
                </div>
                <div class="eachFilter operation col-md-3 col-sm-6">
                    <label>First Name</label>
                    <input type="text" name="filters[firstname]" placeholder="Enter First name"/>
                </div>
                <div class="eachFilter operation col-md-3 col-sm-6">
                    <label>Last Name</label>
                    <input type="text" name="filters[lastname]" placeholder="Enter Last name"/>
                </div>
                <div class="eachFilter operation col-md-3 col-sm-6">
                    <label>Joining Date</label>
                    <input type="text" class="joinDate" value="" name="filters[date]"/>
                </div>
                <!-- <div class="eachFilter operation col-md-3 col-sm-6">
                    <label>Package</label>
                    <select name="filters[package]">
                        <option value="">Select Package</option>
                        <option value="0">All</option>
                        @foreach($package as $pack)
                            <option value="{{ $pack->id }}"> {{ $pack->name }} </option>
                        @endforeach
                    </select>
                </div> -->
                <div class="eachFilter operation col-md-3 col-sm-6">
                    <div class="button-section">
                        <button type="button" class="btn btn-primary filter-reset-button filterRequest">
                            <i class="fa fa-filter"></i>
                            Filter
                        </button>
                        <button type="button" class="btn btn-primary filter-reset-button clearFilter">
                            <i class="fa fa-refresh"></i>
                            Reset
                        </button>
                    </div>
                </div>
            </div>
        </form>
        <script>
            "use strict"
            $(function () {
                //fetch report table while filter is clicked
                $('.filterRequest').click(function () {
                    fetchJoiningReport();
                });

                $('.clearFilter').click(function () {
                    loadreportFilters();
                });

                //User fetcher
                var selectedCallback = function (target, id, name) {

                    $('.userFiller').val(name);
                    $('#user_id').val(id);

                };
                var options = {
                    target: '.userFiller',
                    route: '{{ route("user.verify") }}',
                    action: 'getUsers',
                    name: 'username',
                    selectedCallback: selectedCallback,
                    clearCallback: function (element) {
                        element.siblings('input[name="filters[user_id]"]').val('')
                    }
                };
                // $('.userFiller').ajaxFetch(options);

                $('.joinDate').daterangepicker({
                    locale: {
                        format: 'YYYY-MM-DD'
                    },
                    startDate: '{{ $default_filter['startDate'] }}',
                    endDate: '{{ $default_filter['endDate'] }}',
                    autoApply: true,
                    autoUpdateInput: true
                });

                //Member ID fetcher
                var selectedIdCallback = function (target, id, name) {

                    $('.memberIdFiller').val(name);
                    $('#member_id').val(name);

                };
                var options = {
                    target: '.memberIdFiller',
                    route: '{{ route("user.verify") }}',
                    action: 'getMembersId',
                    name: 'customer_id',
                    selectedCallback: selectedIdCallback,
                    clearCallback: function (element) {
                        element.siblings('input[name="filters[customer_id]"]').val('')
                    }
                };
                // $('.memberIdFiller').ajaxFetch(options);
                //select2
                // $('select').select2({});
                // $('#country_id').select2({
                //     // multiple:true,
                //     placeholder: "Select a country",
                //     // allowClear: true
                // });

            });
        </script>