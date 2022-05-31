<template>
	<div v-if="show">
		<div class="modal fade show display" id="task-edit" v-cloak tabindex="-1" role="dialog" aria-labelledby="ShowTaskModal" aria-hidden="true">
		    <div class="modal-dialog modal-dialog-centered" role="document">
		        <div class="modal-content">
		            <!-- Modal Header -->
		            <div class="modal-header">
		                <h4 class="modal-title">Opis Zadania</h4>
		                <button type="button" class="close" @click="closeModal" aria-label="Close">
		                	<span aria-hidden="true">×</span>
		                </button>
		            </div>

		            <!-- Modal body -->
		            <div class="modal-body">
		                <div class="p-2">
		                	<ul class="list-group list-group-flush">
		                		<li class="list-group-item">
		                            <i class="material-icons">event</i>
		                            {{ formatDate(date.start) }}
		                        </li>
		                	</ul>
		                </div>
		            </div>
		            <!-- Modal footer -->
		            <div class="modal-footer">
		                <button type="button" class="btn btn-danger" @click="closeModal" data-dismiss="modal">Zamknij</button>
		                <button type="button" class="btn btn-success" @click="saveTask" :disabled="!validTaskData">Zapisz</button>
		            </div>
		        </div>
		    </div>
		</div>
		<div v-cloak class="modal-backdrop fade show custom-modal-backdrop"></div>
	</div>
</template>

<script>
export default{
	props: ['show', 'date'],
	    data: () => ({
	        event: {
	            title: null,
	            assignee: 'nobody',
	            note: null
	        },
	        services: []
	    }),

	    methods: {
	        closeModal() {
	            this.event.title = null
	            this.event.assignee = 'nobody'
	            this.event.note = null
	            this.$emit('close')
	        },

	        formatDate(date, format = 'DD/MM/YY HH:mm') {
	            return moment.utc(date).format(format)
	        }

	    },

	    computed: {
	        validEventData() {
	            return !!(this.event.title && this.event.assignee != 'nobody')
	        }
	    },

	    //mounted() {
	        // I absctracted my API calls, this would be the same as:
	        // axios.get('/users').then( .... ) ...
	        //this.$api.services.index()
	        //    .then(({
	        //        data
	        //    }) => {
	        //        this.services = data
	        //    })
	        //    .catch(error => {
	        //        this.services = []
	        //        this.event.assignee = null
	        //   })
	    //}
	}
</script>