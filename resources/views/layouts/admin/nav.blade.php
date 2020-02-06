<div class=" bg-dark wrapper" id="page-top" >
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
		<a class="navbar-brand" href="/admin">
			<span> Адміністрування </span>
		</a>
		<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive"  >
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse sidenav" id="navbarResponsive">

			<ul class="navbar-nav navbar-sidenav" id="Accordion">

				{{-- Орг.комітет --}}

				@if (Auth::user()->role == 'orgComittee' || Auth::user()->role == 'superAdmin')

					@php $role = 'Орг.Комітет' @endphp

					<li class="nav-item" title="Нові заяви">
						<a class="nav-link" href="/admin/new-statements">
							<i class="fa fa-fw fa-users"></i>
							<span class="nav-link-text">Нові заяви</span>
						</a>
					</li>

					<li class="nav-item" title="Видалені заяви">
						<a class="nav-link" href="/admin/removed-statements">
							<i class="fa fa-trash"></i>
							<span class="nav-link-text">Видалені заяви</span>
						</a>
					</li>

					<li class="nav-item" title="Список учасників">
						<a class="nav-link" href="/admin/list-participants">
							<i class="fa fa-list"></i>
							<span class="nav-link-text">Список учасників</span>
						</a>
					</li>

					<li class="nav-item" title="Результати оцінювання">
						<a class="nav-link" href="/admin/evaluation-results">
							<i class="fa fa-list-ol"></i>
							<span class="nav-link-text">Результати оцінювання</span>
						</a>
					</li>

				@endif

				{{-- Журі --}}

				@if (Auth::user()->role == 'jury' || Auth::user()->role == 'superAdmin')

					@php $role = 'Журі' @endphp

					<li class="nav-item" title="Всі заяви">
						<a class="nav-link" href="/admin/all-statements">
							<i class="fa fa-address-card"></i>
							<span class="nav-link-text">Всі заяви</span>
						</a>
					</li>

					<li class="nav-item" title="Оцінювання">
						<a class="nav-link" href="/admin/jury-evaluation">
							<i class="fa fa-calendar-check-o"></i>
							<span class="nav-link-text">Оцінювання</span>
						</a>
					</li>

				@endif

				{{-- Адмін --}}

				@if (Auth::user()->role == 'admin' || Auth::user()->role == 'superAdmin')

					@php $role = 'Адміністратор' @endphp

					<li class="nav-item" title="Відеогалерея">
						<a class="nav-link" href="/admin/video-gallery">
							<i class="fa fa-video-camera"></i>
							<span class="nav-link-text">Відеогалерея</span>
						</a>
					</li>

					<li class="nav-item" title="Фотогалерея">
						<a class="nav-link" href="/admin/foto-gallery">
							<i class="fa fa-file-image-o"></i>
							<span class="nav-link-text">Фотогалерея</span>
						</a>
					</li>

					<li class="nav-item" title="Загальна інформація">
						<a class="nav-link" href="/admin/main-information">
							<i class="fa fa-info-circle"></i>
							<span class="nav-link-text">Загальна інформація</span>
						</a>
					</li>

					<li class="nav-item" title="Питання користувачів">
						<a class="nav-link" href="/admin/question">
							<i class="fa fa-question-circle"></i>
							<span class="nav-link-text">Питання користувачів</span>
						</a>
					</li>

					<li class="nav-item" title="Заявки майстер клас">
						<a class="nav-link" href="/admin/master-class">
							<i class="fa fa-star"></i>
							<span class="nav-link-text">Заявки майстер клас</span>
						</a>
					</li>	

					<li class="nav-item" title="Повідомлення користувачам">
						<a class="nav-link" href="/admin/users-messages">
							<i class="fa fa-envelope"></i>
							<span class="nav-link-text">Повідомлення користувачам</span>
						</a>
					</li>	

				@endif

				{{-- Супер адмін --}}

				@if (Auth::user()->role == 'superAdmin')

					@php $role = 'Супер Адмін' @endphp
					
					<li class="nav-item" title="Додати журі">
						<a class="nav-link" href="/admin/period">
							<i class="fa fa-calendar"></i>
							<span class="nav-link-text">Період проведення</span>
						</a>
					</li>

					<li class="nav-item" title="Додати журі">
						<a class="nav-link" href="/admin/add-jury">
							<i class="fa fa-gavel"></i>
							<span class="nav-link-text">Додати журі</span>
						</a>
					</li>

					<li class="nav-item" title="Додати в орг. комітет">
						<a class="nav-link" href="/admin/add-to-org-committee">
							<i class="fa fa-users"></i>
							<span class="nav-link-text">Додати в орг. комітет</span>
						</a>
					</li>

					<li class="nav-item" title="Додати адміністратора">
						<a class="nav-link" href="/admin/add-admin-org-committee">
							<i class="fa fa-users"></i>
							<span class="nav-link-text">Додати адміністратора</span>
						</a>
					</li>

				@endif

				<li class="nav-item" title="Профіль">
					<a class="nav-link" href="/admin/profile/{{ Auth::user()->user_id }}">
						<i class="fa fa-user"></i>
						<span class="nav-link-text">Профіль</span>
					</a>
				</li>

			</ul>

			<ul class="navbar-nav sidenav-toggler">
				<li class="nav-item">
					<a class="nav-link text-center" id="sidenavToggler">
						<i class="fa fa-fw fa-angle-left"></i>
					</a>
				</li>
			</ul>

			<ul class="navbar-nav mr-auto">
				<li class="nav-item ">
					<a class="nav-link mr-lg-2" id="siteLink" href="/" title="До сайту">
						<i class="fa fa-fw fa-sign-in"></i>
						До сайту
					</a>
				</li>
			</ul>
			<div class="user-block">
				<div class="user-content d-none d-lg-flex">
					<img src="{{ url('/') }}/img/user.png">
					<div class="welcome"><a style="color:#868e96" href="/admin/profile/{{ Auth::user()->user_id }}">{{ Auth::user()->name }} {{ Auth::user()->surname }}</a> ({{ $role }})</div>
				</div>
				<a class="logout" data-toggle="modal" data-target="#modalLogout">
					<i class="fa fa-fw fa-sign-out"></i>Вихід
				</a>
			</div>
		</div>
	</nav>
</div>