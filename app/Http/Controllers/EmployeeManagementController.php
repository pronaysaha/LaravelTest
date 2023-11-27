<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmployeeManagementController extends Controller
{
    <?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::with(['department', 'achievements'])->get();
        return response()->json($employees);
    }
}
public function store(Request $request)
{
    // Validate the request data
    $validatedData = $request->validate([
        'name' => 'required|string',
        'email' => 'required|email|unique:employees,email',
        'phone' => 'required|string',
        'address' => 'required|string',
        'department_id' => 'required|exists:departments,id',
        'achievements' => 'array',
        'achievements.*.id' => 'exists:achievements,id',
        'achievements.*.achievement_date' => 'date',
    ]);

    // Create the employee
    $employee = Employee::create($validatedData);

    // Attach achievements
    if (isset($validatedData['achievements'])) {
        $employee->achievements()->attach($validatedData['achievements']);
    }

    return response()->json($employee, 201);
}
public function update(Request $request, $id)
{
    // Validate the request data
    $validatedData = $request->validate([
        'name' => 'string',
        'email' => 'email|unique:employees,email,' . $id,
        'phone' => 'string',
        'address' => 'string',
        'department_id' => 'exists:departments,id',
        'achievements' => 'array',
        'achievements.*.id' => 'exists:achievements,id',
        'achievements.*.achievement_date' => 'date',
    ]);

    // Find the employee
    $employee = Employee::findOrFail($id);

    // Update the employee
    $employee->update($validatedData);

    // Sync achievements
    if (isset($validatedData['achievements'])) {
        $employee->achievements()->sync($validatedData['achievements']);
    }

    return response()->json($employee);
}
public function destroy($id)
{
    // Find the employee
    $employee = Employee::findOrFail($id);

    // Detach achievements
    $employee->achievements()->detach();

    // Delete the employee
    $employee->delete();

    return response()->json(['message' => 'Employee deleted successfully']);
}


}
