@extends('system.layout.app')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">{{ $page_title }}</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">{{ $page_title }}</li>
    </ol>
    <div class="row">
        <div class="col-xl-3 col-md-6">
            <div class="card bg-danger text-white mb-4">
                <div class="card-body">New Task(s)</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="#">Count {{$new_tasks_count}}</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-primary text-white mb-4">
                <div class="card-body">Open Task(s)</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="#">Count {{$open_tasks_count}}</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-warning text-white mb-4">
                <div class="card-body">In Progress Task(s)</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="#">Count {{$inprogress_tasks_count}}</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-success text-white mb-4">
                <div class="card-body">Completed Task(s)</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="#">Count {{$completed_tasks_count}}</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        
    </div>
    
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            My Pending Tasks List
        </div>
        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Task Name</th>
                        <th>Project</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Status</th>
                    </tr>
                </thead>
                
                <tbody>
                    <?php $x = 0; ?>
                    @foreach ($pending_tasks as $pending_task)
                    <?php $x++;?>
                    <tr data-row="{{ $pending_task->project_task_id}}">
                        <td>{{ $x }}</td>
                        <td>{{ $pending_task->project_task }}</td>
                        <td>{{ $pending_task->project_name }}</td>
                        <td>{{ $pending_task->start_date }}</td>
                        <td>{{ $pending_task->end_date }}</td>
                        <td>

                            <?php 
                            
                            if($pending_task->task_status=="NEW"){ 
                                echo "<span class='badge badge-danger'>New</span>";
                            }elseif($pending_task->task_status=="OPENED"){
                                echo "<span class='badge badge-primary'>Open</span>";
                            }elseif($pending_task->task_status=="INPROGRESS"){
                                echo "<span class='badge badge-warning'>In Progress</span>";
                            }elseif($pending_task->task_status=="COMPLETED"){
                                echo "<span class='badge badge-success'>Completed</span>";
                            }?>
                        
                        
                    </tr>
                    @endforeach

                    <tr>
                        <td colspan="6">
                            <div class="table-message-box" style="text-align:center;">
                            
                            </div>
                        </td>
                    </tr>
                </tbody>

                
            </table>
        </div>
    </div>
</div>

@push('scripting')
@endpush

@endsection
                