<div class="card shadow-sm">    
    <div class="card-body">    	
    	<div class="row">

    		<div class="col-md-12">
    			<h2 class="mb-5">Datos del promovido</h2>
    			<div class="row">	
    				<div class="row mb-7">
						<div class="col-md-4 col-xl-4">
							<div class="position-relative d-flex align-items-center">
								<div class="symbol symbol-20px me-4 position-absolute ms-4">
									<i class="fa fa-globe"></i>
								</div>
								<select class="form-select ps-12 removeIsInvalidSelect" aria-label="Distrito" id="district_id" name="district_id"></select>
							</div>
						</div>

						<div class="col-md-4 col-xl-4" id="dvMunicipality" style="display: none;">
							<div class="position-relative d-flex align-items-center">
								<div class="symbol symbol-20px me-4 position-absolute ms-4">
									<i class="fa fa-location-dot"></i>
								</div>
								<select class="form-select ps-12 removeIsInvalidSelect" aria-label="Distrito" id="municipality_id" name="municipality_id"></select>
							</div>
						</div>

						<div class="col-md-4 col-xl-4" id="dvCoordinators" style="display: none;">
							<div class="position-relative d-flex align-items-center">
								<div class="symbol symbol-20px me-4 position-absolute ms-4">
									<i class="fa fa-people-arrows"></i>
								</div>
								<select class="form-select ps-12 removeIsInvalidSelect" aria-label="Distrito" id="coordinator_id" name="coordinator_id"></select>
							</div>
						</div>
					</div>

					<h2 class="mb-5">Datos del promovido</h2>

					<div class="row">
						<div class="col-md-8 col-xl-8">
							<div class="row mt-7 mb-7">
								<div class="col-md-4 col-xl-4">
									<div class="position-relative d-flex align-items-center">
										<div class="symbol symbol-20px me-4 position-absolute ms-4">
											<i class="fas fa-user-alt"></i>
										</div>
										<input class="form-control form-control-lg ps-12 removeIsInvalid" type="text" placeholder="Nombre(s)" name="nombre" id="nombre" />
									</div>							
								</div>
								<div class="col-md-4 col-xl-4">							
									<div class="position-relative d-flex align-items-center">
										<div class="symbol symbol-20px me-4 position-absolute ms-4">
											<i class="fas fa-user-alt"></i>
										</div>
										<input class="form-control form-control-lg ps-12 removeIsInvalid" type="text" placeholder="Primer apellido" name="primer_apellido" id="primer_apellido"  />
									</div>							
								</div>
								<div class="col-md-4 col-xl-4">							
									<div class="position-relative d-flex align-items-center">
										<div class="symbol symbol-20px me-4 position-absolute ms-4">
											<i class="fas fa-user-alt"></i>
										</div>
										<input class="form-control form-control-lg ps-12 removeIsInvalid" type="text" placeholder="Segundo apellido" name="segundo_apellido" id="segundo_apellido"  />
									</div>							
								</div>
							</div>

							<div class="row mt-7 mb-7">
								<div class="col-md-4 col-xl-4">
									<div class="position-relative d-flex align-items-center">
										<div class="symbol symbol-20px me-4 position-absolute ms-4">
											<i class="fas fa-venus-mars"></i>
										</div>
										<select class="form-select ps-12 removeIsInvalidSelect" aria-label="Sexo" id="sexo" name="sexo">
										    <option value="">--- Sexo ---</option>
										    <option value="1">Hombre</option>
										    <option value="2">Mujer</option>
										</select>
									</div>
								</div>

								<div class="col-md-4 col-xl-4">
									<div class="position-relative d-flex align-items-center">
										<div class="symbol symbol-20px me-4 position-absolute ms-4">
											<i class="fa fa-calendar"></i>
										</div>
										<input class="form-control ps-12 flatpickr-input removeIsInvalid" placeholder="Fecha de nacimiento" name="fecha_nacimiento" id="fecha_nacimiento" />
									</div>
								</div>

								<div class="col-md-4 col-xl-4">							
									<div class="position-relative d-flex align-items-center">
										<div class="symbol symbol-20px me-4 position-absolute ms-4">
											<i class="fa fa-hashtag"></i>
										</div>
										<input class="form-control form-control-lg ps-12 removeIsInvalid" type="text" placeholder="Edad" name="edad" id="edad"  />
									</div>							
								</div>
							</div>

							<div class="row mt-7 mb-7">
								<div class="col-md-4 col-xl-4">							
									<div class="position-relative d-flex align-items-center">
										<div class="symbol symbol-20px me-4 position-absolute ms-4">
											<i class="far fa-credit-card"></i>
										</div>
										<input class="form-control form-control-lg ps-12 removeIsInvalid" type="text" placeholder="Vigencia elector" name="vigencia_elector" id="vigencia_elector"  />
									</div>							
								</div>

								<div class="col-md-4 col-xl-4">							
									<div class="position-relative d-flex align-items-center">
										<div class="symbol symbol-20px me-4 position-absolute ms-4">
											<i class="far fa-credit-card"></i>
										</div>
										<input class="form-control form-control-lg ps-12 removeIsInvalid" type="text" placeholder="Clave elector" name="clave_elector" id="clave_elector"  />
									</div>							
								</div>

								<div class="col-md-4 col-xl-4">
									<div class="position-relative d-flex align-items-center">
										<div class="symbol symbol-20px me-4 position-absolute ms-4">
											<i class="fas fa-id-badge"></i>
										</div>
										<input class="form-control form-control-lg ps-12 removeIsInvalid" type="text" placeholder="CURP" name="curp" id="curp"  />
									</div>
								</div>
							</div>

							<div class="row mt-7 mb-7">
								<div class="col-md-4 col-xl-4">
									<div class="position-relative d-flex align-items-center">
										<div class="symbol symbol-20px me-4 position-absolute ms-4">
											<i class="fas fa-person-booth"></i>
										</div>
										<input class="form-control form-control-lg ps-12 removeIsInvalid" type="text" placeholder="Sección elector" name="seccion_elector" id="seccion_elector"  />
									</div>					
								</div>

								<div class="col-md-8 col-xl-8">
									<div class="position-relative d-flex align-items-center">
										<div class="symbol symbol-20px me-4 position-absolute ms-4">
											<i class="fa fa-map-marked-alt"></i>
										</div>
										<input class="form-control form-control-lg ps-12 removeIsInvalid" type="text" placeholder="Domicilio" name="domicilio" id="domicilio" />
									</div>								
								</div>	
							</div>

							<div class="row mt-7 mb-7">
								<div class="col-md-4 col-xl-4">
			    					<div class="position-relative d-flex align-items-center">
										<div class="symbol symbol-20px me-4 position-absolute ms-4">
											<i class="fas fa-route"></i>
										</div>
										<input class="form-control form-control-lg ps-12" type="text" placeholder="Colonia" name="colonia" id="colonia" />
									</div>
								</div>

								<div class="col-md-2 col-xl-2">
									<div class="position-relative d-flex align-items-center">
										<div class="symbol symbol-20px me-4 position-absolute ms-4">
											<i class="fas fa-map-marker-alt"></i>
										</div>
										<input class="form-control form-control-lg ps-12 removeIsInvalid" type="text" placeholder="C.P." name="cp" id="cp" />
									</div>	
								</div>

								<div class="col-md-2 col-xl-2">
									<div class="position-relative d-flex align-items-center">
										<div class="mb-2">
											<label class="form-label fw-semibold">¿ Afiliación ?</label>
											<div class="d-flex">
												<label class="form-check form-check-sm form-check-custom form-check-solid me-5">
													<input class="form-check-input" type="radio" value="0" checked="checked" id="rdNo" name="afiliacion"  />
													<span class="form-check-label">NO</span>
												</label>
												<label class="form-check form-check-sm form-check-custom form-check-solid">
													<input class="form-check-input" type="radio" value="1" id="rdSi" name="afiliacion" />
													<span class="form-check-label">SI</span>
												</label>
											</div>
										</div>
									</div>
								</div>

								<div class="col-md-4 col-xl-4" id="dvOrganizacion" style="display: none;">
									<div class="position-relative d-flex align-items-center">
										<div class="symbol symbol-20px me-4 position-absolute ms-4">
											<i class="fa fa-building"></i>
										</div>
										<select class="form-select ps-12 removeIsInvalidSelect" aria-label="Organizacion politica" id="id_organizacion" name="id_organizacion"></select>
									</div>
								</div>
							</div>

							<div class="row mt-7 mb-7">

								<div class="col-md-4 col-xl-4">
									<div class="position-relative d-flex align-items-center">
										<div class="symbol symbol-20px me-4 position-absolute ms-4">
											<i class="fa fa-school"></i>
										</div>
										<select class="form-select ps-12 removeIsInvalidSelect" aria-label="Estudios" id="school_grade_id" name="school_grade_id"></select>
									</div>
								</div>

								<div class="col-md-4 col-xl-4">
									<div class="position-relative d-flex align-items-center">
										<div class="symbol symbol-20px me-4 position-absolute ms-4">
											<i class="fa fa-briefcase"></i>
										</div>
										<select class="form-select ps-12 removeIsInvalidSelect" aria-label="Ocupacion" id="id_ocupacion" name="id_ocupacion"></select>
									</div>
								</div>
							</div>							
						</div>

						<div class="col-md-4 col-xl-4">
							<div class="row mb-7">						
								<div class="col-md-12 col-xl-12 text-center">
									<label class="d-block fw-bold fs-6 mb-5">Fotografia de frente</label>


									<div id="dvImgOutFrente" class="image-input image-input-outline" data-kt-image-input="true">
										<div id="dvImgWrapFrente" class="image-input-wrapper w-325px h-200px"></div>
								
										<label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Cambiar imagen">
											<i class="bi bi-pencil-fill fs-7"></i>
											<input type="file" name="ine_frente" accept=".png, .jpg, .jpeg" />
											<input type="hidden" name="avatar_remove" />
										</label>
										<span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancelar imagen">
											<i class="bi bi-x fs-2"></i>
										</span>
										<span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Remover imagen">
											<i class="bi bi-x fs-2"></i>
										</span>
									</div>
								</div>
 
								<div class="col-md-12 col-xl-12 text-center">
									<label class="d-block fw-bold fs-6 mb-5">Fotografia reverso</label>
									<div id="dvImgOutReverso" class="image-input image-input-outline" data-kt-image-input="true">
										<div id="dvImgWrapReverso" class="image-input-wrapper w-325px h-200px"></div>
										
										<label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Cambiar imagen">
											<i class="bi bi-pencil-fill fs-7"></i>
											<input type="file" name="ine_reverso" accept=".png, .jpg, .jpeg" />
											<input type="hidden" name="avatar_remove" />
										</label>
										<span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancelar imagen">
											<i class="bi bi-x fs-2"></i>
										</span>
										<span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Remover imagen">
											<i class="bi bi-x fs-2"></i>
										</span>
									</div>
								</div>
							</div>
						</div>
					</div>
	    		</div>

	    		<div class="row">
	    			<h2 class="mb-5">Medios de contacto del promovido</h2>

	    			<div class="row mb-7">	
						<div class="col-md-3 col-xl-3">
							<div class="position-relative d-flex align-items-center">
								<div class="symbol symbol-20px me-4 position-absolute ms-4">
									<i class="fa fa-mobile-alt"></i>
								</div>
								<input class="form-control form-control-lg ps-12 removeIsInvalid" type="text" placeholder="Teléfono celular" name="telefono_celular" id="telefono_celular" />
							</div>
						</div>

						<div class="col-md-3 col-xl-3">
							<div class="position-relative d-flex align-items-center">
								<div class="symbol symbol-20px me-4 position-absolute ms-4">
									<i class="fa fa-phone-alt"></i>
								</div>
								<input class="form-control form-control-lg ps-12 removeIsInvalid" type="text" placeholder="Teléfono casa" name="telefono_casa" id="telefono_casa" />
							</div>
						</div>

						<div class="col-md-3 col-xl-3">
							<div class="position-relative d-flex align-items-center">
								<div class="symbol symbol-20px me-4 position-absolute ms-4">
									<i class="far fa-envelope"></i>
								</div>
								<input class="form-control form-control-lg ps-12 removeIsInvalid" type="text" placeholder="Correo electrónico" name="correo" id="correo" />
							</div>
						</div>

						<div class="col-md-3 col-xl-3">
							<div class="position-relative d-flex align-items-center">
								<div class="symbol symbol-20px me-4 position-absolute ms-4">
									<i class="fa fa-share-nodes"></i>
								</div>
								<select class="form-select ps-12 removeIsInvalidSelect" aria-label="Redes sociales" id="red_social" name="red_social">
								    <option value="">--- Redes sociales ---</option>
								    <option value="0">NO</option>
								    <option value="1">SI</option>
								</select>
							</div>
						</div>
					</div>
					
					<div class="row mb-7" id="dvRedesSociales" name="dvRedesSociales" style="display: none;">
						<div class="col-md-3 col-xl-3">
							<div class="position-relative d-flex align-items-center">
								<div class="symbol symbol-20px me-4 position-absolute ms-4">
									<i class="fab fa-facebook-f"></i>
								</div>
								<input class="form-control form-control-lg ps-12 removeIsInvalid" type="text" placeholder="Facebook" name="facebook" id="facebook" />
							</div>
						</div>

						<div class="col-md-3 col-xl-3">
							<div class="position-relative d-flex align-items-center">
								<div class="symbol symbol-20px me-4 position-absolute ms-4">
									<i class="fab fa-instagram"></i>
								</div>
								<input class="form-control form-control-lg ps-12 removeIsInvalid" type="text" placeholder="Instagram" name="instagram" id="instagram" />
							</div>
						</div>

						<div class="col-md-3 col-xl-3">
							<div class="position-relative d-flex align-items-center">
								<div class="symbol symbol-20px me-4 position-absolute ms-4">
									<i class="fab fa-twitter"></i>
								</div>
								<input class="form-control form-control-lg ps-12 removeIsInvalid" type="text" placeholder="Twitter" name="twitter" id="twitter" />
							</div>
						</div>

						<div class="col-md-3 col-xl-3">
							<div class="position-relative d-flex align-items-center">
								<div class="symbol symbol-20px me-4 position-absolute ms-4">
									<i class="fab fa-tiktok"></i>
								</div>
								<input class="form-control form-control-lg ps-12 removeIsInvalid" type="text" placeholder="Tik tok" name="tiktok" id="tiktok" />
							</div>
						</div>
					</div>
	    		</div>
    		</div>
    	</div>
    		
	</div>
</div>


