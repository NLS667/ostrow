<template>
  <div>
    <FullCalendar :options="calendarOptions" />
    <show-task-modal :show="show_task_details_modal" :task="current_task" :client="task_client_id" @close="show_task_details_modal = false" />
  </div>
</template>

<script>
import FullCalendar from "@fullcalendar/vue"
import dayGridPlugin from "@fullcalendar/daygrid"
import timeGridPlugin from "@fullcalendar/timegrid"
import interactionPlugin from "@fullcalendar/interaction"
import listPlugin from "@fullcalendar/list"
import plLocale from '@fullcalendar/core/locales/pl'
import bootstrapPlugin from '@fullcalendar/bootstrap'
import ShowTaskModal from './ShowTaskModal'
import CustomViewPlugin from './CustomViewPlugin'
import resourceTimeGridPlugin from '@fullcalendar/resource-timegrid';

export default {
    name: 'Calendar',
    props: {
      filterRoute: String
    },
    components: {
        FullCalendar,
        ShowTaskModal
    },
    data() {
      return {
        task_detail_modal_open: false,
        current_task: null,
        task_client_id: null,
        show_task_details_modal: false,

        /* Full Calendar Options Start */     
        
        calendarOptions: {
          locale: plLocale,
          themeSystem: 'bootstrap',
          plugins: [
            dayGridPlugin,
            timeGridPlugin,
            interactionPlugin,
            listPlugin,
            bootstrapPlugin,
            resourceTimeGridPlugin,
            CustomViewPlugin
          ],
          headerToolbar : {
            start: 'prev today next',
            center: 'title',
            end: 'custom resourceTimeGridFourDay timeGridDay dayGridMonth'
          },
          initialView: 'resourceTimeGridFourDay',
          weekends: false,
          editable: true,
          dayMaxEventRows: true,
          views: {
            timeGrid: {
              eventMaxStack: 4
            },
            monthGrid: {
              eventMaxStack: 4
            },
            dayGrid: {
              dayMaxEvents: 4,
            },
            resourceTimeGridFourDay: {
              type: 'resourceTimeGrid',
              duration: { weeks: 1 },
              buttonText: 'Harmonogram 2'
            },
            custom: {
              title: 'Harmonogram',
              buttonText: 'Harmonogram',
              duration: { weeks: 1 }
            }
          },
          resources: [
            { id: 'a', title: 'Room A' }
          ],
          events: {
            url: this.filterRoute,
            method: 'GET',
            failure: function() {
              alert('there was an error while fetching events!');
            },
            color: 'yellow',
            textColor: 'black'
          },
          eventResize: this.handleEventResize,
          eventDrop: this.handleEventDrop,
          eventClick: this.handleEventClick
        }
      }
    },
    methods: {        
        handleEventResize(e) {
          let updatedEventData = {
            id: e.event.id,
            start: this.formatDate(e.event.start, 'YYYY/MM/DD HH:mm'),
            end: this.formatDate(e.event.end, 'YYYY/MM/DD HH:mm')
          }

          axios.post('/admin/task/updateDates', { data: updatedEventData })
          .then( ({data}) => {
            Swal.fire({
              title: "Zmiana daty",
              text: "Zadanie " + e.event.title + " skończy się " + this.formatDate(e.event.end, 'DD/MM/YYYY HH:mm'),
              type: "info",
              showCancelButton: false,
              confirmButtonColor: "#3C8DBC",
              confirmButtonText: "OK"
            })
          })
          .catch( error => {
            e.revert()
            Swal.fire({
              title: "Błąd",
              text: "Nie udalo się zmienić daty zadania",
              type: "error",
              showCancelButton: false,
              confirmButtonColor: "#3C8DBC",
              confirmButtonText: "OK"
            })
          })
        },
        handleEventClick(e) {
            this.current_task = e.event
            this.task_client_id = e.event.extendedProps.service.client_id;
            this.show_task_details_modal = true
        },
        handleEventDrop(e) {
          let updatedEventData = {
            id: e.event.id,
            start: this.formatDate(e.event.start, 'YYYY/MM/DD HH:mm'),
            end: this.formatDate(e.event.end, 'YYYY/MM/DD HH:mm')
          }

          axios.post('/admin/task/updateDates', { data: updatedEventData })
          .then( ({data}) => {
            Swal.fire({
              title: "Zmiana daty",
              text: "Zadanie " + e.event.title + " zacznie się " + this.formatDate(e.event.start, 'DD/MM/YYYY HH:mm'),
              type: "info",
              showCancelButton: false,
              confirmButtonColor: "#3C8DBC",
              confirmButtonText: "OK"
            })
          })
          .catch( error => {
            e.revert()
            Swal.fire({
              title: "Błąd",
              text: "Nie udalo się zmienić daty zadania",
              type: "error",
              showCancelButton: false,
              confirmButtonColor: "#3C8DBC",
              confirmButtonText: "OK"
            })
          })
        },
        formatDate(date, format = 'DD/MM/YYYY HH:mm') {
          return moment(date).format(format)
        },

        rerenderCalendar() {
          this.$refs.fullCalendar.getApi().refetchEvents()
        }
    },
};
</script>

<style>
    .fc-content {
        color: white;
    }
</style>