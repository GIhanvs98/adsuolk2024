<ul class="nav nav-pills justify-content-center install-steps">
	<li class="nav-item{{ $step >= 0 ? ' enabled' : '' }}">
		<a class="nav-link{{ $current == 1 ? ' active' : '' }}" href="{{ $installUrl . '/system_compatibility?mode=manual' }}">
			<i class="bi bi-info-circle"></i> {{ trans('messages.system_compatibility') }}
		</a>
	</li>
	<li class="nav-item{{ $step >= 1 ? ' enabled' : '' }}">
		<a class="nav-link{{ $current == 2 ? ' active' : '' }}" href="{{ $installUrl . '/site_info' }}">
			<i class="bi bi-gear"></i> {{ trans('messages.configuration') }}
		</a>
	</li>
	<li class="nav-item{{ $step >= 2 ? ' enabled' : '' }}">
		<a class="nav-link{{ $current == 3 ? ' active' : '' }}" href="{{ $installUrl . '/database' }}">
			<i class="bi bi-database"></i> {{ trans('messages.database') }}
		</a>
	</li>
	<li class="nav-item{{ $step >= 4 ? ' enabled' : '' }}">
		<a class="nav-link{{ $current == 5 ? ' active' : '' }}" href="{{ $installUrl . '/cron_jobs' }}">
			<i class="bi bi-clock"></i> {{ trans('messages.cron_jobs') }}
		</a>
	</li>
	<li class="nav-item{{ $step >= 5 ? ' enabled' : '' }}">
		<a class="nav-link{{ $current == 6 ? ' active' : '' }}" href="{{ $installUrl . '/finish' }}">
			<i class="bi bi-check-circle"></i> {{ trans('messages.finish') }}
		</a>
	</li>
</ul>
