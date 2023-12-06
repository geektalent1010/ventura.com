<?php

namespace App\Http\Controllers\Admin;

use App\Exports\UsersExport;
use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\User;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Facades\Excel;

class ReportsController extends Controller
{
    public function index()
    {
        $filters = null;
        $data = [
            'default_filter' => [
                'startDate' => User::min('created_at'),
                'endDate' => User::max('created_at'),
            ],
            'package' => [],
            'countries' => Country::get(),
            'joiningData' => app()->call([$this, 'fetchUserData'], ['filters' => collect($filters), 'pages' => 25]),
        ];

        return view('admin.reports.index', $data);
    }

    public function downline()
    {
        $filters = null;
        $data = [
            'package' => [],
            'countries' => Country::get(),
            'downlineData' => app()->call([$this, 'fetchUserData'], ['filters' => collect($filters), 'pages' => 25]),
        ];

        return view('admin.reports.downline', $data);
    }

    public function sales()
    {
        $filters = null;
        $data = [
            'default_filter' => [
                'startDate' => User::min('created_at'),
                'endDate' => User::max('created_at'),
            ],
            'package' => [],
            'countries' => Country::get(),
            'salesData' => app()->call([$this, 'fetchUserData'], ['filters' => collect($filters), 'pages' => 25]),
        ];

        return view('admin.reports.sales', $data);
    }

    public function filters()
    {
        $data = [
            'default_filter' => [
                'startDate' => User::min('created_at'),
                'endDate' => User::max('created_at'),
            ],
            'package' => [],
            'countries' => Country::get(),
        ];

        return view('admin.reports.partials.joiningReportFilter', $data);
    }

    public function fetch(Request $request)
    {
        $filters = $request->input('filters');
        $data['joiningData'] = app()->call([$this, 'fetchUserData'], ['filters' => collect($filters), 'pages' => $request->input('totalToShow', 25)]);

        return view('admin.reports.partials.joiningReportTable', $data);
    }

    public function downlineFilters()
    {
        $data = [
            'package' => [],
            'countries' => Country::get(),
        ];

        return view('admin.reports.partials.downlineReportFilter', $data);
    }

    public function downlineFetch(Request $request)
    {
        $filters = $request->input('filters');
        $data['downlineData'] = app()->call([$this, 'fetchUserData'], ['filters' => collect($filters), 'pages' => $request->input('totalToShow', 25)]);

        return view('admin.reports.partials.downlineReportTable', $data);
    }

    public function salesFilters()
    {
        $data = [
            'default_filter' => [
                'startDate' => User::min('created_at'),
                'endDate' => User::max('created_at'),
            ],
            'package' => [],
            'countries' => Country::get(),
        ];

        return view('admin.reports.partials.salesReportFilter', $data);
    }

    public function salesFetch(Request $request)
    {
        $filters = $request->input('filters');
        $data['salesData'] = app()->call([$this, 'fetchUserData'], ['filters' => collect($filters), 'pages' => $request->input('totalToShow', 25)]);

        return view('admin.reports.partials.salesReportTable', $data);
    }

    public function downloadJoiningReportPdf(Request $request, PDF $pdf)
    {
        $filters = $request->input('filters');
        $data = [
            'joiningData' => app()->call([$this, 'fetchUserData'], ['filters' => collect($filters), 'showAll' => true]),
            'reportName' => 'Joinging report',
        ];

        $pdf->loadHTML(view('admin.reports.partials.joiningReportExportView', $data));
        $fileName = 'JoiningReport-' . date('Y-m-d-h-i-s') . '.pdf';
        $relativePath = storage_path('app' . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . $fileName);
        $pdf->save($relativePath);

        return response()->json(['link' => asset("storage/{$fileName}")]);
    }

    public function downloadJoiningReportExcel(Request $request)
    {
        $filters = $request->input('filters');
        $data = [
            'joiningData' => app()->call([$this, 'fetchUserData'], ['filters' => collect($filters), 'showAll' => true]),
            'reportName' => 'Joinging report',
        ];

        $fileName = 'JoiningReport-' . date('Y-m-d-h-i-s') . '.xlsx';

        return Excel::download(new UsersExport($data), $fileName);
    }

    public function printJoiningReport(Request $request)
    {
        $filters = $request->input('filters');
        $data = [
            'joiningData' => app()->call([$this, 'fetchUserData'], ['filters' => collect($filters), 'showAll' => true]),
            'reportName' => 'Joinging report',
        ];

        return view('admin.reports.partials.joiningReportExportView', $data);
    }

    public function fetchUserData(Collection $filters, $pages = null, $showAll = false)
    {
        $method = $showAll ? 'get' : 'paginate';

        $memberId = $filters->get('customer_id') ?? null;

        $result = User::query()
            ->when( ! $filters->get('user_id') && $memberId, function ($query) use ($memberId): void {
                /** @var Builder $query */
                $query->where('customer_id', $memberId);
            })
            ->when($userId = $filters->get('user_id'), function ($query) use ($userId): void {
                /** @var Builder $query */
                $query->where('id', $userId);
            })
            ->when($username = $filters->get('username'), function ($query) use ($username): void {
                /** @var Builder $query */
                $query->where('username', 'like', "%{$username}%");
            })
            ->when($email = $filters->get('email'), function ($query) use ($email): void {
                /** @var Builder $query */
                $query->where('email', 'like', "%{$email}%");
            })
            // // ->when($package_id = $filters->get('package'), function ($query) use ($package_id) {
            // //     /** @var Builder $query */
            // //     $query->where('package_id', $package_id);
            // // })
            ->when($filters->get('date'), function ($query) use ($filters): void {
                /** @var Builder $query */
                $dates = explode(' - ', $filters->get('date'));
                $query->whereDate('created_at', '>=', $dates[0]);
                $query->whereDate('created_at', '<=', $dates[1]);
            })
            ->whereHas('profile', function ($query) use ($filters): void {
                /** @var Builder $query */
                if ($firstname = $filters->get('firstname')) {
                    $query->where('first_name', 'like', "%{$firstname}%");
                }
                if ($lastname = $filters->get('lastname')) {
                    $query->where('last_name', 'like', "%{$lastname}%");
                }
                if ($country = $filters->get('country_id')) {
                    $query->where('country', $country);
                    $country_name = Country::find($country)->name;
                    $query->orWhere('country', 'like', "%{$country_name}%");
                }
            });

        if ($showAll) {
            return $result->get();
        }

        return $result->paginate($pages);

    }
}
