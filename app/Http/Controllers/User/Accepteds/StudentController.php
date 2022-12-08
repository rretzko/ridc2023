<?php

namespace App\Http\Controllers\User\Accepteds;

use App\Http\Controllers\Controller;
use App\Http\Requests\StudentRequest;
use App\Models\CurrentEvent;
use App\Models\Student;
use App\Models\Utility\ClassOf;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function __construct()
    {

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $event = CurrentEvent::currentEvent();
        $user = auth()->user();
        $school = $user->school();
        $students = $school->students;

        return view('users.accepteds.students.index',
            compact('event', 'school', 'students', 'user')
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $class_ofs = ClassOf::classOfs();
        $event = CurrentEvent::currentEvent();
        $user = auth()->user();
        $school = $user->school();
        $students = $school->students;

        return view('users.accepteds.students.create',
            compact('class_ofs', 'event', 'school', 'students', 'user')
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StudentRequest $request)
    {
        $school_id = auth()->user()->school()->id;

        $student = ($this->isUniqueStudent($school_id, $request->all()))
            ? Student::create(
                [
                    'school_id' => $school_id,
                    'first' => $request['first'],
                    'middle' => $request['middle'],
                    'last' => $request['last'],
                    'class_of' => $request['class_of'],
                ])
            : new Student;

        ($student->id)
            ? session()->flash('success', $student->fullName.' is added to your roster.')
            : session()->flash('failure', $request['first'].' '.$request['middle'].' '.$request['last'].' ('.$request['class_of'].') is a duplicate and not added to your roster.');

        return redirect()->route('users.accepteds.students.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Student $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        $class_ofs = ClassOf::classOfs();
        $event = CurrentEvent::currentEvent();
        $user = auth()->user();
        $school = $user->school();
        $students = $school->students;

        return view('users.accepteds.students.edit',
            compact('class_ofs', 'event', 'school', 'student', 'students', 'user')
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StudentRequest $request
     * @param Student $student
     * @return \Illuminate\Http\Response
     */
    public function update(StudentRequest $request, Student $student)
    {
        $school_id = auth()->user()->school()->id;

        $student->update(
            [
                'school_id' => $school_id,
                'first' => $request['first'],
                'middle' => $request['middle'],
                'last' => $request['last'],
                'class_of' => $request['class_of'],
            ]
        );

        session()->flash('success', $student->fullName.' has been updated.');

        return redirect()->route('users.accepteds.students.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Student $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        $full_name = $student->fullName;

        $student->delete();

        session()->flash('success', $full_name."'s record has been removed from your roster.");

        return redirect()->route('users.accepteds.students.index');
    }

    private function isUniqueStudent(int $school_id, array $request): bool
    {
        return (! Student::where('school_id', $school_id)
            ->where('first', $request['first'])
            ->where('last', $request['last'])
            ->where('class_of', $request['class_of'])
            ->exists());
    }
}
