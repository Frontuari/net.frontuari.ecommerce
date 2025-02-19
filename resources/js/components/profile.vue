<template>
	<section id="user-profile" class="user-profile">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="profile-header">
						<div class="profile-img">
							<img :src="userData.avatar" :alt="userData.name" v-if="!avatar">
							<img :src="avatar" :alt="userData.name" v-else-if="!!avatar">
							<form action="">
								<div class="change-profile-img">
									<input type="file" name="imgPerfil" ref="file" @change="uploadPhoto($event)"
										style="display:none;">
									<button type="button" class="btn" @click="$refs.file.click()">
										<img src="assets/img/subir-archivo-bio-mercados.svg">
									</button>
								</div>
							</form>
						</div>
						<div class="profile-info">
							<h2 class="profile-title" v-if="dataLoaded">{{ userData.name }}</h2>
						</div>
					</div>
				</div>
				<div class="col-12">
					<div class="row">
						<div class="col-lg-3 profile-sidebar">
							<ul class="nav sidebar-tabs" id="SectionsTab" role="tablist">
								<li class="nav-item">
									<a class="nav-link active" id="personal-info-tab" data-toggle="tab"
										href="#personal-info" role="tab" aria-controls="personal-info" aria-selected="true">
										<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16.69 20">
											<title>datos-personales-bio-mercados</title>
										    <g id="Perfil_de_Usuario" data-name="Perfil de Usuario">
											<path fill="#203876" d="M8.22,9.63a4.63,4.63,0,0,0,3.4-1.41A4.63,4.63,0,0,0,13,4.82a4.65,4.65,0,0,0-1.41-3.41A4.63,4.63,0,0,0,8.22,0,4.65,4.65,0,0,0,4.81,1.41,4.65,4.65,0,0,0,3.4,4.82a4.63,4.63,0,0,0,1.41,3.4A4.65,4.65,0,0,0,8.22,9.63ZM5.64,2.24A3.48,3.48,0,0,1,8.22,1.17a3.46,3.46,0,0,1,2.57,1.07,3.48,3.48,0,0,1,1.07,2.58,3.46,3.46,0,0,1-1.07,2.57A3.46,3.46,0,0,1,8.22,8.46,3.48,3.48,0,0,1,5.64,7.39,3.46,3.46,0,0,1,4.57,4.82,3.48,3.48,0,0,1,5.64,2.24Z"/>
											<path fill="#203876" d="M16.65,15.38a12.56,12.56,0,0,0-.17-1.26,9.22,9.22,0,0,0-.31-1.28,6.15,6.15,0,0,0-.52-1.18,4.61,4.61,0,0,0-.79-1,3.69,3.69,0,0,0-1.13-.71,4,4,0,0,0-1.44-.26,1.47,1.47,0,0,0-.79.33l-.81.53A4.46,4.46,0,0,1,9.63,11a4.1,4.1,0,0,1-1.29.21A4.15,4.15,0,0,1,7.05,11a4.37,4.37,0,0,1-1-.46L5.18,10a1.45,1.45,0,0,0-.78-.33A4,4,0,0,0,3,9.92a3.69,3.69,0,0,0-1.13.71,4.92,4.92,0,0,0-.79,1,6.83,6.83,0,0,0-.52,1.18A10.91,10.91,0,0,0,.2,14.12,12.41,12.41,0,0,0,0,15.38c0,.38,0,.78,0,1.18a3.3,3.3,0,0,0,1,2.51A3.52,3.52,0,0,0,3.53,20h9.63a3.53,3.53,0,0,0,2.54-.93,3.34,3.34,0,0,0,1-2.51c0-.4,0-.8,0-1.18Zm-1.76,2.84a2.37,2.37,0,0,1-1.73.61H3.53a2.4,2.4,0,0,1-1.74-.61,2.18,2.18,0,0,1-.62-1.66c0-.37,0-.74,0-1.1a8.52,8.52,0,0,1,.15-1.14,8.36,8.36,0,0,1,.27-1.12,5.09,5.09,0,0,1,.42-1,3.54,3.54,0,0,1,.58-.76A2.39,2.39,0,0,1,3.39,11a2.64,2.64,0,0,1,.92-.18l.23.14.83.54a5.64,5.64,0,0,0,1.32.59,5.37,5.37,0,0,0,3.3,0,5.74,5.74,0,0,0,1.33-.59l.82-.54.24-.14a2.74,2.74,0,0,1,.92.18,2.34,2.34,0,0,1,.75.47,3.24,3.24,0,0,1,.58.76,5.13,5.13,0,0,1,.43,1,8.36,8.36,0,0,1,.27,1.12q.11.62.15,1.14h0c0,.35,0,.72,0,1.1a2.14,2.14,0,0,1-.62,1.66Z"/>
											</g>

										</svg>
										Datos personales
									</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" id="my-address-tab" ref="addressLink" data-toggle="tab"
										href="#my-address" role="tab" aria-controls="my-address" aria-selected="false">
										<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 19.16 19.2">
											<title>mis-direcciones-bio-mercados</title>
											<g id="Capa_2" data-name="Capa 2">
												<g id="Perfil_de_Usuario" data-name="Perfil de Usuario">
													<path
														d="M7.59,12.07a4.48,4.48,0,1,1,4.48-4.48.38.38,0,1,1-.76,0,3.72,3.72,0,1,0-3.72,3.72.38.38,0,0,1,0,.76Z" />
													<path
														d="M7.36,19.16A.36.36,0,0,1,7,19a28.25,28.25,0,0,0-3-3.71,23,23,0,0,1-2.78-3.44A7.92,7.92,0,0,1,0,7.58,7.6,7.6,0,0,1,7.59,0a7.58,7.58,0,0,1,7.59,7.58.35.35,0,0,1-.11.27.36.36,0,0,1-.26.11.4.4,0,0,1-.39-.38,6.83,6.83,0,0,0-13.66,0c0,3,1.78,4.93,3.84,7.18a27.35,27.35,0,0,1,3.08,3.82.38.38,0,0,1-.12.52A.36.36,0,0,1,7.36,19.16Z" />
													<path
														d="M11.58,19.2a1.8,1.8,0,0,1-1.79-1.8V14l-.67.61a.46.46,0,0,1-.32.16.37.37,0,0,1-.28-.13.38.38,0,0,1-.1-.27.42.42,0,0,1,.12-.26l4-3.68a1.8,1.8,0,0,1,1.22-.48,1.79,1.79,0,0,1,1.22.48l4,3.68a.37.37,0,0,1,.12.26.34.34,0,0,1-.1.27.37.37,0,0,1-.28.13.44.44,0,0,1-.26-.1l-.76-.7V17.4A1.81,1.81,0,0,1,16,19.2Zm2.21-8.54a1.06,1.06,0,0,0-.71.28l-2.53,2.32V17.4a1,1,0,0,0,1,1H16a1,1,0,0,0,1-1V13.22l-2.5-2.28A1,1,0,0,0,13.79,10.66Z" />
												</g>
											</g>
										</svg>
										Mis direcciones de Envío
									</a>
								</li>
								<li class="nav-item">
									<a class="nav-link trigger" id="my-orders-tab" ref="ordersLink" data-toggle="tab"
										href="#my-orders" role="tab" aria-controls="my-orders" aria-selected="false">
										<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 21.43 19.97">
											<title>mis-pedidos-bio-mercados</title>
											<g id="Capa_2" data-name="Capa 2">
												<g id="Perfil_de_Usuario" data-name="Perfil de Usuario">
													<path
														d="M14.53,13h.32a.31.31,0,0,0,0-.61h0v-.82h.84a.27.27,0,0,0,.28.2.3.3,0,0,0,.31-.3v-.21A.31.31,0,0,0,16,11H14.53a.27.27,0,0,0-.21.09.29.29,0,0,0-.09.21v1.43a.31.31,0,0,0,.09.22.27.27,0,0,0,.21.09Z" />
													<path
														d="M14.53,15.76H16a.3.3,0,0,0,.3-.3V14a.3.3,0,0,0-.3-.3H14.53a.3.3,0,0,0-.3.3v1.43a.3.3,0,0,0,.3.3Zm.31-1.43h.82v.83h-.82Z" />
													<path
														d="M14.85,17.93h0v-.82h.82a.31.31,0,0,0,.61,0v-.29A.33.33,0,0,0,16,16.5H14.53a.32.32,0,0,0-.3.32v1.43a.29.29,0,0,0,.09.21.32.32,0,0,0,.21.08h.32a.31.31,0,0,0,0-.61Z" />
													<path
														d="M16.66,11.32l-.89.89-.27-.27a.3.3,0,0,0-.43.43l.49.49a.32.32,0,0,0,.43,0l1.1-1.11a.3.3,0,0,0-.43-.43Z" />
													<path
														d="M16.66,16.93l-.89.89-.27-.27a.3.3,0,0,0-.43.43l.49.48a.3.3,0,0,0,.43,0l1.1-1.1a.3.3,0,0,0-.43-.43Z" />
													<path d="M19.78,11.69H17.87a.3.3,0,1,0,0,.6h1.91a.3.3,0,0,0,0-.6Z" />
													<path
														d="M19.78,14.46H17.87a.31.31,0,0,0,0,.61h1.91a.31.31,0,0,0,0-.61Z" />
													<path
														d="M19.78,17.24H17.87a.31.31,0,0,0,0,.61h1.91a.31.31,0,0,0,0-.61Z" />
													<path
														d="M20.13,8.61H19.05a1.07,1.07,0,0,0-1-.78H16.88V5a.32.32,0,0,0-.15-.26L8.59,0a.32.32,0,0,0-.3,0L.15,4.74A.32.32,0,0,0,0,5v9.4a.33.33,0,0,0,.15.27l8.14,4.7a.32.32,0,0,0,.31,0l4.29-2.47v1.78a1.25,1.25,0,0,0,.37.92,1.28,1.28,0,0,0,.92.37h5.95a1.28,1.28,0,0,0,.92-.37,1.3,1.3,0,0,0,.38-.92V9.92a1.3,1.3,0,0,0-1.3-1.31ZM18,8.43a.44.44,0,0,1,.44.44v0a.44.44,0,0,1-.44.44H16.28a.43.43,0,0,1-.44-.44v0a.44.44,0,0,1,.44-.44ZM8.44.65l3.39,2L4.29,7,.91,5ZM8.16,18.58.61,14.23V5.53L8.16,9.88Zm.28-9.23-3.54-2L12.44,3,16,5Zm4.45.57V16.2L8.76,18.58V9.88l7.51-4.35v2.3h0a1.06,1.06,0,0,0-1,.78H14.18a1.29,1.29,0,0,0-1.29,1.31Zm7.93,8.76a.68.68,0,0,1-.2.49.7.7,0,0,1-.49.2H14.18a.7.7,0,0,1-.49-.2.68.68,0,0,1-.2-.49V9.92a.7.7,0,0,1,.69-.71h1.09a1,1,0,0,0,1,.74H18a1,1,0,0,0,1-.74h1.1a.71.71,0,0,1,.69.71Z" />
												</g>
											</g>
										</svg>
										Mis pedidos
									</a>
								</li>
								<li class="nav-item">
									<a class="nav-link trigger" ref="favoriteLink" id="my-favorite" data-toggle="tab"
										href="#my-favorites" role="tab" aria-controls="my-favorites" aria-selected="false">
										<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24.89 25">
											<defs></defs>
											<title>favoritos-bio</title>
											<g id="Capa_2" data-name="Capa 2">
												<g id="Guias_y_recursos" data-name="Guias y recursos">
													<path class="cls-1"
														d="M7.84,12.6a.7.7,0,0,1-.7-.7V5.84h17a.71.71,0,1,1,0,1.41H8.54V11.9A.7.7,0,0,1,7.84,12.6Z" />
													<path class="cls-2"
														d="M12.81,12.4a3.9,3.9,0,0,1,1.75,1.12,4.14,4.14,0,0,1,1,3.66c-.37,2.26-2.21,4.51-5.13,6.41H24.24V12.4Z" />
													<path class="cls-1"
														d="M24.89,25H12a.71.71,0,0,1,0-1.41H23.48V8.48a.71.71,0,0,1,1.41,0Z" />
													<path class="cls-1"
														d="M19.22,9.93a.7.7,0,0,1-.7-.71V3.33a1.63,1.63,0,0,0-.72-1.4A3.12,3.12,0,0,0,16,1.41c-1.05,0-2.62.51-2.62,1.92V9.22a.71.71,0,1,1-1.41,0V3.33C12,1.14,14,0,16,0s3.94,1,3.94,3.33V9.22A.71.71,0,0,1,19.22,9.93Z" />
													<path class="cls-1"
														d="M14.56,13.52a3.74,3.74,0,0,0-2.72-1.29,6,6,0,0,0-4,1.76,6,6,0,0,0-4-1.76,3.74,3.74,0,0,0-2.72,1.29,4.14,4.14,0,0,0-1,3.66C.53,20,3.25,22.82,7.53,24.93a.72.72,0,0,0,.62,0c4.28-2.11,7-4.94,7.46-7.75A4.14,4.14,0,0,0,14.56,13.52ZM14.22,17C14,18,13.06,20.84,7.84,23.51,2.62,20.84,1.64,18,1.46,17a2.7,2.7,0,0,1,.66-2.44l0,0a2.37,2.37,0,0,1,1.72-.84h.06a5.21,5.21,0,0,1,3.41,1.82.74.74,0,0,0,1,0,5.13,5.13,0,0,1,3.47-1.82,2.37,2.37,0,0,1,1.72.84l0,0A2.7,2.7,0,0,1,14.22,17Z" />
												</g>
											</g>
										</svg>
										Mis Favoritos
									</a>
								</li>
							</ul>
						</div>
						<div class="col-lg-9 profile-content">
							<div class="tab-content" id="TabContent">
								<div class="tab-pane fade show active" id="personal-info" role="tabpanel"
									aria-labelledby="personal-info-tab">
									<ul class="nav nav-tabs" id="" role="tablist">
										<li class="nav-item">
											<a class="nav-link active" id="edit-profile-tab" data-toggle="tab"
												href="#edit-profile" role="tab" aria-controls="edit-profile"
												aria-selected="true">Editar perfil</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" id="security-tab" data-toggle="tab" href="#security"
												role="tab" aria-controls="security" aria-selected="false">Seguridad</a>
										</li>
									</ul>
									<div class="tab-content" id="personal-info-content">
										<div class="tab-pane fade show active" id="edit-profile" role="tabpanel"
											aria-labelledby="edit-profile-tab">
											<form action="">
												<div class="col-12">
													<div class="row">
														<!-- <div class="col-lg-6">
															<div class="form-group">
																<label for="user-name">Cédula / Rif</label>
																<button class="btn btn-edit-info" type="button"><img src="assets/img/editar-bio-mercados.svg"></button>
																<button class="btn btn-confirm-info" type="button"><img src="assets/img/confirmar-bio-mercados.svg"></button>
																<input type="text" class="form-control" id="user-name" name="user-name" disabled="disabled" value="" v-model="userData.rif">
															</div>
														</div> -->
														<div class="col-lg-12">
															<div class="form-group">
																<label for="user-name">Nombre y Apellido (s):</label>
																<button class="btn btn-edit-info" type="button"><img
																		src="assets/img/editar-bio-mercados.svg"></button>
																<button class="btn btn-confirm-info" type="button"><img
																		src="assets/img/confirmar-bio-mercados.svg" @click="updateDetails" ></button>
																<input type="text" class="form-control" id="user-name"
																	name="user-name" disabled="disabled" value=""
																	v-model="userData.name">
															</div>
														</div>
														<!-- <div class="col-lg-6">
															<div class="form-group">
																<label for="user-lastname">Apellido (s):</label>
																<button class="btn btn-edit-info" type="button"><img src="assets/img/editar-bio-mercados.svg"></button>
																<button class="btn btn-confirm-info" type="button"><img src="assets/img/confirmar-bio-mercados.svg"></button>
																<input type="text" class="form-control" id="user-lastname" name="user-lastname" disabled="disabled" value="">
															</div>
														</div> -->
														<div class="col-lg-6">
															<div class="form-group">
																<label for="user-email">Correo Electrónico:</label>
																<button class="btn btn-edit-info" type="button"><img
																		src="assets/img/editar-bio-mercados.svg"></button>
																<button class="btn btn-confirm-info" type="button"><img
																		src="assets/img/confirmar-bio-mercados.svg" @click="updateDetails" ></button>
																<input type="email" class="form-control" id="user-email"
																	name="user-email" disabled="disabled" value=""
																	v-model="userData.email">
															</div>
														</div>
														<div class="col-lg-6">
															<div class="form-group">
																<label for="user-birthday">Cumpleaños:</label>
																<button class="btn btn-edit-info" type="button"><img
																		src="assets/img/editar-bio-mercados.svg"></button>
																<button class="btn btn-confirm-info" type="button"><img
																		src="assets/img/confirmar-bio-mercados.svg" @click="updateDetails" ></button>
																<input type="date" class="form-control" id="user-birthday"
																	name="user-birthday" disabled="disabled"
																	value="DD/MM/YYYY" v-model="userData.birthdate">
															</div>
														</div>
														<div class="col-lg-6">
															<div class="form-group">
																<label for="user-gender">Sexo:</label>
																<button class="btn btn-edit-info" type="button"><img
																		src="assets/img/editar-bio-mercados.svg"></button>
																<button class="btn btn-confirm-info" type="button"><img
																		src="assets/img/confirmar-bio-mercados.svg" @click="updateDetails" ></button>
																<select id="user-gender" name="user-gender"
																	disabled="disabled" class="form-control"
																	v-model="userData.sex">
																	<option value="">Seleccione</option>
																	<option value="m">Masculino</option>
																	<option value="f">Femenino</option>
																</select>
																<!-- <input :type="'text'" class="form-control dropdown-toggle" data-toggle="dropdown" aria-expanded="false" id="user-gender" name="user-gender" disabled="disabled" :value="(userData.sex == 'm')?'Masculino':'Femenino'" v-model="userData.sex">
																<div class="dropdown-menu dropdown-menu-gender">
																    <div class="dropdown-item">
																		<div class="form-check form-check-radio">
																			<input type="radio" class="form-check-input" id="man" name="radio-gender"  value="m" :checked="userData.sex == 'm'?true:false">
																			<label for="man" class="custom-check"><span></span>Masculino</label>
																		</div>
																    </div>
																    <div class="dropdown-item">
																		<div class="form-check form-check-radio">
																	    	<input type="radio" class="form-check-input" id="women" value="f" name="radio-gender" :checked="userData.sex == 'f'?true:false">
																	    	<label for="women" class="custom-check"><span></span>Femenino</label>
																		</div>
																    </div>
																</div> -->
															</div>
														</div>
														<div class="col-lg-6">
															<div class="form-group">
																<label  for="user-contact-phone">Teléfono de
																	Contacto:</label>
																<button class="btn btn-edit-info" type="button"><img
																		src="assets/img/editar-bio-mercados.svg"></button>
																<button class="btn btn-confirm-info" type="button"><img
																		src="assets/img/confirmar-bio-mercados.svg" @click="updateDetails" ></button>
																<input type="text" class="form-control"
																	id="user-contact-phone" name="user-contact-phone"
																	disabled="disabled"  v-model="userData.phone">
															</div>
														</div>
														<div class="col-lg-6">
															<div class="form-group">
																<label for="user-office-phone">Teléfono de Oficina:</label>
																<button class="btn btn-edit-info" type="button"><img
																		src="assets/img/editar-bio-mercados.svg"></button>
																<button class="btn btn-confirm-info" type="button"><img
																		src="assets/img/confirmar-bio-mercados.svg" @click="updateDetails" ></button>
																<input type="text" class="form-control"
																	id="user-office-phone" name="user-office-phone"
																	disabled="disabled" v-model="userData.phone_home">
															</div>
														</div>
														<DireccionHabitacion :Allregions="Allregions" :Allstates="Allstates" :Allcities="Allcities"></DireccionHabitacion>
														

														<div class="col-lg-6"></div>

														
													</div>
												</div>
											</form>
										</div>
										<div class="tab-pane fade" id="security" role="tabpanel" aria-labelledby="security-tab">
											<form action="">
												<div class="col-lg-6">
													<div class="form-group">
														<label for="currently-password">Confirma tu contraseña actual:</label>
														<input type="password" class="form-control" id="currently-password" name="currently-password" v-model="userData.currentlypassword">
													</div>
													<div class="form-group">
														<label for="new-password">Escribe la nueva contraseña:</label>
														<input type="password" class="form-control" id="new-password" name="newpassword" v-model="userData.newpassword">
													</div>
													<div class="form-group">
														<label for="new-password-confirm">Repite la nueva contraseña:</label>
														<input type="password" class="form-control" id="new-password-confirm" name="newpasswordconfirm" v-model="userData.newpasswordconfirm">
													</div>
													<div class="mt-5"></div>
													<div class="form-group">
														<button class="btn btn-submit" @click="update_password(userData)" type="button">GUARDAR CAMBIOS</button>
													</div>
												</div>
											</form>
										</div>
									</div>
								</div>
								<div class="tab-pane fade" id="my-address" role="tabpanel" aria-labelledby="my-address-tab">
									<ul class="nav nav-tabs" id="" role="tablist">
										<li class="nav-item">
											<a class="nav-link active" id="address-tab" data-toggle="tab" href="#address"
												role="tab" aria-controls="address" aria-selected="true">Mis direcciones de
												Envio</a>
										</li>
									</ul>
									<div class="tab-content" id="address-content">
										<div class="tab-pane fade show active" id="address" role="tabpanel"
											aria-labelledby="address-tab">
											<form action="">
												<DireccionUser :userlogged="userlogged"  :Allstates="Allstates"  ></DireccionUser>
												
											</form>
										</div>
									</div>
								</div>

								<!-- ORDER TAB-->
								<div class="tab-pane fade" id="my-orders" role="tabpanel" aria-labelledby="my-orders-tab">
									<ul class="nav nav-tabs" id="" role="tablist">

										<li class="nav-item">
											<a class="nav-link active" id="all-orders-tab" data-toggle="tab"
												href="#all-orders" role="tab" aria-controls="all-orders"
												aria-selected="true">Todos</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" id="order-in-process-tab" data-toggle="tab"
												href="#order-in-process" role="tab" aria-controls="order-in-process"
												aria-selected="false">En Proceso</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" id="complete-orders-tab" data-toggle="tab"
												href="#complete-orders" role="tab" aria-controls="complete-orders"
												aria-selected="false">Completados</a>
										</li>
									</ul>
									<div class="tab-content" id="orders-content" style="position: relative;">
										<div class="tab-pane fade show active" id="all-orders" role="tabpanel"
											aria-labelledby="all-orders-tab" >
											<img src="../../assets/recargas.png" alt="Refresh Icon" class="btn-refresh"
											style="position: absolute; width: 50px; height: 50px; right: 0; top: 0; bottom: 30;"
											@click="refreshOrders">											
																						
											<div class="order-table">
												<div class="thead-bio">
													<div class="row">
														<div class="col-6 col-lg-16">Orden Nro.</div>
														<div class="col-6 col-lg-16">Fecha</div>
														<div class="col-6 col-lg-16">Dirección de entrega</div>
														<div class="col-6 col-lg-16">Fecha de entrega</div>
														<div class="col-6 col-lg-16">Estado</div>
														<div class="col-6 col-lg-16">Acción</div>
													</div>
												</div>

												<div class="row" v-for="order in orders" :key="order.id">
													<div class="col-6 col-lg-16">
														<button class="btn" type="button" onclick="getOrder(this)"
															:value="order.id">
															<span class="order-span">Número de Pedido</span> {{ order.id }}
														</button>
													</div>
													<div class="col-6 col-lg-16"><span class="order-span">Fecha</span>{{
														order.created_at }}</div>
													<div class="col-6 col-lg-16">
														<button class="btn" type="button" data-toggle="tooltip"
															data-placement="bottom"
															title="Urb Zaragoza, Avenida 1 entre calles 10 y 11, casa 57, Araure, Estado Portugesa 3303 (al lado del bodegón Girasol)">
															<span class="order-span">Dirección de entrega</span>
															{{ order.address }}
														</button>
													</div>
													<div class="col-6 col-lg-16"><span class="order-span">Fecha de
															entrega</span>{{ order.delivery_time_date }}</div>
													<div class="col-6 col-lg-16">
														<span class="order-span">Estado</span>
														<div class="process-status in-process" data-toggle="tooltip"
															data-placement="bottom"
															title="Su pedido se está procesando para ser enviado">
															<!-- <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20.12 19.97"><defs></defs><title>en-proceso-bio-mercados</title><g id="Capa_2" data-name="Capa 2"><g id="Perfil_de_Usuario" data-name="Perfil de Usuario"><path class="cls-1" d="M12.09,18.25l-.5.11A.81.81,0,1,0,11.88,20l.6-.13a.81.81,0,0,0-.39-1.57Z"/><path class="cls-1" d="M18.07,7.41a.9.9,0,0,0,.3.41.79.79,0,0,0,.72.1.8.8,0,0,0,.52-1c-.07-.19-.14-.39-.21-.57a.81.81,0,0,0-1.51.6,4.68,4.68,0,0,1,.18.48Z"/><path class="cls-1" d="M14.72,17.1l-.44.27a.8.8,0,0,0-.3,1.1.86.86,0,0,0,.24.26.83.83,0,0,0,.87,0c.17-.1.35-.21.52-.33a.8.8,0,1,0-.89-1.34Z"/><path class="cls-1" d="M20.11,9.67a.81.81,0,0,0-1.62.06c0,.17,0,.35,0,.52a.8.8,0,0,0,.34.68.77.77,0,0,0,.45.14.8.8,0,0,0,.82-.79c0-.2,0-.41,0-.61Z"/><path class="cls-1" d="M9.56,3.52a.66.66,0,0,0-.65.66V10.7l6,3.08a.66.66,0,0,0,.88-.28.65.65,0,0,0-.28-.88L10.22,9.9V4.18a.67.67,0,0,0-.66-.66Z"/><path class="cls-1" d="M19.13,12a.82.82,0,0,0-1,.53c-.05.17-.1.33-.16.49a.81.81,0,0,0,.28.95.76.76,0,0,0,.18.09.82.82,0,0,0,1.05-.46c.07-.19.14-.39.2-.58a.82.82,0,0,0-.53-1Z"/><path class="cls-1" d="M8.56,18.37a8.33,8.33,0,0,1-2.07-.66l0,0c-.16-.07-.31-.15-.46-.23H6c-.27-.15-.54-.32-.8-.5a8.46,8.46,0,0,1,0-13.83l0,0A8.48,8.48,0,0,1,14.74,3L14.1,4c-.17.26-.06.44.24.41l2.75-.24a.46.46,0,0,0,.41-.59L16.76.87c-.08-.3-.29-.33-.47-.08l-.63.92A10,10,0,0,0,8.34.15L7.57.31h0A9.94,9.94,0,0,0,2,4l0,0-.14.19-.21.32,0,0A10.08,10.08,0,0,0,0,10.49v0c0,.2,0,.4,0,.61v0c0,.2.05.4.09.61A10,10,0,0,0,3,17.19H3a9.71,9.71,0,0,0,1.29,1.08,10,10,0,0,0,4,1.68.81.81,0,1,0,.28-1.59Z"/><path class="cls-1" d="M17.94,15a.8.8,0,0,0-1.13.16l-.32.4a.81.81,0,0,0,.09,1.14l.06,0a.81.81,0,0,0,1.08-.14l.38-.48A.8.8,0,0,0,17.94,15Z"/></g></g></svg> -->
															{{ order.namestatus }}
														</div>
													</div>
													<div class="col-6 col-lg-16">
														<div class="btn-group" v-if="order.namestatus == 'Entregado'">
															<button class="btn btn-submit btn-sm dropdown-toggle"
																style="color: white; padding: 5px;" type="button"
																data-toggle="dropdown" aria-haspopup="true"
																aria-expanded="false">
																Acción
															</button>
															<div class="dropdown-menu">
																<a class="dropdown-item" href="javascript:void(0)"
																	@click="repeatOrder(order.id)">Repetir orden</a>
																<a class="dropdown-item" href="javascript:void(0)"
																	@click="devolucion(order.id)">Solicitar Devolución</a>
																<a class="dropdown-item" href="#ModalOrderRating"
																	data-toggle="modal" data-target="#ModalOrderRating"
																	@click="getOrder(order.id)">Calificar Orden</a>
															</div>
														</div>

														<div class="btn-group"
															v-if="order.namestatus == 'Esperando el pago'">
															<button class="btn btn-submit btn-sm dropdown-toggle"
																style="color: white; padding: 5px;" type="button"
																data-toggle="dropdown" aria-haspopup="true"
																aria-expanded="false">
																Acción
															</button>
															<div class="dropdown-menu">
																<a class="dropdown-item" href="javascript:void(0)"
																	@click="PayOrder(order.id)">Realizar Pago</a>
																<a class="dropdown-item" href="javascript:void(0)"
																	@click="cancelOrder(order.id)">Cancelar Orden</a>
															</div>
														</div>

													</div>
												</div>
											</div>
										</div>
										<div class="tab-pane fade" id="order-in-process" role="tabpanel"
											aria-labelledby="order-in-process-tab">
											<div class="order-table">
												<div class="thead-bio">
													<div class="row">
														<div class="col-6 col-lg-20">Número de Pedido</div>
														<div class="col-6 col-lg-20">Fecha</div>
														<div class="col-6 col-lg-20">Dirección de entrega</div>
														<div class="col-6 col-lg-20">Fecha de entrega</div>
														<div class="col-6 col-lg-20">Estado</div>
													</div>
												</div>
												<div class="row" v-for="order in en_proceso" :key="order.id">
													<div class="col-12 col-lg-20">
														<button class="btn" type="button" data-toggle="modal"
															@click="getOrder(order.id)" data-target="#ModalOrder">
															<span class="order-span">Número de Pedido</span> {{ order.id }}
														</button>
													</div>
													<div class="col-6 col-lg-20"><span class="order-span">Fecha</span>{{
														order.created_at }}</div>
													<div class="col-6 col-lg-20">
														<button class="btn" type="button" data-toggle="tooltip"
															data-placement="bottom"
															title="Urb Zaragoza, Avenida 1 entre calles 10 y 11, casa 57, Araure, Estado Portugesa 3303 (al lado del bodegón Girasol)">
															<span class="order-span">Dirección de entrega</span>
															{{ order.address }}
														</button>
													</div>
													<div class="col-6 col-lg-20"><span class="order-span">Fecha de
															entrega</span>{{ order.delivery_time_date }}</div>
													<div class="col-6 col-lg-20">
														<span class="order-span">Estado</span>
														<div class="process-status in-process" data-toggle="tooltip"
															data-placement="bottom"
															title="Su pedido se está procesando para ser enviado">
															<!-- <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20.12 19.97"><defs></defs><title>en-proceso-bio-mercados</title><g id="Capa_2" data-name="Capa 2"><g id="Perfil_de_Usuario" data-name="Perfil de Usuario"><path class="cls-1" d="M12.09,18.25l-.5.11A.81.81,0,1,0,11.88,20l.6-.13a.81.81,0,0,0-.39-1.57Z"/><path class="cls-1" d="M18.07,7.41a.9.9,0,0,0,.3.41.79.79,0,0,0,.72.1.8.8,0,0,0,.52-1c-.07-.19-.14-.39-.21-.57a.81.81,0,0,0-1.51.6,4.68,4.68,0,0,1,.18.48Z"/><path class="cls-1" d="M14.72,17.1l-.44.27a.8.8,0,0,0-.3,1.1.86.86,0,0,0,.24.26.83.83,0,0,0,.87,0c.17-.1.35-.21.52-.33a.8.8,0,1,0-.89-1.34Z"/><path class="cls-1" d="M20.11,9.67a.81.81,0,0,0-1.62.06c0,.17,0,.35,0,.52a.8.8,0,0,0,.34.68.77.77,0,0,0,.45.14.8.8,0,0,0,.82-.79c0-.2,0-.41,0-.61Z"/><path class="cls-1" d="M9.56,3.52a.66.66,0,0,0-.65.66V10.7l6,3.08a.66.66,0,0,0,.88-.28.65.65,0,0,0-.28-.88L10.22,9.9V4.18a.67.67,0,0,0-.66-.66Z"/><path class="cls-1" d="M19.13,12a.82.82,0,0,0-1,.53c-.05.17-.1.33-.16.49a.81.81,0,0,0,.28.95.76.76,0,0,0,.18.09.82.82,0,0,0,1.05-.46c.07-.19.14-.39.2-.58a.82.82,0,0,0-.53-1Z"/><path class="cls-1" d="M8.56,18.37a8.33,8.33,0,0,1-2.07-.66l0,0c-.16-.07-.31-.15-.46-.23H6c-.27-.15-.54-.32-.8-.5a8.46,8.46,0,0,1,0-13.83l0,0A8.48,8.48,0,0,1,14.74,3L14.1,4c-.17.26-.06.44.24.41l2.75-.24a.46.46,0,0,0,.41-.59L16.76.87c-.08-.3-.29-.33-.47-.08l-.63.92A10,10,0,0,0,8.34.15L7.57.31h0A9.94,9.94,0,0,0,2,4l0,0-.14.19-.21.32,0,0A10.08,10.08,0,0,0,0,10.49v0c0,.2,0,.4,0,.61v0c0,.2.05.4.09.61A10,10,0,0,0,3,17.19H3a9.71,9.71,0,0,0,1.29,1.08,10,10,0,0,0,4,1.68.81.81,0,1,0,.28-1.59Z"/><path class="cls-1" d="M17.94,15a.8.8,0,0,0-1.13.16l-.32.4a.81.81,0,0,0,.09,1.14l.06,0a.81.81,0,0,0,1.08-.14l.38-.48A.8.8,0,0,0,17.94,15Z"/></g></g></svg> -->
															{{ order.namestatus }}
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="tab-pane fade" id="complete-orders" role="tabpanel"
											aria-labelledby="complete-orders-tab">
											<div class="order-table">
												<div class="thead-bio">
													<div class="row">
														<div class="col-6 col-lg-20">Número de Pedido</div>
														<div class="col-6 col-lg-20">Fecha</div>
														<div class="col-6 col-lg-20">Dirección de entrega</div>
														<div class="col-6 col-lg-20">Fecha de entrega</div>
														<div class="col-6 col-lg-20">Acción</div>
													</div>
												</div>
												<div class="row" v-for="order in completos" :key="order.id">
													<div class="col-12 col-lg-20">
														<button class="btn" type="button" data-toggle="modal"
															@click="getOrder(order.id)" data-target="#ModalOrder">
															<span class="order-span">Número de Pedido</span> {{ order.id }}
														</button>
													</div>
													<div class="col-6 col-lg-20"><span class="order-span">Fecha</span>{{
														order.created_at }}</div>
													<div class="col-6 col-lg-20">
														<button class="btn" type="button" data-toggle="tooltip"
															data-placement="bottom"
															title="Urb Zaragoza, Avenida 1 entre calles 10 y 11, casa 57, Araure, Estado Portugesa 3303 (al lado del bodegón Girasol)">
															<span class="order-span">Dirección de entrega</span>
															{{ order.address }}
														</button>
													</div>
													<div class="col-6 col-lg-20"><span class="order-span">Fecha de
															entrega</span>{{ order.delivery_time_date }}</div>
													<div class="col-6 col-lg-20">
														<div class="btn-group" v-if="order.namestatus == 'Entregado'">
															<button class="btn btn-submit btn-sm dropdown-toggle"
																style="color: white; padding: 5px;" type="button"
																data-toggle="dropdown" aria-haspopup="true"
																aria-expanded="false">
																Acción
															</button>
															<div class="dropdown-menu">
																<a class="dropdown-item" href="javascript:void()"
																	@click="repeatOrder(order.id)">Repetir orden</a>
																<a class="dropdown-item" href="javascript:void()"
																	@click="devolucion(order.id)">Solicitar Devolución</a>
																<a class="dropdown-item" href="#ModalOrderRating"
																	data-toggle="modal" data-target="#ModalOrderRating"
																	@click="getOrder(order.id)">Calificar Orden</a>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<!-- CIERRE DEL ORDER TAB-->

								<!-- ############################### SECCION DE MIS FAVORITO ######################################## -->

								<!-- FAVORITE TAB-->
								<div class="tab-pane" id="my-favorites" role="tabpanel" aria-labelledby="my-favorites">
									<ul class="nav nav-tabs" id="" role="tablist">
										<li class="nav-item">
											<a class="nav-link active" id="all-orders-tab" data-toggle="tab"
												href="#all-orders" role="tab" aria-controls="all-orders"
												aria-selected="true">Mis productos Favoritos</a>
										</li>

									</ul>
									<div class="tab-content" id="orders-content">
										<div class="tab-pane fade show active" id="all-orders" role="tabpanel"
											aria-labelledby="all-orders-tab">

											<div class="col-md-12 mx-0" v-if="cant_favorites <= 0">
												<p class="cart-empty bio-info">Lista vacia.</p>
												<a class="button" href="catalog">Volver a la tienda</a>
											</div>

											<div class="product-list" v-if="cant_favorites > 0">
												<div class="container-fluid">
													<div class="row">
														<div class="col-6 col-lg-12" v-for="(favorite, index) in favorites"
															:key="favorite.id">
															<div class="product-block">
																<div class="product-img"><img v-if="favorite.photo != null"
																		:src=favorite.photo>
																	<div class="product-actions">
																		<button type="button" data-toggle="modal"
																			data-target="#ModalProd" class="btn">
																			<svg xmlns="http://www.w3.org/2000/svg"
																				viewBox="0 0 14.31 15">
																				<title>añadir-carrito-bio</title>
																				<g id="Capa_2" data-name="Capa 2">
																					<g id="Guias_y_recursos"
																						data-name="Guias y recursos">
																						<path
																							d="M13.2,11.58H8.83a.45.45,0,1,0,0,.9H10.1a.81.81,0,1,1-.81.81.46.46,0,0,0-.91,0,1.72,1.72,0,1,0,3.22-.81h1.6a.45.45,0,1,0,0-.9Z"
																							class="cls-1"></path>
																						<path
																							d="M14.21,3.33a.48.48,0,0,0-.35-.16H4V1.35A.45.45,0,0,0,3.67.92L.58,0A.45.45,0,0,0,0,.32a.45.45,0,0,0,.3.56l2.77.81v9.89H2.65a.45.45,0,0,0,0,.9h2.6a.81.81,0,1,1-.81.81.45.45,0,1,0-.9,0,1.72,1.72,0,1,0,1.71-1.71H4v-.77h8.52a.43.43,0,0,0,.22-.06.46.46,0,0,0,.22-.3L14.3,3.71A.48.48,0,0,0,14.21,3.33Zm-.9.74L13,5.39H4V4.07ZM4,9.91V8.59H10.1a.45.45,0,0,0,0-.9H4V6.29h8.87l-.72,3.62Z"
																							class="cls-1"></path>
																					</g>
																				</g>
																			</svg>
																		</button>
																		<button type="button" class="btn">
																			<svg xmlns="http://www.w3.org/2000/svg"
																				viewBox="0 0 14.93 15">
																				<title>añadir-favorito-bio</title>
																				<g id="Capa_2" data-name="Capa 2">
																					<g id="Guias_y_recursos"
																						data-name="Guias y recursos">
																						<path
																							d="M4.7,7.56a.42.42,0,0,1-.42-.42V3.5H14.51a.43.43,0,0,1,0,.85H5.13V7.14A.42.42,0,0,1,4.7,7.56Z"
																							class="cls-1"></path>
																						<path
																							d="M14.93,15H7.19a.43.43,0,0,1,0-.85h6.9V5.09a.42.42,0,1,1,.84,0Z"
																							class="cls-1"></path>
																						<path
																							d="M11.53,6a.42.42,0,0,1-.42-.43V2a1,1,0,0,0-.43-.84A1.86,1.86,0,0,0,9.6.85C9,.85,8,1.15,8,2V5.53a.42.42,0,1,1-.84,0V2A2.18,2.18,0,0,1,9.6,0,2.12,2.12,0,0,1,12,2V5.53A.43.43,0,0,1,11.53,6Z"
																							class="cls-1"></path>
																						<path
																							d="M8.74,8.11a2.23,2.23,0,0,0-1.63-.77A3.6,3.6,0,0,0,4.7,8.39,3.58,3.58,0,0,0,2.3,7.34a2.23,2.23,0,0,0-1.63.77A2.51,2.51,0,0,0,0,10.31C.32,12,2,13.69,4.52,15a.39.39,0,0,0,.18,0,.41.41,0,0,0,.19,0c2.57-1.27,4.2-3,4.48-4.65A2.51,2.51,0,0,0,8.74,8.11Zm-.21,2.06c-.1.66-.7,2.34-3.83,3.93C1.57,12.51,1,10.83.87,10.17a1.68,1.68,0,0,1,.4-1.47h0a1.39,1.39,0,0,1,1-.51h0a3.14,3.14,0,0,1,2,1.09.44.44,0,0,0,.6,0A3.15,3.15,0,0,1,7.09,8.18a1.41,1.41,0,0,1,1,.51h0A1.63,1.63,0,0,1,8.53,10.17Z"
																							class="cls-1"></path>
																					</g>
																				</g>
																			</svg>
																		</button>
																		<button type="button" data-toggle="modal"
																			data-target="#ModalProd" class="btn">
																			<svg xmlns="http://www.w3.org/2000/svg"
																				viewBox="0 0 15.03 15">
																				<title>visualizar-producto-bio</title>
																				<g id="Capa_2" data-name="Capa 2">
																					<g id="Guias_y_recursos"
																						data-name="Guias y recursos">
																						<path
																							d="M5.77,11.54A5.77,5.77,0,0,1,1.69,1.69,5.77,5.77,0,0,1,9.85,9.85,5.74,5.74,0,0,1,5.77,11.54ZM5.77.77A5,5,0,1,0,9.3,2.23,5,5,0,0,0,5.77.77Z"
																							class="cls-1"></path>
																						<path
																							d="M14.64,15a.4.4,0,0,1-.27-.11l-5.06-5a.37.37,0,0,1,0-.54.39.39,0,0,1,.55,0l5.06,5a.39.39,0,0,1,0,.55A.39.39,0,0,1,14.64,15Z"
																							class="cls-1"></path>
																					</g>
																				</g>
																			</svg>
																		</button>
																	</div>
																</div>
																<div class="product-content">
																	<a href="#" class="product-title">{{ favorite.name
																	}}</a>
																	<!-- <span class="product-info">500 g</span> -->

																	<div class="product-prices"
																		v-if="favorite.impuesto > 0">
																		<p>IVA INCLUIDO</p>
																	</div>
																	<div class="product-prices"
																		v-if="favorite.impuesto > 0">
																		<p> ${{ (favorite.calculado / tasadolar) |
																			FormatDolar }} / Bs {{ favorite.calculado |
																											FormatNumber }}</p>
																	</div>
																	<div class="product-prices" v-if="!favorite.impuesto">
																		<p> ${{ (favorite.price / tasadolar) | FormatDolar
																		}}
																			/ Bs {{ favorite.price | FormatNumber }}</p>
																	</div>
																</div>
																<div class="product-add">

																	<span class="product-info"
																		v-if="favorite.qty_avaliable > 0">Disponibles:
																		<b>{{ favorite.qty_avaliable }} en Stock</b></span>
																	<span class="product-info" v-else>Producto<b>
																			Agotado!</b></span>

																	<form action="">
																		<div class="product-quantity"
																			v-if="favorite.qty_avaliable > 0">
																			<label>Cantidad</label>
																			<div class="product-quantity-group">
																				<input :class="'cantidad_' + favorite.id"
																					type="text" name="quantity" value="1"
																					class="form-control"
																					v-model="cant_product[favorite.id]" @input="updateQuantity(favorite)">
																				<div class="product-quantity-buttons"><span
																						class="max-stock"
																						style="display: none;">{{
																							favorite.qty_avaliable }}</span>
																					<button type="button"
																						@click="increaseValue(favorite)"
																						class="btn"><img
																							src="assets/img/increase.png"
																							alt="Increase"></button>
																					<button type="button"
																						@click="decreaseValue(favorite)"
																						class="btn"><img
																							src="assets/img/decrease.png"
																							alt="decrease"></button>
																				</div>
																			</div>
																		</div>
																		<div class="product-buttons">
																			<button type="button"
																				class="btn btn-addcart-outline"
																				@click="addToCart(favorite, cant_product[favorite.id])"
																				v-if="favorite.qty_avaliable > 0">
																				<svg xmlns="http://www.w3.org/2000/svg"
																					viewBox="0 0 14.31 15">
																					<title>añadir-carrito-bio</title>
																					<g id="Capa_2" data-name="Capa 2">
																						<g id="Guias_y_recursos"
																							data-name="Guias y recursos">
																							<path
																								d="M13.2,11.58H8.83a.45.45,0,1,0,0,.9H10.1a.81.81,0,1,1-.81.81.46.46,0,0,0-.91,0,1.72,1.72,0,1,0,3.22-.81h1.6a.45.45,0,1,0,0-.9Z"
																								class="cls-1"></path>
																							<path
																								d="M14.21,3.33a.48.48,0,0,0-.35-.16H4V1.35A.45.45,0,0,0,3.67.92L.58,0A.45.45,0,0,0,0,.32a.45.45,0,0,0,.3.56l2.77.81v9.89H2.65a.45.45,0,0,0,0,.9h2.6a.81.81,0,1,1-.81.81.45.45,0,1,0-.9,0,1.72,1.72,0,1,0,1.71-1.71H4v-.77h8.52a.43.43,0,0,0,.22-.06.46.46,0,0,0,.22-.3L14.3,3.71A.48.48,0,0,0,14.21,3.33Zm-.9.74L13,5.39H4V4.07ZM4,9.91V8.59H10.1a.45.45,0,0,0,0-.9H4V6.29h8.87l-.72,3.62Z"
																								class="cls-1"></path>
																						</g>
																					</g>
																				</svg>
																				Añadir al carrito
																			</button>
																			<button type="button"
																				class="btn btn-addfavorite"
																				@click="removeToFavorite(favorite.id, favorite.users_id, index)">
																				<svg xmlns="http://www.w3.org/2000/svg"
																					viewBox="0 0 14.93 15">
																					<title>añadir-favorito-bio</title>
																					<g id="Capa_2" data-name="Capa 2">
																						<g id="Guias_y_recursos"
																							data-name="Guias y recursos">
																							<path
																								d="M4.7,7.56a.42.42,0,0,1-.42-.42V3.5H14.51a.43.43,0,0,1,0,.85H5.13V7.14A.42.42,0,0,1,4.7,7.56Z"
																								class="cls-1"></path>
																							<path
																								d="M14.93,15H7.19a.43.43,0,0,1,0-.85h6.9V5.09a.42.42,0,1,1,.84,0Z"
																								class="cls-1"></path>
																							<path
																								d="M11.53,6a.42.42,0,0,1-.42-.43V2a1,1,0,0,0-.43-.84A1.86,1.86,0,0,0,9.6.85C9,.85,8,1.15,8,2V5.53a.42.42,0,1,1-.84,0V2A2.18,2.18,0,0,1,9.6,0,2.12,2.12,0,0,1,12,2V5.53A.43.43,0,0,1,11.53,6Z"
																								class="cls-1"></path>
																							<path
																								d="M8.74,8.11a2.23,2.23,0,0,0-1.63-.77A3.6,3.6,0,0,0,4.7,8.39,3.58,3.58,0,0,0,2.3,7.34a2.23,2.23,0,0,0-1.63.77A2.51,2.51,0,0,0,0,10.31C.32,12,2,13.69,4.52,15a.39.39,0,0,0,.18,0,.41.41,0,0,0,.19,0c2.57-1.27,4.2-3,4.48-4.65A2.51,2.51,0,0,0,8.74,8.11Zm-.21,2.06c-.1.66-.7,2.34-3.83,3.93C1.57,12.51,1,10.83.87,10.17a1.68,1.68,0,0,1,.4-1.47h0a1.39,1.39,0,0,1,1-.51h0a3.14,3.14,0,0,1,2,1.09.44.44,0,0,0,.6,0A3.15,3.15,0,0,1,7.09,8.18a1.41,1.41,0,0,1,1,.51h0A1.63,1.63,0,0,1,8.53,10.17Z"
																								class="cls-1"></path>
																						</g>
																					</g>
																				</svg>
																				Quitar de Favoritos
																			</button>
																			<button type="button" class="btn btn-view"
																				@click="getProduct(favorite)"
																				data-toggle="modal"
																				data-target="#ModalProd">
																				<svg xmlns="http://www.w3.org/2000/svg"
																					viewBox="0 0 15.03 15">
																					<title>visualizar-producto-bio</title>
																					<g id="Capa_2" data-name="Capa 2">
																						<g id="Guias_y_recursos"
																							data-name="Guias y recursos">
																							<path
																								d="M5.77,11.54A5.77,5.77,0,0,1,1.69,1.69,5.77,5.77,0,0,1,9.85,9.85,5.74,5.74,0,0,1,5.77,11.54ZM5.77.77A5,5,0,1,0,9.3,2.23,5,5,0,0,0,5.77.77Z"
																								class="cls-1"></path>
																							<path
																								d="M14.64,15a.4.4,0,0,1-.27-.11l-5.06-5a.37.37,0,0,1,0-.54.39.39,0,0,1,.55,0l5.06,5a.39.39,0,0,1,0,.55A.39.39,0,0,1,14.64,15Z"
																								class="cls-1"></path>
																						</g>
																					</g>
																				</svg>
																				Ver Producto
																			</button>
																		</div>
																	</form>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>

										</div>
										<!-- <div class="tab-pane fade" id="order-in-process" role="tabpanel" aria-labelledby="order-in-process-tab">
											<div class="order-table">
												<div class="thead-bio">
													<div class="row">
														<div class="col-6 col-lg-20">Número de Pedido</div>
														<div class="col-6 col-lg-20">Fecha</div>
														<div class="col-6 col-lg-20">Dirección de entrega</div>
														<div class="col-6 col-lg-20">Fecha de entrega</div>
														<div class="col-6 col-lg-20">Estado</div>
													</div>
												</div>
												<div class="row">
													<div class="col-12 col-lg-20">
														<button class="btn" type="button" data-toggle="modal" data-target="#ModalOrder">
															<span class="order-span">Número de Pedido</span> #2235
														</button>
													</div>
													<div class="col-6 col-lg-20"><span class="order-span">Fecha</span>01/01/2020</div>
													<div class="col-6 col-lg-20">
														<button class="btn" type="button" data-toggle="tooltip" data-placement="bottom" title="Urb Zaragoza, Avenida 1 entre calles 10 y 11, casa 57, Araure, Estado Portugesa 3303 (al lado del bodegón Girasol)">
															<span class="order-span">Dirección de entrega</span>Mi casa
														</button>
													</div>
													<div class="col-6 col-lg-20"><span class="order-span">Fecha de entrega</span>04/01/2020</div>
													<div class="col-6 col-lg-20">
														<span class="order-span">Estado</span>
														<div class="process-status in-process" data-toggle="tooltip" data-placement="bottom" title="Su pedido se está procesando para ser enviado">
															<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20.12 19.97"><defs></defs><title>en-proceso-bio-mercados</title><g id="Capa_2" data-name="Capa 2"><g id="Perfil_de_Usuario" data-name="Perfil de Usuario"><path class="cls-1" d="M12.09,18.25l-.5.11A.81.81,0,1,0,11.88,20l.6-.13a.81.81,0,0,0-.39-1.57Z"/><path class="cls-1" d="M18.07,7.41a.9.9,0,0,0,.3.41.79.79,0,0,0,.72.1.8.8,0,0,0,.52-1c-.07-.19-.14-.39-.21-.57a.81.81,0,0,0-1.51.6,4.68,4.68,0,0,1,.18.48Z"/><path class="cls-1" d="M14.72,17.1l-.44.27a.8.8,0,0,0-.3,1.1.86.86,0,0,0,.24.26.83.83,0,0,0,.87,0c.17-.1.35-.21.52-.33a.8.8,0,1,0-.89-1.34Z"/><path class="cls-1" d="M20.11,9.67a.81.81,0,0,0-1.62.06c0,.17,0,.35,0,.52a.8.8,0,0,0,.34.68.77.77,0,0,0,.45.14.8.8,0,0,0,.82-.79c0-.2,0-.41,0-.61Z"/><path class="cls-1" d="M9.56,3.52a.66.66,0,0,0-.65.66V10.7l6,3.08a.66.66,0,0,0,.88-.28.65.65,0,0,0-.28-.88L10.22,9.9V4.18a.67.67,0,0,0-.66-.66Z"/><path class="cls-1" d="M19.13,12a.82.82,0,0,0-1,.53c-.05.17-.1.33-.16.49a.81.81,0,0,0,.28.95.76.76,0,0,0,.18.09.82.82,0,0,0,1.05-.46c.07-.19.14-.39.2-.58a.82.82,0,0,0-.53-1Z"/><path class="cls-1" d="M8.56,18.37a8.33,8.33,0,0,1-2.07-.66l0,0c-.16-.07-.31-.15-.46-.23H6c-.27-.15-.54-.32-.8-.5a8.46,8.46,0,0,1,0-13.83l0,0A8.48,8.48,0,0,1,14.74,3L14.1,4c-.17.26-.06.44.24.41l2.75-.24a.46.46,0,0,0,.41-.59L16.76.87c-.08-.3-.29-.33-.47-.08l-.63.92A10,10,0,0,0,8.34.15L7.57.31h0A9.94,9.94,0,0,0,2,4l0,0-.14.19-.21.32,0,0A10.08,10.08,0,0,0,0,10.49v0c0,.2,0,.4,0,.61v0c0,.2.05.4.09.61A10,10,0,0,0,3,17.19H3a9.71,9.71,0,0,0,1.29,1.08,10,10,0,0,0,4,1.68.81.81,0,1,0,.28-1.59Z"/><path class="cls-1" d="M17.94,15a.8.8,0,0,0-1.13.16l-.32.4a.81.81,0,0,0,.09,1.14l.06,0a.81.81,0,0,0,1.08-.14l.38-.48A.8.8,0,0,0,17.94,15Z"/></g></g></svg>
															En Proceso
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-12 col-lg-20">
														<button class="btn" type="button" data-toggle="modal" data-target="#ModalOrder">
															<span class="order-span">Número de Pedido</span> #4452
														</button>
													</div>
													<div class="col-6 col-lg-20"><span class="order-span">Fecha</span>23/12/2019</div>
													<div class="col-6 col-lg-20">
														<button class="btn" type="button" data-toggle="tooltip" data-placement="bottom" title="Inversiones JM C.A, Sector Centro, Av 34 entre calles 8 y 9, Local H-21, Acarigua, Estado Portugesa 3301 (Frente a Traki)">
															<span class="order-span">Dirección de entrega</span>Mi Oficina
														</button>
													</div>
													<div class="col-6 col-lg-20"><span class="order-span">Fecha de entrega</span>26/12/2019</div>
													<div class="col-6 col-lg-20">
														<span class="order-span">Estado</span>
														<div class="process-status en-route" data-toggle="tooltip" data-placement="bottom" title="Su pedido ya esta en camino hacia el destino">
															<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 26.09 20"><defs></defs><title>en-camino-bio-mercados</title><g id="Capa_2" data-name="Capa 2"><g id="Perfil_de_Usuario" data-name="Perfil de Usuario"><path class="cls-1" d="M26,11l-5.4-5.4a1.26,1.26,0,0,0-.92-.38H12.17v.87h2.18v6.52h.87V6.09h4.42a.45.45,0,0,1,.31.12l.74.75h-2a.87.87,0,0,0-.87.87v3.91a.87.87,0,0,0,.87.87h6.52v3.48a.44.44,0,0,1-.44.43h-.9a3,3,0,0,0-6,0H11.7a3,3,0,0,0-6,0H4.78a.43.43,0,0,1-.43-.43V12.17H3.48v3.92a1.3,1.3,0,0,0,1.3,1.3h.91a3,3,0,0,0,.88,1.74H0V20H20.87a3,3,0,0,0,3-2.61h.9a1.31,1.31,0,0,0,1.31-1.3V11.3A.43.43,0,0,0,26,11ZM6.52,17A2.18,2.18,0,1,1,8.7,19.13,2.19,2.19,0,0,1,6.52,17Zm4.3,2.17a3,3,0,0,0,.88-1.74h6.16a3.13,3.13,0,0,0,.88,1.74Zm10.05,0A2.18,2.18,0,1,1,23,17a2.17,2.17,0,0,1-2.17,2.17ZM18.7,11.74V7.83h2.86l3.66,3.65v.26Z"/><rect class="cls-1" x="8.26" y="16.52" width="0.87" height="0.87"/><rect class="cls-1" x="20.43" y="16.52" width="0.87" height="0.87"/><rect class="cls-1" y="15.22" width="2.17" height="0.87"/><rect class="cls-1" x="0.87" y="13.48" width="1.3" height="0.87"/><rect class="cls-1" x="1.3" y="11.74" width="0.87" height="0.87"/><path class="cls-1" d="M5.65,11.3A5.65,5.65,0,1,0,0,5.65,5.65,5.65,0,0,0,5.65,11.3ZM5.65.87A4.78,4.78,0,1,1,.87,5.65,4.78,4.78,0,0,1,5.65.87Z"/><path class="cls-1" d="M5.65,9.57A.44.44,0,0,0,6,9.44C6.24,9.16,8.7,6.65,8.7,4.78a3,3,0,0,0-6.09,0c0,1.87,2.45,4.38,2.73,4.66a.48.48,0,0,0,.31.13Zm0-7A2.18,2.18,0,0,1,7.83,4.78c0,1.12-1.37,2.84-2.18,3.72-.8-.88-2.17-2.6-2.17-3.72A2.17,2.17,0,0,1,5.65,2.61Z"/><path class="cls-1" d="M7,4.78A1.31,1.31,0,1,0,5.65,6.09,1.31,1.31,0,0,0,7,4.78Zm-1.74,0a.43.43,0,0,1,.43-.43.44.44,0,0,1,.44.43.44.44,0,0,1-.44.44.44.44,0,0,1-.43-.44Z"/><rect class="cls-1" x="16.52" y="13.48" width="1.74" height="0.87"/></g></g></svg>
															En Camino
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="tab-pane fade" id="complete-orders" role="tabpanel" aria-labelledby="complete-orders-tab">
											<div class="order-table">
												<div class="thead-bio">
													<div class="row">
														<div class="col-6 col-lg-20">Número de Pedido</div>
														<div class="col-6 col-lg-20">Fecha</div>
														<div class="col-6 col-lg-20">Dirección de entrega</div>
														<div class="col-6 col-lg-20">Fecha de entrega</div>
														<div class="col-6 col-lg-20">Estado</div>
													</div>
												</div>
												<div class="row">
													<div class="col-12 col-lg-20">
														<button class="btn" type="button" data-toggle="modal" data-target="#ModalOrder">
															<span class="order-span">Número de Pedido</span> #3602
														</button>
													</div>
													<div class="col-6 col-lg-20"><span class="order-span">Fecha</span>05/12/2019</div>
													<div class="col-6 col-lg-20">
														<button class="btn" type="button" data-toggle="tooltip" data-placement="bottom" title="Urb Zaragoza, Avenida 1 entre calles 10 y 11, casa 57, Araure, Estado Portugesa 3303 (al lado del bodegón Girasol)">
															<span class="order-span">Dirección de entrega</span>Mi casa
														</button>
													</div>
													<div class="col-6 col-lg-20"><span class="order-span">Fecha de entrega</span>08/12/2019</div>
													<div class="col-6 col-lg-20">
														<span class="order-span">Estado</span>
														<div class="process-status complete" data-toggle="tooltip" data-placement="bottom" title="El pedido ya ha sido entregado">
															<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24.75 19.44"><defs></defs><title>confirmar-bio-mercados</title><g id="Capa_2" data-name="Capa 2"><g id="Perfil_de_Usuario" data-name="Perfil de Usuario"><path class="cls-1" d="M20.1.4,9,11.51,4.64,7.16a1.36,1.36,0,0,0-1.92,0L.4,9.48a1.36,1.36,0,0,0,0,1.92L8,19A1.35,1.35,0,0,0,10,19l14.4-14.4a1.36,1.36,0,0,0,0-1.92L22,.4A1.37,1.37,0,0,0,20.1.4Z"/></g></g></svg>
															Completado
														</div>
													</div>
												</div>
											</div>
										</div> -->
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<ModalOrder :tasadolar="currency_rate" :order="tmpOrder"></ModalOrder>
		<ModalCalificacion :order="tmpOrder"></ModalCalificacion>
		<ModalProducto :tasadolar="tasadolar" :product="oneproduct" :user_id="userlogged.id"></ModalProducto>
	</section>
</template>
<script>
import ModalOrder from './ModalOrder.vue';
import ModalProducto from './ModalProducto.vue';
import ModalCalificacion from './ModalCalificacion.vue';
import DireccionHabitacion from './DireccionHabitacion.vue';
import DireccionUser from './DireccionUser.vue';
import { error } from 'jquery';
export default {
	data() {
		return {
			oneproduct: {},
			favorites: [],
			avatar: '',
			cant_favorites: 0,
			get_tab: '',
			userData: [],
			states: [],
			regions: [],
			cities: [],
			Allstates: [],
			Allregions: [],
			Allcities: [],
			orders: [],
			data_products: [],
			en_proceso: [],
			completos: [],
			newDirection: 'none',
			cant_product: [],
			currency_rate: 0,
			tmpOrder: {},
			dataLoaded: false,
		}
	},
	components: {
		ModalOrder,
		ModalProducto,
		ModalCalificacion,
		DireccionHabitacion,
		DireccionUser,
	},
	props: {
		userlogged: Object,
		tasadolar: Number
	},
	methods: {

		updateDetails() {

      this.update_profile(this.userData);
    
	},

		updateQuantity(favorite) {
            console.log("esto es product", favorite);
            const maxStock = favorite.qty_avaliable;
            const minStock = 1; // Valor mínimo permitido
            const enteredQuantity = this.cant_product[favorite.id];

                if (enteredQuantity < minStock) {
                    this.cant_product[favorite.id] = minStock;
                } else if (enteredQuantity > maxStock) {
                    this.cant_product[favorite.id] = maxStock;
                }
        }, 
		
	 async fetchData() {
    try {
		// Cambiar la IP Local a la URLHOME
        const response = await axios.get(URLHOME+'/api_rapida.php?evento=listarProductosAll');
        // Verificar si la solicitud fue exitosa y si hay datos recibidos
		console.log(response);
        if (response.data) {
			console.log("Esto es reponse",response.data);
			response.data.tasadolar = this.tasadolar;

            // Convertir el texto JSON en un objeto
            // Guardar los datos de productos en el local storage con la clave 'productosb'
            window.localStorage.setItem('productosb', JSON.stringify(response.data));
            console.log('Datos de productos guardados en el local storage:', response);
        } else {
            console.error('No se pudo obtener los datos de productos o la solicitud fue fallida:', response.data.message);
        }
    } catch (error) {
        console.error('Error al realizar la solicitud:', error);
    }
},
		refreshOrders() {
	this.getPedidos();
  },

		getAmountBW: function (user_id) {
			axios.get(URLHOME+ 'api/getAmountBW/' + user_id).then(datos => {
				this.userData.saldo = datos.data;
				console.log("userData:", this.userData);

			});
		},
		getProduct: function (objP) {
			this.oneproduct = objP;
		},
		getOrder: async function (id) {
			axios.get(URLHOME+ + 'api/orders/' + id).then(datos => {
				const order = datos.data.data.order[0];
				const products = datos.data.data.products;
				this.tmpOrder = {
					id: order.id,
					num_order: order.id,
					products: products,
					total: Number(order.total_pay),
					direction: order.order_address_id,
					direction_text: order.address + " " + order.sector + " " + order.nro_home + " " + order.zip_code + " " + order.reference_point,
					status: order.namestatus
				};

				JSON.parse(order.rate_json).forEach(a => {
					if (a.id == 1) {
						this.currency_rate = Number(a.rate);
					}
				});

			})
		},
		PayOrder(id) {
			window.location.href = location.href + "?orders_id=" + id;
		},
		async cancelOrder(id) {
			Swal.fire({
				title: 'Bio en Línea',
				text: "¿Está seguro de cancelar su ordern?",
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Eliminar!',
				cancelButtonText: 'Cancelar'
			}).then((result) => {
				if (result.value) {
					axios.get(URLSERVER + "api/orders/cancelar/" + id).then((data) => {
						if (data.data.data == 1) {
							Swal.fire(
								'Bio en Línea',
								'Su orden ha sido cancelada exitosamente',
								'success'
							).then(result => {
								location.href = "/profile?tab=my-orders";
							});
						}
					});
				}
			});
		},
		getFavorites: async function () {
			const response = await axios.get(URLHOME+ 'api/favorites');
			this.favorites = response.data.data;
			this.cant_favorites = response.data.data.length;
		},
		getTabUrl: function () {
			let tab = [];
			window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function (a, name, value) {
				tab[name] = value;
			});

			if (tab['tab'] == 'my-favorites') {
				this.$refs.favoriteLink.click();
			} else if (tab['tab'] == 'my-orders') {
				this.$refs.ordersLink.click();
			} else if (tab['tab'] == "my-address") {
				this.$refs.addressLink.click();
			}
		},
		removeToFavorite(id, user_id, index) {
			Swal.fire({
				title: 'Eliminar Favorito',
				text: "¿Desea eliminar su producto de Favoritos?",
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Eliminar!',
				cancelButtonText: 'Cancelar'
			}).then((result) => {
				if (result.value) {
					const products_id = id;
					const users_id = this.userData.id;

					this.favorites.splice(index, 1);
					this.cant_favorites = this.favorites.length;

					axios.post(URLHOME+ 'api/favorites/delete', {
						products_id: products_id,
						user_id: users_id
					})
						.then(function (response) {
							console.log(response.data);
							EventBus.$emit("update_cantFavorite", response.data);
						})
						.catch(function (error) {
							console.log(error);
						});
				}
			});
		},
		update_profile(user) {
				const that = this;
				console.log(user);

				const user_data = {
					...user,
				};
				console.log("esto es user_data", user_data);

				const maxAttempts = 5; // Número máximo de intentos
				const retryDelay = 1000; // Retraso inicial en ms

				async function makeRequest(attempts = 0) {
					try {
					const response = await axios.post(URLHOME+ 'api/update_profile', {
						user_data: user_data,
					});
					console.log(response.data);
					that.userData = user_data;
					fetch(URLHOME+"api_rapida.php?evento=obtenerTodo");
					Swal.fire(
						'Perfil',
						'Tus datos han sido guardado exitosamente',
						'success'
					);
					} catch (error) {
					if (error.response && error.response.status === 429 && attempts < maxAttempts) {
						console.warn(`Intento ${attempts + 1} fallido. Esperando ${retryDelay * (attempts + 1)}ms antes de reintentar.`);
						setTimeout(() => makeRequest(attempts + 1), retryDelay * (attempts + 1));
					} else {
						console.log("esto es el error", error);
						Swal.fire(
						'Error',
						'Hubo un problema al guardar tus datos. Por favor, intenta de nuevo más tarde.',
						'error'
						);
					}
				  }
				}

				makeRequest();
		},

		update_password(user) {
				const that = this;
				console.log(user);

				const user_data = {
					...user,
				};
				const maxAttempts = 5; // Número máximo de intentos
				const retryDelay = 1000; // Retraso inicial en ms
				
				// Validación de campos de contraseñas vacios
				if (!user_data.newpassword || !user_data.newpasswordconfirm || !user_data.currentlypassword) {
					Swal.fire(
						'Error',
						'Por favor, completa los campos requeridos.',
						'error'
					);
					return; // Salir de la función si la validación falla

				}

				// Validación de que las contraseñas sean iguales
				if (user_data.newpassword !== user_data.newpasswordconfirm) {
					Swal.fire(
						'Error',
						'Las contraseñas no coinciden. Por favor, verifica e intenta de nuevo.',
						'error'
					);
					return; // Salir de la función si las contraseñas no coinciden
				}

				// Validación de caracteres y signos especiales
            	const passwordPattern = /^(?=.*[!@#$%^&*(),.?":{}|<>])(?=.{9,})/; // Al menos un carácter especial y más de 8 caracteres
				if (!passwordPattern.test(user_data.newpassword)) {
					Swal.fire(
						'Error',
						'La nueva contraseña debe tener más de 8 caracteres y al menos un signo especial.',
						'error'
					);
					return; // Salir de la función si la validación de la contraseña falla
				}

				// Validación de la contraseña actual
				async function validateCurrentPassword(attempts = 0) {
					const password = new FormData()
					password.append("password",user_data.currentlypassword)
					try {
						const response = await axios.post(URLHOME+'api_rapida.php', password,
							{
							params: {
    								evento: 'verifyPassword'
								}
							},
						);
						if (response.data.isValid){
							return response.data.isValid;
						}
					} 
					catch (error) {
						if (error.response && error.response.status === 429 && attempts < maxAttempts) {
							console.warn(`Intento ${attempts + 1} fallido. Esperando ${retryDelay * (attempts + 1)}ms antes de reintentar.`);
							setTimeout(() => verifyPassword(attempts + 1), retryDelay * (attempts + 1));
						} else {
							console.log("Error en la verificación de contraseña:", error);
							Swal.fire(
								'Error',
								'Hubo un problema al verificar tu contraseña. Por favor, intenta de nuevo más tarde.',
								'error'
							);
							return;
						}
					}
				}
				validateCurrentPassword().then(isValid => {
        			if (isValid) {
            			// Proceder con la actualización de la contraseña
            			changePassword();
        			} 
					else {
						Swal.fire(
							'Error',
							'Contraseña actual inválida. Por favor, intenta de nuevo...',
							'error'
						);
						return;
        			}
				})

				async function changePassword(attempts = 0) {
					const formData = new FormData();
					formData.append("email",user_data.email);
					formData.append("password",user_data.newpassword);
					axios.post(URLHOME+'api_rapida.php?evento=changePassword',formData).then( (data) => {
							Swal.fire("EosCommerce","¡Clave Cambiada con Exito!","success").then( result => {
								document.location.href = '/';
							});
						}).catch(error => {
							if (error.response && error.response.status === 429 && attempts < maxAttempts) {
								console.warn(`Intento ${attempts + 1} fallido. Esperando ${retryDelay * (attempts + 1)}ms antes de reintentar.`);
								setTimeout(() => verifyPassword(attempts + 1), retryDelay * (attempts + 1));
							} 
							else {
								console.log("Error al actualizar la contraseña:", error);
								Swal.fire({
										icon: 'error',
										title: 'Error',
										text: "Hubo un error al actualizar la contraseña. Intente de nuevo más tarde.",
									});
							return false;
						}
					});
            	}
		},

		async getStates() {
			const response = await axios.get(URLSERVER + "api/states");
			console.log("esto es la respuesta", response);
			this.states.push(response.data.data);

			const response2 = await axios.get(URLSERVER + "api/Allstates");
			console.log("esto es la response2", response2);
			this.Allstates = response2.data.data;
			console.log("esto es this.allStates ", this.Allstates);
		},
		async getRegions() {
			const response = await axios.get(URLSERVER + "api/regions");
			this.regions = response.data.data;

			const { data } = await axios.get(URLSERVER + "api/Allregions");
			this.Allregions = data.data;
		},
		async getCities() {
			const response = await axios.get(URLSERVER + "api/cities");
			this.cities = response.data.data;

			const { data } = await axios.get(URLSERVER + "api/Allcities");
			console.log("esto es la respon all cities", data);
			this.Allcities = data.data;
		},
	
		
		async loadMunicipioHab(event) {
			const state_id = event.target.value;
			const response = await axios.get(URLSERVER + "api/regions/state/" + state_id);
			this.Allregions = response.data.data;
		},
		async loadParroquiaHab(event) {
			const region_id = event.target.value;
			const response = await axios.get(URLSERVER + "api/cities/region/" + region_id);
			this.Allcities = response.data.data;
		},
		async getPedidos() {
			const response = await axios.get(URLSERVER + "api/orders");
			this.orders = response.data.data;

			this.completos = this.orders.filter(lista => {
				return lista.namestatus == "Entregado"
			});

			this.en_proceso = this.orders.filter(lista => {
				return lista.namestatus != "Entregado"
			});
		},
		repeatOrder(id) {
			const _this = this;
			Swal.fire({
				title: 'Repertir orden',
				text: "Al repetir la orden, borrara su carrito actual, ¿Deséa repetir la order " + id + "?",
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Repetir!',
				cancelButtonText: 'Cancelar'
			}).then((result) => {
				axios.get(URLSERVER + "api/orders/products/" + id).then((response) => {
					_this.dropCart();
					response.data.data.forEach((a, b) => {
						console.log("a::> ", a);
						_this.addToCart(a, a.cantidad);
					});

					Swal.fire(
						'Agregado!',
						'La orden ha sido agregada al carrito.',
						'success'
					);
				});


			});
		},
		async devolucion(id) {
			const response = await axios.get(URLSERVER + "api_rapida.php?evento=devolucion&orders_id" + id);
			Swal.fire(
				'Devolución!',
				'Su solicitud de devolución ha sido procesada. Será contactado muy pronto',
				'success'
			);

		},
		async calificar(id) {
			console.log("funciona");
		},
	
		
		increaseValue(product) {
			const productID = product.id;
			const qty_avaliable = product.qty_avaliable;
			if (this.cant_product[productID] < qty_avaliable) {
				this.cant_product[productID]++;
			}
			$('.cantidad_' + productID).val(this.cant_product[productID]);
			$('.cantidad_' + productID)[0].dispatchEvent(new CustomEvent('input'));
		},
		decreaseValue(product) {
			const productID = product.id;
			const qty_avaliable = product.qty_avaliable;
			if (this.cant_product[productID] > 1) {
				this.cant_product[productID]--;
			}
			$('.cantidad_' + productID).val(this.cant_product[productID]);
			$('.cantidad_' + productID)[0].dispatchEvent(new CustomEvent('input'));
		},
		uploadPhoto() {
			const image = event.target.files[0];
			this.base64Image(image);
		},
		base64Image(fileObject) {
			const reader = new FileReader();
			reader.onload = (e) => {
				this.avatar = e.target.result;
				this.sendPhoto();
			}
			reader.readAsDataURL(fileObject);
		},
		async sendPhoto() {
			const { avatar } = this;
			let data = new FormData();
			data.append("image", avatar);
			const response = await axios.post(URLSERVER + "api_rapida.php?evento=actualizarFotoPerfil&from=web", data);
		}
	},
	mounted() {

	
		this.fetchData();
		this.getFavorites();
		this.getTabUrl();
		this.getStates();
		this.getRegions();
		this.getCities();
		this.getPedidos();
		console.log("esto es el userLLoger", this.userlogged);
		this.userData = this.userlogged;
		console.log("esto es userData", this.userData);
		this.getAmountBW(this.userData.id);
		console.log("this.userData::> ", this.userData);
	
	},
	async created() {
  try {
    // Realizar la petición para obtener los datos y esperar la respuesta
    const response = await fetch(URLHOME+ "api_rapida.php?evento=obtenerTodo");
	if(response.ok){

			this.dataLoaded = true;

	}
    // Convertir la respuesta a formato JSON
    const data = await response.json();

	

	console.log("esto es data extraida", data);
	
    // Verificar si habDirection está vacío
    if (!this.userlogged.habDirection) {
      // Si habDirection está vacío, inicializa sus propiedades
      this.userlogged.habDirection = {
        state_id: '',
        region_id: '',
        city_id: '',
        urb: '',
        sector: '',
        nro_home: '',
        zip_code: '',
        reference_point: ''
      };

    } else {
      // Si habDirection tiene datos, asigna sus propiedades al objeto userlogged.habDirection
      this.userlogged.habDirection = {
        state_id: data.habDirection[0].state_id,
        region_id: data.habDirection[0].region_id,
        city_id: data.habDirection[0].city_id,
        urb: data.habDirection[0].urb,
        sector: data.habDirection[0].sector,
        nro_home: data.habDirection[0].nro_home,
        zip_code: data.habDirection[0].zip_code,
        reference_point: data.habDirection[0].reference_point
      };

    }


    // Asigna el objeto userlogged a userData
    this.userData = this.userlogged;

    // Inicializa cant_product con valores predeterminados
    for (let i = 0; i < 2000; i++) {
      this.cant_product[i] = 1;
    }

    // Verifica el resultado
    console.log("this.userData::> ", this.userData);
  } catch (error) {
    console.error("Error al obtener datos:", error);
  }


},




}
</script>
