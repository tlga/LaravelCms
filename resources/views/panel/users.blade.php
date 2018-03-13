@extends('layouts.master')
@section('Header_Script')


@endsection
@section('content')
	<div class="row">
		@if(!isset($userId))
		<div class="col-md-6">
			<div class="m-portlet">
				<div class="m-portlet__head">
					<div class="m-portlet__head-caption">
						<div class="m-portlet__head-title">
							<h3 class="m-portlet__head-text">
								Kullanıcılar
							</h3>
						</div>
					</div>
				</div>

				<div class="m-form m-form--fit m-form--label-align-right">
					<div class="m-portlet__body p-10">
						<table class="table table-hover">
							<thead>
							<tr>
								<th scope="col">Ad Soyad</th>
								<th scope="col">T.C. Kimlik Nu.</th>
							</tr>
							</thead>
							<tbody>
							@foreach(\App\User::get() as $user)

								<tr>
										<td><a href="{{ route('admin.userProcess').'/student/'.$student->id }}" style="text-transform:capitalize;">{{ $student->name }}</a></td>
										<td>{{ $student->email }}</td>
								</tr>

							@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>

		<div class="col-md-6">
			<div class="m-portlet">
				<div class="m-portlet__head">
					<div class="m-portlet__head-caption">
						<div class="m-portlet__head-title">
							<h3 class="m-portlet__head-text">
								Yöneticiler
							</h3>
						</div>
					</div>
				</div>

				<div class="m-form m-form--fit m-form--label-align-right">
					<div class="m-portlet__body p-10">
						<table class="table table-hover">
							<thead>
							<tr>
								<th scope="col">Ad Soyad</th>
								<th scope="col">Email</th>
							</tr>
							</thead>
							<tbody>
							@foreach(\App\Admin::get() as $admin)

								<tr>
									<td><a href="{{ route('admin.userProcess').'/admin/'.$admin->id }}" style="text-transform:capitalize;">{{ $admin->name }}</a></td>
									<td>{{ $admin->email }}</td>
								</tr>

							@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
			@else
			<div class="col-md-12">
				<div class="m-portlet">
					<div class="m-portlet__head">
						<div class="m-portlet__head-caption">
							<div class="m-portlet__head-title">
								<h3 class="m-portlet__head-text" style="text-transform:capitalize;">
									{{ $name }} 'nın bilgilerini düzenle
								</h3>

							</div>
						</div>
					</div>

					<form method="post" name="pageForm" action="{{ route('admin.userEdit').'/'.$auth.'/'.$userId }}">
						<div class="m-form m-form--fit m-form--label-align-right">
							<div class="m-portlet__body p-10">
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label for="exampleInputEmail1">Ad Soyad</label>
											<input type="text" class="form-control" id="adsoyad" name="adsoyad" aria-describedby="emailHelp" placeholder="Ad Soyad" value="{{ $name }}">
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group">
											<label for="email">E-mail</label>
											<input type="email" class="form-control" id="email" name="email" aria-describedby="email" placeholder="E-mail" value="{{ $email }}">
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group">
											<label for="password">Yeni Şifre</label>
											<input type="password" class="form-control" name="password" id="password" aria-describedby="password" placeholder="Yeni Şifre">
										</div>
									</div>
									<div class="col-md-12" style="text-align:center;">
										<div class="form-group">
											<button class="pageDelete btn m-btn--pill m-btn--air btn-danger" type="button" style="min-width:200px;">
												Sil
											</button>
										</div>
										<div class="form-group">
											<button class="pageSave btn m-btn--pill m-btn--air btn-focus" type="button" style="min-width:200px;">
												Kaydet
											</button>
										</div>
									</div>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		@endif
	</div>




@stop

@section('Footer_Script')
<script type="text/javascript">
	$(document).ready(function(){
		$(document).on('click', '.pageSave', function(e) {

			var content = $('.summernote').summernote('code');

			ajaxPost($(this).parents('form').attr('action'),pageSave,$(this).parents("form").serialize());

			//location.reload();
		});
		@if(isset($userId))
		$(document).on('click', '.pageDelete', function(e) {

			var content = $('.summernote').summernote('code');

			ajaxPost('{{ route('admin.userDelete').'/'.$auth.'/'.$userId }}',pageSave,$(this).parents("form").serialize());

			//location.reload();
		});
		@endif

		function pageSave(data) {
			console.log('mission complete');
		}

	});
</script>
@endsection
