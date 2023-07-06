<div class="col-xl-3 col-sm-6">
						<div class="card">
							<div class="card-body">
								<div class="d-flex align-items-center justify-content-between">
									<div class="icon-box icon-box-lg bg-success-light rounded-circle">
										<svg width="46" height="46" viewBox="0 0 46 46" fill="none" xmlns="http://www.w3.org/2000/svg">
											<path fill-rule="evenodd" clip-rule="evenodd" d="M22.9715 29.3168C15.7197 29.3168 9.52686 30.4132 9.52686 34.8043C9.52686 39.1953 15.6804 40.331 22.9715 40.331C30.2233 40.331 36.4144 39.2328 36.4144 34.8435C36.4144 30.4543 30.2626 29.3168 22.9715 29.3168Z" stroke="#3AC977" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
											<path fill-rule="evenodd" clip-rule="evenodd" d="M22.9714 23.0537C27.7304 23.0537 31.5875 19.1948 31.5875 14.4359C31.5875 9.67694 27.7304 5.81979 22.9714 5.81979C18.2125 5.81979 14.3536 9.67694 14.3536 14.4359C14.3375 19.1787 18.1696 23.0377 22.9107 23.0537H22.9714Z" stroke="#3AC977" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
										</svg>
									</div>
									<div class="total-projects ms-3">
										<h3 class="text-success count">{{ $livreurs->count() }}</h3>
										<span>Livreur</span>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-xl-3 col-sm-6">
						<div class="card">
							<div class="card-body">
								<div class="d-flex align-items-center justify-content-between">
									<div class="icon-box icon-box-lg bg-primary-light rounded-circle">

											<img class="livraison" src="Images/livraison.jpg" alt="">


									</div>
									<div class="total-projects ms-3">
										<h3 class="text-primary count">{{ $livraisons->count() }}</h3>
										<span>Livraisons effectuées</span>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-xl-3 col-sm-6">
						<div class="card">
							<div class="card-body">
								<div class="d-flex align-items-center justify-content-between">
									<div class="icon-box icon-box-lg bg-purple-light rounded-circle">
										<img class="transaction" src="Images/transaction.png" alt="">
									</div>
									<div class="total-projects ms-3">
										<h3 class="text-purple count">{{ $paiements->count() }}</h3>
										<span>Total transactions</span>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-xl-3 col-sm-6">
						<div class="card">
							<div class="card-body">
								<div class="d-flex align-items-center justify-content-between">
									<div class="icon-box icon-box-lg bg-danger-light rounded-circle">
										<img class="annulé" src="Images/annulé.png" alt="">
									</div>
									<div class="total-projects ms-3">
										<h3 class="text-danger count">{{ $livraisons->count() }}</h3>
										<span>Livraisons non effectuées</span>
									</div>
								</div>
							</div>
						</div>
					</div>
