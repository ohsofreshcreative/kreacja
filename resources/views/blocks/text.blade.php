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

<!--- text -->

<section data-gsap-anim="section" @if($id) id="{{ $id }}" @endif class="text relative {{ $sectionClass }} {{ $class }}">

	<div class="__wrapper relative">
		<div data-gsap-element="txt" class="mt-2">
			{!! $g_text['content'] !!}
		</div>
	</div>

</section>