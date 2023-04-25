<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Student::all();
        return $students;
    }

    public function create()
    {
        return view('students.create');
    }

    public function store(Request $request)
    {
        $student = new Student;
        $student->name = $request->input('name');
        $student->email = $request->input('email');
        $student->password = bcrypt($request->input('password'));
        $student->save();
        return response()->json([
            'message' => 'Student created successfully',
            'book' => $student
        ], 201);
    }

    public function show(string $id)
    {
        //buscar el estudiante por id
        $student = Student::find($id);
        if ($student) {
            return response()->json($student);
        } else {
            return response()->json(['message' => 'Student not found'], 404);
        }
    }
    public function edit(Student $student)
    {
        return view('students.edit', compact('student'));
    }

    public function update(Request $request, Student $student)
    {
        $student = Student::findorFail($student->id);
        if ($student){
            $student->name = $request->input('name');
            $student->email = $request->input('email');
            $student->password = bcrypt($request->input('password'));
            $student->save();
            return response()->json(['message' => 'Student updated successfully', 'book' => $student], 200);
        } else {
            return response()->json(['message' => 'Student not found'], 404);
        }

    }

    public function destroy($id)
    {
        $student = Student::destroy($id);
        if($student){
            return response()->json(['message' => 'Student deleted successfully'], 200);
        } else {
            return response()->json(['message' => 'Student not found'], 404);
        }
    }

}
