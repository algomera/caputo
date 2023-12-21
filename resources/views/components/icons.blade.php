@props(['name'])

@switch($name)
    @case('chevron_down')
        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" width="13.839" height="7.912"
        {{ $attributes->merge(['class']) }} viewBox="0 0 13.839 7.912">
            <path id="Icon_ionic-ios-arrow-down" data-name="Icon ionic-ios-arrow-down" d="M13.109,16.774l5.233-5.237a.985.985,0,0,1,1.4,0,1,1,0,0,1,0,1.4L13.81,18.871a.987.987,0,0,1-1.364.029l-5.97-5.958a.989.989,0,0,1,1.4-1.4Z" transform="translate(-6.188 -11.246)"/>
        </svg>
        @break
    @case('back')
        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" width="10.731" height="18.771"
        {{ $attributes->merge(['class']) }} viewBox="0 0 10.731 18.771">
            <path id="Icon_ionic-ios-arrow-back" data-name="Icon ionic-ios-arrow-back" d="M14.486,15.577l7.1-7.1a1.341,1.341,0,0,0-1.9-1.894l-8.047,8.041a1.339,1.339,0,0,0-.039,1.85l8.08,8.1a1.341,1.341,0,1,0,1.9-1.894Z" transform="translate(-11.251 -6.194)"/>
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
        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" width="14.039" height="16.332"
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
        {{ $attributes->merge(['class']) }} viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path opacity="0.1" d="M10.2501 5.147L3.64909 17.0287C2.9085 18.3618 3.87244 20 5.39741 20H18.5994C20.1243 20 21.0883 18.3618 20.3477 17.0287L13.7467 5.147C12.9847 3.77538 11.0121 3.77538 10.2501 5.147Z" fill="#323232"/>
            <path d="M12 10V13" stroke="#323232" stroke-width="2" stroke-linecap="round"/>
            <path d="M12 16V15.9888" stroke="#323232" stroke-width="2" stroke-linecap="round"/>
            <path d="M10.2515 5.147L3.65056 17.0287C2.90997 18.3618 3.8739 20 5.39887 20H18.6008C20.1258 20 21.0897 18.3618 20.3491 17.0287L13.7482 5.147C12.9861 3.77538 11.0135 3.77538 10.2515 5.147Z" stroke="#323232" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
        @break
    @case('drive')
        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" stroke="currentColor" width="75.859" height="73.032"
        {{ $attributes->merge(['class']) }} viewBox="0 0 75.859 73.032">
            <g id="Icon_user_-_servizi" data-name="Icon user - servizi" transform="translate(0.819 0.75)">
            <g id="Raggruppa_43" data-name="Raggruppa 43" transform="translate(4.859)">
                <path id="Tracciato_44" data-name="Tracciato 44" d="M840.68,959.229a31.96,31.96,0,0,0,44.782-.469" transform="translate(-830.847 -904.179)" fill="none" stroke="#5e53dd" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
                <path id="Tracciato_45" data-name="Tracciato 45" d="M875.057,836.964v-.007a31.982,31.982,0,1,0-62.995-2.354v0" transform="translate(-811.78 -798.34)" fill="none" stroke="#5e53dd" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
                <path id="Tracciato_46" data-name="Tracciato 46" d="M848.329,923.24a18.767,18.767,0,0,0,.457-4.139,19.5,19.5,0,0,0-15.226-18.834,20.485,20.485,0,0,0-4.7-.544c-.391,0-.782.011-1.167.033" transform="translate(-822.276 -865.23)" fill="none" stroke="#5e53dd" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
                <path id="Tracciato_47" data-name="Tracciato 47" d="M942.972,899.757c-.385-.022-.771-.033-1.161-.033a20.514,20.514,0,0,0-4.71.544A19.5,19.5,0,0,0,921.88,919.1a18.774,18.774,0,0,0,.457,4.139" transform="translate(-884.42 -865.23)" fill="none" stroke="#5e53dd" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
                <path id="Tracciato_48" data-name="Tracciato 48" d="M830.057,867.645a154.6,154.6,0,0,1,51.527,0h0" transform="translate(-823.839 -842.639)" fill="none" stroke="#5e53dd" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
                <ellipse id="Ellisse_8" data-name="Ellisse 8" cx="5.467" cy="5.467" rx="5.467" ry="5.467" transform="translate(26.515 26.515)" fill="none" stroke="#5e53dd" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
                <path id="Tracciato_49" data-name="Tracciato 49" d="M889.615,953.725a21.705,21.705,0,0,0,11.005,0" transform="translate(-863.133 -900.855)" fill="none" stroke="#5e53dd" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
                <path id="Tracciato_50" data-name="Tracciato 50" d="M964.871,869.138a21.712,21.712,0,0,1,1.3,10.8" transform="translate(-912.784 -845.05)" fill="none" stroke="#5e53dd" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
                <path id="Tracciato_51" data-name="Tracciato 51" d="M842.5,879.938a21.718,21.718,0,0,1,1.3-10.8" transform="translate(-831.923 -845.05)" fill="none" stroke="#5e53dd" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
            </g>
            <path id="Tracciato_52" data-name="Tracciato 52" d="M811.618,927.187v0l.572-4.9.817-7.023.854-7.329a2.776,2.776,0,0,0-1.946-2.977,2.222,2.222,0,0,0-.643-.1,2.174,2.174,0,0,0-2.072,1.528c-.068.218-.136.439-.2.653a1.012,1.012,0,0,1-.112.238,1.6,1.6,0,0,1-.415.415c-.956.684-2.031.371-3.2-.146a3.966,3.966,0,0,1-1.847-2.048l-.636-1.7a1.559,1.559,0,0,0-.146-.293v0a1.583,1.583,0,0,0-2.81.276l-1.3,3.341a11.155,11.155,0,0,0,.208,9.8L802,923.25a6.918,6.918,0,0,1,.752,2.759" transform="translate(-797.498 -867.237)" fill="none" stroke="#5e53dd" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
            <path id="Tracciato_53" data-name="Tracciato 53" d="M804.114,982.288l1.4-10.524a1.028,1.028,0,0,1,1.155-.884l9.766,1.3a1.028,1.028,0,0,1,.884,1.154l-1.365,10.278" transform="translate(-801.863 -912.17)" fill="none" stroke="#5e53dd" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
            <path id="Tracciato_54" data-name="Tracciato 54" d="M969.757,927.187v0l-.626-5.366-.837-7.189-.779-6.693a2.78,2.78,0,0,1,1.946-2.977,2.237,2.237,0,0,1,.643-.1,2.174,2.174,0,0,1,2.072,1.528.577.577,0,0,0,.024.071v0c.061.194.119.388.18.578a1.291,1.291,0,0,0,.524.653c.959.684,2.031.371,3.2-.146a3.924,3.924,0,0,0,1.688-1.688v-.007a2.49,2.49,0,0,0,.163-.354l.633-1.7a1.582,1.582,0,0,1,2.957-.02l1.3,3.341a11.155,11.155,0,0,1-.2,9.8l-3.266,6.339a6.849,6.849,0,0,0-.752,2.759" transform="translate(-909.656 -867.237)" fill="none" stroke="#5e53dd" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
            <path id="Tracciato_55" data-name="Tracciato 55" d="M983.41,982.288l-1.4-10.524a1.028,1.028,0,0,0-1.155-.884l-9.766,1.3a1.028,1.028,0,0,0-.884,1.154l1.365,10.278" transform="translate(-911.439 -912.17)" fill="none" stroke="#5e53dd" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
            <path id="Tracciato_56" data-name="Tracciato 56" d="M828.066,848.452a26.879,26.879,0,1,1,51.393-.677v0" transform="translate(-816.817 -808.236)" fill="none" stroke="#5e53dd" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
            <path id="Tracciato_57" data-name="Tracciato 57" d="M886.18,938.44v0a26.879,26.879,0,0,1-43.19.623" transform="translate(-827.512 -890.773)" fill="none" stroke="#5e53dd" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
            </g>
        </svg>
        @break
    @case('patent')
        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" stroke="currentColor" width="75.331" height="50.154"
        {{ $attributes->merge(['class']) }} viewBox="0 0 75.331 50.154">
            <g id="Icon_patente_-_servizi" data-name="Icon patente - servizi" transform="translate(0.75 0.75)">
            <path id="Rettangolo_85" data-name="Rettangolo 85" d="M13.241,0h47.35A13.241,13.241,0,0,1,73.831,13.241V35.413A13.241,13.241,0,0,1,60.591,48.654H13.24A13.24,13.24,0,0,1,0,35.413V13.241A13.241,13.241,0,0,1,13.241,0Z" fill="none" stroke="#7a95db" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
            <g id="Raggruppa_55" data-name="Raggruppa 55" transform="translate(6.478 11.533)">
                <g id="Raggruppa_54" data-name="Raggruppa 54" transform="translate(0.627 3.763)">
                <ellipse id="Ellisse_12" data-name="Ellisse 12" cx="5.917" cy="5.917" rx="5.917" ry="5.917" transform="translate(4.67)" fill="none" stroke="#7a95db" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
                <path id="Tracciato_82" data-name="Tracciato 82" d="M473,591.475c0-5.392,4.74-9.762,10.587-9.762s10.588,4.371,10.588,9.762" transform="translate(-473.002 -569.879)" fill="none" stroke="#7a95db" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
                </g>
                <rect id="Rettangolo_86" data-name="Rettangolo 86" width="22.429" height="25.587" fill="none" stroke="#7a95db" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
            </g>
            <line id="Linea_71" data-name="Linea 71" x2="28.855" transform="translate(36.608 22.646)" fill="none" stroke="#7a95db" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
            <line id="Linea_72" data-name="Linea 72" x2="28.855" transform="translate(36.608 30.546)" fill="none" stroke="#7a95db" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
            <line id="Linea_73" data-name="Linea 73" x2="16.743" transform="translate(36.608 38.447)" fill="none" stroke="#7a95db" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
            <line id="Linea_74" data-name="Linea 74" x1="28.547" transform="translate(36.916 14.746)" fill="none" stroke="#7a95db" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
            <rect id="Rettangolo_87" data-name="Rettangolo 87" width="28.547" height="6.925" transform="translate(36.916 7.821)" fill="none" stroke="#7a95db" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
            </g>
        </svg>
        @break
    @case('prof_training')
        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" stroke="currentColor" width="81.8" height="70.54"
        {{ $attributes->merge(['class']) }} viewBox="0 0 81.8 70.54">
            <g id="Icon_study_prof_-_servizi" data-name="Icon study prof - servizi" transform="translate(0.75 0.75)">
            <g id="Raggruppa_63" data-name="Raggruppa 63">
                <path id="Tracciato_88" data-name="Tracciato 88" d="M143.377,1209.394c-7.595-1-15.646,1.4-22.564,5.575v-41.6h0a30.7,30.7,0,0,1,31.882,0h0v18.57" transform="translate(-115.166 -1168.901)" fill="none" stroke="#74d4ff" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
                <path id="Tracciato_89" data-name="Tracciato 89" d="M214.5,1191.935v-18.57h0a30.7,30.7,0,0,1,31.882,0h0v17.349" transform="translate(-176.971 -1168.901)" fill="none" stroke="#74d4ff" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
                <path id="Tracciato_90" data-name="Tracciato 90" d="M228.982,1198.425a30.617,30.617,0,0,1,23.03.407" transform="translate(-186.525 -1187.026)" fill="none" stroke="#74d4ff" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
                <path id="Tracciato_91" data-name="Tracciato 91" d="M157.084,1198.425a30.618,30.618,0,0,0-23.03.407" transform="translate(-123.901 -1187.026)" fill="none" stroke="#74d4ff" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
                <path id="Tracciato_92" data-name="Tracciato 92" d="M152.113,1228.569a30.621,30.621,0,0,0-18.058,1.858" transform="translate(-123.902 -1207.868)" fill="none" stroke="#74d4ff" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
                <path id="Tracciato_93" data-name="Tracciato 93" d="M146.476,1259.568a30.671,30.671,0,0,0-12.422,2.454" transform="translate(-123.901 -1228.712)" fill="none" stroke="#74d4ff" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
                <path id="Tracciato_94" data-name="Tracciato 94" d="M132.669,1236.862c-9.48-1.152-19.73,2.706-28.449,7.61h0V1201.41h5.349" transform="translate(-104.22 -1190.347)" fill="none" stroke="#74d4ff" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
                <path id="Tracciato_95" data-name="Tracciato 95" d="M314.41,1217.669v-16.26h-5.349" transform="translate(-239.353 -1190.347)" fill="none" stroke="#74d4ff" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
            </g>
            <g id="Raggruppa_64" data-name="Raggruppa 64" transform="translate(28.211 16.951)">
                <path id="Tracciato_96" data-name="Tracciato 96" d="M213.165,1218.712a26.069,26.069,0,1,0,26.044,26.045A26.045,26.045,0,0,0,213.165,1218.712Z" transform="translate(-187.12 -1218.712)" fill="none" stroke="#74d4ff" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
                <path id="Tracciato_97" data-name="Tracciato 97" d="M221.516,1231.371a21.756,21.756,0,1,0,21.736,21.737A21.738,21.738,0,0,0,221.516,1231.371Z" transform="translate(-195.471 -1227.063)" fill="none" stroke="#74d4ff" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
                <path id="Tracciato_98" data-name="Tracciato 98" d="M239.24,1285.128a13.913,13.913,0,0,0-13.551,17.025,21.757,21.757,0,0,1-8.342,0,13.913,13.913,0,0,0-17.042-16.582,21.734,21.734,0,0,1,.231-10.432,125.9,125.9,0,0,1,41.961,0h0a21.765,21.765,0,0,1,.229,10.432A13.833,13.833,0,0,0,239.24,1285.128Z" transform="translate(-195.471 -1254.776)" fill="none" stroke="#74d4ff" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
            </g>
            <circle id="Ellisse_14" data-name="Ellisse 14" cx="4.812" cy="4.812" r="4.812" transform="translate(49.443 39.49)" fill="#fff" stroke="#74d4ff" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
            </g>
        </svg>
        @break
    @case('boat')
        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" stroke="currentColor" width="70.152" height="79.133"
        {{ $attributes->merge(['class']) }} viewBox="0 0 70.152 79.133">
            <g id="Icon_boat_-_servizi" data-name="Icon boat - servizi" transform="translate(1.408 1)">
            <rect id="Rettangolo_164" data-name="Rettangolo 164" width="24.137" height="8.162" transform="translate(21.599 6.906)" fill="none" stroke="#a6cb0d" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/>
            <path id="Tracciato_856" data-name="Tracciato 856" d="M6440.751,1695.5l-8.182-20.209a1.493,1.493,0,0,1,.889-1.969l29.8-9.877a9.116,9.116,0,0,1,5.736,0l29.8,9.877a1.493,1.493,0,0,1,.889,1.969L6491.5,1695.5" transform="translate(-6432.459 -1634.54)" fill="none" stroke="#a6cb0d" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/>
            <path id="Tracciato_857" data-name="Tracciato 857" d="M6506.789,1859.451a8.183,8.183,0,0,0-5.749-2.227c-6.273,0-6.273,5.343-12.546,5.343s-6.275-5.343-12.551-5.343-6.275,5.343-12.551,5.343-6.276-5.343-12.553-5.343a8.184,8.184,0,0,0-5.75,2.227" transform="translate(-6442.271 -1785.435)" fill="none" stroke="#a6cb0d" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/>
            <path id="Tracciato_858" data-name="Tracciato 858" d="M6499.8,1810.549a8.807,8.807,0,0,0-6.273-2.5c-6.846,0-6.846,5.991-13.692,5.991s-6.848-5.991-13.7-5.991-6.849,5.991-13.7,5.991-6.849-5.991-13.7-5.991a8.809,8.809,0,0,0-6.275,2.5" transform="translate(-6432.467 -1747.237)" fill="none" stroke="#a6cb0d" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/>
            <line id="Linea_348" data-name="Linea 348" y1="20.971" transform="translate(33.672 39.752)" fill="none" stroke="#a6cb0d" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/>
            <line id="Linea_349" data-name="Linea 349" x1="28.854" transform="translate(19.24 22.153)" fill="none" stroke="#a6cb0d" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/>
            <line id="Linea_350" data-name="Linea 350" y1="6.906" transform="translate(33.667)" fill="none" stroke="#a6cb0d" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/>
            <path id="Tracciato_859" data-name="Tracciato 859" d="M6482.177,1623.438v-20.362h45.153v20.362" transform="translate(-6471.081 -1588.007)" fill="none" stroke="#a6cb0d" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/>
            </g>
        </svg>
        @break
    @case('prof_patent')
        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" stroke="currentColor" width="82.684" height="51.439"
        {{ $attributes->merge(['class']) }} viewBox="0 0 82.684 51.439">
            <g id="Icon_patente_prof_-_servizi" data-name="Icon patente prof - servizi" transform="translate(0.75 0.75)">
            <path id="Tracciato_361" data-name="Tracciato 361" d="M1611.027,1985.993v-4.175h-53.271" transform="translate(-1533.05 -1951.536)" fill="none" stroke="#01bca0" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
            <path id="Tracciato_362" data-name="Tracciato 362" d="M1694.577,2001.8h9.8v-7.742" transform="translate(-1623.189 -1959.597)" fill="none" stroke="#01bca0" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
            <path id="Tracciato_363" data-name="Tracciato 363" d="M1490.8,1949.53h-2.9a2.56,2.56,0,0,1-2.56-2.56V1931.7a3.173,3.173,0,0,1,.63-1.9l6.71-13.806a3.181,3.181,0,0,1,2.548-1.275h14.818v27.068" transform="translate(-1485.342 -1907.331)" fill="none" stroke="#01bca0" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
            <line id="Linea_271" data-name="Linea 271" x1="0.929" transform="translate(54.977 42.199)" fill="none" stroke="#01bca0" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
            <line id="Linea_272" data-name="Linea 272" x1="18.559" transform="translate(20.938 42.199)" fill="none" stroke="#01bca0" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
            <path id="Tracciato_364" data-name="Tracciato 364" d="M1491.929,1927.85h10.412V1939.3h-16.059" transform="translate(-1485.961 -1915.981)" fill="none" stroke="#01bca0" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
            <path id="Tracciato_365" data-name="Tracciato 365" d="M1486.278,1980.451h5.308v3.4h-5.308" transform="translate(-1485.959 -1950.635)" fill="none" stroke="#01bca0" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
            <g id="Raggruppa_227" data-name="Raggruppa 227" transform="translate(5.456 34.457)">
                <circle id="Ellisse_57" data-name="Ellisse 57" cx="7.741" cy="7.741" r="7.741" transform="translate(0 0)" fill="none" stroke="#01bca0" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
                <circle id="Ellisse_58" data-name="Ellisse 58" cx="4.238" cy="4.238" r="4.238" transform="translate(2.643 10.892) rotate(-76.717)" fill="none" stroke="#01bca0" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
            </g>
            <g id="Raggruppa_228" data-name="Raggruppa 228" transform="translate(39.496 34.457)">
                <circle id="Ellisse_59" data-name="Ellisse 59" cx="7.741" cy="7.741" r="7.741" transform="translate(0 0)" fill="none" stroke="#01bca0" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
                <circle id="Ellisse_60" data-name="Ellisse 60" cx="4.238" cy="4.238" r="4.238" transform="translate(2.643 10.892) rotate(-76.717)" fill="none" stroke="#01bca0" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
            </g>
            <g id="Raggruppa_229" data-name="Raggruppa 229" transform="translate(55.906 34.457)">
                <circle id="Ellisse_61" data-name="Ellisse 61" cx="7.741" cy="7.741" r="7.741" fill="none" stroke="#01bca0" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
                <circle id="Ellisse_62" data-name="Ellisse 62" cx="4.238" cy="4.238" r="4.238" transform="translate(1.748 7.741) rotate(-45)" fill="none" stroke="#01bca0" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
            </g>
            <path id="Tracciato_366" data-name="Tracciato 366" d="M1603.585,1923.344v-20.119h-41.527a4.712,4.712,0,0,1-4.436-3.123l-1.755-4.9a3.231,3.231,0,0,0-3.042-2.141h-11.074v4.587h8.664v25.7Z" transform="translate(-1522.505 -1893.062)" fill="none" stroke="#01bca0" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
            <line id="Linea_273" data-name="Linea 273" x1="67.987" transform="translate(13.197 34.457)" fill="none" stroke="#01bca0" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
            </g>
        </svg>
        @break
    @case('courses')
        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" stroke="currentColor" width="56.832" height="70.54"
        {{ $attributes->merge(['class']) }} viewBox="0 0 56.832 70.54">
            <g id="Icon_study_-_servizi" data-name="Icon study - servizi" transform="translate(0.75 0.75)">
            <rect id="Rettangolo_97" data-name="Rettangolo 97" width="55.207" height="69.04" rx="6" fill="none" stroke="#017c67" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
            <path id="Tracciato_161" data-name="Tracciato 161" d="M814.55,657.12a4.829,4.829,0,0,1,4.829-4.829h45.073a6.8,6.8,0,0,0,5.122-2.325h0" transform="translate(-814.55 -592.909)" fill="none" stroke="#017c67" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
            <path id="Tracciato_162" data-name="Tracciato 162" d="M836.258,667.666h42.468a9.008,9.008,0,0,0,6.051-2.336h0" transform="translate(-829.862 -603.746)" fill="none" stroke="#017c67" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
            <line id="Linea_124" data-name="Linea 124" y2="59.382" transform="translate(7.006)" fill="none" stroke="#017c67" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
            <g id="Raggruppa_101" data-name="Raggruppa 101" transform="translate(12.69 10.351)">
                <path id="Tracciato_163" data-name="Tracciato 163" d="M865.964,567.176v3.072a1.589,1.589,0,0,1-1.658,1.509h-2.557a1.589,1.589,0,0,1-1.658-1.509v-3.072" transform="translate(-859.363 -544.862)" fill="none" stroke="#017c67" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
                <g id="Raggruppa_99" data-name="Raggruppa 99" transform="translate(2.881 14.451)">
                <path id="Tracciato_164" data-name="Tracciato 164" d="M871.965,543.606h-3.378a1.184,1.184,0,0,1-1.184-1.184v-.748a1.184,1.184,0,0,1,1.44-1.156l3.378.748a1.184,1.184,0,0,1,.928,1.156h0A1.185,1.185,0,0,1,871.965,543.606Z" transform="translate(-867.403 -540.488)" fill="none" stroke="#017c67" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
                </g>
                <path id="Tracciato_165" data-name="Tracciato 165" d="M865.869,513.1l-3.284-.169a.653.653,0,0,0-.647.528l-.118.5a.924.924,0,0,0,.784,1.179l2.121.553" transform="translate(-860.563 -506.601)" fill="none" stroke="#017c67" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
                <path id="Tracciato_166" data-name="Tracciato 166" d="M893.209,534.56a.345.345,0,0,0,.345-.345v-6.433a6.428,6.428,0,0,0-6.428-6.428H864.051a6.428,6.428,0,0,0-6.428,6.428v6.433a.345.345,0,0,0,.345.345Z" transform="translate(-857.623 -512.541)" fill="none" stroke="#017c67" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
                <path id="Tracciato_167" data-name="Tracciato 167" d="M957.173,567.176v3.072a1.589,1.589,0,0,0,1.658,1.509h2.557a1.589,1.589,0,0,0,1.658-1.509v-3.072" transform="translate(-927.843 -544.862)" fill="none" stroke="#017c67" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
                <g id="Raggruppa_100" data-name="Raggruppa 100" transform="translate(27.302 14.451)">
                <path id="Tracciato_168" data-name="Tracciato 168" d="M951.475,543.606h3.378a1.185,1.185,0,0,0,1.184-1.184v-.748a1.184,1.184,0,0,0-1.441-1.156l-3.378.748a1.184,1.184,0,0,0-.928,1.156h0A1.184,1.184,0,0,0,951.475,543.606Z" transform="translate(-950.291 -540.488)" fill="none" stroke="#017c67" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
                </g>
                <path id="Tracciato_169" data-name="Tracciato 169" d="M961.567,513.1l3.284-.169a.653.653,0,0,1,.647.528l.118.5a.924.924,0,0,1-.784,1.179l-2.121.553" transform="translate(-930.943 -506.601)" fill="none" stroke="#017c67" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
                <path id="Tracciato_170" data-name="Tracciato 170" d="M900.482,500.239l-.774-3.479c-.7-3.14-3.041-5.321-5.716-5.321H880.98c-2.675,0-5.018,2.181-5.716,5.321l-.774,3.479" transform="translate(-869.521 -491.439)" fill="none" stroke="#017c67" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
            </g>
            <line id="Linea_125" data-name="Linea 125" x2="24.421" transform="translate(18.445 45.196)" fill="none" stroke="#017c67" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
            <line id="Linea_126" data-name="Linea 126" x2="18.528" transform="translate(21.392 50.337)" fill="none" stroke="#017c67" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
            </g>
        </svg>
        @break
@endswitch
