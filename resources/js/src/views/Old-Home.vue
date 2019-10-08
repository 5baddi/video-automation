<template>
	<div>
		<h5 class="pb-4">Sign up Form | </h5>
		
		<vx-card class="content-md">
			<vs-row>
				
			</vs-row>
			<vs-row>
				<vs-col vs-w="4">
					<label>Dealership ID:</label>
				</vs-col>
				<vs-col vs-w="4" class="text-right">
					<vs-input class="inputx" size="small" color="success" />
				</vs-col>
				<vs-col vs-w="4" class="text-right">
					<vs-button color="#74c166" size="small">Search</vs-button>
					<vs-button class="cancel-btn" color="#ececec" size="small">Cancel</vs-button>
				</vs-col>
			</vs-row>
			<vs-row>
				<apexchart :options="chartOptions" :series="series"></apexchart>
				<!-- width="500" type="bar"  -->
			</vs-row>
		</vx-card>
	</div>
</template>

<script>
	import VueApexCharts from 'vue-apexcharts'
	// Vue.use(VueApexCharts)
	// Vue.component('apexchart', VueApexCharts)
	
	export default {
		data() {
			return {
				chartOptions: {
					
					chart: {
						height: 350,
						type: 'area',
					},
					dataLabels: {
						enabled: false
					},
					stroke: {
						curve: 'smooth'
					},
					/* series: [{
						name: 'series1',
						data: [100, 31, 51, 28, 42, 40, 109 ]
					}, {
						name: 'series2',
						data: [100, 31, 51, 28, 42, 40, 109 ]
					}], */

					/* xaxis: {
						type: 'datetime',
						categories: [
							"2018-09-19T06:30:00",
							"2018-09-19T00:00:00",
							"2018-09-19T01:30:00",
							"2018-09-19T02:30:00",
							"2018-09-19T03:30:00",
							"2018-09-19T04:30:00",
							"2018-09-19T05:30:00",
						],
					}, */
					tooltip: {
						x: {
							format: 'dd/MM/yy HH:mm'
						},
					}
					
					/* chart: { id: 'vuechart-example' },
					xaxis: {
						categories: [1991, 1992, 1993, 1994, 1995, 1996, 1997, 1998]
					} */
				},
				series: [{
					name: 'series-1',
					data: [91, 30, 40, 35, 50, 49, 60, 70]
				}]
			}
		},
		components: {
			apexchart: VueApexCharts
		}
	}
</script>

<style lang="scss">
	
</style>