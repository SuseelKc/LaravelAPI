<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    //

    public function getEmployee(Request $request){
   
        return response()->json(Employee::all(),200);
    }


    public function getEmployeeById($id){

        $employee=Employee::find($id);
        if(is_null($employee)){
            return response()->json(['message'=>'Employee Not Found'],404);
        }
        return response()->json($employee,200);

    }

    public function addEmployee(Request $request){
        
        // $employee= Employee::create($request->all());
        // return response($employee,201);

         // Optionally validate the request
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'salary' => 'required|numeric',
        ]);

        // Create employee with validated data
        $employee = Employee::create($validatedData);
        
        return response($employee, 201);

    }
    public function updateEmployee(Request $request,$id){
        
        $employee=Employee::find($id);
        if(is_null($employee)){
            return response()->json(['message'=>'Employee Not Found'],404);
        }

        $employee->update($request->all());

        return response($employee, 200);

    }

    public function deleteEmployee(Request $request,$id){

        $employee=Employee::find($id);
        if(is_null($employee)){
            return response()->json(['message'=>'Employee Not Found'],404);
        }

        $employee->delete($request->all());

        return response($employee, 200);

    }

}
