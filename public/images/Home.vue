<template>
	<div>
		<h5 class="pb-4">Sign up Form | </h5>
		
		<vx-card class="content-md">
			<vs-row>
				<vs-col vs-w="4">
					<label>Dealership ID:</label>
				</vs-col>
				<vs-col vs-w="4" class="text-right">
					<vs-input class="inputx" size="small" />
				</vs-col>
				<vs-col vs-w="4" class="text-right">
					<vs-button color="#74c166" size="small">Search</vs-button>
					<vs-button class="cancel-btn" color="#ececec" size="small">Cancel</vs-button>
				</vs-col>
			</vs-row>
			<vs-row>
				<vs-col vs-w="12" class="text-center pt-4 pb-4">
					<h2>Firstly, let’s get to know your dealership!</h2>
				</vs-col>
			</vs-row>
			<vs-row class="pb-5">
				<vs-col vs-w="4">
					<label>Dealership name:</label>
				</vs-col>
				<vs-col vs-w="8">
					<vs-input class="inputx" disabled size="small" placeholder="RedOne Motors, LLC" style="width: 100%;" />
				</vs-col>
			</vs-row>
			<vs-row class="mb-2">
				<vs-col vs-w="4">
					<label>Dealership zipcode:</label>
				</vs-col>
				<vs-col vs-w="8" class="pb-3">
					<vs-input class="inputx" disabled size="small" placeholder="98712" style="width: 100%;" />
				</vs-col>
				<vs-col vs-w="12">
					<hr>
				</vs-col>
			</vs-row>
			<vs-row class="mb-5">
				<vs-col vs-w="4">
					<label>Type of cars:</label>
				</vs-col>
				<vs-col vs-w="8" class="pb-3">
					<vs-row class="pb-3">
						<vs-col vs-w="2" class="p-0">
							<vs-checkbox color="success">Trucks</vs-checkbox>
						</vs-col>
						<vs-col vs-w="2" class="p-0">
							<vs-checkbox color="success">Pickups</vs-checkbox>
						</vs-col>
						<vs-col vs-w="2" class="p-0">
							<vs-checkbox color="success">SUVs</vs-checkbox>
						</vs-col>
						<vs-col vs-w="2" class="p-0">
							<vs-checkbox color="success">Sedan</vs-checkbox>
						</vs-col>
						<vs-col vs-w="2" class="p-0">
							<vs-checkbox color="success">Motorcycles</vs-checkbox>
						</vs-col>
						<vs-col vs-w="2" class="p-0">
							<vs-checkbox color="success">Cargo</vs-checkbox>
						</vs-col>
					</vs-row>
					<vs-row>
						<vs-col vs-w="2" class="p-0">
							<vs-checkbox color="success">Trailers</vs-checkbox>
						</vs-col>
						<vs-col vs-w="2" class="p-0">
							<vs-checkbox color="success">Commercial</vs-checkbox>
						</vs-col>
						<vs-col vs-w="2" class="p-0">
							<vs-checkbox color="success">Utility</vs-checkbox>
						</vs-col>
						<vs-col vs-w="2" class="p-0">
							<vs-checkbox color="success">Boats</vs-checkbox>
						</vs-col>
						<vs-col vs-w="2" class="p-0">
						</vs-col>
						<vs-col vs-w="2" class="p-0">
						</vs-col>
					</vs-row>
				</vs-col>
				<vs-col vs-w="12">
					<hr>
				</vs-col>
			</vs-row>
			<vs-row class="mb-5">
				<vs-col vs-w="4">
					<label>Brands:</label>
				</vs-col>
				<vs-col vs-w="8" class="pb-3">
					<vs-row class="pb-3">
						<vs-col vs-w="2" class="p-0">
							<vs-checkbox color="success">Chevrolet</vs-checkbox>
						</vs-col>
						<vs-col vs-w="2" class="p-0">
							<vs-checkbox color="success">Ford</vs-checkbox>
						</vs-col>
						<vs-col vs-w="2" class="p-0">
							<vs-checkbox color="success">GMC</vs-checkbox>
						</vs-col>
						<vs-col vs-w="2" class="p-0">
							<vs-checkbox color="success">Volkswagen</vs-checkbox>
						</vs-col>
						<vs-col vs-w="2" class="p-0">
							<vs-checkbox color="success">Audi</vs-checkbox>
						</vs-col>
						<vs-col vs-w="2" class="p-0">
							<vs-checkbox color="success">Mercedes</vs-checkbox>
						</vs-col>
					</vs-row>
					<vs-row>
						<vs-col vs-w="2" class="p-0">
							<vs-checkbox color="success">Nissan</vs-checkbox>
						</vs-col>
						<vs-col vs-w="2" class="p-0">
							<vs-checkbox color="success">KIA</vs-checkbox>
						</vs-col>
						<vs-col vs-w="2" class="p-0">
							<vs-checkbox color="success">Volvo</vs-checkbox>
						</vs-col>
						<vs-col vs-w="2" class="p-0">
							<vs-checkbox color="success">Jeep</vs-checkbox>
						</vs-col>
						<vs-col vs-w="2" class="p-0">
						</vs-col>
						<vs-col vs-w="2" class="p-0">
						</vs-col>
					</vs-row>
				</vs-col>
				<vs-col vs-w="12">
					<hr>
				</vs-col>
			</vs-row>
			<vs-row class="mb-5">
				<vs-col vs-w="4">
					<label>Financing Services:</label>
				</vs-col>
				<vs-col vs-w="8" class="pb-3">
					<vs-row>
						<vs-col vs-w="4" class="p-0">
							<vs-checkbox color="success">Trade-in</vs-checkbox>
						</vs-col>
						<vs-col vs-w="4" class="p-0">
							<vs-checkbox color="success">Warranty</vs-checkbox>
						</vs-col>
						<vs-col vs-w="4" class="p-0">
							<vs-checkbox color="success">Buy here pay here</vs-checkbox>
						</vs-col>
					</vs-row>
				</vs-col>
			</vs-row>
			<vs-row class="mb-5">
				<vs-col vs-w="4">
					<label>Price Range:</label>
				</vs-col>
				<vs-col vs-w="8" class="pb-3">
					<vs-select size="small" style="width:100%" placeholder="Under $5k">
						<vs-select-item :key="index" :value="item.value" :text="item.text" v-for="item,index in options1" />
					</vs-select>
				</vs-col>
				<vs-col vs-w="12">
					<hr>
				</vs-col>
			</vs-row>
			
			<vs-row class="mb-5">
				<vs-col vs-w="12" class="text-center pb-5">
					<h2>Secondly, let’s configure your campaign!</h2>
				</vs-col>
				<vs-col vs-w="4">
					<label>Your weekly budget (in USD):</label>
				</vs-col>
				<vs-col vs-w="8" class="pb-3">
					<vs-input class="inputx" size="small" />
				</vs-col>
				<vs-col vs-w="12">
					<hr>
				</vs-col>
			</vs-row>
			
			<vs-row class="mb-5">
				<vs-col vs-w="4">
					<label>Ad platforms:</label>
				</vs-col>
				<vs-col vs-w="3" class="pb-3">
					<vs-checkbox color="success"><img src="/images/facebook.svg" /> <h6>Facebook</h6></vs-checkbox>
				</vs-col>
				<vs-col vs-w="5" class="pb-3">
					<vs-checkbox color="success"><img src="/images/google.svg" /> <h6>Gooogle</h6></vs-checkbox>
				</vs-col>
			</vs-row>
			<vs-row class="mb-5">
				<vs-col vs-w="4">
					<label>Editor Access:</label>
				</vs-col>
				<vs-col vs-w="8" class="pb-3">
					<img src="/images/warning.svg" />
					<span style="color: #c54242; vertical-align: super;font-size: 10px;"> Looks like we don’t have access to your facebook page! </span>
					<img src="/images/fb_login_js_sdk.jpg" style="width: 10%;vertical-align: top;" />
				</vs-col>
			</vs-row>
			<vs-row class="mb-5">
				<vs-col vs-w="4">
					<label>Budget Split:</label>
				</vs-col>
				<vs-col vs-w="8" class="pb-3">
					<vs-row>
						<vs-col vs-w="1">
							<img src="/images/facebook.svg" style="vertical-align: -webkit-baseline-middle;" /> 
						</vs-col>
						<vs-col vs-w="10">
							<vs-slider />
						</vs-col>
						<vs-col vs-w="1">
							<img src="/images/google.svg" style="vertical-align: -webkit-baseline-middle;" />
						</vs-col>
					</vs-row>
				</vs-col>
			</vs-row>
			<vs-row class="mb-5">
				<vs-col vs-w="4">
					<label>Target Radius:</label>
				</vs-col>
				<vs-col vs-w="8" class="pb-3">
					<vs-input size="small" />
					<vs-radio vs-value="primary">Kilometers</vs-radio>
					<vs-radio vs-value="primary">Miles</vs-radio>
				</vs-col>
			</vs-row>
			<vs-row class="mb-5">
				<vs-col vs-w="4">
					<label>Type of campaigns:</label>
				</vs-col>
				<vs-col vs-w="8" class="pb-2">
					<vs-row class="pb-3">
						<vs-col vs-w="4">
							<vs-checkbox color="success">Display</vs-checkbox>
						</vs-col>
						<vs-col vs-w="4">
							<vs-checkbox color="success">Retargeting</vs-checkbox>
						</vs-col>
						<vs-col vs-w="4">
							<vs-checkbox color="success">Dynamic Retargeting</vs-checkbox>
						</vs-col>
					</vs-row>
					<vs-row>
						<vs-col vs-w="4">
							<vs-checkbox color="success">Display</vs-checkbox>
						</vs-col>
						<vs-col vs-w="4">
							<vs-checkbox color="success">Retargeting</vs-checkbox>
						</vs-col>
						<vs-col vs-w="4">
							<vs-checkbox color="success">Dynamic Retargeting</vs-checkbox>
						</vs-col>
					</vs-row>
				</vs-col>
			</vs-row>
			<vs-row class="mb-5">
				<vs-col vs-w="4">
					<label>Ad placements:</label>
				</vs-col>
				<vs-col vs-w="8" class="pb-3">
					<vs-row class="pb-3">
						<vs-col vs-w="4">
							<vs-checkbox color="success">Gmail</vs-checkbox>
						</vs-col>
						<vs-col vs-w="4">
							<vs-checkbox color="success">YouTube</vs-checkbox>
						</vs-col>
						<vs-col vs-w="4">
							<vs-checkbox color="success">Facebook</vs-checkbox>
						</vs-col>
					</vs-row>
					<vs-row>
						<vs-col vs-w="4">
							<vs-checkbox color="success">Messenger</vs-checkbox>
						</vs-col>
						<vs-col vs-w="4">
							<vs-checkbox color="success">Instagram</vs-checkbox>
						</vs-col>
						<vs-col vs-w="4">
							<vs-checkbox color="success">Marketplace</vs-checkbox>
						</vs-col>
					</vs-row>
				</vs-col>
				<vs-col vs-w="12">
					<hr>
				</vs-col>
			</vs-row>
			<vs-row class="mb-5">
				<vs-col vs-w="4">
					<label>Short Tagline:</label>
				</vs-col>
				<vs-col vs-w="8" class="pb-3">
					<vs-input size="small" class="inputx" placeholder="The best car dealership in The United States of America." />
				</vs-col>
			</vs-row>
			<vs-row class="mb-5">
				<vs-col vs-w="4">
					<label>Long Tagline:</label>
				</vs-col>
				<vs-col vs-w="8" class="pb-3">
					<vs-textarea class="inputx" counter="200" color="success" label="Describe your dealership in a few words." />
				</vs-col>
			</vs-row>
			<vs-row class="mb-5">
				<vs-col vs-w="4">
					<label>Description:</label>
				</vs-col>
				<vs-col vs-w="8" class="pb-3">
					<vs-textarea class="inputx" counter="200" color="success" label="Describe your dealership in a few words." />
				</vs-col>
			</vs-row>
			<vs-row class="mb-5">
				<vs-col vs-w="4">
					<label>Headline:</label>
				</vs-col>
				<vs-col vs-w="8" class="pb-3">
					<vs-input size="small" class="inputx" placeholder="The best car dealership in The United States of America." />
				</vs-col>
				<vs-col vs-w="12">
					<hr>
				</vs-col>
			</vs-row>
			<vs-row class="mb-5">
				<vs-col vs-w="12" class="text-center pb-5">
					<h2>Finally, let’s design your creative!</h2>
				</vs-col>
				<vs-col vs-w="4">
					<label>Color Scheme:</label>
				</vs-col>
				<vs-col vs-w="8" class="pb-3">
					<vs-select size="small" style="width:100%">
						<vs-select-item :key="index" :value="item.value" :text="item.text" v-for="item,index in options1" />
					</vs-select>
				</vs-col>
			</vs-row>
			<vs-row class="mb-5">
				<vs-col vs-w="4">
					<label>Ad Template:</label>
				</vs-col>
				<vs-col vs-w="8" class="pb-3">
					<vs-select size="small" style="width:100%">
						<vs-select-item :key="index" :value="item.value" :text="item.text" v-for="item,index in options1" />
					</vs-select>
				</vs-col>
			</vs-row>
			<vs-row class="mb-5">
				<vs-col vs-w="4">
					<label>Vehicule in Ad:</label>
				</vs-col>
				<vs-col vs-w="8" class="pb-3">
					<vs-input size="small" class="inputx" placeholder="Red Tesla Model 3" />
				</vs-col>
			</vs-row>
			<vs-row class="mb-5">
				<vs-col vs-w="4">
					<label>Your Logo:</label>
				</vs-col>
				<vs-col vs-w="8">
					<vs-row class="mb-5">
						<vs-col vs-w="4">
							<img src="/images/redone.png" style="width: 100%;" />
						</vs-col>
						<vs-col vs-w="4">
							<vs-button color="#74c166" size="small"><vs-icon>cloud</vs-icon> <span>Replace this logo </span></vs-button>
						</vs-col>
						<vs-col vs-w="4">
						</vs-col>
					</vs-row>
				</vs-col>
			</vs-row>
			<vs-row class="mb-5">
				<vs-col vs-w="4">
					<label>Call to Action:</label>
				</vs-col>
				<vs-col vs-w="8" class="pb-3">
					<vs-input size="small" class="inputx" placeholder="When Others Say No, We Say YES!" />
				</vs-col>
			</vs-row>
			<vs-row class="mb-5">
				<vs-col vs-w="4">
					<label>Landing page:</label>
				</vs-col>
				<vs-col vs-w="8" class="pb-3">
					<vs-input size="small" class="inputx" placeholder="https://www.redonemotors.com/" />
				</vs-col>
			</vs-row>
			<vs-row class="mb-5">
				<vs-col vs-w="4">
					<label>Notes:</label>
				</vs-col>
				<vs-col vs-w="8" class="pb-3">
					<vs-textarea class="inputx" label="Enter any specifics you want us to pay attention to…" />
				</vs-col>
			</vs-row>
			<vs-row class="mb-5">
				<vs-col vs-w="12">
					<vs-button color="#74c166" class="inputx">Submit</vs-button>
				</vs-col>
			</vs-row>
		</vx-card>
	</div>
</template>

<script>
	export default {
		data() {
			return {
				options1:[
					{text:'IT',value:0},
					{text:'Blade Runner',value:2},
					{text:'Thor Ragnarok',value:3},
				],
			}
		}
	}
</script>

<style lang="scss">
	.content-md {
		padding: 2em 14em;
	}
	.vs-con-input-label {
		display: inline-block;
	}
	.cancel-btn {
		color: #000;
		font-weight: 500;
	}
	.inputx {
		width: 100%;
	}
	.vs-checkbox {
		width: 15px;
		height: 15px;
	}
	.con-slot-label {
		font-size: 9px;
	}
	label {
		font-size: 12px;
		font-weight: 400;
		color: #000;
	}
	
	.vx-card .vx-card__collapsible-content {
		img {
			display: inline-block;
			width: 20px;
		}
		h6 {
			display: inline-block;
			vertical-align: super;
		}
	}
	hr {
		display: block;
		height: 1px;
		border: 0; 
		border-top: 1px solid #ccc;
		margin: 1em 0;
		padding: 0; 
	}
	
	.vs-textarea--count {
		background: #74c166;
	}
	
	
</style>