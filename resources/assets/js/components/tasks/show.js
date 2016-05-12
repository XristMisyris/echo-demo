Vue.component('tasks-show', {
    props: ['user', 'currentTeam', 'taskId'],

    /**
     * All of the component's data.
     */
    data() {
        return {
            viewers: [],
            task: null
        };
    },


    /**
     * Prepare the component.
     */
    ready() {
        this.listen();

        this.getTask();
    },



    methods: {
        /**
         * Listen to Echo channels.
         */
        listen() {
            echo.join('task.' + this.taskId)
                .here(viewers => {
                    this.viewers = viewers;
                });
        },


        /**
         * Get the task being viewed.
         */
        getTask() {
            this.$http.get('/api/teams/' + this.currentTeam.id + '/tasks/' + this.taskId)
                .then(response => {
                    this.task = response.data;
                });
        }
    },


    computed: {
        /**
         * Get all of the current viewers except me.
         */
        viewersExceptMe() {
            return _.reject(this.viewers, viewer => this.user.id == viewer.id);
        }
    }
});
