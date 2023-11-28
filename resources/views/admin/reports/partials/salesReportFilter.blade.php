<form class="filterForm">
            <div class="row">
                <div class="eachFilter operation col-md-3 col-sm-6">
                    <label>Username</label>
                    <input type="text" class="userFiller" name="filters[username]" placeholder="Enter user name"/>
                    <input type="hidden" name="filters[user_id]" id="user_id">
                </div>
                <!-- <div class="eachFilter operation col-md-3 col-sm-6">
                    <label>Package</label>
                    <select name="filters[package]">
                        <option value="">Select Package</option>
                        <option value="0">All</option>
                        @foreach ($package as $pack)
                            <option value="{{ $pack->id }}"> {{ $pack->name }} </option>
                        @endforeach
                    </select>
                </div> -->
                <div class="eachFilter operation col-md-3 col-sm-6">
                    <label>Member ID</label>
                    <input type="text" class="memberIdFiller" placeholder="Enter Member ID"/>
                    <input type="hidden" name="filters[customer_id]" id="member_id"/>
                </div>
                <div class="eachFilter operation col-md-3 col-sm-6">
                    <label>Joining Date</label>
                    <input type="text" class="joinDate" value="" name="filters[date]"/>
                </div>
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
                    fetchSalesReport();
                });

                $('.clearFilter').click(function () {
                    loadreportFilters();
                });

                $('.joinDate').daterangepicker({
                    locale: {
                        format: 'YYYY-MM-DD'
                    },
                    startDate: '{{ $default_filter['startDate'] }}',
                    endDate: '{{ $default_filter['endDate'] }}',
                    autoApply: true,
                    autoUpdateInput: true
                });
            });
        </script>