@extends('spark::layouts.app')

@section('content')
<home :user="user" :current-team="currentTeam" inline-template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Create New @{{ spark.state.currentTeam.name }} Task</div>

                    <div class="panel-body">
                        <form class="form-horizontal" role="form" @submit.prevent="create">
                            <!-- Name -->
                            <div class="form-group m-b-none" :class="{'has-error': form.errors.has('name')}">
                                <div class="col-md-12">
                                    <input type="text" class="form-control" name="name" v-model="form.name">

                                    <span class="help-block" v-show="form.errors.has('name')">
                                        @{{ form.errors.get('name') }}
                                    </span>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row" v-if="tasks.length > 0">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Current @{{ spark.state.currentTeam.name }} Tasks</div>

                    <div class="panel-body">
                        <table class="table table-borderless m-b-none">
                            <thead>
                                <th>Name</th>
                                <th></th>
                                <th></th>
                            </thead>

                            <tbody>
                                <tr v-for="task in tasks">
                                    <!-- Name -->
                                    <td>
                                        <div class="btn-table-align">
                                            @{{ task.name }}
                                        </div>
                                    </td>

                                    <!-- View Button -->
                                    <td>
                                        <a href="/teams/@{{ currentTeam.id }}/tasks/@{{ task.id }}">
                                            <button class="btn btn-primary">
                                                <i class="fa fa-search"></i>
                                            </button>
                                        </a>
                                    </td>

                                    <!-- Delete Button -->
                                    <td>
                                        <button class="btn btn-danger-outline" @click="deleteTask(task)">
                                            <i class="fa fa-times"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</home>
@endsection
