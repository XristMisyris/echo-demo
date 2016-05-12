@extends('spark::layouts.app')

@section('content')
<tasks-show :user="user" :current-team="currentTeam" :task-id="{{ $task->id }}" inline-template>
    <div class="container">
        <div class="row" v-if="viewers.length > 1">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Also Viewing</div>

                    <div class="panel-body">
                        <table class="table table-borderless m-b-none">
                            <thead>
                                <th></th>
                                <th>Name</th>
                            </thead>

                            <tbody>
                                <tr v-for="viewer in viewersExceptMe">
                                    <!-- Photo -->
                                    <td>
                                        <img :src="viewer.photo_url" class="spark-profile-photo">
                                    </td>

                                    <!-- Name -->
                                    <td>
                                        <div class="btn-table-align">
                                            @{{ viewer.name }}
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="row" v-if="task">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">@{{ task.name }}</div>

                    <div class="panel-body">
                        <p class="m-b-none">
                            This task was created by @{{ task.creator.name }} on @{{ task.created_at | datetime }}.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</tasks-show>
@endsection
