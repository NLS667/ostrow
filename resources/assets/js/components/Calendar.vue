<template>
    <FullCalendar :options="calendarOptions"/>
</template>

<script>
import FullCalendar from "@fullcalendar/vue"
import dayGridPlugin from "@fullcalendar/daygrid"
import timeGridPlugin from "@fullcalendar/timegrid"
import interactionPlugin from "@fullcalendar/interaction"
import listPlugin from "@fullcalendar/list"
import plLocale from '@fullcalendar/core/locales/pl';
import bootstrapPlugin from '@fullcalendar/bootstrap';

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
        FullCalendar
    },
    data() {
      /* Full Calendar Options Start */
      return {        
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
        handleDateClick(e) {
            this.new_event_modal_open = true
            this.new_event_start = e.dateStr
            let endTime = (new Date(e.dateStr)).toISOString()
            this.new_event_details.start = e.dateStr
            this.new_event_details.end = endTime
        },

        handleEventDrop(e) {
            let updatedEventData = {
              start: e.event.start,
              end: e.event.end
            }
            this.$api.appointments.update(e.event.id, updatedEventData)
              .then( ({data}) => {
                new Noty({
                  text: `Event has been updated.`,
                  timeout: 700,
                  type: 'success'
                }).show()
              })
              .catch( error => {
                e.revert()
                new Noty({
                  text: `Oops, something bad happened while updating your event.`,
                  timeout: 1000,
                  type: 'error'
                }).show()
              })
        },

        handleEventClick(e) {
            this.current_event = e.event
            this.show_event_details_modal = true
        },

        formatDate(date) {
          return moment.utc(date).format('DD/MM/YY HH:mm')
        },

        resetNewEventData() {
          this.new_event_details.start = null
          this.new_event_details.end = null
          this.new_event_details.title = null
          this.new_event_modal_open = false
        },

        newEventCreated() {
          this.rerenderCalendar()
          this.new_event_modal_open = false
          this.resetNewEventData()
          new Noty({
            text: `Appointment has been created.`,
            timeout: 1000,
            type: 'success'
          }).show()
        },

        eventResize(e) {
          let updatedEventData = {
            start: e.event.start,
            end: e.event.end
          }
          this.$api.appointments.update(e.event.id, updatedEventData)
            .then( ({data}) => {
              new Noty({
                text: `Appointment duration updated.`,
                timeout: 1000,
                type: 'success'
              }).show()
            })
            .catch( error => {
              e.revert()
              new Noty({
                text: `Oooops, couldn't update appointment duration. Sorry.`,
                timeout: 1000,
                type: 'error'
              }).show()
            })
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