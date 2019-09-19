<div id="back_to_top">
	<i class="fa fa-arrow-circle-up fa-3x" aria-hidden="true"></i>
</div>
<footer class="sticky-footer">
	<div class="container">
		<div class="text-center">
			<small>Copyright © GIAS 2019</small>
		</div>
	</div>
</footer>

<div class="modal fade" id="modalLogout">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modalLogoutLabel">Хочете покинути систему?</h5>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body">Виберіть "Вихід" нижче, якщо ви готові завершити поточний сеанс.</div>
			<div class="modal-footer">
				<button class="btn btn-secondary" type="button" data-dismiss="modal">Скасувати</button>
				<a class="btn btn-primary" onclick="event.preventDefault();
				document.getElementById('logout-form').submit();" href="{{ route('logout') }}">Вихід</a>
				<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
					@csrf
				</form>
			</div>
		</div>
	</div>
</div>
</div>