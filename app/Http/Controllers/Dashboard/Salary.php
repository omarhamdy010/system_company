<?php


namespace App\Http\Controllers\Dashboard;


use App\Models\User;

class Salary
{
    public function getSalary($id,$daynumberofattend,$absence){
        $totalsalary = \auth()->user()->salary;
        $user = User::where('id', $id)->first();
        if ($user) {
            $salaryofday = $user->salary / 30;
            if ($daynumberofattend <= 15) {
                $totalsalary = $salaryofday * $daynumberofattend;
            } else {
                $totalsalary = $user->salary - $salaryofday * $absence;
            }
        }
        return $totalsalary;
    }
}
