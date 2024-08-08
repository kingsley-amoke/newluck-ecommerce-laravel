@php

$images = ['/images/hero/audio.webp', "https://cdn.euromart.com/media/images/smartphones-and-accessories-1-10-3522964.jpg", "https://s.yimg.com/ny/api/res/1.2/kNtxEBZn9MOQP3EzJ_qrLA--/YXBwaWQ9aGlnaGxhbmRlcjt3PTk2MDtoPTQ4MDtjZj13ZWJw/https://media.zenfs.com/en/accesswire.ca/f201f5588227ca44dca32a5e3d9de78b", '/images/hero/hero.webp', '/images/hero/afcon.webp',];

@endphp

<section class="my-10 px-5 w-full lg:w-2/3 lg:ml-[50%] lg:-translate-x-[50%] flex justify-center items-center">
    <x-hero-slider :images="$images" />
</section>
<section class="flex justify-center items-center w-full md:w-2/3 lg:ml-[50%] lg:-translate-x-[50%]">

<div class="flex flex-1 flex-col items-center justify-between gap-8 lg:flex-row w-4/5 mx-10">
    <div class="flex flex-col lg:flex-row lg:h-12 w-full lg:divide-x lg:overflow-hidden rounded-lg lg:border">
        <div class="flex w-[80%] lg:w-1/3 items-center justify-start lg:justify-center gap-5">
            <ShieldCheck />
            <div>

                100% Guarantee
            </div>
        </div>
        <div class="flex w-[80%] lg:w-1/3 items-center justify-start lg:justify-center gap-5">
            <Ship />
            <div>

                Free shipping
            </div>
        </div>
        <div class="flex w-[80%] lg:w-1/3 items-center justify-start lg:justify-center gap-5">
            <DollarSign />
            <div>

                Cash on Delivery
            </div>
        </div>
    </div>
</div>
</section>
