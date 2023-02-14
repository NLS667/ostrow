<template>
	<div v-if="show">
		<div class="modal fade show" id="task-edit" v-cloak tabindex="-1" role="dialog" aria-labelledby="ShowTaskModal" aria-hidden="true" style="display: block;">
		    <div class="modal-dialog modal-dialog-centered" role="document">
		        <div class="modal-content">
		            <!-- Modal Header -->
		            <div class="modal-header">
		                <h5 class="modal-title" id="ShowTaskModal">{{ task.title }}</h5>
		                <button type="button" class="close" @click="closeModal" aria-label="Close">
		                	<span aria-hidden="true">×</span>
		                </button>
		                <h6>{{ task.type }}
		            </div>

		            <!-- Modal body -->
		            <div class="modal-body">
		                <div class="p-2">
		                	<ul class="list-group list-group-flush">
		                		<li class="list-group-item">
		                            <strong>Adres Zadania:</strong><br/>
		                            {{ task.extendedProps.service.client.adr_street }} {{ task.extendedProps.service.client.adr_street_nr }} {{ task.extendedProps.service.client.adr_home_nr }}<br/>
		                            {{ task.extendedProps.service.client.adr_zipcode }} {{ task.extendedProps.service.client.adr_city }}
		                        </li>
		                		<li class="list-group-item">
		                            <strong>Data rozpoczęcia:</strong><br/> {{ formatDate(task.start) }}
		                        </li>
		                        <li class="list-group-item">
		                            <strong>Data zakończenia:</strong><br/> {{ formatDate(task.end) }}
		                        </li>
		                        <li class="list-group-item">
		                            <strong>Przydzielony pracownik:</strong><br/> {{ task.extendedProps.assignee.first_name }} {{ task.extendedProps.assignee.last_name }}
		                        </li>
		                        <li class="list-group-item">
		                            <strong>Zespół:</strong><br/> {{ task.extendedProps.team }}
		                        </li>
		                        <li class="list-group-item">
		                            <strong>Uwagi:</strong><br/> {{ task.extendedProps.note }}
		                        </li>
		                	</ul>
		                </div>
		            </div>
		            <!-- Modal footer -->
		            <div class="modal-footer">
		                <button type="button" class="btn btn-danger" @click="closeModal" data-dismiss="modal">Zamknij</button>
		                <a v-bind:href="'/admin/task/' + task.id + '/edit'" class="btn btn-info" data-dismiss="modal">Przejdź do edycji</a>
		            </div>

		        </div>
		    </div>
		</div>
		<div v-cloak class="modal-backdrop fade show custom-modal-backdrop"></div>
	</div>
</template>

<script>
export default{
	props: ['show', 'task', 'client'],
	data() {
		return {
		    clientInfo: this.client
		}
	},

	methods: {
	    closeModal() {
	        this.$emit('close')
	    },

	    formatDate(date, format = 'DD/MM/YYYY HH:mm') {
	        return moment(date).format(format)
	    }
	},
	computed: {
	    clientID() {
		    return this.client
		}
	}
}
</script>