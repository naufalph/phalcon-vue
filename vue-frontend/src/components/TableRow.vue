<template>
  <tr>
    <td>{{ patient.name }}</td>
    <td>{{ patient.sex }}</td>
    <td>{{ patient.religion }}</td>
    <td>{{ patient.phone }}</td>
    <td class="d-flex justify-content-around">
      <router-link :to="patient.id" class="btn btn-primary">Detail</router-link>
      <button class="btn btn-danger" @click="emitDel">Delete</button>
    </td>
  </tr>
</template>

<script>
import { mapActions } from "pinia";
import { usePatientStore } from "../stores/counter";
import Swal from "sweetalert2";
export default {
  props: {
    patient: Object,
  },
  methods: {
    ...mapActions(usePatientStore, ["delPatient"]),
    emitDel() {
      Swal.fire({
        title: "Do you want to delete this patient?",
        showCancelButton: true,
        confirmButtonText: "Delete",
        confirmButtonColor: "red",
      }).then((result) => {
        if (result.isConfirmed) {
          this.delPatient(this.patient.id);
        }
      });
    },
  },
};
</script>
