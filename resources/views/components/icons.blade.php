@props(['name'])

@switch($name)
    @case('chevron_down')
        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" width="13.839" height="7.912"
        {{ $attributes->merge(['class']) }} viewBox="0 0 13.839 7.912">
            <path id="Icon_ionic-ios-arrow-down" data-name="Icon ionic-ios-arrow-down" d="M13.109,16.774l5.233-5.237a.985.985,0,0,1,1.4,0,1,1,0,0,1,0,1.4L13.81,18.871a.987.987,0,0,1-1.364.029l-5.97-5.958a.989.989,0,0,1,1.4-1.4Z" transform="translate(-6.188 -11.246)"/>
        </svg>
        @break
    @case('notify')
        <svg id="Notifiche" xmlns="http://www.w3.org/2000/svg" fill="currentColor" width="22.189" height="22.108"
        {{ $attributes->merge(['class']) }} viewBox="0 0 22.189 22.108">
            <path id="Tracciato_1" data-name="Tracciato 1" d="M19.156,28.336a.716.716,0,0,0-.7.564,1.385,1.385,0,0,1-.276.6,1.044,1.044,0,0,1-.89.326,1.062,1.062,0,0,1-.89-.326,1.385,1.385,0,0,1-.276-.6.716.716,0,0,0-.7-.564h0a.721.721,0,0,0-.7.879,2.469,2.469,0,0,0,2.569,2.05,2.464,2.464,0,0,0,2.569-2.05.723.723,0,0,0-.7-.879Z" transform="translate(-8.471 -9.156)" fill="#2c2c2c"/>
            <path id="Sottrazione_1" data-name="Sottrazione 1" d="M-4957.777,44.184h-9.934a1.1,1.1,0,0,1-.985-.61,1.075,1.075,0,0,1,.107-1.147,6.787,6.787,0,0,1,.522-.587c.893-.931,2-2.09,2-6.216a9.88,9.88,0,0,1,1.4-5.607,4.974,4.974,0,0,1,3-2.117c.206-.052.343-.127.343-.327v-.16A1.361,1.361,0,0,1-4960,26.054h.034a1.361,1.361,0,0,1,1.326,1.359v.16c0,.2.126.272.343.327,1.279.3,4.266,1.616,4.395,7.344a5.958,5.958,0,0,0-1.432.508c0-.042,0-.085,0-.128a8.489,8.489,0,0,0-1.155-4.8,3.543,3.543,0,0,0-2.139-1.525,2.006,2.006,0,0,1-1.039-.591.421.421,0,0,0-.318-.143.46.46,0,0,0-.34.154,1.941,1.941,0,0,1-1.026.58,3.536,3.536,0,0,0-2.139,1.525,8.479,8.479,0,0,0-1.155,4.8,12.508,12.508,0,0,1-.791,4.874,6.661,6.661,0,0,1-1.16,1.846.243.243,0,0,0-.039.264.24.24,0,0,0,.221.14h8.014a5.966,5.966,0,0,0,.62,1.435Z" transform="translate(4968.814 -26.054)" fill="#2c2c2c"/>
            <circle id="Ellisse_4" data-name="Ellisse 4" cx="5.5" cy="5.5" r="5.5" transform="translate(11.189 10.054)" fill="#347af2"/>
        </svg>
        @break
    @case('setting')
        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" width="21.225" height="21.225"
        {{ $attributes->merge(['class']) }} viewBox="0 0 21.225 21.225">
            <path id="Tracciato_1215" data-name="Tracciato 1215" d="M12.112,15.3A3.185,3.185,0,1,1,15.3,12.114,3.185,3.185,0,0,1,12.112,15.3Zm0-7.7a4.512,4.512,0,1,0,4.513,4.513A4.512,4.512,0,0,0,12.112,7.6ZM21.4,13.248V10.977l-1.755-.509a.66.66,0,0,1-.452-.448A7.3,7.3,0,0,0,18.6,8.587a.663.663,0,0,1,0-.637l.882-1.6L17.874,4.743l-1.6.882a.66.66,0,0,1-.637,0A7.345,7.345,0,0,0,14.2,5.033a.663.663,0,0,1-.45-.453l-.508-1.753H10.976L10.468,4.58a.665.665,0,0,1-.449.453,7.311,7.311,0,0,0-1.432.592.66.66,0,0,1-.637,0l-1.6-.882L4.743,6.348l.882,1.6a.66.66,0,0,1,0,.637,7.341,7.341,0,0,0-.593,1.433.66.66,0,0,1-.451.448l-1.755.509v2.272l1.755.509a.66.66,0,0,1,.451.448,7.341,7.341,0,0,0,.594,1.431.662.662,0,0,1,0,.637l-.881,1.6,1.606,1.608,1.6-.882a.66.66,0,0,1,.637,0,7.294,7.294,0,0,0,1.432.592.665.665,0,0,1,.449.453l.508,1.753h2.272l.508-1.753a.663.663,0,0,1,.45-.453,7.335,7.335,0,0,0,1.432-.592.66.66,0,0,1,.637,0l1.6.882,1.606-1.608-.882-1.6a.664.664,0,0,1,0-.637A7.3,7.3,0,0,0,19.19,14.2a.66.66,0,0,1,.452-.448l1.754-.509Zm.848-3.406-1.893-.551a8.724,8.724,0,0,0-.42-1.014l.953-1.725a.662.662,0,0,0-.112-.788L18.461,3.452a.66.66,0,0,0-.789-.11l-1.727.951a8.339,8.339,0,0,0-1.014-.42L14.383,1.98a.663.663,0,0,0-.637-.48H10.477a.664.664,0,0,0-.637.48L9.292,3.872a8.355,8.355,0,0,0-1.013.42L6.552,3.342a.66.66,0,0,0-.789.11L3.452,5.764a.662.662,0,0,0-.112.788l.951,1.727a8.721,8.721,0,0,0-.42,1.014l-1.894.55a.66.66,0,0,0-.479.637v3.266a.66.66,0,0,0,.479.637l1.894.551a8.721,8.721,0,0,0,.42,1.014L3.34,17.672a.662.662,0,0,0,.112.788l2.311,2.313a.66.66,0,0,0,.789.11l1.727-.951a8.308,8.308,0,0,0,1.013.42l.549,1.893a.664.664,0,0,0,.637.48h3.269a.663.663,0,0,0,.637-.48l.549-1.893a8.325,8.325,0,0,0,1.014-.42l1.727.951a.66.66,0,0,0,.789-.11l2.311-2.313a.662.662,0,0,0,.112-.788l-.952-1.727a8.724,8.724,0,0,0,.42-1.014l1.893-.551a.66.66,0,0,0,.479-.637V10.479a.66.66,0,0,0-.479-.637Z" transform="translate(-1.499 -1.5)" fill="#2c2c2c" fill-rule="evenodd"/>
        </svg>
        @break
    @case('search')
        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" width="21.219" height="21.224"
        {{ $attributes->merge(['class']) }} viewBox="0 0 21.219 21.224">
            <path id="Icon_ionic-ios-search" data-name="Icon ionic-ios-search" d="M25.47,24.181l-5.9-5.957a8.41,8.41,0,1,0-1.276,1.293l5.863,5.918a.908.908,0,0,0,1.282.033A.914.914,0,0,0,25.47,24.181ZM12.96,19.589a6.641,6.641,0,1,1,4.7-1.945A6.6,6.6,0,0,1,12.96,19.589Z" transform="translate(-4.5 -4.493)" fill="#2c2c2c"/>
        </svg>
        @break
    @case('user')
        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" stroke="currentColor" width="21" height="21"
        {{ $attributes->merge(['class']) }} viewBox="0 0 21 21">
            <g id="Raggruppa_6" data-name="Raggruppa 6" transform="translate(-53 -136)">
                <rect id="Rettangolo_5" data-name="Rettangolo 5" width="21" height="21" transform="translate(53 136)" opacity="0"/>
                <g id="Raggruppa_530" data-name="Raggruppa 530" transform="translate(-1373.402 87.426)">
                    <path id="Tracciato_85" data-name="Tracciato 85" d="M18.433,7.716A3.216,3.216,0,1,1,15.216,4.5a3.216,3.216,0,0,1,3.216,3.216Z" transform="translate(1421.686 46.702)" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.3"/>
                    <g id="noun-user-1062391" transform="translate(1431.215 59.845)">
                        <g id="Raggruppa_16" data-name="Raggruppa 16" transform="translate(0 0)">
                            <path id="Tracciato_90" data-name="Tracciato 90" d="M18.677,971.453A2.678,2.678,0,0,0,16,974.13v3.68a.335.335,0,0,0,.335.335H27.041a.335.335,0,0,0,.335-.335v-3.68a2.678,2.678,0,0,0-2.677-2.676Zm0,.669H24.7a2,2,0,0,1,2.007,2.007v3.346H16.669V974.13A2,2,0,0,1,18.677,972.122Z" transform="translate(-16 -971.453)" stroke-width="0.6"/>
                        </g>
                    </g>
                </g>
            </g>
        </svg>
        @break
    @case('folders')
        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" width="21" height="21"
        {{ $attributes->merge(['class']) }} viewBox="0 0 21 21">
            <g id="Raggruppa_6" data-name="Raggruppa 6" transform="translate(-53 -136)">
                <rect id="Rettangolo_5" data-name="Rettangolo 5" width="21" height="21" transform="translate(53 136)" opacity="0"/>
                <g id="Raggruppa_6-2" data-name="Raggruppa 6">
                    <rect id="Rettangolo_5-2" data-name="Rettangolo 5" width="21" height="21" transform="translate(53 136)" opacity="0"/>
                    <g id="Icona_Gestione_Anamnesi_off" data-name="Icona Gestione Anamnesi off" transform="translate(56.258 139.625)">
                        <path id="Tracciato_17" data-name="Tracciato 17" d="M-18.9-589.306a2.1,2.1,0,0,1-2.1-2.1v-6.613a2.1,2.1,0,0,1,2.1-2.1h.839v-.839a2.1,2.1,0,0,1,2.1-2.1h2.2a.626.626,0,0,1,.445.185l1.285,1.284h3.413a2.1,2.1,0,0,1,2.1,2.1v5.142a2.1,2.1,0,0,1-2.1,2.1h-.839v.839a2.1,2.1,0,0,1-2.1,2.1Zm-.839-8.712v6.613a.84.84,0,0,0,.839.839h7.347a.84.84,0,0,0,.839-.839v-.839h-5.247a2.1,2.1,0,0,1-2.1-2.1v-4.513H-18.9A.84.84,0,0,0-19.74-598.018Zm2.939,3.674a.84.84,0,0,0,.839.84h7.347a.841.841,0,0,0,.839-.84v-5.142a.841.841,0,0,0-.839-.84h-3.674a.631.631,0,0,1-.446-.184l-1.284-1.284h-1.943a.84.84,0,0,0-.839.839v6.612Z" transform="translate(21 603.056)"/>
                    </g>
                </g>
            </g>
        </svg>
        @break
    @case('list')
        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" width="21" height="21"
        {{ $attributes->merge(['class']) }} viewBox="0 0 21 21">
            <g id="Raggruppa_6" data-name="Raggruppa 6" transform="translate(-53 -136)">
                <rect id="Rettangolo_5" data-name="Rettangolo 5" width="21" height="21" transform="translate(53 136)" opacity="0"/>
                <g id="icona_Lista_Pazienti_off" data-name="icona Lista Pazienti off" transform="translate(57.463 138.627)">
                    <path id="Tracciato_16" data-name="Tracciato 16" d="M-18.042-533.008a2.209,2.209,0,0,1-2.173-2.238v-9.659a2.209,2.209,0,0,1,2.173-2.238h.911a2.242,2.242,0,0,1,2.149-1.61h1.61a2.242,2.242,0,0,1,2.148,1.61h.911a2.209,2.209,0,0,1,2.174,2.238v9.659a2.209,2.209,0,0,1-2.174,2.238Zm-.917-11.9v9.659a.952.952,0,0,0,.917.982h7.728a.952.952,0,0,0,.917-.982v-9.659a.952.952,0,0,0-.917-.982h-.911a2.242,2.242,0,0,1-2.148,1.61h-1.61a2.242,2.242,0,0,1-2.149-1.61h-.911A.952.952,0,0,0-18.959-544.905Zm2.994-1.61a.982.982,0,0,0,.982.981h1.61a.982.982,0,0,0,.981-.981.983.983,0,0,0-.981-.982h-1.61A.983.983,0,0,0-15.965-546.515Zm-.4,9.725a.87.87,0,0,1-.87-.87.87.87,0,0,1,.87-.87h.009a.87.87,0,0,1,.87.87.87.87,0,0,1-.87.87Zm2.19-.193a.677.677,0,0,1-.677-.677.678.678,0,0,1,.677-.677h2.641a.677.677,0,0,1,.676.677.676.676,0,0,1-.676.677Zm-2.19-3.026a.87.87,0,0,1-.87-.87.87.87,0,0,1,.87-.87h.009a.87.87,0,0,1,.87.87.87.87,0,0,1-.87.87Zm2.19-.194a.677.677,0,0,1-.677-.676.677.677,0,0,1,.677-.677h2.641a.676.676,0,0,1,.676.677.676.676,0,0,1-.676.676Z" transform="translate(20.215 548.754)"/>
                </g>
            </g>
        </svg>
        @break
    @case('delete')
        <svg xmlns="http://www.w3.org/2000/svg" width="14.039" height="16.332"
        {{ $attributes->merge(['class']) }} viewBox="0 0 14.039 16.332">
            <path id="Tracciato_1219" data-name="Tracciato 1219" d="M5285.072-605.168a1.282,1.282,0,0,1-1.281-1.28v-11.335h-1.149V-619.2h14.039v1.416h-1.146v11.335a1.284,1.284,0,0,1-1.283,1.28Zm.134-1.414h8.911v-11.2h-8.911Zm5.467-2.02v-7.174h1.417v7.174Zm-3.442,0v-7.174h1.417v7.174Zm-.007-11.479V-621.5h4.871v1.419Z" transform="translate(-5282.641 621.5)" fill="#e9863e"/>
        </svg>
        @break
    @case('b-edit')
        <svg xmlns="http://www.w3.org/2000/svg" width="27" height="27"
        {{ $attributes->merge(['class']) }} viewBox="0 0 27 27">
            <g id="Raggruppa_742" data-name="Raggruppa 742" transform="translate(-1446 -668)">
            <rect id="Rettangolo_282" data-name="Rettangolo 282" width="27" height="27" rx="3" transform="translate(1446 668)" fill="#5e53dd" opacity="0.1"/>
            <path id="Tracciato_56" data-name="Tracciato 56" d="M19.056,4.05a.627.627,0,0,1,.445.184L22.257,6.99a.629.629,0,0,1,0,.89L11.232,18.9l0,0,0,0a.626.626,0,0,1-.279.159L7.1,20.167a.629.629,0,0,1-.778-.778l1.1-3.848a.626.626,0,0,1,.163-.283L18.611,4.234A.627.627,0,0,1,19.056,4.05Zm1.867,3.385L19.056,5.569,17.74,6.884,19.607,8.75Zm-2.2,2.2L16.851,7.773,8.921,15.7l1.867,1.867ZM9.587,18.148,8.343,16.9l-.5,1.742Z" transform="translate(1445.129 669.38)" fill="#5e53dd"/>
            </g>
        </svg>
        @break
    @case('b-delete')
        <svg xmlns="http://www.w3.org/2000/svg" width="27" height="27"
        {{ $attributes->merge(['class']) }} viewBox="0 0 27 27">
            <g id="Raggruppa_741" data-name="Raggruppa 741" transform="translate(-1446 -668)">
            <rect id="Rettangolo_282" data-name="Rettangolo 282" width="27" height="27" rx="3" transform="translate(1446 668)" fill="#ffdbc1" opacity="0.5"/>
            <path id="Tracciato_56" data-name="Tracciato 56" d="M5285.072-605.168a1.282,1.282,0,0,1-1.281-1.28v-11.335h-1.149V-619.2h14.039v1.416h-1.146v11.335a1.284,1.284,0,0,1-1.283,1.28Zm.134-1.414h8.911v-11.2h-8.911Zm5.467-2.02v-7.174h1.417v7.174Zm-3.442,0v-7.174h1.417v7.174Zm-.007-11.479V-621.5h4.871v1.419Z" transform="translate(-3830.16 1294.834)" fill="#e9863e"/>
            </g>
        </svg>
        @break
    @case('alert')
        <svg width="70px" height="70px"
        {{ $attributes->merge(['class']) }}viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path opacity="0.1" d="M10.2501 5.147L3.64909 17.0287C2.9085 18.3618 3.87244 20 5.39741 20H18.5994C20.1243 20 21.0883 18.3618 20.3477 17.0287L13.7467 5.147C12.9847 3.77538 11.0121 3.77538 10.2501 5.147Z" fill="#323232"/>
            <path d="M12 10V13" stroke="#323232" stroke-width="2" stroke-linecap="round"/>
            <path d="M12 16V15.9888" stroke="#323232" stroke-width="2" stroke-linecap="round"/>
            <path d="M10.2515 5.147L3.65056 17.0287C2.90997 18.3618 3.8739 20 5.39887 20H18.6008C20.1258 20 21.0897 18.3618 20.3491 17.0287L13.7482 5.147C12.9861 3.77538 11.0135 3.77538 10.2515 5.147Z" stroke="#323232" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
        @break
@endswitch
