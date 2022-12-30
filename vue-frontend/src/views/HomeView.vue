<template>
  <div class="d-flex mx-4 my-6">
    <table class="table">
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
    ...mapActions(usePatientStore, ["fetchPatient"]),
  },
  computed: {
    ...mapState(usePatientStore, ["patients"]),
  },
  created() {
    this.fetchPatient();
  },
};
</script>
