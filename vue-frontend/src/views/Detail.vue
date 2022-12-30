<template>
  <div class="d-flex mx-4 my-6">
    <table class="table">
      <thead>
        <tr>
          <th>Detil Pasien</th>
          <th>Deskripsi</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>Nama</td>
          <td>{{ singlePatient.name }}</td>
        </tr>
        <tr>
          <td>NIK</td>
          <td>{{ singlePatient.nik }}</td>
        </tr>
        <tr>
          <td>Religion</td>
          <td>{{ singlePatient.religion }}</td>
        </tr>
        <tr>
          <td>Phone Number</td>
          <td>{{ singlePatient.phone }}</td>
        </tr>
        <tr>
          <td>Address</td>
          <td>{{ singlePatient.address }}</td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
import { mapActions, mapState } from "pinia";
import { usePatientStore } from "../stores/counter";

export default {
  methods: {
    ...mapActions(usePatientStore, ["fetchOnePatient"]),
  },
  computed: {
    ...mapState(usePatientStore, ["singlePatient"]),
  },
  created() {
    this.fetchOnePatient(this.$route.params.id);
  },
};
</script>
