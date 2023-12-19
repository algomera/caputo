<nav class="h-[calc(100vh-96px)] w-[340px] bg-white py-6 shadow-md">
    <div class="px-4">
        {{-- Profile --}}
        <div>
            <h2 class="uppercase text-color-538ef4 font-semibold text-xs mb-5">profilo</h2>
            <x-link_nav routeName="admin.profile" name="profilo" icon="user" />
            <x-link_nav :href="route('admin.schools')" routeName="admin.schools" name="filiali autoscuole" icon="folders" />
            <x-link_nav routeName="admin.courses" name="creazioni corsi" icon="list" />
        </div>
    </div>
</nav>
