<template>
  <form @submit.prevent="submitHandler" class="form">
    <div>
      <label for="name">Name</label>
      <input
        type="text"
        class="form-control login"
        name="name"
        placeholder="Insert name here..."
        v-model="patientData.name"
      />
    </div>
    <div>
      <label for="nik">NIK</label>
      <input
        type="text"
        class="form-control login"
        name="nik"
        placeholder="Insert Your NIK here..."
        v-model="patientData.nik"
      />
    </div>
    <div>
      <select class="form-select" aria-label="Default select example" v-model="patientData.sex">
        <option selected disabled>Select your gender</option>
        <option value="L">Male</option>
        <option value="P">Female</option>
      </select>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</template>

<script>
import { mapActions, mapState } from "pinia";
import { usePatientStore } from "../stores/counter";

export default {
  data() {
    return {
      patientData: {
        name: "",
        sex: "",
        religion: "",
        phone: "",
        address: "",
        nik: "",
      },
      isPatient: true,
    };
  },
  computed: {
    ...mapState(usePatientStore, ["singlePatient"]),
  },
  beforeCreate() {
    if (this.singlePatient?.id) {
      this.patientData = this.singlePatient;
    } else this.isPatient = false;
  },
  methods: {
    ...mapActions(usePatientStore, ["postPatient", "putPatient"]),
    submitHandler() {
      // if (this.isPatient) {
      //   this.putPatient(this.patientData, this.patientData.id);
      // } else {
      //   this.postPatient(this.patientData);
      // }
      console.log(this.patientData);
    },
  },
};
</script>
