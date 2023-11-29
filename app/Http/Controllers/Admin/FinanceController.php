<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class FinanceController extends Controller
{
    public function index()
    {
        $filters = null;
        $fromDate = date('Y-m-d', strtotime(User::min('created_at')));
        $data = [
            'filters' => [
                'operation' => [
                    'values' => ['Registration'],
                    'default' => '',
                ],
                'fromDate' => $fromDate,
                'toDate' => date('Y-m-d'),
                'groupBy' => [
                    'values' => ['Day', 'Month', 'Year'],
                    'default' => 'day',
                ],
                'orderBy' => [
                    'values' => ['Asc', 'Desc'],
                    'default' => 'desc',
                ],
            ],
            'package' => [],
            'groupByTransactions' => app()->call([$this, 'fetchUserData'], ['filters' => collect($filters), 'pages' => 10]),
        ];
        $data['totalBalance'] = User::query()->count() * 120;

        return view('admin.finance.index', $data);
    }

    public function filters()
    {
        $fromDate = date('Y-m-d', strtotime(User::min('created_at')));
        $data = [
            'filters' => [
                'operation' => [
                    'values' => ['Registration'],
                    'default' => '',
                ],
                'fromDate' => $fromDate,
                'toDate' => date('Y-m-d'),
                'groupBy' => [
                    'values' => ['Day', 'Month', 'Year'],
                    'default' => 'day',
                ],
                'orderBy' => [
                    'values' => ['Asc', 'Desc'],
                    'default' => 'desc',
                ],
            ],
            'package' => [],
        ];

        return view('admin.finance.partials.filter', $data);
    }

    public function fetch(Request $request)
    {
        $filters = $request->input('filters');
        $fromDate = date('Y-m-d', strtotime(User::min('created_at')));
        $data = [
            'filters' => [
                'operation' => [
                    'values' => ['Registration'],
                    'default' => '',
                ],
                'fromDate' => [
                    'default' => $fromDate,
                ],
                'toDate' => [
                    'default' => date('Y-m-d'),
                ],
                'groupBy' => [
                    'values' => ['Day', 'Month', 'Year'],
                    'default' => 'day',
                ],
                'orderBy' => [
                    'values' => ['Asc', 'Desc'],
                    'default' => 'desc',
                ],
            ],
        ];

        foreach ($data['filters'] as $key => $value) {
            $data['filters'][$key]['default'] = $request->input("filters.{$key}", $value['default']);
        }
        $data['groupByTransactions'] = app()->call([$this, 'fetchUserData'], ['filters' => collect($filters), 'pages' => $request->input('totalToShow', 10)]);

        return view('admin.finance.partials.transactionList', $data);
    }

    public function fetchUserData(Collection $filters, $pages = null, $showAll = false)
    {
        $method = $showAll ? 'get' : 'paginate';
        $orderBy = $filters->get('orderBy') ? $filters->get('orderBy') : 'desc';
        $groupBy = $filters->get('groupBy') ? $filters->get('groupBy') : 'day';

        $result = User::query()
            ->when($filters->get('fromDate'), function ($query) use ($filters): void {
                /** @var Builder $query */
                $query->whereDate('created_at', '>=', $filters->get('fromDate'));
            })
            ->when($filters->get('toDate'), function ($query) use ($filters): void {
                /** @var Builder $query */
                $query->whereDate('created_at', '<=', $filters->get('toDate'));
            });

        if ($showAll) {
            $result = $result->orderBy('created_at', $orderBy)->get();
        } else {
            $result = collect(
                $result
                    ->orderBy('created_at', $orderBy)
                    ->paginate($pages)
                    ->items()
            );
        }

        return $result->groupBy(fn ($value) => $this->formatToGroupBy($value, $groupBy));
    }

    public function formatToGroupBy(Model $model, $groupBy)
    {
        /** @var Carbon $createdAt */
        $createdAt = $model->created_at;

        switch ($groupBy) {
            case 'year':
                return $createdAt->format('Y');
                break;
            case 'month':
                return $createdAt->format('F');
                break;
            default:
                return $createdAt->format('l');
                break;
        }
    }
}
