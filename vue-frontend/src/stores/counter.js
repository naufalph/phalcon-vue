import { defineStore } from "pinia";
import axios from "axios";
import Swal from "sweetalert2";
const server = "http://localhost:8080/";

export const usePatientStore = defineStore("patient", {
  state: () => {
    return {
      patients: [],
      singlePatient: {
        name: "",
        sex: "",
        religion: "",
        phone: "",
        address: "",
        nik: "",
      },
    };
  },
  actions: {
    async fetchPatient() {
      try {
        const data = await axios({
          method: "get",
          url: server + "patients",
        });
        console.log(data);
        this.patients = data.data?.result;
      } catch (error) {
        // console.log(error)
        console.log(error.response?.data.message);
      }
    },
    async fetchOnePatient(id) {
      try {
        const patientId = +id;
        const data = await axios({
          method: "get",
          url: server + `patients/${patientId}`,
        });
        console.log(data);
        this.singlePatient = data.data?.result;
      } catch (error) {
        console.log(error);
      }
    },
    async delPatient(id) {
      try {
        await axios({
          method: "delete",
          url: server + `patients/${id}`,
        });
        this.fetchPatient()
        Swal.fire({
          title:'Delete success',
          timer: 1000
        })
      } catch (error) {
        console.log(error.response.data)
      }
    },
  },
});
