<template>
  <div>
    <div class="card card-primary mt-3">
      <div class="card-header">
        <h3 class="card-title">CUSTOMER GROUP</h3>
        <button type="button" class="btn btn-info btn-sm" style="float: right">
          Create new Group
        </button>
      </div>
      <table id="example" class="display nowrap table" width="100%">
        <thead>
          <tr>
            <td>Id</td>
            <td>Group Name</td>
            <td>Condition</td>
            <td>&nbsp;</td>
          </tr>
        </thead>
        <tbody>
          <tr v-for="customer_group in customer_groups" :key="customer_group.id">
            <td>{{ customer_group.id }}</td>
            <td>{{ customer_group.group_name }}</td>
            <td>${{ customer_group.condition }}</td>
            <td>
              <button class="btn btn-primary btn-sm">
                <i class="fas fa-eye"></i>
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
import "jquery/dist/jquery.min.js";
import "bootstrap/dist/css/bootstrap.min.css";
import "datatables.net-dt/js/dataTables.dataTables";
import "datatables.net-dt/css/jquery.dataTables.min.css";
import $ from "jquery";
import Modal from "../../components/Modal.vue";
export default {
  data() {
    return {
      customer_groups: [],
    };
  },
  created() {},
  mounted() {
    fetch("http://127.0.0.1:8000/admin/customers/group")
      .then((response) => response.json())
      .then((data) => {
        console.log(data);
        this.customer_groups = data;
        setTimeout(() => {
          $("#example").DataTable({
            order: [
              [0, "asc"],
              [3, "desc"],
            ],
            responsive: true,
            destroy: true,
            retrieve: true,
            autoFill: true,
            colReorder: true,
            buttons: ["copy", "excel", "pdf"],
          });
        });
      });
  },
  methods: {
    showModal() {
      this.isModalVisible = true;
    },
    closeModal() {
      this.isModalVisible = false;
    },
  },
  components: {
    Modal,
  },
};
</script>

