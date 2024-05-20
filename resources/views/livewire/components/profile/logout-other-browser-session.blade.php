<div class="col-12">

    <?php $agent = new \Jenssegers\Agent\Agent(); ?>
    @foreach ($this->session as $session)
        <div class="d-flex col-12 border shadow-sm rounded flex-wrap pt-2 list-row align-items-center mb-3">
            <div class="col-sm-12 col-md-6 d-flex align-items-center">
                <div class="list-icon bgl-primary mr-3 mb-2">
                    @if ($agent->isDesktop($session->user_agent))
                        <svg fill="none" width="32" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            viewBox="0 0 24 24" stroke="currentColor" class="text-muted">
                            <path
                                d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                            </path>
                        </svg>
                    @else
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"
                            class="text-muted">
                            <path d="M0 0h24v24H0z" stroke="none"></path>
                            <rect x="7" y="4" width="10" height="16" rx="1"></rect>
                            <path d="M11 5h2M12 17v.01"></path>
                        </svg>
                    @endif
                </div>
                <div class="info mb-2">
                    <h4 class="card-title mb-1">
                        {{ $agent->platform($session->user_agent) }} -
                        {{ $agent->browser($session->user_agent) }}
                        @if ($session->id == $this_device)
                            &nbsp;<span class="badge badge-success badge-pill">(Perangkat ini)</span>
                        @endif
                    </h4>
                    <div class="d-flex col-12">
                        <span class="text-primary ml-n2 mr-3">{{ $session->ip_address }}</span>
                        <span>Terakhir aktif
                            {{ \Carbon\Carbon::createFromTimestamp($session->last_activity)->diffForHumans() }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    @livewire('components.profile.form-logout-other-browser-session')
</div>
