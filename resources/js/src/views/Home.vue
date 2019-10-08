<template>
	<div>
		<vs-row>
			<vs-col vs-w="6">
				<h5 class="pb-4">Dashboard | </h5>
			</vs-col>
			<vs-col vs-w="6" class="text-right p-0">
				
				<vs-row>
					<vs-col vs-w="4" class="p-0">
					</vs-col>
					<vs-col vs-w="4" class="p-0">
						<h5 class="pb-4"><span style="font-size: 10px;margin-right: 8px;">From</span> <input type="date" class="time-picker-md" value="2019-09-25" /></h5>
					</vs-col>
					<vs-col vs-w="4" class="text-right p-0">
						<h5 class="pb-4"><span style="font-size: 10px;margin-right: 8px;">To</span> <input type="date" class="time-picker-md" value="2019-09-25" /></h5>
					</vs-col>
				</vs-row>
				
			</vs-col>
		</vs-row>
		<vs-row>
			<vs-col vs-w="3" class="p-0 pr-4">
				<vx-card>
					<vs-row>
						<div class="p-6 pb-0">
							<svg width="46px" height="46px" viewBox="0 0 62 62" version="1.1">
								<desc>Created with Sketch.</desc>
								<g id="New-design" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
									<g id="Dashboard-Home" transform="translate(-352.000000, -217.000000)">
										<g id="New-dealers" transform="translate(320.000000, 192.000000)">
											<g id="Group-8" transform="translate(32.000000, 25.000000)">
												<circle id="Oval" fill="#E6F7EE" cx="31" cy="31" r="31"></circle>
												<g id="users" transform="translate(17.000000, 20.000000)" stroke="#2DCD7A" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
													<path d="M20,22 L20,19.6666667 C20,17.0893378 17.7614237,15 15,15 L5,15 C2.23857625,15 0,17.0893378 0,19.6666667 L0,22" id="Path"></path>
													<circle id="Oval" cx="10" cy="5" r="5"></circle>
													<path d="M28,22 L28,19.6149915 C27.9981871,17.4411966 26.3533317,15.5434483 24,15" id="Path"></path>
													<path d="M19,0 C21.3537328,0.526261689 23,2.3783123 23,4.5 C23,6.6216877 21.3537328,8.47373831 19,9" id="Path"></path>
												</g>
											</g>
										</g>
									</g>
								</g>
							</svg>
							<div>
								<h2 class="mb-1 font-bold">97.5K</h2>
								<span class="title-chart-md">Dealers signed up</span>
							</div>
						</div>
					</vs-row>
					<vs-row style="height: 10em;">
						<apexchart :options="chartOptions" :series="series"></apexchart>
					</vs-row>
				</vx-card>
			</vs-col>
			<vs-col vs-w="3" class="p-0 pr-4">
				<vx-card>
					<vs-row>
						<div class="p-6 pb-0">
							<svg width="46px" height="46px" viewBox="0 0 63 62" version="1.1">
								<desc>Created with Sketch.</desc>
								<g id="New-design" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
									<g id="Dashboard-Home" transform="translate(-754.000000, -217.000000)">
										<g id="Subscribers-Card" transform="translate(722.000000, 192.000000)">
											<g id="Group-9" transform="translate(32.104092, 25.000000)">
												<circle id="Oval" fill="#D5D1FB" cx="31" cy="31" r="31"></circle>
												<g id="users" transform="translate(17.000000, 20.000000)" stroke="#7E72F2" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
													<path d="M20,22 L20,19.6666667 C20,17.0893378 17.7614237,15 15,15 L5,15 C2.23857625,15 0,17.0893378 0,19.6666667 L0,22" id="Path"></path>
													<circle id="Oval" cx="10" cy="5" r="5"></circle>
													<path d="M28,22 L28,19.6149915 C27.9981871,17.4411966 26.3533317,15.5434483 24,15" id="Path"></path>
													<path d="M19,0 C21.3537328,0.526261689 23,2.3783123 23,4.5 C23,6.6216877 21.3537328,8.47373831 19,9" id="Path"></path>
												</g>
											</g>
										</g>
									</g>
								</g>
							</svg>
							<div>
								<h2 class="mb-1 font-bold">9.6k</h2>
								<span class="title-chart-md">Dealers with budgets and no campaigns</span>
							</div>
						</div>
					</vs-row>
					<vs-row style="height: 10em;">
						<apexchart :options="chartOptions1" :series="series"></apexchart>
					</vs-row>
				</vx-card>
			</vs-col>
			<vs-col vs-w="3" class="p-0 pr-2">
				<vx-card>
					<vs-row>
						<div class="p-6 pb-0">
							<svg width="46px" height="46px" viewBox="0 0 62 62" version="1.1">
								<desc>Created with Sketch.</desc>
								<g id="New-design" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
									<g id="Dashboard-Home" transform="translate(-1153.000000, -217.000000)">
										<g id="Dealers-paused" transform="translate(1122.000000, 192.000000)">
											<g id="Group-10" transform="translate(31.000000, 25.000000)">
												<circle id="Oval-Copy" fill="#FFDFC2" cx="31" cy="31" r="31"></circle>
												<g id="users" transform="translate(17.000000, 20.000000)" stroke="#FF9F43" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
													<path d="M20,22 L20,19.6666667 C20,17.0893378 17.7614237,15 15,15 L5,15 C2.23857625,15 0,17.0893378 0,19.6666667 L0,22" id="Path"></path>
													<circle id="Oval" cx="10" cy="5" r="5"></circle>
													<path d="M28,22 L28,19.6149915 C27.9981871,17.4411966 26.3533317,15.5434483 24,15" id="Path"></path>
													<path d="M19,0 C21.3537328,0.526261689 23,2.3783123 23,4.5 C23,6.6216877 21.3537328,8.47373831 19,9" id="Path"></path>
												</g>
											</g>
										</g>
									</g>
								</g>
							</svg>
							<div>
								<h2 class="mb-1 font-bold">4.5K</h2>
								<span class="title-chart-md">Dealers with paused campaigns</span>
							</div>
						</div>
					</vs-row>
					<vs-row style="height: 10em;">
						<apexchart :options="chartOptions2" :series="series"></apexchart>
					</vs-row>
				</vx-card>
			</vs-col>
			<vs-col vs-w="3" class="p-0 pl-2">
				<vx-card>
					<vs-row>
						<div class="p-6 pb-0">
							<svg width="46px" height="46px" viewBox="0 0 63 62" version="1.1">
								<g id="New-design" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
									<g id="Dashboard-Home" transform="translate(-1550.000000, -217.000000)">
										<g id="Sales-Card" transform="translate(1518.000000, 192.000000)">
											<g id="Group-11" transform="translate(32.104092, 25.000000)">
												<circle id="Oval" fill="#FCEAEA" cx="31" cy="31" r="31"></circle>
												<g id="users" transform="translate(16.895908, 20.000000)" stroke="#ED5F5F" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
													<path d="M20,22 L20,19.6666667 C20,17.0893378 17.7614237,15 15,15 L5,15 C2.23857625,15 0,17.0893378 0,19.6666667 L0,22" id="Path"></path>
													<circle id="Oval" cx="10" cy="5" r="5"></circle>
													<path d="M28,22 L28,19.6149915 C27.9981871,17.4411966 26.3533317,15.5434483 24,15" id="Path"></path>
													<path d="M19,0 C21.3537328,0.526261689 23,2.3783123 23,4.5 C23,6.6216877 21.3537328,8.47373831 19,9" id="Path"></path>
												</g>
											</g>
										</g>
									</g>
								</g>
							</svg>
							<div>
								<h2 class="mb-1 font-bold">124</h2>
								<span class="title-chart-md">Dealers lost</span>
							</div>
						</div>
					</vs-row>
					<vs-row style="height: 10em;">
						<apexchart :options="chartOptions3" :series="series" width="100%"></apexchart>
					</vs-row>
				</vx-card>
			</vs-col>
		</vs-row>
		<vs-row class="pt-5">
			<vs-col vs-w="12" class="pl-0 pr-0">
				<vx-card>
					
					<vs-tabs alignment="fixed"> <!-- color="success" -->
						<vs-tab label="Form filled">
							
							<vs-table stripe :data="users" max-items="3" pagination color="success" search>
								<template slot="header">
									<h3>
										<vs-select placeholder="Filter by" class="selectExample"></vs-select>
									</h3>
								</template>
								<template slot="thead">
									<vs-th sort-key="id">ID</vs-th>
									<vs-th>NAME</vs-th>
									<vs-th>BUDGET WEKLY</vs-th>
									<vs-th>BUDGET TYPE</vs-th>
									<vs-th>DATE SUBMITTED</vs-th>
									<vs-th>FILLED BY</vs-th>
									<vs-th>Ad Platform</vs-th>
								</template>
								<template slot-scope="{data}">
									<vs-tr :key="indextr" v-for="(tr, indextr) in data" >
										<vs-td :data="data[indextr].id">
											<center><b>{{data[indextr].id}}</b></center>
										</vs-td>
										<vs-td :data="data[indextr].name">{{data[indextr].name}}</vs-td>
										<vs-td :data="data[indextr].website">{{data[indextr].website}}</vs-td>
										<vs-td :data="data[indextr].id">{{data[indextr].id}}</vs-td>
										<vs-td :data="data[indextr].date">
											{{data[indextr].date}}
											<span class="label-md-late">LATE</span>
										</vs-td>
										<vs-td :data="data[indextr].id">
											<vs-avatar src="/images/avatar-s-11.png" />
											<div class="filled-name"> Tony</div>
										</vs-td>
										<vs-td :data="data[indextr].id">
											<!-- {{data[indextr].id}} -->
											<svg width="26px" height="26px" viewBox="0 0 28 28" version="1.1" style="margin-right: 10px;">
												<!-- Generator: Sketch 57.1 (83088) - https://sketch.com -->
												<title>Icon Shape</title>
												<desc>Created with Sketch.</desc>
												<g id="New-design" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
													<g id="Dashboard-Home" transform="translate(-1596.000000, -736.000000)" fill="#4285F4" fill-rule="nonzero">
														<g id="Group-6" transform="translate(1596.000000, 731.000000)">
															<g id="active" transform="translate(0.000000, 5.000000)">
																<g id="Ad-platforms">
																	<path d="M14,0 C6.26875,0 0,6.26875 0,14 C0,21.73125 6.26875,28 14,28 C21.73125,28 28,21.73125 28,14 C28,6.26875 21.73125,0 14,0 Z M19.21875,19.8 C17.95,20.96875 16.21875,21.65625 14.153125,21.65625 C11.1625,21.65625 8.575,19.940625 7.315625,17.440625 C6.796875,16.40625 6.5,15.2375 6.5,14 C6.5,12.7625 6.796875,11.59375 7.315625,10.559375 C8.575,8.05625 11.1625,6.340625 14.153125,6.340625 C16.215625,6.340625 17.946875,7.1 19.275,8.334375 L17.08125,10.53125 C16.2875,9.771875 15.278125,9.3875 14.15625,9.3875 C12.1625,9.3875 10.475,10.734375 9.871875,12.54375 C9.71875,13.003125 9.63125,13.49375 9.63125,14 C9.63125,14.50625 9.71875,14.996875 9.871875,15.45625 C10.475,17.265625 12.1625,18.6125 14.153125,18.6125 C15.184375,18.6125 16.059375,18.340625 16.74375,17.88125 C17.55625,17.3375 18.09375,16.528125 18.271875,15.56875 L14.153125,15.56875 L14.153125,12.60625 L21.3625,12.60625 C21.453125,13.109375 21.5,13.63125 21.5,14.171875 C21.5,16.50625 20.665625,18.465625 19.21875,19.8 L19.21875,19.8 Z" id="Icon-Shape"></path>
																</g>
															</g>
														</g>
													</g>
												</g>
											</svg>
											
											<svg width="26px" height="26px" viewBox="0 0 29 28" version="1.1" style="margin-right: 10px;">
												<!-- Generator: Sketch 57.1 (83088) - https://sketch.com -->
												<title>Icon Path</title>
												<desc>Created with Sketch.</desc>
												<g id="New-design" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
													<g id="Dashboard-Home" transform="translate(-1643.000000, -736.000000)" fill="#3C5A99" fill-rule="nonzero">
														<g id="Group-6" transform="translate(1596.000000, 731.000000)">
															<g id="active" transform="translate(0.000000, 5.000000)">
																<g id="Ad-platforms">
																	<path d="M75.1702092,14.0862785 C75.1702092,6.30595732 68.8642519,0 61.0851046,0 C53.3059573,0 47,6.30595732 47,14.0862785 C47,21.1153314 52.1508825,26.9423553 58.8841236,27.9988261 L58.8841236,18.1572129 L55.3085566,18.1572129 L55.3085566,14.0851046 L58.8841236,14.0851046 L58.8841236,10.9826018 C58.8841236,7.4516413 60.9876745,5.50186559 64.2040414,5.50186559 C65.7453151,5.50186559 67.3570201,5.77654802 67.3570201,5.77654802 L67.3570201,9.24294638 L65.582149,9.24294638 C63.8331028,9.24294638 63.2872595,10.3287637 63.2872595,11.4427535 L63.2872595,14.0862785 L67.193854,14.0862785 L66.5693623,18.1583868 L63.2872595,18.1583868 L63.2872595,28 C70.0205006,26.9435291 75.1713831,21.1165053 75.1713831,14.0862785 L75.1702092,14.0862785 Z" id="Icon-Path"></path>
																</g>
															</g>
														</g>
													</g>
												</g>
											</svg>
											
										</vs-td>
									</vs-tr>
								</template>
							</vs-table>
							
						</vs-tab>
						<vs-tab label="Banners created">
							
							<vs-table stripe :data="users" max-items="3" pagination color="success" search>
								<template slot="header">
									<h3>
										<vs-select placeholder="Filter by" class="selectExample"></vs-select>
									</h3>
								</template>
								<template slot="thead">
									<vs-th sort-key="id">ID</vs-th>
									<vs-th>NAME</vs-th>
									<vs-th>BUDGET WEKLY</vs-th>
									<vs-th>BUDGET TYPE</vs-th>
									<vs-th>DATE SUBMITTED</vs-th>
									<vs-th>FILLED BY</vs-th>
									<vs-th>Ad Platform</vs-th>
								</template>
								<template slot-scope="{data}">
									<vs-tr :key="indextr" v-for="(tr, indextr) in data" >
										<vs-td :data="data[indextr].id">
											<center><b>{{data[indextr].id}}</b></center>
										</vs-td>
										<vs-td :data="data[indextr].name">{{data[indextr].name}}</vs-td>
										<vs-td :data="data[indextr].website">{{data[indextr].website}}</vs-td>
										<vs-td :data="data[indextr].id">{{data[indextr].id}}</vs-td>
										<vs-td :data="data[indextr].date">
											{{data[indextr].date}}
											<span class="label-md-late">LATE</span>
										</vs-td>
										<vs-td :data="data[indextr].id">
											<vs-avatar src="/images/avatar-s-11.png" />
											<div class="filled-name"> Tony</div>
										</vs-td>
										<vs-td :data="data[indextr].id">
											<!-- {{data[indextr].id}} -->
											<svg width="26px" height="26px" viewBox="0 0 28 28" version="1.1" style="margin-right: 10px;">
												<!-- Generator: Sketch 57.1 (83088) - https://sketch.com -->
												<title>Icon Shape</title>
												<desc>Created with Sketch.</desc>
												<g id="New-design" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
													<g id="Dashboard-Home" transform="translate(-1596.000000, -736.000000)" fill="#4285F4" fill-rule="nonzero">
														<g id="Group-6" transform="translate(1596.000000, 731.000000)">
															<g id="active" transform="translate(0.000000, 5.000000)">
																<g id="Ad-platforms">
																	<path d="M14,0 C6.26875,0 0,6.26875 0,14 C0,21.73125 6.26875,28 14,28 C21.73125,28 28,21.73125 28,14 C28,6.26875 21.73125,0 14,0 Z M19.21875,19.8 C17.95,20.96875 16.21875,21.65625 14.153125,21.65625 C11.1625,21.65625 8.575,19.940625 7.315625,17.440625 C6.796875,16.40625 6.5,15.2375 6.5,14 C6.5,12.7625 6.796875,11.59375 7.315625,10.559375 C8.575,8.05625 11.1625,6.340625 14.153125,6.340625 C16.215625,6.340625 17.946875,7.1 19.275,8.334375 L17.08125,10.53125 C16.2875,9.771875 15.278125,9.3875 14.15625,9.3875 C12.1625,9.3875 10.475,10.734375 9.871875,12.54375 C9.71875,13.003125 9.63125,13.49375 9.63125,14 C9.63125,14.50625 9.71875,14.996875 9.871875,15.45625 C10.475,17.265625 12.1625,18.6125 14.153125,18.6125 C15.184375,18.6125 16.059375,18.340625 16.74375,17.88125 C17.55625,17.3375 18.09375,16.528125 18.271875,15.56875 L14.153125,15.56875 L14.153125,12.60625 L21.3625,12.60625 C21.453125,13.109375 21.5,13.63125 21.5,14.171875 C21.5,16.50625 20.665625,18.465625 19.21875,19.8 L19.21875,19.8 Z" id="Icon-Shape"></path>
																</g>
															</g>
														</g>
													</g>
												</g>
											</svg>
											
											<svg width="26px" height="26px" viewBox="0 0 29 28" version="1.1" style="margin-right: 10px;">
												<!-- Generator: Sketch 57.1 (83088) - https://sketch.com -->
												<title>Icon Path</title>
												<desc>Created with Sketch.</desc>
												<g id="New-design" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
													<g id="Dashboard-Home" transform="translate(-1643.000000, -736.000000)" fill="#3C5A99" fill-rule="nonzero">
														<g id="Group-6" transform="translate(1596.000000, 731.000000)">
															<g id="active" transform="translate(0.000000, 5.000000)">
																<g id="Ad-platforms">
																	<path d="M75.1702092,14.0862785 C75.1702092,6.30595732 68.8642519,0 61.0851046,0 C53.3059573,0 47,6.30595732 47,14.0862785 C47,21.1153314 52.1508825,26.9423553 58.8841236,27.9988261 L58.8841236,18.1572129 L55.3085566,18.1572129 L55.3085566,14.0851046 L58.8841236,14.0851046 L58.8841236,10.9826018 C58.8841236,7.4516413 60.9876745,5.50186559 64.2040414,5.50186559 C65.7453151,5.50186559 67.3570201,5.77654802 67.3570201,5.77654802 L67.3570201,9.24294638 L65.582149,9.24294638 C63.8331028,9.24294638 63.2872595,10.3287637 63.2872595,11.4427535 L63.2872595,14.0862785 L67.193854,14.0862785 L66.5693623,18.1583868 L63.2872595,18.1583868 L63.2872595,28 C70.0205006,26.9435291 75.1713831,21.1165053 75.1713831,14.0862785 L75.1702092,14.0862785 Z" id="Icon-Path"></path>
																</g>
															</g>
														</g>
													</g>
												</g>
											</svg>
											
										</vs-td>
									</vs-tr>
								</template>
							</vs-table>
							
						</vs-tab>
						<vs-tab label="Campaigns launched">
							
							<vs-table stripe :data="users" max-items="3" pagination color="success" search>
								<template slot="header">
									<h3>
										<vs-select placeholder="Filter by" class="selectExample"></vs-select>
									</h3>
								</template>
								<template slot="thead">
									<vs-th>ID</vs-th>
									<vs-th>NAME</vs-th>
									<vs-th>BUDGET WEKLY</vs-th>
									<vs-th>BUDGET TYPE</vs-th>
									<vs-th>DATE SUBMITTED</vs-th>
									<vs-th>FILLED BY</vs-th>
									<vs-th>Ad Platform</vs-th>
								</template>
								<template slot-scope="{data}">
									<vs-tr :key="indextr" v-for="(tr, indextr) in data" >
										<vs-td :data="data[indextr].id">
											<center><b>{{data[indextr].id}}</b></center>
										</vs-td>
										<vs-td :data="data[indextr].name">{{data[indextr].name}}</vs-td>
										<vs-td :data="data[indextr].website">{{data[indextr].website}}</vs-td>
										<vs-td :data="data[indextr].id">{{data[indextr].id}}</vs-td>
										<vs-td :data="data[indextr].date">
											{{data[indextr].date}}
											<span class="label-md-late">LATE</span>
										</vs-td>
										<vs-td :data="data[indextr].id">
											<vs-avatar src="/images/avatar-s-11.png" />
											<div class="filled-name"> Tony</div>
										</vs-td>
										<vs-td :data="data[indextr].id">
											<!-- {{data[indextr].id}} -->
											<svg width="26px" height="26px" viewBox="0 0 28 28" version="1.1" style="margin-right: 10px;">
												<!-- Generator: Sketch 57.1 (83088) - https://sketch.com -->
												<title>Icon Shape</title>
												<desc>Created with Sketch.</desc>
												<g id="New-design" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
													<g id="Dashboard-Home" transform="translate(-1596.000000, -736.000000)" fill="#4285F4" fill-rule="nonzero">
														<g id="Group-6" transform="translate(1596.000000, 731.000000)">
															<g id="active" transform="translate(0.000000, 5.000000)">
																<g id="Ad-platforms">
																	<path d="M14,0 C6.26875,0 0,6.26875 0,14 C0,21.73125 6.26875,28 14,28 C21.73125,28 28,21.73125 28,14 C28,6.26875 21.73125,0 14,0 Z M19.21875,19.8 C17.95,20.96875 16.21875,21.65625 14.153125,21.65625 C11.1625,21.65625 8.575,19.940625 7.315625,17.440625 C6.796875,16.40625 6.5,15.2375 6.5,14 C6.5,12.7625 6.796875,11.59375 7.315625,10.559375 C8.575,8.05625 11.1625,6.340625 14.153125,6.340625 C16.215625,6.340625 17.946875,7.1 19.275,8.334375 L17.08125,10.53125 C16.2875,9.771875 15.278125,9.3875 14.15625,9.3875 C12.1625,9.3875 10.475,10.734375 9.871875,12.54375 C9.71875,13.003125 9.63125,13.49375 9.63125,14 C9.63125,14.50625 9.71875,14.996875 9.871875,15.45625 C10.475,17.265625 12.1625,18.6125 14.153125,18.6125 C15.184375,18.6125 16.059375,18.340625 16.74375,17.88125 C17.55625,17.3375 18.09375,16.528125 18.271875,15.56875 L14.153125,15.56875 L14.153125,12.60625 L21.3625,12.60625 C21.453125,13.109375 21.5,13.63125 21.5,14.171875 C21.5,16.50625 20.665625,18.465625 19.21875,19.8 L19.21875,19.8 Z" id="Icon-Shape"></path>
																</g>
															</g>
														</g>
													</g>
												</g>
											</svg>
											
											<svg width="26px" height="26px" viewBox="0 0 29 28" version="1.1" style="margin-right: 10px;">
												<!-- Generator: Sketch 57.1 (83088) - https://sketch.com -->
												<title>Icon Path</title>
												<desc>Created with Sketch.</desc>
												<g id="New-design" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
													<g id="Dashboard-Home" transform="translate(-1643.000000, -736.000000)" fill="#3C5A99" fill-rule="nonzero">
														<g id="Group-6" transform="translate(1596.000000, 731.000000)">
															<g id="active" transform="translate(0.000000, 5.000000)">
																<g id="Ad-platforms">
																	<path d="M75.1702092,14.0862785 C75.1702092,6.30595732 68.8642519,0 61.0851046,0 C53.3059573,0 47,6.30595732 47,14.0862785 C47,21.1153314 52.1508825,26.9423553 58.8841236,27.9988261 L58.8841236,18.1572129 L55.3085566,18.1572129 L55.3085566,14.0851046 L58.8841236,14.0851046 L58.8841236,10.9826018 C58.8841236,7.4516413 60.9876745,5.50186559 64.2040414,5.50186559 C65.7453151,5.50186559 67.3570201,5.77654802 67.3570201,5.77654802 L67.3570201,9.24294638 L65.582149,9.24294638 C63.8331028,9.24294638 63.2872595,10.3287637 63.2872595,11.4427535 L63.2872595,14.0862785 L67.193854,14.0862785 L66.5693623,18.1583868 L63.2872595,18.1583868 L63.2872595,28 C70.0205006,26.9435291 75.1713831,21.1165053 75.1713831,14.0862785 L75.1702092,14.0862785 Z" id="Icon-Path"></path>
																</g>
															</g>
														</g>
													</g>
												</g>
											</svg>
											
										</vs-td>
									</vs-tr>
								</template>
							</vs-table>
							
						</vs-tab>
						<vs-tab label="All">
							
							<vs-table stripe :data="users" max-items="3" pagination color="success" search> <!--  sort -->
								<template slot="header">
									<h3>
										<vs-select placeholder="Filter by" class="selectExample"></vs-select>
									</h3>
								</template>
								<template slot="thead">
									<vs-th>ID</vs-th> <!--  sort-key="id" -->
									<vs-th>NAME</vs-th>
									<vs-th>BUDGET WEKLY</vs-th>
									<vs-th>BUDGET TYPE</vs-th>
									<vs-th>DATE SUBMITTED</vs-th>
									<vs-th>FILLED BY</vs-th>
									<vs-th>Ad Platform</vs-th>
								</template>
								<template slot-scope="{data}">
									<vs-tr :key="indextr" v-for="(tr, indextr) in data" >
										<vs-td :data="data[indextr].id">
											<center><b>{{data[indextr].id}}</b></center>
										</vs-td>
										<vs-td :data="data[indextr].name">{{data[indextr].name}}</vs-td>
										<vs-td :data="data[indextr].website">{{data[indextr].website}}</vs-td>
										<vs-td :data="data[indextr].id">{{data[indextr].id}}</vs-td>
										<vs-td :data="data[indextr].date">
											{{data[indextr].date}}
											<span class="label-md-late">LATE</span>
										</vs-td>
										<vs-td :data="data[indextr].id">
											<vs-avatar src="/images/avatar-s-11.png" />
											<div class="filled-name"> Tony</div>
										</vs-td>
										<vs-td :data="data[indextr].id">
											<!-- {{data[indextr].id}} -->
											<svg width="26px" height="26px" viewBox="0 0 28 28" version="1.1" style="margin-right: 10px;">
												<!-- Generator: Sketch 57.1 (83088) - https://sketch.com -->
												<title>Icon Shape</title>
												<desc>Created with Sketch.</desc>
												<g id="New-design" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
													<g id="Dashboard-Home" transform="translate(-1596.000000, -736.000000)" fill="#4285F4" fill-rule="nonzero">
														<g id="Group-6" transform="translate(1596.000000, 731.000000)">
															<g id="active" transform="translate(0.000000, 5.000000)">
																<g id="Ad-platforms">
																	<path d="M14,0 C6.26875,0 0,6.26875 0,14 C0,21.73125 6.26875,28 14,28 C21.73125,28 28,21.73125 28,14 C28,6.26875 21.73125,0 14,0 Z M19.21875,19.8 C17.95,20.96875 16.21875,21.65625 14.153125,21.65625 C11.1625,21.65625 8.575,19.940625 7.315625,17.440625 C6.796875,16.40625 6.5,15.2375 6.5,14 C6.5,12.7625 6.796875,11.59375 7.315625,10.559375 C8.575,8.05625 11.1625,6.340625 14.153125,6.340625 C16.215625,6.340625 17.946875,7.1 19.275,8.334375 L17.08125,10.53125 C16.2875,9.771875 15.278125,9.3875 14.15625,9.3875 C12.1625,9.3875 10.475,10.734375 9.871875,12.54375 C9.71875,13.003125 9.63125,13.49375 9.63125,14 C9.63125,14.50625 9.71875,14.996875 9.871875,15.45625 C10.475,17.265625 12.1625,18.6125 14.153125,18.6125 C15.184375,18.6125 16.059375,18.340625 16.74375,17.88125 C17.55625,17.3375 18.09375,16.528125 18.271875,15.56875 L14.153125,15.56875 L14.153125,12.60625 L21.3625,12.60625 C21.453125,13.109375 21.5,13.63125 21.5,14.171875 C21.5,16.50625 20.665625,18.465625 19.21875,19.8 L19.21875,19.8 Z" id="Icon-Shape"></path>
																</g>
															</g>
														</g>
													</g>
												</g>
											</svg>
											
											<svg width="26px" height="26px" viewBox="0 0 29 28" version="1.1" style="margin-right: 10px;">
												<!-- Generator: Sketch 57.1 (83088) - https://sketch.com -->
												<title>Icon Path</title>
												<desc>Created with Sketch.</desc>
												<g id="New-design" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
													<g id="Dashboard-Home" transform="translate(-1643.000000, -736.000000)" fill="#3C5A99" fill-rule="nonzero">
														<g id="Group-6" transform="translate(1596.000000, 731.000000)">
															<g id="active" transform="translate(0.000000, 5.000000)">
																<g id="Ad-platforms">
																	<path d="M75.1702092,14.0862785 C75.1702092,6.30595732 68.8642519,0 61.0851046,0 C53.3059573,0 47,6.30595732 47,14.0862785 C47,21.1153314 52.1508825,26.9423553 58.8841236,27.9988261 L58.8841236,18.1572129 L55.3085566,18.1572129 L55.3085566,14.0851046 L58.8841236,14.0851046 L58.8841236,10.9826018 C58.8841236,7.4516413 60.9876745,5.50186559 64.2040414,5.50186559 C65.7453151,5.50186559 67.3570201,5.77654802 67.3570201,5.77654802 L67.3570201,9.24294638 L65.582149,9.24294638 C63.8331028,9.24294638 63.2872595,10.3287637 63.2872595,11.4427535 L63.2872595,14.0862785 L67.193854,14.0862785 L66.5693623,18.1583868 L63.2872595,18.1583868 L63.2872595,28 C70.0205006,26.9435291 75.1713831,21.1165053 75.1713831,14.0862785 L75.1702092,14.0862785 Z" id="Icon-Path"></path>
																</g>
															</g>
														</g>
													</g>
												</g>
											</svg>
											
										</vs-td>
									</vs-tr>
								</template>
							</vs-table>
							
						</vs-tab>
					</vs-tabs>
				</vx-card>
			</vs-col>
		</vs-row>
	</div>
</template>

<script>
	import VueApexCharts from 'vue-apexcharts'
	
	export default {
		data() {
			return {
				
				users:[
				  {
					"id": 34567,
					"name": "Dallas Preowned",
					"date": "8 May 2019",
					"username": "Bret",
					"email": "Sincere@april.biz",
					"website": "$50.00",
				  },
				  {
					"id": 34567,
					"name": "Dallas Preowned",
					"date": "8 May 2019",
					"username": "Antonette",
					"email": "Shanna@melissa.tv",
					"website": "$150.00",
				  },
				  {
					"id": 34567,
					"name": "Dallas Preowned",
					"date": "8 May 2019",
					"username": "Samantha",
					"email": "Nathan@yesenia.net",
					"website": "$300.00",
				  },
				  {
					"id": 34567,
					"name": "Dallas Preowned",
					"date": "8 May 2019",
					"username": "Karianne",
					"email": "Julianne.OConner@kory.org",
					"website": "$250.00",
				  },
				  {
					"id": 34567,
					"name": "Dallas Preowned",
					"date": "8 May 2019",
					"username": "Kamren",
					"email": "Lucio_Hettinger@annie.ca",
					"website": "$50.00",
				  },
				],
				
				
				
				
				
				
				
				
				
				
				
				
				chartOptions: {
					chart: { type	: 'area', toolbar: { show: false } },
					dataLabels: { enabled: false },
					colors: ['#2dcd7a'],
					stroke: { curve: 'smooth', },
					tooltip: { 
						x: { format: 'dd/MM/yy HH:mm' },
					},
				},
				chartOptions1: {
					chart: { type	: 'area', toolbar: { show: false } },
					dataLabels: { enabled: false },
					colors: ['#7e72f2'],
					stroke: { curve: 'smooth', },
					tooltip: { 
						x: { format: 'dd/MM/yy HH:mm' },
					},
				},
				chartOptions2: {
					chart: { type	: 'area', toolbar: { show: false } },
					dataLabels: { enabled: false },
					colors: ['#ff9f43'],
					stroke: { curve: 'smooth', },
					tooltip: { 
						x: { format: 'dd/MM/yy HH:mm' },
					},
				},
				chartOptions3: {
					chart: { type	: 'area', toolbar: { show: false } },
					dataLabels: { enabled: false },
					colors: ['#ea5455'],
					stroke: { curve: 'smooth', },
					tooltip: { 
						x: { format: 'dd/MM/yy HH:mm' },
					},
				},
				series: [{
					name: 'TEAM A',
					type: 'area',
					data: [26, 55, 31, 47, 31, 43, 44]
				}],
			}
		},
		components: {
			apexchart: VueApexCharts
		}
	}
</script>

<style lang="scss">
	.apexcharts-gridline , .apexcharts-xaxis, .apexcharts-xaxis-tick, .apexcharts-yaxis {
		display: none;
	}
	.vx-card__body {
		padding: 0px !important;
	}
	
	span.title-chart-md {
		font-size: 9px;
		font-weight: 500;
	}
	.con-vs-pagination {
		display: inline-block;
		margin: 5px auto;
	}
	
	.vs-tabs--btn span {
		color: #000;
		font-weight: 600;
	}
	
	.vs-tabs-primary .line-vs-tabs {
		background: #74c166 !important;
		box-shadow: none !important;
	}
	
	.vs-pagination--ul .vs-pagination--li .effect {
		background: #86da76 !important;
		color: #fff;
	}
	
	.label-md-late {
		border: 1px solid transparent;
		padding: 6px 12px;
		font-size: 8px;
		font-weight: 500;
		border-radius: 15px;
		background-color: #ffa24a;
		color: #fff;
		vertical-align: middle;
		margin-left: 8px;
	}
	
	.filled-name {
		display: inline-block;
		vertical-align: top;
		margin-top: 11px;
		color: #b3b3b3;
	}
	
	button.vs-pagination--buttons:not(:disabled):hover {
		color: #eee !important;
		background: #86da76 !important;
	}
	.vs-table--td>span {
		color: #929292;
		font-size: 12px;
	}
	input.time-picker-md {
		border: 1px solid #ccc;
		padding: 4px;
		border-radius: 15px;
		width: 66%;
		font-size: 10px;
	}
</style>