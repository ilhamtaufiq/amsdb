{{--

/**
*
* Created a new component <x-rtl.widgets._w-three/>.
*
*/

--}}


<div class="widget widget-three">
    <div class="widget-heading">
        <h5 class="">{{$title}}</h5>

        <div class="task-action">
            <div class="dropdown">
                <a class="dropdown-toggle" href="#" role="button" id="summary" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg>
                </a>

                <div class="dropdown-menu left" aria-labelledby="summary" style="will-change: transform;">
                    <a class="dropdown-item" href="javascript:void(0);">View Report</a>
                    <a class="dropdown-item" href="javascript:void(0);">Edit Report</a>
                    <a class="dropdown-item" href="javascript:void(0);">Mark as Done</a>
                </div>
            </div>
        </div>

    </div>
    <div class="widget-content">

        <div class="order-summary">

            <div class="summary-list">
                <div class="w-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>                </div>
                <div class="w-summary-details">

                    <div class="w-summary-info">
                        <h6>Jiwa</h6>
                        <p class="summary-count">{{ $jiwa }}</p>
                    </div>

                </div>

            </div>

            <div class="summary-list">
                <div class="w-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>                </div>
                <div class="w-summary-details">

                    <div class="w-summary-info">
                        <h6>Sarana dan Prasarana</h6>
                        <p class="summary-count">{{ $sarpras }}</p>
                    </div>

                </div>

            </div>

        </div>

    </div>
</div>
