<?php

namespace App\Http\Livewire;

use App\Models\Students;
use Livewire\Component;
use RealRashid\SweetAlert\Facades\Alert;

class StudentComponent extends Component
{
    public $student_id, $name, $email, $phone, $student_edit_id, $student_delete_id;    
    public $view_student_id, $view_student_name, $view_student_email, $view_student_phone, $view_student_id_view;

    // input fields on update validate
    public function updated($fields) {
        $this->validateOnly($fields, [
             'student_id' => 'required|unique:students,student_id,'.$this->student_edit_id.'', //Validation with ignoring own data
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|numeric',
        ], [
            'student_id.required' => 'Kolom Student ID wajib diisi',
            'student_id.unique' => 'Student ID sudah terdaftar',
            'name.required' => 'Kolom Nama wajib diisi',
            'email.required' => 'Kolom email wajib diisi',
            'email.email' => 'Kolom email harus berupa email',
            'phone.required' => 'Kolom phone wajib diisi',
        ]);
    }

    public function storeStudentData() {
        // on form submit validation
        $this->validate([
            'student_id' => 'required|unique:students',
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|numeric',
        ], [
            'student_id.required' => 'Kolom Student ID wajib diisi',
            'student_id.unique' => 'Student ID sudah terdaftar',
            'name.required' => 'Kolom Nama wajib diisi',
            'email.required' => 'Kolom email wajib diisi',
            'email.email' => 'Kolom email harus berupa email',
            'phone.required' => 'Kolom phone wajib diisi',
        ]);

        //Add Student Data
        Students::create([
            'student_id' => $this->student_id,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
        ]);

        session()->flash('message', 'New student has been added successfully');

        $this->student_id = '';
        $this->name = '';
        $this->email = '';
        $this->phone = '';

        //For hide modal after add student success
        $this->dispatchBrowserEvent('close-modal');
    }

    public function resetInputs() {
        $this->student_edit_id = '';
        $this->student_id = '';
        $this->name = '';
        $this->email = '';
        $this->phone = '';
    }

    public function editStudents($id) {
        $student = Students::where('id', $id)->first();

        $this->student_edit_id = $student->id;
        $this->student_id = $student->student_id;
        $this->name = $student->name;
        $this->email = $student->email;
        $this->phone = $student->phone;

        $this->dispatchBrowserEvent('show-edit-student-modal');
    }

    public function editStudentData() {
        // on form submit validation
        $this->validate([
            'student_id' => 'required|unique:students,student_id,'.$this->student_edit_id.'', //Validation with ignoring own data
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|numeric',
        ], [
            'student_id.required' => 'Kolom Student ID wajib diisi',
            'student_id.unique' => 'Student ID sudah terdaftar',
            'name.required' => 'Kolom Nama wajib diisi',
            'email.required' => 'Kolom email wajib diisi',
            'email.email' => 'Kolom email harus berupa email',
            'phone.required' => 'Kolom phone wajib diisi',
        ]);

        $student = Students::where('id', $this->student_edit_id)->first();
        $student->student_id = $this->student_id;
        $student->name = $this->name;
        $student->email = $this->email;
        $student->phone = $this->phone;

        $student->save();

        session()->flash('message', 'Student has been updated successfully');

        //For hide modal after add student success
        $this->dispatchBrowserEvent('close-modal');

    }

    // Delete confirmation
    public function deleteConfirm($id) {
        // $student = Students::where('id', $id)->first();

        $this->student_delete_id = $id;
        $this->dispatchBrowserEvent('show-delete-confirm-modal');
    }

    public function deleteStudentData() {
        $student = Students::where('id', $this->student_delete_id)->first();
        $student->delete();

        session()->flash('message', 'Student has been deleted successfully');

        //For hide modal after add student success
        $this->dispatchBrowserEvent('close-modal');

        $this->student_delete_id = '';
    }

    public function viewStudentsDetails($id) {
        $student = Students::where('id', $id)->first();

        $this->view_student_id = $student->student_id;
        $this->view_student_name = $student->name;
        $this->view_student_email = $student->email;
        $this->view_student_phone = $student->phone;

        $this->dispatchBrowserEvent('show-view-student-modal');
    }

    public function closeViewStudentModal() {
        $this->view_student_id = '';
        $this->view_student_name = '';
        $this->view_student_email = '';
        $this->view_student_phone = '';
    }

    public function closeEditStudentModal() {
        $this->student_id = '';
        $this->name = '';
        $this->email = '';
        $this->phone = '';
    }

    public function render()
    {
        // get all data
        $data['students'] = Students::all();

        return view('livewire.student-component', $data)->layout('livewire.layouts.base');
    }
}
