<?php

namespace App\Http\Controllers;

use App\Models\Expenses;
use Illuminate\Http\Request;

class ExpensesController extends Controller
{
    private function calculatePercentageChange($current, $previous)
    {
        if ($previous == 0) {
            return $current > 0 ? 100 : 0;
        }

        return (($current - $previous) / $previous) * 100;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userId = auth()->id();

        // Current Periods
        $currentMonth = Expenses::where('user_id', $userId)
            ->whereMonth('expense_date', date('m'))
            ->sum('amount');

        $currentWeek = Expenses::where('user_id', $userId)
            ->whereBetween('expense_date', [now()->startOfWeek(), now()->endOfWeek()])
            ->sum('amount');

        $currentDay = Expenses::where('user_id', $userId)
            ->whereDate('expense_date', date('Y-m-d'))
            ->sum('amount');

        // Previous Periods
        $lastMonth = Expenses::where('user_id', $userId)
            ->whereMonth('expense_date', now()->subMonth()->format('m'))
            ->sum('amount');

        $lastWeek = Expenses::where('user_id', $userId)
            ->whereBetween('expense_date', [now()->subWeek()->startOfWeek(), now()->subWeek()->endOfWeek()])
            ->sum('amount');

        $previousDay = Expenses::where('user_id', $userId)
            ->whereDate('expense_date', now()->subDay()->format('Y-m-d'))
            ->sum('amount');

        // Calculate percentage changes
        $monthlyChange = $this->calculatePercentageChange($currentMonth, $lastMonth);
        $weeklyChange = $this->calculatePercentageChange($currentWeek, $lastWeek);
        $dailyChange = $this->calculatePercentageChange($currentDay, $previousDay);

        // List of expenses
        $list = Expenses::where('user_id', $userId)
            ->orderBy('expense_date', 'desc')
            ->paginate(10);

        return response([
            'monthly' => $currentMonth,
            'monthlyChange' => $monthlyChange,
            'lastMonth' => $lastMonth,
            'weekly' => $currentWeek,
            'weeklyChange' => $weeklyChange,
            'lastWeek' => $lastWeek,
            'daily' => $currentDay,
            'dailyChange' => $dailyChange,
            'previousDay' => $previousDay,
            'list' => $list,
        ], 200);
    }

    public function store(Request $request)
    {
        logger($request->all());
        // try {
        //     $data = $request->validate([
        //         'title' => 'required',
        //         'amount' => 'required',
        //         'expense_date' => 'required',
        //     ]);

        //     $data['user_id'] = auth()->id();


        //     $expense = Expenses::create($data);

        //     logger($expense);

        //     return response([
        //         'data' => $expense
        //     ], 200);
        // } catch (\Illuminate\Validation\ValidationException $e) {
        //     foreach ($e->errors() as  $value) {
        //         return response()->json(['message' => $value[0]], 422);
        //     }

        //     logger($e);
        // }
    }

    public function show($id)
    {
        $data = Expenses::where('user_id', auth()->id())->find($id);

        return response([
            'data' => $data
        ], 200);
    }

    public function update(Request $request, $id)
    {

        $expense = Expenses::where('user_id', auth()->id())->find($id);

        $expense->update([
            'title' => $request->title,
            'amount' => $request->amount,
            'expense_date' => $request->expense_date,
            'description' => $request->description,
        ]);

        return response([
            'data' => $expense
        ], 200);
    }

    public function destroy($id)
    {
        $expense = Expenses::find($id);

        $expense->delete();

        return response([
            'message' => 'Expense deleted successfully'
        ], 200);
    }
}
