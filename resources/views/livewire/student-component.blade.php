<div>
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-12">
                <div class="card shadow">
                    <div class="card-header d-flex justify-content-between">
                        <h6><strong>All Student</strong></h6>
                        <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addStudentModal">Add New Student</button>
                    </div>
                    <div class="card-body">
                        @if (session()->has('message')) 
                            <div class="alert alert-success text-center">{{ session('message') }}</div>
                        @endif

                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr class="table-success">
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($students->count() > 0)
                                    @foreach ($students as $s)
                                        <tr>
                                            <td>{{ $s->student_id }}</td>
                                            <td>{{ $s->name }}</td>
                                            <td>{{ $s->email }}</td>
                                            <td>{{ $s->phone }}</td>
                                            <td class="text-center">
                                                <button class="btn btn-sm btn-secondary" wire:click="viewStudentsDetails({{$s->id}})">View</button>
                                                <button class="btn btn-sm btn-primary" wire:click="editStudents({{ $s->id }})">Edit</button>
                                                <button class="btn btn-sm btn-danger" wire:click="deleteConfirm({{ $s->id }})">Delete</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr colspan="4" class="text-center"><small>No Student Found</small></tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Modal Body -->
    <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
    <div wire:ignore.self class="modal fade" id="addStudentModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitleId">Add New Student</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="storeStudentData">
                        <div class="form-group row mb-3">
                            <label class="col-3" for="student_id">Student ID</label>
                            <div class="col-9">
                                <input type="number" id="student_id" name="student_id" class="form-control" wire:model="student_id">
                                @error('student_id')
                                    <span class="text-danger" style="font-size: 11.5px">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label class="col-3" for="name">Name</label>
                            <div class="col-9">
                                <input type="text" id="name" name="name" class="form-control" wire:model="name">
                                @error('name')
                                    <span class="text-danger" style="font-size: 11.5px">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label class="col-3" for="email">Email</label>
                            <div class="col-9">
                                <input type="email" id="email" name="email" class="form-control" wire:model="email">
                                @error('email')
                                    <span class="text-danger" style="font-size: 11.5px">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label class="col-3" for="phone">Phone</label>
                            <div class="col-9">
                                <input type="number" id="phone" name="phone" class="form-control" wire:model="phone">
                                @error('phone')
                                    <span class="text-danger" style="font-size: 11.5px">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label class="col-3" for=""></label>
                            <div class="col-9">
                                <button type="submit" class="btn btn-sm btn-primary">Add Student</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div wire:ignore.self class="modal fade" id="editStudentModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitleId">Edit Student</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" wire:click="closeEditStudentModal"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="editStudentData">
                        <div class="form-group row mb-3">
                            <label class="col-3" for="student_id">Student ID</label>
                            <div class="col-9">
                                <input type="number" id="student_id" name="student_id" class="form-control" wire:model="student_id">
                                @error('student_id')
                                    <span class="text-danger" style="font-size: 11.5px">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label class="col-3" for="name">Name</label>
                            <div class="col-9">
                                <input type="text" id="name" name="name" class="form-control" wire:model="name">
                                @error('name')
                                    <span class="text-danger" style="font-size: 11.5px">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label class="col-3" for="email">Email</label>
                            <div class="col-9">
                                <input type="email" id="email" name="email" class="form-control" wire:model="email">
                                @error('email')
                                    <span class="text-danger" style="font-size: 11.5px">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label class="col-3" for="phone">Phone</label>
                            <div class="col-9">
                                <input type="number" id="phone" name="phone" class="form-control" wire:model="phone">
                                @error('phone')
                                    <span class="text-danger" style="font-size: 11.5px">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label class="col-3" for=""></label>
                            <div class="col-9">
                                <button type="submit" class="btn btn-sm btn-primary">Edit Student</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div wire:ignore.self class="modal fade" id="deleteStudentModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitleId">Delete Confirm</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pt-4 pb-4">
                    <h6 class="text-center">Are you sure? You wanna delete student data!</h6>
                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <button class="btn btn-sm btn-primary" data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-sm btn-danger" wire:click="deleteStudentData()">Yes! Delete</button>
                </div>
            </div>
        </div>
    </div>

    <div wire:ignore.self class="modal fade" id="viewStudentModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitleId">Student Information</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" wire:click="closeViewStudentModal"></button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered table-hover shadow-md">
                        <tbody>
                            <tr>
                                <th>Student ID: </th>
                                <td>{{$view_student_id}}</td>
                            </tr>
                            <tr>
                                <th>Name: </th>
                                <td>{{$view_student_name}}</td>
                            </tr>
                            <tr>
                                <th>Email: </th>
                                <td>{{$view_student_email}}</td>
                            </tr>
                            <tr>
                                <th>Phone: </th>
                                <td>{{$view_student_phone}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        window.addEventListener('close-modal', event =>{
            $('#addStudentModal').modal('hide');
            $('#editStudentModal').modal('hide');
            $('#deleteStudentModal').modal('hide');
        });
        window.addEventListener('show-edit-student-modal', event =>{
            $('#editStudentModal').modal('show');
        });
        window.addEventListener('show-delete-confirm-modal', event =>{
            $('#deleteStudentModal').modal('show');
        });
        window.addEventListener('show-view-student-modal', event =>{
            $('#viewStudentModal').modal('show');
        });
    </script>
@endpush

