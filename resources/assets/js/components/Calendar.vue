<template>
<div>
    <FullCalendar
        ref="fullCalendar"
        defaultView="timeGridDay"
        :options="calendarOptions"
        :header="{
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
          }"
        :plugins="calendarPlugins"
        :weekends="calendarWeekends"
        :events="calendarEvents"
        @dateClick="handleDateClick"
        @eventDrop="handleEventDrop"
        @eventClick="handleEventClick"
        @eventResize="eventResize"
        :editable="true"
        navLinks="true"
        timeZone="UTC"
    />
</div>
</template>

<script>
import FullCalendar from "@fullcalendar/vue"
import dayGridPlugin from "@fullcalendar/daygrid"
import timeGridPlugin from "@fullcalendar/timegrid"
import interactionPlugin from "@fullcalendar/interaction"
import listPlugin from "@fullcalendar/list"
import plLocale from '@fullcalendar/core/locales/pl';

import "@fullcalendar/common/main.css"
import "@fullcalendar/daygrid/main.css"
import "@fullcalendar/timegrid/main.css"
import "@fullcalendar/list/main.css"

export default {
    name: 'Calendar',
    components: {
        FullCalendar
    },
    data: () => ({
        /* Full Calendar Options Start */
        calendarPlugins: [
            dayGridPlugin,
            timeGridPlugin,
            interactionPlugin,
            listPlugin
        ],
        calendarWeekends: true,
        calendarEvents:
          {
            url: '/tasks/filter'
          },
        locale: plLocale,
        calendarOptions: {
            dayMaxEventRows: true,
            views: {
                timeGrid: {
                    eventLimit: 4
                },
                monthGrid: {
                    eventLimit: 4
                },
                dayGrid: {
                    eventLimit: 4,
                }
            },
        },
        /* Full Calendar Options End */
    }),

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