@php
$sectionClass = '';
$sectionClass .= $flip ? ' order-flip' : '';
$sectionClass .= $wide ? ' wide' : '';
$sectionClass .= $nomt ? ' !mt-0' : '';
$sectionClass .= $gap ? ' wider-gap' : '';
$sectionClass .= $lightbg ? ' section-light' : '';
$sectionClass .= $graybg ? ' section-gray' : '';
$sectionClass .= $whitebg ? ' section-white' : '';
$sectionClass .= $brandbg ? ' section-brand' : '';
@endphp

<section data-gsap-anim="section" @if($id) id="{{ $id }}" @endif class="returns {{ $sectionClass }} {{ $class }}">
	<div class="">

		@if (!empty($g_returns['title']))
		<h2 class="">{{ strip_tags($g_returns['title']) }}</h2>
		@endif


		<div class="grid gap-4 mt-4">
			@foreach ($g_returns['r_returns'] as $item)
			<div class="__card relative bg-white b-border rounded-2xl flex flex-col md:flex-row justify-between items-start md:items-center gap-4 px-8 py-6">
				<div class="flex flex-col md:flex-row gap-4 items-start md:items-center">
					<img class="" src="{{ $item['card_image']['url'] }}" alt="{{ $item['card_image']['alt'] ?? '' }}" />
					<div>
						<b class="m-title text-xl">{{ $item['card_title'] }}</b>
						<p class="">{!! $item['card_txt'] !!}</p>
					</div>
				</div>
				<p class="text-xl whitespace-nowrap">{{ $item['price'] }}</p>
			</div>
			@endforeach
		</div>

	</div>

</section>