<template>
  <div class="d-flex flex-column justify-content-center">
    <div class="text-center">
      <h1>{{ isPatient ? "Edit Patient" : "Add Patient" }}</h1>
    </div>
    <form @submit.prevent="submitHandler" class="w-50 align-self-center">
      <div class="form-outline mb-4">
        <label for="name">Name</label>
        <input
          type="text"
          class="form-control"
          name="name"
          placeholder="Insert name here..."
          v-model="patientData.name"
        />
      </div>
      <div>
        <label for="nik">NIK</label>
        <input
          type="text"
          class="form-control mb-4"
          name="nik"
          placeholder="Insert your NIK here..."
          v-model="patientData.nik"
        />
      </div>
      <div>
        <label for="gender">Gender</label>
        <select
          name="gender"
          class="form-select mb-4"
          v-model="patientData.sex"
        >
          <option selected disabled>Select your gender</option>
          <option value="L">Male</option>
          <option value="P">Female</option>
        </select>
      </div>
      <div>
        <label for="religion">Religion</label>
        <select
          name="religion"
          class="form-select mb-4"
          v-model="patientData.religion"
        >
          <option selected disabled>Select your religion</option>
          <option value="Islam">Islam</option>
          <option value="Christian">Christian</option>
          <option value="Buddhism">Buddhism</option>
          <option value="Hinduism">Hinduism</option>
          <option value="Other">Other ..</option>
        </select>
      </div>
      <div>
        <label for="phone">Phone Number</label>
        <input
          type="text"
          class="form-control mb-4"
          name="phone"
          placeholder="Insert your phone number here..."
          v-model="patientData.phone"
        />
      </div>
      <div>
        <label for="address">Address</label>
        <textarea
          type="text"
          class="form-control mb-4"
          name="address"
          placeholder="Insert your phone number here..."
          rows="2"
          v-model="patientData.address"
        ></textarea>
      </div>
      <div class="text-center">
        <button type="submit" class="btn btn-primary">Submit</button>
        <router-link to="/" class="m-6"
          ><button class="btn btn-danger m-6">Cancel</button></router-link
        >
      </div>
    </form>
  </div>
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
      isPatient: false,
    };
  },
  // props: {
  //   patientProps: Object
  // },
  computed: {
    ...mapState(usePatientStore, ["singlePatient"]),
  },
  created() {
    if (this.singlePatient?.id) {
      this.patientData = this.singlePatient;
      this.isPatient = true;
    } else this.isPatient = false;
  },
  methods: {
    ...mapActions(usePatientStore, ["postPatient", "putPatient"]),
    submitHandler() {
      if (this.isPatient) {
        this.putPatient(this.patientData, this.patientData.id);
      } else {
        this.postPatient(this.patientData);
      }
      console.log(this.patientData);
    },
  },
};
</script>
