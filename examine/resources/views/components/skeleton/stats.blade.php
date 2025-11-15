<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4 lg:gap-6">
    @for ($i = 0; $i < 4; $i++)
        <div class="bg-white/90 backdrop-blur-sm rounded-xl sm:rounded-2xl p-3 sm:p-4 lg:p-6 shadow-soft border border-white/20">
        <div class="flex items-center justify-between gap-2 sm:gap-3">
            <div class="flex-1">
                <div class="h-2 sm:h-3 bg-spiritual-200 rounded w-16 sm:w-20 mb-1 sm:mb-2 skeleton-pulse"></div>
                <div class="h-6 sm:h-8 bg-spiritual-200 rounded w-20 sm:w-24 skeleton-pulse"></div>
            </div>
            <div class="w-8 h-8 sm:w-10 sm:h-10 lg:w-12 lg:h-12 bg-spiritual-200 rounded-lg sm:rounded-xl skeleton-pulse flex-shrink-0"></div>
        </div>
        <div class="mt-2 sm:mt-3 lg:mt-4 h-1.5 sm:h-2 bg-spiritual-200 rounded skeleton-pulse"></div>
</div>
@endfor
</div>