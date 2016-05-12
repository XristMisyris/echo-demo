Vue.component('home', {
    props: ['user', 'currentTeam'],

    /**
     * All of the component's data.
     */
    data() {
        return {
            tasks: [],

            form: new SparkForm({
                name: ''
            })
        };
    },


    /**
     * Prepare the component.
     */
    ready() {
        this.getTasks();
        this.listen();
    },


    methods: {
        /**
         * Listen to the Echo channels.
         */
        listen() {
            echo.channel('teams.' + this.currentTeam.id + '.tasks')
                .listen('TaskCreated', message => {
                    this.tasks.push(message.task);
                })
                .listen('TaskDeleted', message => {
                    this.removeTaskFromData(message.taskId);
                });
        },


        /**
         * Get all of the tasks for the team.
         */
        getTasks() {
            this.$http.get('/api/teams/' + this.currentTeam.id + '/tasks')
                .then(response => {
                    this.tasks = response.data;
                });
        },


        /**
         * Create a fresh task.
         */
        create() {
            Spark.post('/api/teams/' + this.currentTeam.id + '/tasks', this.form)
                .then(task => {
                    this.form.name = '';

                    this.tasks.push(task);
                });
        },


        /**
         * Delete the given task.
         */
        deleteTask(task) {
            this.$http.delete('/api/teams/' + this.currentTeam.id + '/tasks/' + task.id);

            this.removeTaskFromData(task.id);
        },


        /**
         * Remove the task from the component's data.
         */
        removeTaskFromData(taskId) {
            this.tasks = _.reject(this.tasks, t => t.id == taskId);
        }
    }
});
