@php

$images = ['/images/hero/hero.webp', '/images/hero/afcon.webp', '/images/hero/audio.webp'];

@endphp

<section class="my-10 mx-5 w-full flex justify-center items-center">
    <div class="flex flex-col justify-center items-center gap-10 w-full  md:w-2/3 h-full">
        <div class="flex justify-center items-center flex-4">
            {{-- <img src="/images/hero/hero.webp" alt="hero" class="w-full h-full" /> --}}
            <x-hero-slider :images="$images" />
        </div>

        <div class="flex flex-1 flex-col items-center justify-between gap-8 md:flex-row w-4/5">
            <div class="flex flex-col md:flex-row lg:h-12 w-full lg:divide-x lg:overflow-hidden rounded-lg lg:border">
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
    </div>
</section>