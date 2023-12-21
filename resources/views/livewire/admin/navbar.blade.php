<nav class="h-[calc(100vh-96px)] w-72 2xl:w-[340px] bg-white py-6 shadow-md">
    <div class="h-full px-4 flex flex-col justify-between">
        {{-- Profile --}}
        <div>
            <h2 class="uppercase text-color-538ef4 font-semibold text-xs mb-5">Impostazioni</h2>
            <x-link_nav :href="route('admin.schools')" routeName="admin.schools" name="filiali autoscuole" icon="folders" />
            <x-link_nav :href="route('admin.courses')" routeName="admin.courses" name="creazioni corsi" icon="list" />
        </div>

        {{-- <div class="w-full pt-5 px-2 flex items-center justify-end shadow-inner border-t">
        </div> --}}
    </div>
</nav>
