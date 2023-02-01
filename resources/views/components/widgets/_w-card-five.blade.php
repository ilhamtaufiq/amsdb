{{--

/**
*
* Created a new component <x-widgets._w-card-five/>.
*
*/

--}}


<div class="widget widget-card-five">
    <div class="widget-content">
        <div class="account-box">

            <div class="info-box">
                <div class="icon">
                    <span>
                        <img src="{{Vite::asset('resources/images/money-bag.png')}}" alt="money-bag">
                    </span>
                </div>

                <div class="balance-info">
                    <h6>{{$title}}</h6>
                    <p>{{$balance}}</p>
                </div>
            </div>

            <div class="card-bottom-section">
                <h5>Tahun Anggaran {{ app('request')->input('tahun_anggaran') ?? Carbon\Carbon::now()->format('Y') }}</h5>
            </div>
        </div>
    </div>
</div>
