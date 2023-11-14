@if($salesData->count())
    <div class="reportOptions">
        <button type="button" class="btn btn-primary downloadPdf"><i
                    class="fa fa-file-pdf"></i>Pdf</button>
        <button type="button" class="btn btn-primary downloadExcel"><i
                    class="fa fa-file-excel"></i>Excel</button>
        <!-- <button type="button" class="btn btn-primary downloadCsv"><i
                    class="fa fa-file-csv"></i>Csv</button> -->
        <button type="button" class="btn btn-primary printReport"><i
                    class="fa fa-print"></i>Print</button>
    </div>
    <div class="w-100 mb-3">
        <table id="reportTable" class="row-border hover display nowrap reporttable">
            <thead>
                <tr>
                    <th> </th>
                    <th> Sl No</th>
                    <th> Username</th>
                    <th> User ID</th>
                    <th> Package</th>
                    <th> Total</th>
                    <th> Joining Date</th>
                </tr>
            </thead>
            <tbody>
            @foreach($salesData as $user)
                <tr>
                    <td></td>
                    <td>{{ ($salesData->currentPage() * $salesData->perPage()) - $salesData->perPage() + $loop->iteration }}</td>
                    <td> {{ $user->username }} </td>
                    <td> {{ $user->customer_id }} </td>
                    <td> Basic </td>
                    <td> 0 </td>
                    <td> {{ date('Y-m-d', strtotime($user->created_at)) }} </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="paginationWrapper mt-2">
            {!! $salesData->links() !!}
        </div>
    </div>
@else
    <div class="no-reports"> No sales found</div>
@endif
<script type="text/javascript">
    'use strict';

    $('.paginationWrapper .pagination li a').click(function (e) {
        e.preventDefault();
        var route = $(this).attr('href');
        fetchSalesReport(route);
    });

    var TableDatatablesButtons = function () {

        var initTable1 = function () {
            new DataTable('#reportTable', {
                destroy: true,
                info: false,
                paging: false,
                searching: false,
                columnDefs: [
                    {
                        className: 'dtr-control',
                        orderable: false,
                        targets: 0
                    }
                ],
                order: [1, 'asc'],
                responsive: {
                    details: {
                        type: 'column'
                    }
                }
            });
        }

        return {

            //main function to initiate the module
            init: function () {

                if (!jQuery().dataTable) {
                    return;
                }

                initTable1();
            }

        };
    }();
    jQuery(document).ready(function () {
        TableDatatablesButtons.init();
    });

    // Download report as pdf
    $('.downloadPdf').click(function () {
        $.post('{{ route('joiningReport.download.pdf') }}', $('.filterForm').serialize(), function (response) {
            window.open(response.link);
        });
    });

    // Download report as Excel
    $('.downloadExcel').click(function () {
      window.location.href = '{{ route('joiningReport.download.excel') }}?' + $('.filterForm').serialize();
    });

    // print report
    $('.printReport').click(function () {
        $.post('{{ route('joiningReport.print') }}', $('.filterForm').serialize(), function (response) {
            var HTML = response;

            var WindowObject = window.open("", "PrintWindow", "width=750,height=650,top=50,left=50,toolbars=no,scrollbars=yes,status=no,resizable=yes");
            WindowObject.document.writeln(HTML);
            WindowObject.document.close();
            WindowObject.focus();
            WindowObject.print();
            WindowObject.close();
        });
    });
</script>
