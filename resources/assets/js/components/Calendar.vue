<template>
  <div>
    <FullCalendar :options="calendarOptions" @eventClick="handleEventClick" />
    <show-task-modal :show="show_task_details_modal" :event="current_task" @close="show_task_details_modal = false" />
  </div>
</template>

<script>
import FullCalendar from "@fullcalendar/vue"
import dayGridPlugin from "@fullcalendar/daygrid"
import timeGridPlugin from "@fullcalendar/timegrid"
import interactionPlugin from "@fullcalendar/interaction"
import listPlugin from "@fullcalendar/list"
import plLocale from '@fullcalendar/core/locales/pl';
import bootstrapPlugin from '@fullcalendar/bootstrap';
import ShowTaskModal from './ShowTaskModal'

import "@fullcalendar/common/main.css"
import "@fullcalendar/daygrid/main.css"
import "@fullcalendar/timegrid/main.css"
import "@fullcalendar/list/main.css"

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
            bootstrapPlugin
          ],
          headerToolbar : {
            start: 'prev next today',
            center: 'title',
            end: 'dayGridMonth timeGridWeek timeGridDay listWeek'
          },
          initialView: 'dayGridMonth',
          weekends: true,
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
            }
          },
          events: {
            url: this.filterRoute,
            method: 'GET',
            failure: function() {
              alert('there was an error while fetching events!');
            },
            color: 'yellow',
            textColor: 'black'
          },
        }
      }
    },
    methods: {
        handleEventClick(e) {
            this.current_task = e.event
            this.show_task_details_modal = true
        },

        formatDate(date) {
          return moment.utc(date).format('DD/MM/YY HH:mm')
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