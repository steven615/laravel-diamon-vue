<template>
  <app>
    <div class="p-grid">
      <div class="p-col-12">
        <div class="card">
          <FullCalendar :events="events" :options="options" />

          <Dialog
            v-model:visible="eventDialog"
            :style="{ width: '450px' }"
            header="Detalhes do Evento"
            :modal="true"
            :closable="true"
          >
            <div class="p-fluid">
              <div class="p-field">
                <label for="title">Descrição</label>
                <InputText
                  id="title"
                  v-if="clickedEvent"
                  v-model="changedEvent.title"
                  required="true"
                  autofocus
                  :disabled="true"
                />
              </div>
              <div class="p-field">
                <label for="start">Início</label>
                <Calendar
                  id="start"
                  v-if="clickedEvent"
                  v-model="changedEvent.start"
                  :showTime="true"
                  appendTo="body"
                  :disabled="true"
                />
              </div>
              <div class="p-field">
                <label for="end">Fim</label>
                <Calendar
                  id="end"
                  v-if="clickedEvent"
                  v-model="changedEvent.end"
                  :showTime="true"
                  appendTo="body"
                  :disabled="true"
                />
              </div>
            </div>
            <template #footer>
              <Button
                label="Fechar"
                icon="pi pi-close"
                class="p-button-text"
                @click="fechar"
              />
            </template>
          </Dialog>
        </div>
      </div>
    </div>
  </app>
</template>

<script>
import App from "@/Layouts/App";
import CalendarioService from "./CalendarioService";
import dayGridPlugin from "@fullcalendar/daygrid";
import timeGridPlugin from "@fullcalendar/timegrid";
import interactionPlugin from "@fullcalendar/interaction";
export default {
  components: {
    App,
  },
  data() {
    return {
      eventDialog: false,
      clickedEvent: null,
      changedEvent: { title: "", start: null, end: "", allDay: null },
      options: {
        plugins: [dayGridPlugin, timeGridPlugin, interactionPlugin],
        //defaultDate: '2019-01-01',
        locale: "pt-br",
        buttonText: {
          month: "Mês",
          week: "Semana",
          day: "Dia",
        },
        header: {
          left: "prev,next",
          center: "title",
          right: "dayGridMonth,timeGridWeek,timeGridDay",
        },
        editable: true,
        eventClick: (e) => {
          this.eventDialog = true;
          this.clickedEvent = e.event;
          this.changedEvent.title = this.clickedEvent.title;
          this.changedEvent.start = this.clickedEvent.start;
          this.changedEvent.end = this.clickedEvent.end;
        },
      },
      events: null,
    };
  },
  eventService: null,
  created() {
    this.eventService = new CalendarioService();
  },
  mounted() {
    this.eventService.getEvents().then((data) => {
      //console.log(data);
      this.events = data;
    });
  },
  methods: {
    findIndexById(id) {
      let index = -1;
      for (let i = 0; i < this.events.length; i++) {
        if (this.events[i].id === id) {
          index = i;
          break;
        }
      }
      return index;
    },
    save() {
      this.eventDialog = false;
      this.clickedEvent.setProp("title", this.changedEvent.title);
      this.clickedEvent.setStart(this.changedEvent.start);
      this.clickedEvent.setEnd(this.changedEvent.end);
      this.clickedEvent.setAllDay(this.changedEvent.allDay);
      this.changedEvent = { title: "", start: null, end: "", allDay: null };
    },
    reset() {
      this.changedEvent.title = this.clickedEvent.title;
      this.changedEvent.start = this.clickedEvent.start;
      this.changedEvent.end = this.clickedEvent.end;
    },
    fechar() {
      this.eventDialog = false;
      this.changedEvent = { title: "", start: null, end: "", allDay: null };
    },
  },
};
</script>

<style scoped>
@media screen and (max-width: 960px) {
  ::v-deep(.fc-header-toolbar) {
    display: flex;
    flex-wrap: wrap;
  }
}
</style>
