<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyCompanyExpenseRequest;
use App\Http\Requests\StoreCompanyExpenseRequest;
use App\Http\Requests\UpdateCompanyExpenseRequest;
use App\Models\Company;
use App\Models\CompanyExpense;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class CompanyExpenseController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('company_expense_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            if (session()->has('company_id') && session()->get('company_id') !== '0') {
                $query = CompanyExpense::where('company_id', session()->get('company_id'))->with(['company'])->select(sprintf('%s.*', (new CompanyExpense)->table));
            } else {
                $query = CompanyExpense::with(['company'])->select(sprintf('%s.*', (new CompanyExpense)->table));
            }

            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'company_expense_show';
                $editGate = 'company_expense_edit';
                $deleteGate = 'company_expense_delete';
                $crudRoutePart = 'company-expenses';

                return view(
                    'partials.datatablesActions',
                    compact(
                        'viewGate',
                        'editGate',
                        'deleteGate',
                        'crudRoutePart',
                        'row'
                    )
                );
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            $table->addColumn('company_name', function ($row) {
                return $row->company ? $row->company->name : '';
            });

            $table->editColumn('weekly_value', function ($row) {
                return $row->weekly_value ? $row->weekly_value : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'company']);

            return $table->make(true);
        }

        return view('admin.companyExpenses.index');
    }

    public function create()
    {
        abort_if(Gate::denies('company_expense_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $companies = Company::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.companyExpenses.create', compact('companies'));
    }

    public function store(StoreCompanyExpenseRequest $request)
    {
        $companyExpense = CompanyExpense::create($request->all());

        return redirect()->route('admin.company-expenses.index');
    }

    public function edit(CompanyExpense $companyExpense)
    {
        abort_if(Gate::denies('company_expense_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $companies = Company::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $companyExpense->load('company');

        return view('admin.companyExpenses.edit', compact('companies', 'companyExpense'));
    }

    public function update(UpdateCompanyExpenseRequest $request, CompanyExpense $companyExpense)
    {
        $companyExpense->update($request->all());

        return redirect()->route('admin.company-expenses.index');
    }

    public function show(CompanyExpense $companyExpense)
    {
        abort_if(Gate::denies('company_expense_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $companyExpense->load('company');

        return view('admin.companyExpenses.show', compact('companyExpense'));
    }

    public function destroy(CompanyExpense $companyExpense)
    {
        abort_if(Gate::denies('company_expense_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $companyExpense->delete();

        return back();
    }

    public function massDestroy(MassDestroyCompanyExpenseRequest $request)
    {
        $companyExpenses = CompanyExpense::find(request('ids'));

        foreach ($companyExpenses as $companyExpense) {
            $companyExpense->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
