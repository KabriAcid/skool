<div class="bg-white/90 backdrop-blur-sm rounded-xl sm:rounded-2xl p-4 sm:p-5 lg:p-6 shadow-soft border border-white/20">
    <!-- Skeleton Chart Header -->
    <div class="flex items-center justify-between mb-4 sm:mb-5 lg:mb-6">
        <div class="h-5 sm:h-6 bg-spiritual-200 rounded w-24 sm:w-32 skeleton-pulse"></div>
    </div>

    <!-- Skeleton Chart Bars -->
    <div class="space-y-3 sm:space-y-4 mb-4 sm:mb-6">
        @for ($i = 0; $i < 4; $i++)
            <div class="flex items-center gap-2 sm:gap-3">
            <div class="w-16 sm:w-24">
                <div class="h-3 sm:h-4 bg-spiritual-200 rounded skeleton-pulse"></div>
            </div>
            <div class="flex-1">
                <div class="h-6 sm:h-8 bg-spiritual-200 rounded-lg skeleton-pulse"></div>
            </div>
            <div class="w-10 sm:w-12">
                <div class="h-3 sm:h-4 bg-spiritual-200 rounded skeleton-pulse"></div>
            </div>
    </div>
    @endfor
</div>

<!-- Skeleton Stats -->
<div class="pt-4 sm:pt-5 lg:pt-6 border-t border-spiritual-200 grid grid-cols-2 gap-3 sm:gap-4">
    <div class="text-center">
        <div class="h-6 sm:h-8 bg-spiritual-200 rounded w-12 sm:w-16 mx-auto mb-1 sm:mb-2 skeleton-pulse"></div>
        <div class="h-2.5 sm:h-3 bg-spiritual-200 rounded skeleton-pulse"></div>
    </div>
    <div class="text-center">
        <div class="h-6 sm:h-8 bg-spiritual-200 rounded w-12 sm:w-16 mx-auto mb-1 sm:mb-2 skeleton-pulse"></div>
        <div class="h-2.5 sm:h-3 bg-spiritual-200 rounded skeleton-pulse"></div>
    </div>
</div>
</div>