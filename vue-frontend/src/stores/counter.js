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
        // await axios({
        //   method: "delete",
        //   url: server + `patients/${id}`,
        // });
        await axios.delete(server + `patients/${id}`);
        this.fetchPatient();
        Swal.fire({
          title: "Delete success",
          timer: 1000,
        });
      } catch (error) {
        this.fetchPatient();
        console.log(error);
      }
    },
    async postPatient(newPatient) {
      try {
        await axios({
          method: "POST",
          url: server + `patients`,
          data: newPatient,
          headers: {
            "Content-Type": "application/json",
          },
        });
        Swal.fire({
          icon: "success",
          text: "Post new patient successful",
          showConfirmButton: false,
          timer: 1000,
        });
        this.$route.push("/");
      } catch (error) {
        console.log(error);
      }
    },
    async putPatient(newPatient, id) {
      try {
        await axios({
          method: "PUT",
          url: server + `patients/${id}`,
          data: newPatient,
          headers: {
            "Content-Type": "application/json",
          },
        });
        Swal.fire({
          icon: "success",
          text: `Edit patient ${id} successful`,
          showConfirmButton: false,
          timer: 1000,
        });
        this.$route.push(`/${id}`);
      } catch (error) {
        console.log(error);
      }
    },
  },
});
