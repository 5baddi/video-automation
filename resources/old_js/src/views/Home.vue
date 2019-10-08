<template>
	<div>
		<h5 class="pb-4">Sign up Form | </h5>
		
		<vx-card class="content-md">
			<vs-row>
				<vs-col vs-w="4">
					<label>Dealership ID:</label>
				</vs-col>
				<vs-col vs-w="4" class="text-right">
					<vs-input class="inputx" v-model="dealer_id" size="small" color="success" />
				</vs-col>
				<vs-col vs-w="4" class="text-right">
					<vs-button color="#74c166" size="small" v-on:click="searchDealer()">Search</vs-button>
					<vs-button class="cancel-btn" color="#ececec" size="small">Cancel</vs-button>
				</vs-col>
			</vs-row>
			<div v-show="showfirststep">
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
					<vs-input class="inputx" disabled size="small" v-model="dealer_name" placeholder="RedOne Motors, LLC" style="width: 100%;" color="success" />
				</vs-col>
			</vs-row>
			<vs-row class="mb-2">
				<vs-col vs-w="4">
					<label>Dealership zipcode:</label>
				</vs-col>
				<vs-col vs-w="8" class="pb-3">
					<vs-input class="inputx" v-model="dealer_zipcode" disabled size="small" placeholder="98712" style="width: 100%;" color="success" />
				</vs-col>
				<vs-col vs-w="12">
					<hr>
				</vs-col>
			</vs-row>
			<vs-row class="mb-5">
				<vs-col vs-w="4">
					<label>Bodies type:</label>
				</vs-col>
				<vs-col vs-w="8" class="pb-3">
					<vs-row>
						<vs-col vs-w="2" class="p-0" v-for="(option,index) in bodies" :key="index">
							<vs-checkbox size="small" v-model="option.checked" :label="option.value" color="success">{{option.value}}</vs-checkbox>
						</vs-col>
					</vs-row>
				</vs-col>
				<vs-col vs-w="12">
					<hr>
				</vs-col>
			</vs-row>
			<vs-row class="mb-5">
				<vs-col vs-w="4">
					<label>Makes:</label>
				</vs-col>
				<vs-col vs-w="8" class="pb-3">
					<vs-row class="pb-3">
						<vs-col vs-w="2" class="p-0" v-for="(option,index) in makes" :key="index">
							<vs-checkbox size="small" v-model="option.checked" :label="option.value" color="success">{{option.value}}</vs-checkbox>
						</vs-col>
				
					</vs-row>
					
				</vs-col>
				<vs-col vs-w="12">
					<hr>
				</vs-col>
			</vs-row>
			<vs-row class="mb-5">
				<vs-col vs-w="4">
					<label>Price Range:</label>
				</vs-col>
				<vs-col vs-w="8" class="pb-3">
					<vs-select size="small" v-model="price_range" style="width:100%"  color="success">
						<vs-select-item :key="index" :value="item.value" :text="item.text" v-for="item,index in priceranges" />
					</vs-select>
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
						<vs-col vs-w="3" class="p-0">
							<vs-checkbox size="small" v-model="trade_in" color="success">Trade-in</vs-checkbox>
						</vs-col>
						<vs-col vs-w="3" class="p-0">
							<vs-checkbox size="small" v-model="warranty" color="success">Warranty</vs-checkbox>
						</vs-col>
						<vs-col vs-w="6" class="p-0">
							<vs-checkbox size="small" v-model="buy_here" color="success">Buy here pay here</vs-checkbox>
						</vs-col>
					</vs-row>
				</vs-col>
				<vs-col vs-w="12">
					<hr>
				</vs-col>
			</vs-row>
			</div>
			
			<vs-row class="mb-5" v-if="warranty || trade_in || buy_here">
				<vs-col vs-w="12" class="text-center pb-5">
					<h2>Secondly, let’s configure your campaign!</h2>
				</vs-col>
				<vs-col vs-w="4">
					<label>Your weekly budget (in USD):</label>
				</vs-col>
				<vs-col vs-w="8" class="pb-3">
					<vs-select size="small" v-model="weekly_budget" style="width:100%" color="success">
						<vs-select-item :key="index" :value="item.value" :text="item.text" v-for="item,index in weeklybudget" />
					</vs-select>
				</vs-col>
				<vs-col vs-w="4" v-if="weekly_budget == 500">
					<label>Specify Your weekly budget (in USD) must be more than 150$:</label>
				</vs-col>
				<vs-col vs-w="8" class="pb-3" v-if="weekly_budget == 500">
					<vs-input class="inputx" type="number" min="150" v-model="custom_weekly_budget"   placeholder="weekly budget (in USD) must be more than 150$" style="width: 100%;" color="success" />
				</vs-col>
				<vs-col vs-w="12">
					<hr>
				</vs-col>
			</vs-row>
			<div v-if="weekly_budget != '' && (warranty || trade_in || buy_here)">
			<vs-row class="mb-5" v-if="weekly_budget > 50">
				<vs-col vs-w="4">
					<label>Ad platforms:</label>
				</vs-col>
				<vs-col vs-w="3" class="pb-3">
					<vs-checkbox size="small"  v-model="plateform_facebook" color="success"><img src="/images/facebook.svg" /> <h6>Facebook</h6></vs-checkbox>
				</vs-col>
				<vs-col vs-w="5" class="pb-3">
					<vs-checkbox size="small"  v-model="plateform_google" color="success"><img src="/images/google.svg" /> <h6>Gooogle</h6></vs-checkbox>
				</vs-col>
			</vs-row>
			<vs-row class="mb-5"   v-if="weekly_budget == 50 || weekly_budget < 50">
				<vs-col vs-w="4">
					<label>Ad platforms:</label>
				</vs-col>
				<vs-col vs-w="3" class="pb-3">
					<vs-radio @change="seevalue()" vs-value="facebook" v-model="plateform"  color="success"><h6>Facebook</h6></vs-radio>
					
				</vs-col>
				<vs-col vs-w="5" class="pb-3">
					<vs-radio @change="seevalue()" vs-value="google" v-model="plateform"  color="success"><h6>Gooogle</h6></vs-radio>
				</vs-col>
			</vs-row>
			<vs-row class="mb-5" v-if="plateform_facebook || plateform =='facebook'">
				<vs-col vs-w="4">
					<label>Editor Access:</label>
				</vs-col>
				<vs-col vs-w="8" class="pb-3">
					<img src="/images/warning.svg" />
					<span style="color: #c54242; vertical-align: super;font-size: 10px;"> Looks like we don’t have access to your facebook page! </span>
					<img src="/images/fb_login_js_sdk.jpg" style="width: 10%;vertical-align: top;" />
				</vs-col>
			</vs-row>
			<vs-row class="mb-5 border-bottom" v-if="plateform_facebook && plateform_google">
				<vs-col vs-w="4">
					<label>Budget Split:</label>
				</vs-col>
				<vs-col vs-w="8" class="pb-3">
					<vs-row>
						<vs-col vs-w="1">
							<img src="/images/facebook.svg" style="vertical-align: -webkit-baseline-middle;" /> 
						</vs-col>
						<vs-col vs-w="10">
							<vs-row>
								<vs-col vs-w="1" style="padding: 8px 0 0 0;">
									<span style="font-size: 12px;">{{ valueSlider }} %</span>
								</vs-col>
								<vs-col vs-w="10">
									<vs-slider v-model="valueSlider" />
								</vs-col>
								<vs-col vs-w="1" style="padding: 8px 0 0 0;">
									<span style="font-size: 12px;">{{ 100 - valueSlider }} %</span>
								</vs-col>
							</vs-row>

						</vs-col>
						<vs-col vs-w="1">
							<img src="/images/google.svg" style="vertical-align: -webkit-baseline-middle;" />
						</vs-col>
					</vs-row>
				</vs-col>
			</vs-row>
			<vs-row class="mb-5 border-bottom">
				<vs-col vs-w="4">
					<label>Target Radius:</label>
				</vs-col>
				<vs-col vs-w="8" class="pb-3">
					<vs-row>
						<vs-col vs-w="6">
							<vs-input size="small" v-model="target_radius"  color="success" />
						</vs-col>
						<vs-col vs-w="3">
							<vs-radio vs-value="primary" v-model="radius_km" color="success">Kilometers</vs-radio>
						</vs-col>
						<vs-col vs-w="3" class="text-center">
							<vs-radio vs-value="primary" v-model="radius_mile" color="success">Miles</vs-radio>
						</vs-col>
					</vs-row>
				</vs-col>
			</vs-row>
			<vs-row class="mb-5 border-bottom" v-if="plateform_facebook || plateform_google || plateform =='facebook' || plateform =='google'" >
				<vs-col vs-w="4">
					<label>Type of campaigns:</label>
				</vs-col>
				<vs-col vs-w="8" class="pb-2">
					<vs-row class="pb-3" v-if="plateform_facebook || plateform == 'facebook'" >
						<vs-col vs-w="1">
							<img src="/images/facebook.svg" /> 
						</vs-col>
						<vs-col vs-w="3" v-if="weekly_budget > 125">
							<vs-checkbox size="small" v-model="fb_display" color="success">Display</vs-checkbox>
						</vs-col>
						<vs-col vs-w="4" v-if="weekly_budget > 125">
							<vs-checkbox size="small" v-model="fb_retargeting" color="success">Retargeting</vs-checkbox>
						</vs-col>
						<vs-col vs-w="3" v-if="weekly_budget <= 125">
							<vs-radio size="small" v-model="facebook_campaign" vs-value="display" color="success">Display</vs-radio>
						</vs-col>
						<vs-col vs-w="4" v-if="weekly_budget <= 125">
							<vs-radio size="small" v-model="facebook_campaign" vs-value="retargeting" color="success">Retargeting</vs-radio>
						</vs-col>
						<vs-col vs-w="4" v-if="weekly_budget == 500">
							<vs-checkbox size="small" v-model="fb_dynamic_retargeting" color="success">Dynamic Retargeting</vs-checkbox>
						</vs-col>
					</vs-row>
					<vs-row v-if="plateform_google || plateform == 'google'">
						<vs-col vs-w="1">
							<img src="/images/google.svg" /> 
						</vs-col>
						<vs-col vs-w="3">
							<vs-checkbox size="small" v-model="g_display" color="success">Display</vs-checkbox>
						</vs-col>
						<vs-col vs-w="4">
							<vs-checkbox size="small" v-model="g_retargeting" color="success">Retargeting</vs-checkbox>
						</vs-col>
						<vs-col vs-w="4" v-if="weekly_budget == 500">
							<vs-checkbox size="small"  v-model="g_dynamic_retargeting" color="success">Dynamic Retargeting</vs-checkbox>
						</vs-col>
					</vs-row>
				</vs-col>
			</vs-row>
			<vs-row class="mb-5" v-if="plateform_facebook || plateform_google">
				<vs-col vs-w="4">
					<label>Ad placements:</label>
				</vs-col>
				<vs-col vs-w="8" class="pb-3">
					<vs-row class="pb-3" v-if="plateform_google">
						<vs-col vs-w="4">
							<vs-checkbox size="small" v-model="ad_gmail" color="success">Gmail</vs-checkbox>
						</vs-col>
						<vs-col vs-w="4">
							<vs-checkbox size="small" v-model="ad_youtube" color="success">YouTube</vs-checkbox>
						</vs-col>
					</vs-row>
					<vs-row v-if="plateform_facebook">
						<vs-col vs-w="4">
							<vs-checkbox size="small" v-model="ad_messenger" color="success">Messenger</vs-checkbox>
						</vs-col>
						<vs-col vs-w="4">
							<vs-checkbox size="small" v-model="ad_instagram" color="success">Instagram</vs-checkbox>
						</vs-col>
						<vs-col vs-w="4">
							<vs-checkbox size="small" v-model="ad_marketplace" color="success">Marketplace</vs-checkbox>
						</vs-col>
						<vs-col vs-w="4">
							<vs-checkbox size="small" v-model="ad_facebook" color="success">Facebook</vs-checkbox>
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
					<vs-input size="small" v-model="short_tagline" class="inputx" placeholder="The best car dealership in The United States of America." color="success" />
				</vs-col>
			</vs-row>
			<vs-row class="mb-5">
				<vs-col vs-w="4">
					<label>Long Tagline:</label>
				</vs-col>
				<vs-col vs-w="8" class="pb-3">
					<vs-textarea class="inputx" v-model="long_tagline" counter="200" color="success" label="Describe your dealership in a few words." />
				</vs-col>
			</vs-row>
			<vs-row class="mb-5">
				<vs-col vs-w="4">
					<label>Description:</label>
				</vs-col>
				<vs-col vs-w="8" class="pb-3">
					<vs-textarea class="inputx"  v-model="description" counter="200" color="success" label="Describe your dealership in a few words." />
				</vs-col>
			</vs-row>
			<vs-row class="mb-5">
				<vs-col vs-w="4">
					<label>Headline:</label>
				</vs-col>
				<vs-col vs-w="8" class="pb-3">
					<vs-input size="small" class="inputx" v-model="headline" placeholder="The best car dealership in The United States of America." color="success" />
				</vs-col>
				<vs-col vs-w="12">
					<hr>
				</vs-col>
			</vs-row>
		</div>
		<div v-show="Isfinalstep()">
			<vs-row class="mb-5">
				<vs-col vs-w="12" class="text-center pb-5">
					<h2>Finally, let’s design your creative!</h2>
				</vs-col>
				<vs-col vs-w="4">
					<label>Color Scheme:</label>
				</vs-col>
				<vs-col vs-w="8" class="pb-3">
					<vs-select size="small" v-model="color_sheme" style="width:100%" color="success">
						<vs-select-item :key="index" :value="item.value" :text="item.text" v-for="item,index in colors" />
					</vs-select>
				</vs-col>
			</vs-row>
			<vs-row class="mb-5">
				<vs-col vs-w="4">
					<label>Ad Template:</label>
				</vs-col>
				<vs-col vs-w="8" class="pb-3">
					<vs-select size="small" v-model="ad_template" style="width:100%" color="success">
						<vs-select-item :key="index" :value="item.value" :text="item.text" v-for="item,index in ad_templates" />
					</vs-select>
				</vs-col>
			</vs-row>
			<vs-row class="mb-5">
				<vs-col vs-w="4">
					<label>Vehicule in Ad:</label>
				</vs-col>
				<vs-col vs-w="8" class="pb-3">
					<vs-input size="small" v-model="vehicle_ad" class="inputx" placeholder="Red Tesla Model 3" color="success" />
				</vs-col>
			</vs-row>
			<vs-row class="mb-5">
				<vs-col vs-w="4">
					<label>Your Logo:</label>
				</vs-col>
				<vs-col vs-w="8">
					<vs-row class="mb-5">
						<vs-col vs-w="4">
							<img  :src="logo" style="width: 100%;"/>
						</vs-col>
						<vs-col vs-w="4">
							<input type="file"  style="display:none"  id="fileInput"  @change="onFileChange"/>
							<vs-button color="#74c166" onclick="document.getElementById('fileInput').click()" size="small" ><vs-icon>cloud</vs-icon> <span>Replace this logo </span></vs-button>
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
					<vs-input size="small" class="inputx" v-model="call_action" placeholder="When Others Say No, We Say YES!" color="success" />
				</vs-col>
			</vs-row>
			<vs-row class="mb-5">
				<vs-col vs-w="4">
					<label>Landing page:</label>
				</vs-col>
				<vs-col vs-w="8" class="pb-3">
					<vs-input size="small" class="inputx" v-model="landing_page" placeholder="https://www.redonemotors.com/" color="success" />
				</vs-col>
				<vs-col vs-w="12">
					<hr>
				</vs-col>
			</vs-row>
			<vs-row class="mb-5">
				<vs-col vs-w="4">
					<label>Notes:</label>
				</vs-col>
				<vs-col vs-w="8" class="pb-3">
					<vs-textarea class="inputx" v-model="notes" label="Enter any specifics you want us to pay attention to…" color="success" />
				</vs-col>
			</vs-row>
			<vs-row class="mb-5" v-if="landing_page != '' && vehicle_ad != '' && call_action != ''">
				<vs-col vs-w="12">
					<vs-button color="#74c166" class="inputx" @click="submitForm">Submit</vs-button>
				</vs-col>
			</vs-row>
		</div>
		</vx-card>
	</div>
</template>

<script>
	import axios from 'axios'
	export default {
		data() {
			return {
				weeklybudget:[
					{text:'$50    - Basic',value:50},
					{text:'$100   - Standard',value:100},
					{text:'$125   - Plus',value:125},
					{text:'$150   - Premium',value:150},
					{text:'Custom - Ultimate',value:500},

				],
				priceranges:[
					{text:'Under $5k',value:5},
					{text:'Under $10k',value:10},
					{text:'Under $15k',value:15},
					{text:'Under $20k',value:20},
					{text:'Under $30k',value:30},
				],
				colors:[
					{text:'Green',value:"green"},
					{text:'Red',value:"red"},
					{text:'Yellow',value:"yellow"},
					{text:'Pink',value:"pink"},
					{text:'Orange',value:"orange"},
					{text:'Violet',value:"violet"},
					{text:'Blue',value:"blue"},
					{text:'Brown',value:"brown"},
					{text:'Gray',value:"gray"},
					{text:'Black',value:"black"},
					
				],
				ad_templates:[
					{text:'AD 01',value:"ad01"},
					{text:'AD 02',value:"ad02"},
					{text:'AD 03',value:"ad03"},
					{text:'AD 04',value:"ad04"},
					{text:'AD 05',value:"ad05"},
					{text:'AD 06',value:"ad06"},
					{text:'AD 07',value:"ad07"},
					{text:'AD 08',value:"ad08"},
					{text:'AD 09',value:"ad09"},
					{text:'AD 10',value:"ad10"},
					{text:'AD 11',value:"ad11"},
					{text:'AD 12',value:"ad12"},
					{text:'AD 13',value:"ad13"},
					{text:'AD 14',value:"ad14"},
					{text:'AD 15',value:"ad15"},
					{text:'AD 16',value:"ad16"},
					{text:'AD 17',value:"ad17"},
					{text:'AD 18',value:"ad18"},
					{text:'AD 19',value:"ad19"},
					{text:'AD 20',value:"ad20"},
					{text:'AD 21',value:"ad21"},
					{text:'AD 22',value:"ad22"},
					{text:'AD 23',value:"ad23"},
					{text:'AD 24',value:"ad24"},
					{text:'AD 25',value:"ad25"},
				],
				logo:"https://cdn-w.v12soft.com/photos/LTX4ZDy/logo_lckWepiG.png",
				makes:{},
				bodies: {},
				dealer_id: "",
				valueSlider: 50,
				dealer_name: "",
				dealer_zipcode: "",
				logoupload: "",
				plateform_facebook:false,
				plateform_google:false,
				plateform:'',
				target_radius:"",
				radius_mile:false,
				radius_km:false,
				custom_weekly_budget:150,
				trade_in:false,
				warranty:false,
				buy_here:false,
				weekly_budget: 50,
				fb_retargeting:false,
				fb_display:false,
				fb_dynamic_retargeting:false,
				g_display:false,
				g_retargeting:false,
				g_dynamic_retargeting:false,
				facebook_campaign:'display',
				ad_facebook:false,
				ad_marketplace:false,
				ad_instagram:false,
				ad_messenger:false,
				ad_youtube:false,
				ad_gmail:false,

				short_tagline:"",
				long_tagline:"",
				description:"",
				headline:"",
				price_range:5,
				color_sheme:"green",
				ad_template:"ad01",
				notes:"",
				landing_page:"",
				call_action:"",
				vehicle_ad:"",

				showfirststep:false,
				showsecondstep:false,
				showfinalstep:false,
			}
		},
		methods:{
			 onFileChange(e) {
		      const file = e.target.files[0];
		      this.logoupload = e.target.files[0]
		      this.logo = URL.createObjectURL(file);
		    },
			seevalue(){
				if(this.plateform == 'facebook'){
					this.plateform_facebook = true
					this.plateform_google = false
				}else{
					this.plateform_facebook = false
					this.plateform_google = true
				}
			},
			searchDealer(){
					let params = {
						id: this.dealer_id
					}
					
					  axios.post('getDealerByID',{params}).then(response => {
					  	let result = response.data
					  	let data = result['data']
					  	this.dealer_name = data["dealer_name"]
					  	this.dealer_zipcode = data['zipcode']
					  	this.makes = data['makes']
					  	this.bodies = data['bodies']
					  	this.logo = data['logo']
					  	this.showfirststep = true					
				  })

			},
			submitForm(){
				var financing_service = ""

				if(this.trade_in) financing_service += "tradein|"
				if(this.warranty) financing_service += "warranty|"
				if(this.buy_here) financing_service += "buy_here_pay_here"	
				var plateform = ""
				var weekly_budget = (this.weekly_budget == 500) ? this.custom_weekly_budget : this.weekly_budget
				if(this.weekly_budget == '50'){
					plateform = this.plateform
				}else{
					if(this.plateform_facebook && this.plateform_google){
						plateform = "facebook|google"
					}else if(this.plateform_facebook && !this.plateform_google){

						plateform = "facebook"
					}else if(this.plateform_google && !this.plateform_facebook){
						plateform = "google"
					}
				}
				var budget_split_facebook = this.valueSlider
				var budget_split_google = 100 - this.valueSlider
				var budget_split = {facebook: budget_split_facebook, google:budget_split_google}
				var type_facebook = ""
				var type_google = ""
				if(plateform == 'facebook|google'){
							if(this.weekly_budget <= 125){
								type_facebook = this.facebook_campaign
							}else{
								if(this.fb_display) type_facebook += "display|"
								if(this.fb_retargeting) type_facebook += "retargeting|"
								if(this.fb_dynamic_retargeting) type_facebook += "dynamic_retargeting"
							}
							if(this.g_display) type_google += "display|"
							if(this.g_retargeting) type_google += "retargeting|"
							if(this.g_dynamic_retargeting) type_google += "dynamic_retargeting"
					}else if(plateform == 'google'){
							if(this.g_display) type_google += "display|"
							if(this.g_retargeting) type_google += "retargeting|"
							if(this.g_dynamic_retargeting) type_google += "dynamic_retargeting"
					}else{
						if(this.weekly_budget <= 125){
							type_facebook = this.facebook_campaign
						}else{
							if(this.fb_display) type_facebook += "display|"
							if(this.fb_retargeting) type_facebook += "retargeting|"
							if(this.fb_dynamic_retargeting) type_facebook += "dynamic_retargeting"
						}
					}

				var type_campaign = {facebook:type_facebook, google: type_google};

				var ad_placement_google = ""
				var ad_placement_facebook = ""
				if(this.ad_gmail) ad_placement_google += "gmail|"
				if(this.ad_youtube) ad_placement_google += "youtube"
				if(this.ad_messenger) ad_placement_facebook += "messenger|"
				if(this.ad_instagram) ad_placement_facebook += "Instagram|"
				if(this.ad_facebook) ad_placement_facebook += "facebook|"
				if(this.ad_marketplace) ad_placement_facebook += "marketplace|"
				var ad_placement = {facebook: ad_placement_facebook, google : ad_placement_google}
					var data = {
					dealer_id : this.dealer_id,
					dealer_name: this.dealer_name,
					makes : this.makes,
					bodies: this.bodies,
					price_range: this.price_range,
					financing_service: financing_service,
					weekly_budget: weekly_budget,
					ad_plateform: plateform,
					target_radius:this.target_radius,
					plateform:plateform,
					budget_split: budget_split,
					type_campaign: type_campaign,
					ad_placement: ad_placement,
					short_tagline: this.short_tagline,
					long_tagline: this.long_tagline,
					description: this.description,
					headline: this.headline,
					color_sheme : this.color_sheme,
					ad_template: this.ad_template,
					vehicle_ad : this.vehicle_ad,
					call_action: this.call_action,
					landing_page: this.landing_page,
					logoupload: document.getElementById('fileInput').files[0]
				}
				 
 
				 axios.post('saveForm',{data}).then(response => {
					let formData = new FormData();
				    formData.append('image', document.getElementById('fileInput').files[0]);
				    formData.append('id', response.data.id);
				    axios.post('uploadlogo', formData, {
				                headers: {
				                  'Content-Type': 'multipart/form-data'
				                }
				            })
				            .then(response => {
				                 flash(response.data.message, 'success');
				            })
				            .catch(e => {
				                console.log(e);
				            });		
				  })
			},
			Isfinalstep(){

					if(this.plateform_facebook || this.plateform && !this.plateform_google){
						if(this.target_radius != ""  && (this.ad_messenger || this.ad_instagram || this.ad_marketplace || this.ad_facebook) && this.short_tagline != "" && this.long_tagline != "" && this.description != "" && this.headline != ""){
							return true;
						}else{
							return false;
						}

					}
					if(this.plateform_google || this.plateform && !this.plateform_facebook ){
						if(this.target_radius != "" && (this.g_display || this.g_retargeting || this.g_dynamic_retargeting) && (this.ad_gmail || this.ad_youtube) && this.short_tagline != "" && this.long_tagline != "" && this.description != "" && this.headline != ""){
							return true;
						}else{
							return false;
						}

					}
					if(this.plateform_facebook || this.plateform && this.plateform_google ){
						if(this.target_radius != "" && (this.g_display || this.g_retargeting || this.g_dynamic_retargeting) && (this.ad_gmail || this.ad_youtube) && this.short_tagline != "" && this.long_tagline != "" && this.description != "" && this.headline != "" && (this.ad_messenger || this.ad_instagram || this.ad_marketplace || this.ad_facebook)  ){
							return true;
						}else{
							return false;
						}

					}
					
					return false

				
			}
		},
		computed: {
       
	    },
	    created() {
	      	
	    }
	}
</script>

<style lang="scss">
	.vs-slider {
		background: #ea4335;
	}
	.content-md {
		padding: 2em 5em;
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
	/* .vs-checkbox {
		width: 15px;
		height: 15px;
	}
	*/
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
	.border-bottom {
	    border-bottom: 1px solid #ccc;
	}
</style>