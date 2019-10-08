


<template>
  <vs-tabs>
    <vs-tab label="Forms" icon-pack="feather" icon="icon-file-text">
    	<statistics-card-line
		icon="ShoppingBagIcon"
		statistic="97.5K"
		statisticTitle="Orders Received"
		:chartData="ordersReceviedChartData"
		color='warning'
		type='area' /></statistics-card-line>
    </vs-tab>
    <vs-tab label="Budget" icon-pack="feather" icon="icon-dollar-sign">
    </vs-tab>
    <vs-tab label="Editor Access" icon-pack="feather" icon="icon-facebook">
    </vs-tab>
    <vs-tab label="Banners" icon-pack="feather" icon="icon-film">
    </vs-tab>
    <vs-tab label="Campaigns" icon-pack="feather" icon="icon-navigation">
    </vs-tab>
  </vs-tabs>
</template>
<!-- <template>

  <form-wizard color="#74C166" :title="null" :subtitle="null" finishButtonText="Submit" @on-complete="formSubmitted">

      <tab-content title="Forms" class="mb-5" icon="feather icon-file-text">
	 	
          tab 1 content

      </tab-content>

      tab 2 content
      <tab-content title="Budget" class="mb-5" icon="feather icon-dollar-sign">
       
      </tab-content>

      tab 3 content
      <tab-content title="Editor Access" class="mb-5" icon="feather icon-facebook">
 
      </tab-content>
      <tab-content title="Banners" class="mb-5" icon="feather icon-film">
         
      </tab-content>
      <tab-content title="Campaigns" class="mb-5" icon="feather icon-navigation">
       
      </tab-content>
  </form-wizard>

</template>
 -->

<script>
import StatisticsCardLine from '@/components/statistics-cards/StatisticsCardLine.vue'
export default {
  data() {
    return {
      firstName: "",
      lastName: "",
      email: "",
      city: "new-york",
      proposalTitle: "",
      jobTitle: "",
      textarea: "",
      eventName: "",
      eventLocation: "san-francisco",
      status: "plannning",
      cityOptions: [
        {text: "New York", value:"new-york"},
        {text: "Chicago", value:"chicago"},
        {text: "San Francisco", value:"san-francisco"},
        {text: "Boston", value:"boston"},
      ],
      statusOptions: [
        {text: "Plannning", value:"plannning"},
        {text: "In Progress", value:"in progress"},
        {text: "Finished", value:"finished"},
      ],
      LocationOptions: [
        {text: "New York", value:"new-york"},
        {text: "Chicago", value:"chicago"},
        {text: "San Francisco", value:"san-francisco"},
        {text: "Boston", value:"boston"},
      ],
      subscribersGainedChartData: {
          series: [{
              name: 'Subscribers',
              data: [28, 40, 36, 52, 38, 60, 55]
          }],
          chartOptions: {
              grid: {
                  show: false,
                  padding: {
                      left: 0,
                      right: 0
                  }
              },
              chart: {
                  toolbar: {
                      show: false,
                  },
                  sparkline: {
                      enabled: true
                  }
              },
              dataLabels: {
                  enabled: false
              },
              stroke: {
                  curve: 'smooth',
                  width: 2.5
              },
              fill: {
                  type: 'gradient',
                  gradient: {
                      shadeIntensity: 0.9,
                      opacityFrom: 0.7,
                      opacityTo: 0.5,
                      stops: [0, 80, 100]
                  }
              },
              xaxis: {
                  type: 'numeric',
                  lines: {
                      show: false,
                  },
                  axisBorder: {
                      show: false,
                  },
                  labels: { show: false }
              },
              yaxis: [{
                  y: 0,
                  offsetX: 0,
                  offsetY: 0,
                  padding: { left: 0, right: 0 },
              }],
              tooltip: {
                  x: { show: false }
              },
          },
      },
    }
  },
  methods: {
    formSubmitted() {
      alert("Form submitted!");
    }
  },
  components: {
    StatisticsCardLine
  },
  watch: {
        
    },
    computed: {
        
    },
    created() {
      
    }
}
</script>
        