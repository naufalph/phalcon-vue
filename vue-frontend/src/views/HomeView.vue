<template>
  <div class="d-flex flex-column mx-4 my-6 justify-content-center">
    <div class="d-flex justify-content-between">
      <h1>Patient List</h1>
      <router-link to="/add"><button class="btn btn-primary mx-6">Add Patient</button></router-link>
    </div>
    <table class="table w-75 align-self-center">
      <thead>
        <tr>
          <th>Nama</th>
          <th>SEX</th>
          <th>Religion</th>
          <th>Phone Number</th>
          <th class="text-center">Actions</th>
        </tr>
      </thead>
      <tbody>
        <TableRowVue
          v-for="patient in patients"
          :key="patient.id"
          :patient="patient"
        />
      </tbody>
    </table>
  </div>
</template>

<script>
import { mapActions, mapState } from "pinia";
import { usePatientStore } from "../stores/counter";
import TableRowVue from "../components/TableRow.vue";

export default {
  components: { TableRowVue },
  methods: {
    ...mapActions(usePatientStore, ["fetchPatient","resetPatientData"]),
  },
  computed: {
    ...mapState(usePatientStore, ["patients"]),
  },
  created() {
    this.fetchPatient();
    this.resetPatientData();
  },
};
</script>
