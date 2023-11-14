
        <form class="filterForm">
            <div class="row">
                <div class="eachFilter operation col-md-4 col-sm-6">
                    <label>Operation</label>
                    <select name="filters[operation]" id="operation" class="form-control" >
                        <option value="">All</option>
                        @foreach($filters['operation']['values'] as $operation)
                            <option {{ $filters['operation']['default'] == strtolower($operation) ? 'selected' : '' }} value="{{ strtolower($operation) }}">{{ $operation }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="eachFilter operation col-md-4 col-sm-6">
                    <label>Frome Date</label>
                    <input type="text" class="datePicker" value="{{ $filters['fromDate'] }}" name="filters[fromDate]"/>
                </div>
                <div class="eachFilter operation col-md-4 col-sm-6">
                    <label>To Date</label>
                    <input type="text" class="datePicker" value="{{ $filters['toDate'] }}" name="filters[toDate]"/>
                </div>
                <div class="eachFilter operation col-md-4 col-sm-6">
                    <label>Group by</label>
                    <select name="filters[groupBy]" id="group-by" class="form-control" >
                        @foreach($filters['groupBy']['values'] as $group)
                            <option {{ $filters['groupBy']['default'] == strtolower($group) ? 'selected' : '' }} value="{{ strtolower($group) }}">{{ $group }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="eachFilter operation col-md-4 col-sm-6">
                    <label>Order by</label>
                    <select name="filters[orderBy]" id="order-by" class="form-control" >
                        @foreach($filters['orderBy']['values'] as $order)
                            <option {{ $filters['orderBy']['default'] == strtolower($order) ? 'selected' : '' }} value="{{ strtolower($order) }}">{{ $order }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="eachFilter operation col-md-4 col-sm-6">
                    <div class="button-section">
                        <button type="button" class="btn btn-primary filter-reset-button filterRequest">
                            <i class="fa fa-filter"></i>
                            Filter
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
                    fetchTransactions();
                });

                $('.clearFilter').click(function () {
                    loadTransactionFilters();
                });
                
                $('.datePicker').datepicker({
                    format: 'yyyy-mm-dd',
                    autoclose: true,
                    todayHighlight: true,
                });
            });
        </script>