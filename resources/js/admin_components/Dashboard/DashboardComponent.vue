<template>
  <div>
    <div class="content-header">
      <div class="container-fluid">
        <div class="row">
          <h1>Dashboard</h1>
        </div>
      </div>
      <!-- /.container-fluid -->
    </div>
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>150</h3>
                <p>New Orders</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="#" class="small-box-footer"
                >More info <i class="fas fa-arrow-circle-right"></i
              ></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>53<sup style="font-size: 20px">%</sup></h3>
                <p>Bounce Rate</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="#" class="small-box-footer"
                >More info <i class="fas fa-arrow-circle-right"></i
              ></a>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>44</h3>
                <p>User Registrations</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="#" class="small-box-footer"
                >More info <i class="fas fa-arrow-circle-right"></i
              ></a>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>65</h3>
                <p>Unique Visitors</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="#" class="small-box-footer"
                >More info <i class="fas fa-arrow-circle-right"></i
              ></a>
            </div>
          </div>
        </div>
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">
              <i class="fas fa-chart-pie mr-1"> Doanh thu 12 tháng </i>
            </h3>
            <div class="card-tools">
              <ul class="nav nav-pills ml-auto">
                <li class="nav-item">
                  <button
                    class="nav-link active"
                    data-toggle="tab"
                    @click="selectLineChart()"
                  >
                    Area
                  </button>
                </li>
                <li class="nav-item">
                  <button
                    class="nav-link"
                    data-toggle="tab"
                    @click="selectDonutChart()"
                  >
                    Donut
                  </button>
                </li>
              </ul>
            </div>
          </div>
          <!-- /.card-header -->
          <line-chart v-if="saleOption == 1"></line-chart>
          <doughnut-chart v-if="saleOption == 0"></doughnut-chart>
        </div>
        <div class="row">
          <div class="col-lg-6">
            <bar-chart></bar-chart>
          </div>
          <div class="col-lg-6">
            <doughnut-chart></doughnut-chart>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<script>
import LineChart from "./LineChart.vue";
import BarChart from "./BarChart.vue";
import DoughnutChart from "./DoughnutChart.vue";
import PieChart from "./PieChart.vue";
import RadarChart from "./RadarChart.vue";
import PolarAreaChart from "./PolarAreaChart.vue";
import BubbleChart from "./BubbleChart.vue";
import ScatterChart from "./ScatterChart.vue";

export default {
  data() {
    return {
      sale: [],
      saleOption: 1,
      data: [600, 1150, 342, 6050, 2522, 3241, 1259, 157, 1545, 9841],
    };
  },
  created() {},
  watch: {},
  methods: {
    selectLineChart() {
      this.saleOption = 1;
    },
    selectDonutChart() {
      this.saleOption = 0;
    },
  },
  components: {
    LineChart,
    BarChart,
    DoughnutChart,
    PieChart,
    RadarChart,
    PolarAreaChart,
    BubbleChart,
    ScatterChart,
  },
};
</script>