@php
$sectionClass = '';
@endphp

<section data-gsap-anim="section" class="contact -spt {{ $sectionClass }}">

	<div class="__wrapper c-main-wide relative z-2">

		<div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
			<div class="__content w-full flex flex-col justify-between">
				<div class="__data">
					<h2 class="flex m-title w-full">{!! $g_contact_1['title'] !!}</h2>
					<div class="mb-6">{!! $g_contact_1['text'] !!}</div>
					<b class="">Kontakt</b>
					<a class="__phone flex items-center w-max mt-4" href="tel:{{ $g_contact_1['phone'] }}">{{ $g_contact_1['phone'] }}</a>
					<a class="__mail flex items-center w-max" href="mailto:{{ $g_contact_1['phone'] }}">{{ $g_contact_1['mail'] }}</a>
					<b class="block mt-8">Adres</b>
					<div class="__address mt-4">{!! $g_contact_1['adres'] !!}</div>
				</div>
			</div>
			<div class="__form b-border rounded-2xl bg-white p-10 ">
				<h4>{{ $g_contact_2['title'] }}</h4>
				<div class="contact-form-container mt-4">
					{!! do_shortcode($g_contact_2['shortcode']) !!}
				</div>
			</div>
		</div>
	</div>
</section>