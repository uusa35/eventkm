<div id="lang" class="d-none">{{ app()->getLocale() }}</div>
<form id="logout-form" action="{{ url('/logout') }}" method="POST"
      style="display: none;">
    @csrf
</form>
@include('frontend.wokiee.partials.scripts')
<!-- CSS only -->

<!-- JavaScript Bundle with Popper -->
<script type="text/javascript">
    $('.docs-datepicker-trigger-search').datepicker({
        language: '{{  app()->isLocal('ar') ? 'ar-EG': 'en-GB' }}',
        autoHide: true,
        autoShow: false,
        format: 'dd/mm/yyyy',
        transmissionFormat: 'mm/dd/yyyy',
        weekStart: 1,
        disabledClass: 'dayOff',
        date: '{{ \Carbon\Carbon::today()->format('d/m/y') }}',
        startDate: '{{  \Carbon\Carbon::today()->format('d/m/y') }}',
        endDate: '{{  \Carbon\Carbon::today()->addMonth(1)->format('d/m/y') }}',
        show: function(e) {
        },
        hide: function(e) {
        },
        pick: function(e) {
            console.log('from the search form');
            dayNo = e.date.getDay();
            day_selected_format = moment(e.date).format('MM/DD/YYYY');
            dayName = moment(e.date).format('dddd');
            console.log('day namee', dayName);
            console.log('day no', dayNo);
            console.log('date_selected format', day_selected_format);
            // set Day No + Day Format Value
            $('input[id^="day_selected"]').attr('value', dayNo);
            $('input[id^="day_selected_format"]').attr('value', day_selected_format);
        },
        update: function(e) {
        }
    });

    var $dateContainer = $('[data-toggle="datepicker"]');
    $dateContainer.datepicker({
        language: '{{  app()->isLocal('ar') ? 'ar-EG': 'en-GB' }}',
        autoHide: true,
        autoShow: false,
        format: 'dd/mm/yyyy',
        transmissionFormat: 'mm/dd/yyyy',
        weekStart: 1,
        disabledClass: 'dayOff',
        filter: function(date, view) {
            @if(isset($workingDays))
            const workingDays = [@foreach($workingDays as $day) {{ $day }}, @endforeach];
            const dayOff = '{{ $dayOff ? $dayOff->day_no : null }}';
            console.log('DayOff', dayOff);
            if (date.getDay() === dayOff && view === 'day') {
                return false; // Disable all Sundays, but still leave months/years, whose first day is a Sunday, enabled.
            }
            @endif
        },
        date: '{{ \Carbon\Carbon::today()->format('d/m/y') }}',
        startDate: '{{  \Carbon\Carbon::today()->format('d/m/y') }}',
        endDate: '{{  \Carbon\Carbon::today()->addMonth(1)->format('d/m/y') }}',
        // endDate: 'one month',
        trigger: '.docs-datepicker-trigger',
        show: function(e) {
            $('*[class^="timing-element-"]').addClass('d-none');
        },
        hide: function(e) {
        },
        pick: function(e) {
            $("#timing_select option[selected]").removeAttr("selected");
            $('#timing_select').find('option:first').attr('selected', 'selected');
            console.log('from the service Element Picker');
            dayNo = e.date.getDay();
            day_selected_format = moment(e.date).format('MM/DD/YYYY');
            dayName = moment(e.date).format('dddd');
            console.log('console.log the service Element :: date_selected', day_selected_format);
            // set Day No + Day Format Value
            $('input[id^="day_selected"]').attr('value', dayNo);
            $('input[id^="day_selected_format"]').attr('value', day_selected_format);


            // Modal Case
            $(`div[id^="service_form"]`).removeClass('d-none');
            $(`*[class^="timing-element-"]`).addClass('d-none');
            $(`*[class^="timing-element-${dayNo}"]`).removeClass('d-none');

            // only In Modal Case
            $('#chooseTimeModal').modal('show');
        },
        update: function(e) {
        }
    });
    // $('.areas').select2();
    $(document).ready(function () {

    })
    $('.skltbs-init').skeletabs({ panelHeight: 'adapt', keyboard : false , history : false , autoplay : false  , breakpoint: 0 });

    var acc = document.getElementsByClassName("accordionCustome");
    var i;

    for (i = 0; i < acc.length; i++) {
        acc[i].addEventListener("click", function() {
            /* Toggle between adding and removing the "active" class,
            to highlight the button that controls the panel */
            this.classList.toggle("active");

            /* Toggle between hiding and showing the active panel */
            var panel = this.nextElementSibling;
            if (panel.style.display === "block") {
                panel.style.display = "none";
            } else {
                panel.style.display = "block";
            }
        });
    }
</script>


