@if ($groupByTransactions->count())
    <div class="w-100 mb-3">
        <div class="accordion" id="transaction">
            @foreach ($groupByTransactions as $key => $group)

                <div class="card">
                    <div class="card-header" id="transactionHead{{ $key }}">
                        <a href="#" class="btn btn-header-link collapsed" data-toggle="collapse" data-target="#transaction{{ $key }}" aria-expanded="true" aria-controls="transaction{{ $key }}">
                            <div class="groupTag">{{ ucfirst($filters['groupBy']['default']) }}</div>
                            <div class="groupKey">{{ $key }}</div>
                            <div class="groupTotal mx-3">
                                Total Transaction
                                <div>{{ $group->count() }}</div>
                            </div>
                            <div class="groupDate">{!! $group->first()->created_at->toFormattedDateString() !!}</div>
                        </a>
                    </div>

                    <div id="transaction{{ $key }}" class="collapse" aria-labelledby="transactionHead{{ $key }}" data-parent="#transaction">
                        @foreach ($group as $user)
                            <div class="card-body row">
                                <div class="col-6 col-sm-3">{{ $user->username }}</div>
                                <div class="col-6 col-sm-3 operation text-right">Registration</div>
                                <div class="col-6 col-sm-3 status">[Credited]</div>
                                <div class="col-6 col-sm-3 amount credit">+ € 120</div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@else
    <div class="no-transactions"> No transactions found</div>
@endif
<script type="text/javascript">
    'use strict';
</script>
